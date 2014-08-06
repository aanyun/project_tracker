
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>Simple Login with CodeIgniter</title>
   <link href="assets/css/bootstrap.css" rel="stylesheet">
   <?php //echo link_tag('css/bootstrap.css'); ?>
 </head>
 <body>
   <!-- <h1>Simple Login with CodeIgniter</h1> -->
   <?php echo validation_errors(); ?>
   <form action="verifylogin" method="POST">
  <!--    <label for="username">Username:</label>
     <input type="text" size="20" id="username" name="username"/>
     <br/>
     <label for="password">Password:</label>
     <input type="password" size="20" id="passowrd" name="password"/>
     <br/>
     <input type="submit" value="Login"/> -->
     <div class="container" style="margin-top:30px">
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">
  <div class="panel-heading"><h3 class="panel-title"><strong>Sign in </strong></h3></div>
  <div class="panel-body">
   <form role="form">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" style="border-radius:0px" id="username" name="username" placeholder="Enter username">
  </div>
  <div class="form-group">
    <!-- <label for="password">Password <a href="/sessions/forgot_password">(forgot password)</a></label> -->
    <input type="password" class="form-control" style="border-radius:0px" id="password" name="password" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-sm btn-default">Sign in</button>
</form>
  </div>
</div>
</div>
</div>

   </form>
 </body>
</html>

