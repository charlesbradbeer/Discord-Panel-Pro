<?php
include('../Template/config.php');
?>
<?php

$link = mysql_connect("$server", "$username", "$password");
mysql_select_db("$db", $link);

$result = mysql_query("SELECT * FROM tblusers", $link);
$num_rows = mysql_num_rows($result);

$result1 = mysql_query("SELECT * FROM tblbugs", $link);
$num_rows1 = mysql_num_rows($result1);
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php"><?php echo $brandname; ?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fas fa-tachometer-alt"></i>
            <span class="nav-link-text">Main</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="bot1.php">
            <i class="fab fa-discord"></i>
            <span class="nav-link-text"><?php echo $bot1; ?></span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="bot2.php">
            <i class="fab fa-discord"></i>
            <span class="nav-link-text"><?php echo $bot2; ?></span>
          </a>
        </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="bot3.php">
            <i class="fab fa-discord"></i>
            <span class="nav-link-text"><?php echo $bot3; ?></span>
          </a>
        </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="bot4.php">
            <i class="fab fa-discord"></i>
            <span class="nav-link-text"><?php echo $bot4; ?></span>
          </a>
        </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="bot5.php">
            <i class="fab fa-discord"></i>
            <span class="nav-link-text"><?php echo $bot5; ?></span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="bot6.php">
            <i class="fab fa-discord"></i>
            <span class="nav-link-text"><?php echo $bot6; ?></span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="bugs.php">
            <i class="fas fa-bug"></i>
            <span class="nav-link-text">Bugs</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link mr-lg-2" href="todolist.php"aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Tasks
              <span class="badge badge-pill badge-warning">You have <?php echo "$num_rows"; ?> New Tasks</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link mr-lg-2" href="bugs.php"aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bug"></i>
            <span class="d-lg-none">Bugs
              <span class="badge badge-pill badge-warning">You have <?php echo "$num_rows1"; ?> New Bugs</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
      </ul>
    </div>
  </nav>