<style>
body{
  margin-top: 70px!important;
}
</style>
<link href="<?php echo base_url() ?>assets/css/datepicker.css" rel="stylesheet" type="text/css" />
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">

<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand"> <img src="../../assets/img/ignitorlabslogo_p.png"  style="width: 160px;margin-top:-15px" alt="Ignitor Labs">

        <span style="position:relative; top: 5px; left: 10px; font-size: 24px;">

          <i class='glyphicon glyphicon-chevron-right' style="font-size: 16px; top: -2px; color: #50284a;"></i> Project Tracker
        </span>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    
      <!--<ul class="nav navbar-nav navbar-right">
        <li><a href="javascript:void(0)" id="newProjectLink">Add New Project</a></li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $username;?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="home/logout">Log Out</a></li>
          </ul>
        </li> -->
      <ul class="nav navbar-nav navbar-right">

        <li><a><?php echo $username;?></a></li>
        <?php
        if(isset($project)){
        ?>
        <li><a href="../../home"><span class='glyphicon glyphicon-cog'></span> Admin Home</a></li>

        <?php
        } 
        if(!isset($project)){
        ?>
        <li><a href="javascript:void(0)" id="newProjectLink"><span class="glyphicon glyphicon-plus"></span> Add New Project</a></li>
        <?php 
        }
        ?>

        <li><a href="../home/logout"><span class='glyphicon glyphicon-log-out'></span> Log Out</a></li>




      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="spacer"></div>