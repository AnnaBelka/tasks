<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tasks</title>

    <!-- Bootstrap -->
    <link href="/views/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 50px;
        }
        .starter-template {
            padding: 40px 15px;
            text-align: center;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="/views/js/baloon/js/baloon.js" type="text/javascript" defer></script>
    <link   href="/views/js/baloon/css/baloon.css" rel="stylesheet" type="text/css" />

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

    <script src="/views/js/jquery.fancybox.min.js"></script>
    <link href="/views/css/jquery.fancybox.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Tasks</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/task/create">Добавить задачу</a></li>
                <?php
                if ($_SESSION['admin']) {?>
                    <li><a href="/auth/logout">Выйти</a></li>
                <?} else {?>
                    <li><a href="/auth/login">Войти</a></li>
                <?}
                ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">

    <div class="starter-template">
        <h1>Tasks</h1>
        <p class="lead"></p>
    </div>
    <?php
    if (!empty($template)) {
        include 'views/web/'.$template.'.php';
    }
    ?>

</div


<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/views/js/bootstrap.min.js"></script>
<script src="/views/js/tasks.js"></script>
</body>
</html>