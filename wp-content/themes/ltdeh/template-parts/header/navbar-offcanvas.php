<div class="dx-navbar dx-navbar-fullscreen">
    <div class="container">
        <button class="dx-navbar-burger">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="dx-navbar-content">
            <?php
            $defaults = array(
                'theme_location' => 'top_menu',
                'container' => 'ul',
                'menu_class' => 'dx-nav dx-nav-align-left'
            );
            wp_nav_menu($defaults);
            ?>
            <div class="mt-30">
                <?php get_template_part('template-parts/header/searchform',''); ?>
            </div>
        </div>
    </div>
</div>