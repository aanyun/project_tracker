<style>
body{
  margin-top: 70px!important;
}
</style>
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

        <span>

          <i class='glyphicon glyphicon-chevron-right' style="font-size: 16px; top: -2px; color: #50284a;"></i> Project Tracker
        </span>
      </a>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<!--       <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form> -->
      <ul class="nav navbar-nav navbar-right">

        <li><a class ="popover-dismiss" data-toggle="popover" href="javascript:void(0)"><?php echo $username;?> <span class="badge" style="background-color:#d9534f"><?php echo $alert;?></span></a>
        </li>

        <li><a href="../home"><span class='glyphicon glyphicon-cog'></span> Client Home</a></li>

        <li><a href="../home/logout"><span class='glyphicon glyphicon-log-out'></span> Log Out</a></li>

      </ul>
    </div><!-- /.navbar-collapse -->

</div>


</nav>

<div class="spacer"></div>
