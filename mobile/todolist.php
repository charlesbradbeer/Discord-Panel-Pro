<?php
include('Template/top.php');
include('Template/nav.php');
?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.html">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Bugs</li>
      </ol>
      <div class="row">
        <div class="col-12">
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
	<script type="text/javascript" src="../Template/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</body>

                              <div class=" add-task-row">
                                  <input class="form-control" type="text" id="user" placeholder="Write A New Task Here...."><button type="button" class="btn btn-success btn-sm pull-left" onclick="addUser(); loadPage();">Add A Bug</button>
                              </div>
                          </div>
<script type="text/javascript" src="../Template/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
                      </section>
                  </div><!-- /col-md-12-->
              </div><!-- /row -->        </div>
      </div>
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
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
  </div>
</body>

</html>
