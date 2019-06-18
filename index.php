
<?php
include('Template/top.php');
include('Template/header.php');
include('Template/config.php');
?>
<?php
$conn = new mysqli("$server", "$username", "$password", "$db");
 
$sql = "SELECT * FROM `tblusers`";
 
$connStatus = $conn->query($sql);
 
$numberOfRows = mysqli_num_rows($connStatus);
 
$conn->close();
?>
<?php
$conn = new mysqli("$server", "$username", "$password", "$db");
 
$sql = "SELECT * FROM `tblbugs`";
 
$connStatus = $conn->query($sql);
 
$numberOfRowsBugs = mysqli_num_rows($connStatus);
 

$conn->close();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
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
                      <a class="active" href="index.php">
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
                      <a href="bot5.php" >
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

              <div class="row">
                  <div class="col-lg-9 main-chart">
                  
                  	<div class="row mtbox">
                  		<div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                           <center>BUG COUNT:</center>
                  			<div class="box1">
					  			<h3><font color="red"><?php echo "$numberOfRowsBugs"; ?></font></h3>
                  			</div>
					  			<p>Amout of bugs you currently have reported!</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                           <center>TO DO COUNT:</center>
                  			<div class="box1">
					  			<h3><?php echo "$numberOfRows"; ?></h3>
                  			</div>
					  			<p>Amout of items on your To Do List!</p>
                  		</div>
                  	 

                  	 <div class="col-md-2 col-sm-2 box0">
                  	       <center>SQL SERVER:</center>
                  			<div class="box1">
					  			<span class="li_stack"></span>
					  			<h3><?php

// Create connection
$conn = mysqli_connect($server, $username, $password, $db);

// Check connection
if (!$conn) {
    die("ERROR!" . mysqli_connect_error());
}
echo "OK!";
?></h3>
                  			</div>
					  			<p>See if your SQL server is working</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  	       <center>PHP VERSION:</center>
                  			<div class="box1">
					  			<span class="li_news"></span>
					  			<h3><?php
echo '' . phpversion();
?></h3>
                  			</div>
					  			<p>The current php version.</p>
                  		</div>
                  		<?php
                        $url = file_get_contents('https://discordpanel.xyz/proversion12.php');
                        echo $url; 
                        ?>
                  	
                  	</div><!-- /row mt -->	

                      
                      <div class="row mt">
                      	<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn">
                      			<div class="white-header">
						  			<h5><?php echo $bot1; ?></h5>
						  			<img src="https://discordbots.org/api/widget/status/<?php echo $bot1ID; ?>.svg" alt="Bot Status"><br><br>
<img src="https://discordbots.org/api/widget/servers/<?php echo $bot1ID; ?>.svg" alt="Bot Servers"><br><br><img src="https://discordbots.org/api/widget/owner/<?php echo $bot1ID; ?>.svg" alt="Bot Owner">
                    <br>
                    <br>
                    <br>
                    <style>
.button {
  background-color: #FFD777; /* Green */
  border: none;
  color: white;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
.button4 {border-radius: 12px;}
</style>
<button class="button button4">Control</button>
                      			</div>
                      		</div>
                      	</div><!-- /col-md-4 -->
                      	

                      	<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn">
                      			<div class="white-header">
						  			<h5><?php echo $bot2; ?></h5>
<img src="https://discordbots.org/api/widget/status/<?php echo $bot2ID; ?>.svg" alt="Bot Status"><br><br>
<img src="https://discordbots.org/api/widget/servers/<?php echo $bot2ID; ?>.svg" alt="Bot Servers"><br><br><img src="https://discordbots.org/api/widget/owner/<?php echo $bot2ID; ?>.svg" alt="Bot Owner">
                    <br>
                    <br>
                    <br>
                    <style>
.button {
  background-color: #FFD777; /* Green */
  border: none;
  color: white;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
.button4 {border-radius: 12px;}
</style>
<button class="button button4">Control</button>
                      			</div>
                      			</div>
                      	</div><!-- /col-md-4 -->
                      	
						<div class="col-md-4 mb">
                      		<div class="white-panel pn">
                      			<div class="white-header">
						  			<h5><?php echo $bot3; ?></h5>
<img src="https://discordbots.org/api/widget/status/<?php echo $bot3ID; ?>.svg" alt="Bot Status"><br><br>
<img src="https://discordbots.org/api/widget/servers/<?php echo $bot3ID; ?>.svg" alt="Bot Servers"><br><br><img src="https://discordbots.org/api/widget/owner/<?php echo $bot3ID; ?>.svg" alt="Bot Owner">
                    <br>
                    <br>
                    <br>
                    <style>
.button {
  background-color: #FFD777; /* Green */
  border: none;
  color: white;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
.button4 {border-radius: 12px;}
</style>
<button class="button button4">Control</button>
                      			</div>
                      			</div>

                      		</div>
						</div><!-- /col-md-4 -->
                      	

                    </div><!-- /row -->
                    
                    		
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
<style type="text/css" media="screen">
    #footert11 {
        position: fixed;
        bottom: 0;
    }
</style>  
<div id="footert11" style="width:100%;">
                  
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
      <!--footer end--></div>

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
