
<?php
include('config.php');
?>
<?php
include('Template/config.php');
?>
<?php
$conn = new mysqli("$server", "$username", "$password", "$db");
 
$sql = "SELECT * FROM `tblusers`";
 
$connStatus = $conn->query($sql);
 
$numberOfRows = mysqli_num_rows($connStatus);
 
$conn->close();
?>
  <body>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
          <script type="text/javascript"> 
function disableselect(e){  
return false  
}  

function reEnable(){  
return true  
}  

//if IE4+  
document.onselectstart=new Function ("return false")  
document.oncontextmenu=new Function ("return false")  
//if NS6  
if (window.sidebar){  
document.onmousedown=disableselect  
document.onclick=reEnable  
}
</script>
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b><?php echo $brandname; ?></b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.php">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme"><?php echo "$numberOfRows"; ?>
</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have <?php echo "$numberOfRows"; ?> pending tasks on your to do list!</p>
                            </li>
                        </ul>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                   <p>Please note your using a demo so things are disabled.</p>
                    </li>
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
                </ul>
            </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user-circle fa-2x"></i>
                                    <p class="hidden-lg hidden-md">Profile</p>
                                    <p class="hidden-lg hidden-md">Notifications</p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="logout.php">Logout <? echo $_SESSION['username']; ?></a>
                                    </li>
                                    <li>
                                        <a href="license.php">License Settings</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
        </header>
      <!--header end-->