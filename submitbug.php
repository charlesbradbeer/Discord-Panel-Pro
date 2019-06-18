
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