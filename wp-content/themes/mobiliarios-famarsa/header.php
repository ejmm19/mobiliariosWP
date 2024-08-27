<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<body>
<header id="mf-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="<?= get_home_url() ?>">
                    <img src="<?= get_template_directory_uri().'/assets/img/logo-mobiliarios-famarsa.png' ?>" alt="">
                </a>
            </div>
            <div class="col-12 col-sm-6 col-lg-8">
                <nav>
                    <?php wp_nav_menu([
                        'theme_location' => 'top_menu',
                        'menu_class' => 'menu-principal',
                        'container_class' => 'container-menu'
                    ]) ?>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="separator"></div>
</header>