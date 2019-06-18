<?php
/**
 * WHMCS Licensing Addon - Integration Code Sample
 * http://www.whmcs.com/addons/licensing-addon/
 *
 * The following code is a fully working code sample demonstrating how to
 * perform license checks using the WHMCS Licensing Addon. It is PHP 4 and
 * 5 compatible.  Requires the WHMCS Licensing Addon to be used.
 *
 * @package    WHMCS
 * @author     WHMCS Limited <development@whmcs.com>
 * @copyright  Copyright (c) WHMCS Limited 2005-2014
 * @license    http://www.whmcs.com/license/ WHMCS Eula
 * @version    $Id$
 * @link       http://www.whmcs.com/
 */

/**
 * This is just example code, and is not intended to be invoked directly.
 *
 * To ensure this code isn't unintentionally invoked on the command line or
 * via the web interface, any attempt to actually execute this code will
 * be exited:
 */
/**
 * If you are using this file as a template for your own module, once
 * you've modified the code for your use, remove the exit above.
 */

// Replace "yourprefix" with your own unique prefix to avoid conflicts with
// other instances of the licensing addon included within the same scope
function licensetest_check_license($licensekey, $localkey='') {

    // -----------------------------------
    //  -- Configuration Values --
    // -----------------------------------

    // Enter the url to your WHMCS installation here
    $whmcsurl = 'https://hostable.xyz/billing/';
    // Must match what is specified in the MD5 Hash Verification field
    // of the licensing product that will be used with this check.
    $licensing_secret_key = 'dhdhsgfd';
    // The number of days to wait between performing remote license checks
    $localkeydays = 15;
    // The number of days to allow failover for after local key expiry
    $allowcheckfaildays = 5;

    // -----------------------------------
    //  -- Do not edit below this line --
    // -----------------------------------

    $check_token = time() . md5(mt_rand(1000000000, 9999999999) . $licensekey);
    $checkdate = date("Ymd");
    $domain = $_SERVER['SERVER_NAME'];
    $usersip = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : $_SERVER['LOCAL_ADDR'];
    $dirpath = dirname(__FILE__);
    $verifyfilepath = 'modules/servers/licensing/verify.php';
    $localkeyvalid = false;
    if ($localkey) {
        $localkey = str_replace("\n", '', $localkey); # Remove the line breaks
        $localdata = substr($localkey, 0, strlen($localkey) - 32); # Extract License Data
        $md5hash = substr($localkey, strlen($localkey) - 32); # Extract MD5 Hash
        if ($md5hash == md5($localdata . $licensing_secret_key)) {
            $localdata = strrev($localdata); # Reverse the string
            $md5hash = substr($localdata, 0, 32); # Extract MD5 Hash
            $localdata = substr($localdata, 32); # Extract License Data
            $localdata = base64_decode($localdata);
            $localkeyresults = unserialize($localdata);
            $originalcheckdate = $localkeyresults['checkdate'];
            if ($md5hash == md5($originalcheckdate . $licensing_secret_key)) {
                $localexpiry = date("Ymd", mktime(0, 0, 0, date("m"), date("d") - $localkeydays, date("Y")));
                if ($originalcheckdate > $localexpiry) {
                    $localkeyvalid = true;
                    $results = $localkeyresults;
                    $validdomains = explode(',', $results['validdomain']);
                    if (!in_array($_SERVER['SERVER_NAME'], $validdomains)) {
                        $localkeyvalid = false;
                        $localkeyresults['status'] = "Invalid";
                        $results = array();
                    }
                    $validips = explode(',', $results['validip']);
                    if (!in_array($usersip, $validips)) {
                        $localkeyvalid = false;
                        $localkeyresults['status'] = "Invalid";
                        $results = array();
                    }
                    $validdirs = explode(',', $results['validdirectory']);
                    if (!in_array($dirpath, $validdirs)) {
                        $localkeyvalid = false;
                        $localkeyresults['status'] = "Invalid";
                        $results = array();
                    }
                }
            }
        }
    }
    if (!$localkeyvalid) {
        $responseCode = 0;
        $postfields = array(
            'licensekey' => $licensekey,
            'domain' => $domain,
            'ip' => $usersip,
            'dir' => $dirpath,
        );
        if ($check_token) $postfields['check_token'] = $check_token;
        $query_string = '';
        foreach ($postfields AS $k=>$v) {
            $query_string .= $k.'='.urlencode($v).'&';
        }
        if (function_exists('curl_exec')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $whmcsurl . $verifyfilepath);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($ch);
            $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        } else {
            $responseCodePattern = '/^HTTP\/\d+\.\d+\s+(\d+)/';
            $fp = @fsockopen($whmcsurl, 80, $errno, $errstr, 5);
            if ($fp) {
                $newlinefeed = "\r\n";
                $header = "POST ".$whmcsurl . $verifyfilepath . " HTTP/1.0" . $newlinefeed;
                $header .= "Host: ".$whmcsurl . $newlinefeed;
                $header .= "Content-type: application/x-www-form-urlencoded" . $newlinefeed;
                $header .= "Content-length: ".@strlen($query_string) . $newlinefeed;
                $header .= "Connection: close" . $newlinefeed . $newlinefeed;
                $header .= $query_string;
                $data = $line = '';
                @stream_set_timeout($fp, 20);
                @fputs($fp, $header);
                $status = @socket_get_status($fp);
                while (!@feof($fp)&&$status) {
                    $line = @fgets($fp, 1024);
                    $patternMatches = array();
                    if (!$responseCode
                        && preg_match($responseCodePattern, trim($line), $patternMatches)
                    ) {
                        $responseCode = (empty($patternMatches[1])) ? 0 : $patternMatches[1];
                    }
                    $data .= $line;
                    $status = @socket_get_status($fp);
                }
                @fclose ($fp);
            }
        }
        if ($responseCode != 200) {
            $localexpiry = date("Ymd", mktime(0, 0, 0, date("m"), date("d") - ($localkeydays + $allowcheckfaildays), date("Y")));
            if ($originalcheckdate > $localexpiry) {
                $results = $localkeyresults;
            } else {
                $results = array();
                $results['status'] = "Invalid";
                $results['description'] = "Remote Check Failed";
                return $results;
            }
        } else {
            preg_match_all('/<(.*?)>([^<]+)<\/\\1>/i', $data, $matches);
            $results = array();
            foreach ($matches[1] AS $k=>$v) {
                $results[$v] = $matches[2][$k];
            }
        }
        if (!is_array($results)) {
            die("Invalid License Server Response");
        }
        if ($results['md5hash']) {
            if ($results['md5hash'] != md5($licensing_secret_key . $check_token)) {
                $results['status'] = "Invalid";
                $results['description'] = "MD5 Checksum Verification Failed";
                return $results;
            }
        }
        if ($results['status'] == "Active") {
            $results['checkdate'] = $checkdate;
            $data_encoded = serialize($results);
            $data_encoded = base64_encode($data_encoded);
            $data_encoded = md5($checkdate . $licensing_secret_key) . $data_encoded;
            $data_encoded = strrev($data_encoded);
            $data_encoded = $data_encoded . md5($data_encoded . $licensing_secret_key);
            $data_encoded = wordwrap($data_encoded, 80, "\n", true);
            $results['localkey'] = $data_encoded;
        }
        $results['remotecheck'] = true;
    }
    unset($postfields,$data,$matches,$whmcsurl,$licensing_secret_key,$checkdate,$usersip,$localkeydays,$allowcheckfaildays,$md5hash);
    return $results;
}

// Get the license key and local key from storage
// These are typically stored either in flat files or an SQL database

$licensekey = "";
$localkey = "";

$base = __DIR__;
$handle = fopen($base."/Template/license.txt", "r");
if ($handle) {
    $count = 0;
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        if ($count == 0) {
            $licensekey = trim($line);
        } else if ($count == 1) {
            $localkey = trim($line);
            break;
        }
        $count++;
    }
    fclose($handle);
} else {
    die("Could not read license file. Please contact support.");
}
// Validate the license key information
$results = licensetest_check_license($licensekey, $localkey);
// Raw output of results for debugging purpose
// Interpret response
switch ($results['status']) {
    case "Active":
        // get new local key and save it somewhere
        $localkeydata = str_replace(' ','',preg_replace('/\s+/', ' ', $results['localkey']));
        $handle = fopen($base."/Template/license.txt", "r");
        if ($handle) {
            $count = 0;
            while (($line = fgets($handle)) !== false) {
                // process the line read.
                if ($count == 0) {
                    $licensekey = trim($line);
                    break;
                }
                $count++;
            }
            fclose($handle);
            if (isset($results['localkey'])) {
                $textfile = fopen($base . "/Template/license.txt", "w") or die("Unable to open file!");
                $contents = $licensekey . "\n" . $localkeydata . "\n";
                fwrite($textfile, $contents);
                fclose($textfile);
            }
        } else {
            die("Could not read license file. Please contact support.");
        }
        break;
    case "Invalid":
        die("License key is Invalid");
        break;
    case "Expired":
        die("License key is Expired");
        break;
    case "Suspended":
        die("License key is Suspended");
        break;
    default:
        die("Invalid Response");
        break;
}
?>
<?php
include('Template/top.php');
include('Template/config.php');
?>
<style>
body {
    background-color: #282B30 !important;
}
</style>
<body>
    <div>
        <div>
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                    </div>
                </div>
            </nav>
<body onload="getList()">
	<div class="mainContainer">
		<header>
		  <center><h1><font color="white">Report A Bug</font></h1></center>
		</header>
<script>
  function checkForm(form)
  {
    ...
    if(!form.terms.checked) {
      alert("Please indicate that you accept the Terms and Conditions");
      form.terms.focus();
      return false;
    }
    return true;
  }
</script>
		<div class="container" ... onsubmit="return checkForm(this);">
			<label>Report A Bug To Us</label>
			<input class="form-control" type="text" id="user" placeholder="Write something here...">
            <button type="button" class="btn btn-primary buttonArea" onclick="addUser(); loadPage();">Submit</button>
            <br>
            <br>
            <p id="myBtn"><font color="white">Clicking Submit means you agree to our Terms. You can read them by clicking me!</font></p>
		</div>
		<div class="container list-group">
			<hr>
			<label>Reported Bugs:</label>
			<ul id="userList"></ul>
		</div>
	</div>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p><?php echo $terms; ?></p>
  </div>
</div>
<script>
var modal = document.getElementById('myModal');

var btn = document.getElementById("myBtn");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="scriptbugsreported.js"></script>
</body>
           <br>
<?php
include('Template/footer.php');
?>
        </div>
    </div>
</body>

</html>