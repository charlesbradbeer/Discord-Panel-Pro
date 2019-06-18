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
<? 

/* DISCORD OAUTH */

$json = file_get_contents('Template/bot5Owners.json');

$owners = json_decode($json, true);

if (is_array($owners)) {

    foreach ($owners as $obj) {

        $ownerID = $obj['id'];

        if ($_SESSION['user_id'] == $ownerID) {

            $x = 1;
    
        }else{

        }   
    }
}

if($x == 1){

}else{

    $x = 0;
    header("Location: error.php");
    die();   

}


?>
<?php
include('Net/SSH2.php');
#Log in
$ip = "$bot5IP";
$user = "$bot5User";
$password = "$bot5Password";
$ssh = new Net_SSH2($ip);
if (!$ssh->login($user, $password)) {
    exit('<!DOCTYPE html><html><style>body {background: #fff;font: 16px Georgia, serif;line-height: 1.3;margin: 0;padding: 0;}#content {background: #fff url(/wp-content/dberror.png) no-repeat left top;height: 225px;margin: 80px auto 0;padding: 75px 50px 0 300px;width: 375px;}h1 {font-size: 34px;font-weight: normal;margin-top: 0;}p {margin: 0 0 10px 5px;}</style><div id="content"><h1>A error has arrived...</h1><p>Looks like the server login details do not work...</p><p>No need to worry though! Its fixable!<p><p>You can try these steps to fix it:<p> <ul><li>Check config file to see if there there</li><li>See if the login details are right</li><li>Check if the server is up and working</li></ul> <p>If none of these work join the offical discord server for support:<a href="https://discord.gg/fezkDt6"> Here</a>.<p></div>');
}
?>
<?php
include('Template/header.php');
?>
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
     <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><center><iframe src="Template/user.php" frameBorder="0"></iframe></center></p>
              	  <h5 class="centered"><? echo $_SESSION['username'];?></h5>
              	  	
                  <li class="mt">
                      <a href="index.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Main</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="bot1.php" >
                          <i class="fa fa-desktop"></i>
                          <span><?php echo $bot1; ?></span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="bot2.php" >
                          <i class="fa fa-cogs"></i>
                          <span><?php echo $bot2; ?></span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="bot3.php" >
                          <i class="fa fa-book"></i>
                          <span><?php echo $bot3; ?></span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="bot4.php" >
                          <i class="fa fa-tasks"></i>
                          <span><?php echo $bot4; ?></span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a class="active" href="bot5.php" >
                          <i class="fa fa-book"></i>
                          <span><?php echo $bot5; ?></span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="bot6.php" >
                          <i class="fa fa-tasks"></i>
                          <span><?php echo $bot6; ?></span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="todo_list.php" >
                          <i class="fa fa-th"></i>
                          <span>To Do List</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="bugs.php" >
                          <i class=" fa fa-bar-chart-o"></i>
                          <span>Bugs</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> <?php echo $bot5; ?> Panel</h3>
          	
          	<!-- SIMPLE TO DO LIST -->
          	<div class="row mt">
          		<div class="col-md-12">
          			<div class="white-panel pn">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> <?php echo $bot5; ?> Controls</h5></div>
	                        <br>
	                 	</div>
				  		<div class="custom-check goleft mt">
						<h5> About <?php echo $bot5; ?>:</h5>
						<p><?php echo $Bot5about; ?></p>
<br>
<br>
<br>
<br>
<br>

<?php
if(!empty($_POST['lobby-stop'])) { #Watch if the button is pressed
    $ssh->exec('killall -9 node'); #Execution in SSH
}
if(!empty($_POST['lobby-restart'])) { #Watch if the button is pressed
    $ssh->exec('cd /$bot1location; node bot.js'); #Execution in SSH
}
?>
   <form method="post" action=""> 
   <center><input type="submit" name="lobby-stop" value="Stop" class="btn btn-success">  <input type="submit" name="lobby-restart" value="Start" class="btn btn-danger"/></center>

						</div><!-- /table-responsive -->
					</div><!--/ White-panel -->
          		</div><! --/col-md-12 -->
          	</div><! -- row -->
          	             <div>
                      		<div class="white-panel pn">
                      			<div class="white-header">
						  			<h5><?php echo $bot5; ?></h5>
                      			</div>
                      			<iframe src="Template/homepanel5.php" frameBorder="0" height="300"></iframe>
                      		</div>
                      	</div><!-- /col-md-4 --><br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->
	  

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2017-2018 DiscordPanel
              <a href="index.php" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="Template/assets/js/jquery.js"></script>
    <script src="Template/assets/js/jquery-1.8.3.min.js"></script>
    <script src="Template/assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="Template/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="Template/assets/js/jquery.scrollTo.min.js"></script>
    <script src="Template/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="Template/assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="Template/assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="Template/assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="Template/assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="Template/assets/js/sparkline-chart.js"></script>    
	<script src="Template/assets/js/zabuto_calendar.js"></script>	
	
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  

  </body>
</html>