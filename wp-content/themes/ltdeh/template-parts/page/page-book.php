<div class="col-xl-12" id="form-container">
    <header class="mb-50">
        <a class="dx-btn" href="<?= ltdeh_get_permalink('calendario'); ?>">Volver al calendario</a>
    </header>
    <?php
    if (isset($_GET['error-book'])) :
        switch ($_GET['error-book']) {
            case 'availability':
                echo '<div class="alert dx-alert dx-alert-danger" role="alert">No hay disponibilidad en esa fecha</div>';
                break;
            case 'data':
                echo '<div class="alert dx-alert dx-alert-danger" role="alert">Error en los datos enviados</div>';
                break;
        }
    endif;
    ?>
    <div class="alert alert-success" id="book-success"></div>
    <div class="alert alert-danger" id="book-error"></div>
    <?php
    if (get_option('_ltdeh_enable_books') == 'Y' || current_user_can('manage_options')) {
        get_template_part('template-parts/page/form', 'book');
    } else {
        echo '<h2>Lo sentimos, las reservas de espacios no están disponibles</h2>';
    }
    ?>
</div>