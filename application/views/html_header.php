<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Project Tracker</title>
    <link href="http://<?php echo $_SERVER['SERVER_NAME']?>/assets/css/bootstrap.css" rel="stylesheet"> 
    <link href="../assets/css/project_detail.css" rel="stylesheet">

  <!--Import Fonts-->  
<!--   <link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700' rel='stylesheet' type='text/css'> -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src='../assets/js/moment.min.js'></script>
    <script src='../assets/js/jquery.tablesorter.js'></script>
    <script src='../assets/js/jquery.tablesorter.widgets.min.js'></script>
    <script src='../assets/js/excellentexport.js'></script>
    <script>

    <?php
 
    echo "var task_status=".json_encode($task_status).";";
    echo "var taskDetails=".json_encode($activities).";";
    echo "var alert_num=".$alert.";";
    echo "console.log(task_status);";
    ?>

    </script>

  </head>
  <body>

     <div class="container">