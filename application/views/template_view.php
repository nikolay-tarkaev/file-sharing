<?php
    $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="robots" content="index, follow" />
		<link rel="shortcut icon" href="<?php echo $host; ?>images/favicon.png" type="image/png" />
		<link rel="stylesheet" href="<?php echo $host; ?>css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $host; ?>css/style.css" type="text/css" />
		<script src="<?php echo $host; ?>js/jquery.min.js" type="text/JavaScript"></script>
		<script src="<?php echo $host; ?>js/bootstrap.min.js" type="text/JavaScript"></script>
    </head>
    <body>
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" data-target="#navmenu" data-toggle="collapse" class="navbar-toggle">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="<?php echo $host; ?>" class="navbar-brand">Brand</a>
				</div>
				<div id="navmenu" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="<?php echo $host; ?>">Home</a></li>
						<li><a href="#">Link 2</a></li>
						<li><a href="#">Link 3</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Log In</a></li>
					</ul>
				</div>
			</div>
		</nav>
        <div class="container">
				<?php include '../application/views/'.$content_view; ?>
        </div>
    </body>
</html>