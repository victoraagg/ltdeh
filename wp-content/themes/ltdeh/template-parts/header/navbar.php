<!--
    Additional Classes:
    .dx-navbar-sticky || .dx-navbar-fixed
    .dx-navbar-autohide
    .dx-navbar-dropdown-triangle
    .dx-navbar-dropdown-dark - only <ul>
    .dx-navbar-expand || .dx-navbar-expand-lg || .dx-navbar-expand-xl
-->
<nav class="dx-navbar dx-navbar-top dx-navbar-collapse dx-navbar-sticky dx-navbar-expand-lg sub-menu-triangle dx-navbar-autohide">
    <div class="container">
        <a href="<?= home_url(); ?>" class="dx-nav-logo"><img src="<?= get_template_directory_uri(); ?>/assets/images/logo.png">La Torre de Esteban Hambrán</a>
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
                'menu_class' => 'dx-nav dx-nav-align-right'
            );
            wp_nav_menu($defaults);
            ?>
            <?php get_template_part('template-parts/header/searchform',''); ?>
        </div>
    </div>
</nav>