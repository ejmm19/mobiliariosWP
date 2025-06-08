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
            <div class="col-10 col-sm-10 col-lg-4">
                <a href="<?= get_home_url() ?>">
                    <img src="<?= get_template_directory_uri().'/assets/img/mobiliarios-famarsa-logo-origin.png' ?>" alt="">
                </a>
            </div>
            <div class="col-2 col-sm-2 col-lg-8">
                <nav id="nav-desktop">
                    <?php wp_nav_menu([
                        'theme_location' => 'top_menu',
                        'menu_class' => 'menu-principal-desktop',
                        'container_class' => 'container-menu'
                    ]) ?>
                </nav>
                <nav id="nav-mobil" v-if="activeMenu"  class="d-lg-none">
                    <div id="close-btn" @click="toggleMenu" class="d-lg-none">
                        <i class="fas fa-times"></i>
                    </div>
                    <?php wp_nav_menu([
                        'theme_location' => 'top_menu',
                        'menu_class' => 'menu-principal',
                        'container_class' => 'container-menu'
                    ]) ?>
                </nav>
                <div id="btn-menu" @click="toggleMenu" class="d-lg-none">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="separator"></div>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const vueApp = new Vue({
            el: '#mf-header',
            data: {
                message: 'Hello Vue!',
                activeMenu: false,
            },
            methods: {
                toggleMenu() {
                    this.activeMenu = !this.activeMenu;
                    console.log('Menu toggled:', this.activeMenu);
                }
            }
        });
    });
</script>