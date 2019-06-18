
<?php
include('Template/top.php');
?>
<?php
include('Template/config.php');
?>
<? 

/* DISCORD OAUTH */

$json = file_get_contents('Template/bot1Owners.json','Template/bot2Owners.json','Template/bot3Owners.json','Template/bot4Owners.json','Template/bot5Owners.json','Template/bot6Owners.json');

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
                      <a href="bot5.php" >
                          <i class="fa fa-book"></i>
                          <span><?php echo $bot5; ?></span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="bot5.php" >
                          <i class="fa fa-tasks"></i>
                          <span><?php echo $bot6; ?></span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a  href="todo_list.php" >
                          <i class="fa fa-th"></i>
                          <span>To Do List</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="bugs.php" >
                          <i class="active" class=" fa fa-bar-chart-o"></i>
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
          	<h3><i class="fa fa-angle-right"></i> Bugs</h3>
          		

          	<!-- COMPLEX TO DO LIST -->			
              <div class="row mt">
                  <div class="col-md-12">
                      <section class="task-panel tasks-widget">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> Bug List</h5></div>
	                        <br>
	                 	</div>
                          <div class="panel-body">
<body onload="getList()">
	<div>
		<div>
			<hr>
			<ul id="userList"></ul>
		</div>
	</div>
<script type="text/javascript" src="Template/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="scriptbug.js"></script>
</body>

                              <div class=" add-task-row">
                                  <input class="form-control" type="text" id="user" placeholder="Write A New Task Here...."><button type="button" class="btn btn-success btn-sm pull-left" onclick="addUser(); loadPage();">Add A Bug</button>
                              </div>
                          </div>
<script type="text/javascript" src="Template/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="scriptbug.js"></script>
                      </section>
                  </div><!-- /col-md-12-->
              </div><!-- /row -->
					
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