<?php
    $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
    
    $separate_method_GET = explode('?', $_SERVER['REQUEST_URI']);
    $routes = explode('/', $separate_method_GET[0]);
    if ( !empty($routes[1]) ){	
        $controller_name = $routes[1];
    }
    else {
        $controller_name = "main";
    }
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
		<link rel="stylesheet" href="<?php echo $host; ?>css/template.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $host; ?>css/<?php echo $controller_name; ?>.css" type="text/css" />
		<script src="<?php echo $host; ?>js/jquery.min.js" type="text/JavaScript"></script>
		<script src="<?php echo $host; ?>js/bootstrap.min.js" type="text/JavaScript"></script>
        <?php
            if(!isset($_SESSION['auth'])){
                ?>
                    <style>
                        .input_head_error {
                            border: 1px solid #db4242 !important;
                            box-shadow: 0 0 7px #db4242 !important;
                        }
                        .input_head_success {
                            border: 1px solid #3ab030 !important;
                            box-shadow: 0 0 5px #3ab030 !important;
                        }
                    </style>
                    <script type="text/javascript">
                        $(function(){
                            $('#login_form_head').on('submit', function(e){
                                e.preventDefault();
                                var $that = $(this),
                                formData = new FormData($that.get(0));
                                $.ajax({
                                    url: $that.attr('action'),
                                    type: $that.attr('method'),
                                    contentType: false,
                                    processData: false,
                                    data: formData,
                                    dataType: 'json',
                                    success: function(json){
                                        if(json){

                                            if(json.error == "1"){
                                                $('#login_input').addClass('input_head_error');
                                                $('#password_input').addClass('input_head_error');
                                                setTimeout(function(){
                                                    $('#login_input').val('');
                                                    $('#password_input').val('');
                                                    $('#login_input').removeClass('input_head_error');
                                                    $('#password_input').removeClass('input_head_error');
                                                    window.location.href = "<?php echo $host; ?>login";
                                                }, 1500);
                                            }
                                            else {
                                                $('#login_input').addClass('input_head_success');
                                                $('#password_input').addClass('input_head_success');
                                                setTimeout(function(){
                                                    window.location.href = "<?php echo $host; ?>";
                                                }, 1500);
                                            }
                                        }
                                    }
                                });
                            });
                        });
                    </script>
                <?php
            }
        ?>
    </head>
    <body>
        <div class="wrapper">
            <div class="content">
                <nav class="navbar navbar-inverse" role="navigation">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" data-target="#navmenu" data-toggle="collapse" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a href="<?php echo $host; ?>" class="navbar-brand"><img src="images/favicon.png" style="height:28px; margin: -5px 0 -5px 0;" /> Upload</a>

                        </div>
                        <div id="navmenu" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li<?php echo ($controller_name == "main") ? " class='active'" : ""; ?>><a href="<?php echo $host; ?>"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;&nbsp;Главная</a></li>
                                <li<?php echo ($controller_name == "aboutsite") ? " class='active'" : ""; ?>><a href="<?php echo $host; ?>aboutsite">О сайте</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <?php
                                    if(isset($_SESSION['auth'])){
                                        
                                        if($_SESSION['auth'] == TRUE){
                                            if($_SESSION['auth']['status'] == "admin"){
                                                ?>
                                                    <li><a href="<?php echo $host; ?>adminpanel">Панель администратора</a></li>
                                                <?php
                                            }
                                            ?>
                                                <li class="dropdown">
                                                    <a class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" style="cursor: pointer;">
                                                        <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['auth']['login']; ?>
                                                        <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                        <li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp;Мой профиль</a></li>
                                                        <li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#"><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;&nbsp;Сообщения</a></li>
                                                        <li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;&nbsp;Настройки</a></li>
                                                        <li role="presentation" class="divider"></li>
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo $host; ?>logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;&nbsp;Выйти</a></li>
                                                    </ul>
                                                </li>
                                            <?php
                                            
                                        }
                                    }
                                    else{
                                        ?>
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" style="cursor: pointer;">
                                                    Войти
                                                    <span class="caret"></span>
                                                </a>
                                                    <ul class="dropdown-menu login_form" role="menu" aria-labelledby="dropdownMenu1">
                                                        <form action="<?php echo $host; ?>login/ajax" method="POST" id="login_form_head">
                                                            <li role="presentation">
                                                                <input type="text" name="user_login" class="form-control" placeholder="Логин" role="menuitem" id="login_input" /></li>
                                                            <li role="presentation">
                                                                <input type="password" name="user_password" class="form-control" placeholder="Пароль" role="menuitem" id="password_input" /></li>
                                                            <!-- <li role="presentation">
                                                                <input type="checkbox" name="" role="menuitem" />&nbsp;&nbsp;&nbsp;Запомнить меня</li> -->
                                                            <li role="presentation">
                                                                <button type="submit" class="btn btn-info" name="login_submit" role="menuitem">Войти <span class="glyphicon glyphicon-log-in"></span></button></li>
                                                            <li role="presentation" class="divider"></li>
                                                        </form>
                                                        <li role="presentation"><a class="btn btn-default" href="<?php echo $host; ?>registration" role="menuitem">Регистрация</a></li>
                                                    </ul>
                                            </li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="container">
                        <?php include '../application/views/'.$content_view; ?>
                </div>
            </div>

            <div class="footer copyright">
                <div class="container">
                    <div class="col-md-6">
                        <!-- <p><?php echo "© " . date('Y') . " - All Rights with " . $_SERVER['HTTP_HOST']; ?></p> -->
                        <p><?php echo date('Y') . " - " . $_SERVER['HTTP_HOST']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <ul class="bottom_ul">
                            <li><a href="<?php echo $host; ?>"><?php echo $_SERVER['HTTP_HOST']; ?></a></li>
                            <li><a href="<?php echo $host; ?>aboutsite">О сайте</a></li>
                            <?php
                                if(isset($_SESSION['auth'])){
                                    ?>
                                        <li><a href="<?php echo $host; ?>logout">Выход</a></li>
                                    <?php
                                }
                                else {
                                    ?>
                                        <li><a href="<?php echo $host; ?>login">Войти</a></li>
                                        <li><a href="<?php echo $host; ?>registration">Регистрация</a></li>
                                    <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <script src="<?php echo $host; ?>js/<?php echo $controller_name; ?>.js" type="text/JavaScript"></script>
    </body>
</html>