<?php
include('Template/top.php');
include('Template/nav.php');
include('../Template/config.php');
?>
<?php

$link = mysql_connect("$server", "$username", "$password");
mysql_select_db("$db", $link);

$result = mysql_query("SELECT * FROM tblusers", $link);
$num_rows = mysql_num_rows($result);


?>
<?php

$link = mysql_connect("$server", "$username", "$password");
mysql_select_db("$db", $link);

$result = mysql_query("SELECT * FROM tblbugs", $link);
$num_rows1 = mysql_num_rows($result);


?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-bug"></i>
              </div>
              <div class="mr-5">Bug Count: <?php echo "$num_rows1"; ?></div>
            </div>
              <span class="float-right">
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5">To Do Count: <?php echo "$num_rows"; ?></div>
            </div>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-server"></i>
              </div>
              <div class="mr-5">SQL Server: <?php

// Create connection
$conn = mysqli_connect($server, $username, $password, $db);

// Check connection
if (!$conn) {
    die("ERROR!" . mysqli_connect_error());
}
echo "OK!";
?></h3></div>
            </div>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-support"></i>
              </div>
              <div class="mr-5">PHP Version: <?php
echo '' . phpversion();
?></h3></div>
            </div>
              </span>
            </a>
          </div>
        </div>
      </div>

                      <hr>
                      <div class="row mt">
                      	<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn">
                      			<div class="white-header">
						  			<center><h5><?php echo $bot1; ?></h5></center>
                      			</div>
                      			<iframe src="../Template/homepanel1.php" frameBorder="0" height="300"></iframe>
                      		</div>
                      	</div><!-- /col-md-4 -->
                      	<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn">
                      			<div class="white-header">
						  			<center><h5><?php echo $bot2; ?></h5></center>
                      			</div>
                      			<iframe src="../Template/homepanel2.php" frameBorder="0" height="300"></iframe>
                      		</div>
                      	</div><!-- /col-md-4 -->
						<div class="col-md-4 mb">
                      		<div class="white-panel pn">
                      			<div class="white-header">
						  			<center><h5><?php echo $bot3; ?></h5></center>
                      			</div>
                      			<iframe src="../Template/homepanel3.php" frameBorder="0" height="300"></iframe>
                      		</div>
						</div><!-- /col-md-4 -->
					</div><!-- /row -->
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>2017-2018 DiscordPanel</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
