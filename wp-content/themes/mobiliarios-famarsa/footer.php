<footer>

    <div class="container">
        <div class="row">
            <?php dynamic_sidebar('footer') ?>
        </div>
    </div>
    <div class="container-fluid bg-black py-2">
        <div class="row">
            <div class="col-12 text-center">
                <p class="text-white">
                    &copy; <?= date('Y') ?> <?= get_bloginfo('name') ?>. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>