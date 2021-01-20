<head>
    <?php $version=1; ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php if (isset($product['name'])) {echo $product['name'];} else {echo 'pinsk-mebel.by';}; ?></title>
    <link href="/template/css/bootstrap.min.css?v=<?= $version; ?>" rel="stylesheet">
    <link href="/template/css/font-awesome.min.css?v=<?= $version; ?>" rel="stylesheet">
    <link href="/template/css/prettyPhoto.css?v=<?= $version; ?>" rel="stylesheet">
    <link href="/template/css/price-range.css?v=<?= $version; ?>" rel="stylesheet">
    <link href="/template/css/animate.css?v=<?= $version; ?>" rel="stylesheet">
    <link href="/template/css/main.css?v=<?= $version; ?>" rel="stylesheet">
    <link href="/template/css/responsive.css?v=<?= $version; ?>" rel="stylesheet">
    <link rel="shortcut icon" href="/template/images/icon/2.png?v=<?= $version; ?>" type="image/png">

</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +375 29 66 88 029</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> mebel-p@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="/site/tableTest"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="/"><img src="/template/images/home/logo.png" alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <?php if (isset($_SESSION['status'])) { ?>
                                <li>
                                    <a href="/admin/"><i class="fa fa-folder-open"></i> Админпанель</a>
                                </li>
                            <?php } ?>
                            <li>
                                <a href="/cart/"><i class="fa fa-shopping-cart"></i> Корзина
                                    (<span data-cart="count"><?php echo Cart::countItems(); ?></span>)
                                </a>
                            </li>
                            <?php if (!isset($_SESSION['id'])) { ?>
                                <li><a href="/user/register/"><i class="fa fa-user"></i> Регистрация</a></li>
                                <li><a href="/user/login/"><i class="fa fa-lock"></i> Вход</a></li>
                            <?php } else { ?>
                                <li><a href="/cabinet/"><i class="fa fa-user"></i> Аккаунт</a></li>
                                <li><a href="/user/logout/"><i class="fa fa-unlock"></i> Выход</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="/">Главная</a></li>
                            <li class="dropdown"><a href="#">Магазин<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="/catalog/">Каталог товаров</a></li>
                                    <li><a href="/cart/">Корзина(<span data-cart="count"><?php echo Cart::countItems(); ?></span>)</a></li>
                                </ul>
                            </li>
                            <li><a href="/search/">Поиск</a></li>
                            <li><a href="">О магазине</a></li>
                            <li><a href="">Контакты</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->

</header><!--/header-->

