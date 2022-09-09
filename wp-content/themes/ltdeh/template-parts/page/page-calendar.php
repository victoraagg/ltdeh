<div class="col-xl-12 bg-white pb-30">
    <?php
    if (get_option('_ltdeh_enable_books') == 'Y') {
        echo '<header class="mb-50">';
        echo '<a class="dx-btn dx-btn-lg dx-btn-block" href="' . ltdeh_get_permalink('reserva') . '">Solicitar reserva</a>';
        echo '</header>';
    }
    ?>
    <div id="calendar"></div>
</div>