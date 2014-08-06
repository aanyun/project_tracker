<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<meta charset='UTF-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
<meta name="viewport" content="width=device-width" />
<title>Project Tracker</title>
<!--[if IE 9]>
  <style type="text/css"> .gradient { filter: none;} </style>
<![endif]-->
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- in the <head> .. -->
<? foreach($stylesheets as $stylesheet): ?>
  <?= css_asset($stylesheet); ?>    
<? endforeach; ?>

<!-- right before <body> -->
<? foreach($javascripts as $javascript): ?>
  <?= js_asset($javascript); ?>
<? endforeach; ?>
</head>
<body>
</body>
</html>