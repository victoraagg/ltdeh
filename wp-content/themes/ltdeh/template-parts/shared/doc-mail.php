<?php
$details = get_query_var('details');
$footer = get_query_var('footer');
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <style>
            * { white-space: normal; font-family: serif }
            h1{ font-size: 18px; }
            p{ font-size: 12px; }
            .col-1 { clear: both; display: block; width: 100%; margin-bottom: 10px; }
            .clear { clear: both; margin: 0; height: 0 }
            .mb-10 { margin-bottom: 10px; }
            .mb-20 { margin-bottom: 20px; }
            .nomargin { margin: 0 }
            .text-center { text-align: center }
            .logo-header { display: inline }
            .conditions p{ font-size: 11px; }
        </style>
    </head>
    <body>
        <div class="col-1 text-center">
            <img class="logo-header" src="<?= get_stylesheet_directory_uri().'/assets/images/escudo-small.jpg'; ?>" /> 
        </div>
        <div class="col-1 text-center">
            <h1>AYUNTAMIENTO DE LA TORRE DE ESTEBAN HAMBRÁN</h1>
            <p class="nomargin">PLAZA DE LA CONSTITUCIÓN, NÚM. 1</p>
            <p class="nomargin">45920 (TOLEDO)</p>
            <p class="nomargin">TEL: 925 79 51 01 – FAX: 925 79 52 05</p>
            <div class="clear mb-10"></div>
            <small>P-4517200-D | R.E.L. Nº: 01451719</small>
        </div>
        <div class="col-1">
            <p><strong>AUTORIZACIÓN DE USO - <?= $details['calendar']; ?></strong></p>
            <p>D./Dª.: <?= $details['title']; ?></p>
            <p>D.N.I.: <?= $details['dni']; ?></p>
            <p>Email: <?= $details['mail']; ?></p>
            <p>Teléfono: <?= $details['phone']; ?></p>
            <p>En representación de: <?= $details['representation']; ?></p>
            <p>Actividad: <?= $details['activity']; ?></p>
            <p>Día: <?= $details['event_time']['day']; ?> de <?= $details['event_time']['month']; ?> de <?= date('Y'); ?></p>
            <p>Hora inicio: <?= $details['event_time']['start_time']; ?> h.</p>
            <p>Duración: <?= $details['event_time']['duration']; ?> h.</p>
            <div class="conditions"><?= $footer; ?></div>
        </div>
        <div class="clear mb-20"></div>
        <div class="footer text-center">
            <p>El Ayuntamiento</p>
            <p>(Documento firmado digitalmente)</p>
        </div>
    </body>
</html>