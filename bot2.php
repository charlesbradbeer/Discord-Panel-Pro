
<?php
include('Template/top.php');
include('Template/config.php');
?>
<? 

/* DISCORD OAUTH */

$json = file_get_contents('Template/bot2Owners.json');

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
$ip = "$bot1IP";
$user = "$bot2User";
$password = "$bot2Password";
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
                      <a class="active" href="bot2.php" >
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
          	<h3><i class="fa fa-angle-right"></i> <?php echo $bot2; ?> Panel</h3>
          	
          	<!-- SIMPLE TO DO LIST -->
          	<div class="row mt">
          		<div class="col-md-12">
          			<div class="white-panel pn">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> <?php echo $bot2; ?> Controls</h5></div>
	                        <br>
	                 	</div>
				  		<div class="custom-check goleft mt">
						<h5> About <?php echo $bot2; ?>:</h5>
						<p><?php echo $Bot2about; ?></p>
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
   <center><input type="submit" name="lobby-stop" value="Stop" class="btn btn-success"> <input type="submit" name="lobby-restart" value="Start" class="btn btn-danger"/></center>

						</div><!-- /table-responsive -->
					</div><!--/ White-panel -->
          		</div><! --/col-md-12 -->
          	</div><! -- row -->
          	             <div>
                      		<div class="white-panel pn">
                      			<div class="white-header">
						  			<h5><?php echo $bot2; ?></h5>
                      			</div>
                      			<iframe src="Template/homepanel2.php" frameBorder="0" height="300"></iframe>
                      		</div>
                      	</div><!-- /col-md-4 -->
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