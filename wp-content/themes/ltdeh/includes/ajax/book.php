<?php
require_once ABSPATH.'vendor/autoload.php';

add_action('wp_ajax_nopriv_create_book', 'create_book_ajax');
add_action('wp_ajax_create_book', 'create_book_ajax');
function create_book_ajax(){

    // Get event details
    $event_id = date('ynjGi');
    $details = $_POST['event_details'];

    $footer_1 = '<p>Al solicitar el uso de dichos locales se compromete a cumplir las normas establecidas para su uso que, en síntesis, son las siguientes:</p>';
    $footer_1 .= '<p>1.- Compromiso de respetar el mobiliario y enseres de las dependencias.</p>';
    $footer_1 .= '<p>2.- Compromiso de dejar el mobiliario tal y como se encuentre, sin alterar su orden.</p>';
    $footer_1 .= '<p>3.- Prohibición de fumar e introducir bebidas en las dependencias.</p>';
    $footer_1 .= '<p>4.- Cualquier desperfecto ocasionado en el desarrollo de la actividad será de la responsabilidad del peticionario, que deberá asumir los gastos ocasionados en su reparación.</p>';
    
    $footer_2 = '<p>Al solicitar el uso de dichos locales se compromete a cumplir las normas establecidas para su uso que, en síntesis, son las siguientes:</p>';
    $footer_2 .= '<p>1.- Compromiso de respetar el mobiliario y enseres de las dependencias.</p>';
    $footer_2 .= '<p>2.- Compromiso de dejar el mobiliario tal y como se encuentre, sin alterar su orden. Limpio y en buen estado.</p>';
    $footer_2 .= '<p>3.- Cualquier desperfecto ocasionado en el desarrollo de la actividad será de la responsabilidad del peticionario, que deberá asumir los gastos ocasionados en su reparación.</p>';
    $footer_2 .= '<p>4.- El uso de estas dependencias será siempre a título particular.</p>';
    $footer_2 .= '<p>5.- En caso de uso nocturno será el horario de cierre de los bares de la localidad, respetando siempre el derecho de los vecinos a descansar.</p>';
    $footer_2 .= '<p>6.- La persona que alquila es la responsable de todo lo que ocurra en el local.</p>';
    $footer_2 .= '<p>7.- Por la ley 42/2010 queda totalmente prohibido fumar en este local</p>';
    $footer_2 .= '<p>8.- La responsabilidad del consumo de alcohol en los menores recaerá en la persona que alquile este local.</p>';

    $footer = $footer_1;
    switch ($details['calendar']) {
        case 'Claustro - El Convento':
            $footer = $footer_2;
            $footer .= '<p>9.- El usuario abonará una fianza de 60 euros y un cargo por el alquiler de 100 euros.</p>';
            break;
        case 'Casa de la Juventud':
            $footer = $footer_2;
            $footer .= '<p>9.- El usuario abonará una fianza de 60 euros y un cargo por el alquiler de 40 euros.</p>';
            break;
    }

    // Send PDF to administration
    $html = '
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
                <img class="logo-header" src="'.get_stylesheet_directory_uri().'/assets/images/escudo-small.jpg" /> 
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
                <p><strong>AUTORIZACIÓN DE USO - '.$details['calendar'].'</strong></p>
                <p>D./Dª.: '.$details['title'].'</p>
                <p>D.N.I.: '.$details['dni'].'</p>
                <p>Email: '.$details['mail'].'</p>
                <p>Teléfono: '.$details['phone'].'</p>
                <p>En representación de: '.$details['representation'].'</p>
                <p>Actividad: '.$details['activity'].'</p>
                <p>Día: '.$details['event_time']['day'].' de '.$details['event_time']['month'].' de '.date('Y').'</p>
                <p>Hora inicio: '.$details['event_time']['start_time'].' h.</p>
                <p>Duración: '.$details['event_time']['duration'].' h.</p>
                <div class="conditions">'.$footer.'</div>
            </div>
            <div class="clear mb-20"></div>
            <div class="footer text-center">
                <p>El Ayuntamiento</p>
                <p>(Documento firmado digitalmente)</p>
            </div>
        </body>
    </html>
    ';
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $mpdf->Output('../wp-content/solicitudes/'.$event_id.'.pdf', \Mpdf\Output\Destination::FILE);
    $attachment = array(ABSPATH.'/wp-content/solicitudes/'.$event_id.'.pdf');

    $availability = ltdeh_check_availability_book($details['event_time'], $details['calendar']);
    if(!$availability){
        wp_send_json( array('message' => 'Error') );
        exit();
    }
    
    if(strlen($details['event_time']['day'])==1){ $day = '0'.$details['event_time']['day']; }else{ $day = $details['event_time']['day']; }
    if(strlen($details['event_time']['month'])==1){ $month = '0'.$details['event_time']['month']; }else{ $month = $details['event_time']['month']; }
    
    $new_book = array(
        'post_title' => $event_id,
        'post_status' => 'publish',
        'post_type' => 'book',
        'meta_input' => array(
            '_book_name' => $details['title'],
            '_book_mail' => $details['mail'],
            '_book_phone' => $details['phone'],
            '_book_day' => $day,
            '_book_month' => $month,
            '_book_year' => date('Y'),
            '_book_hour' => $details['event_time']['start_time'],
            '_book_duration' => $details['event_time']['duration'],
            '_book_site' => $details['calendar'],
            '_book_dni' => $details['dni'],
            '_book_representation' => $details['representation'],
            '_book_activity' => $details['activity']
        )
    );    
    wp_insert_post( $new_book );

    notify_event_managers($details, $event_id, $details['calendar'], $day, $start_hour, $end_hour, $attachment);
    wp_send_json( array('message' => __($event_id, 'ltdeh') ) );

}

function notify_event_managers($details, $event_id, $calendar, $day, $start_hour, $end_hour, $attachment){
    switch ($calendar) {
        case 'Pista Pádel 1':
        case 'Pista Pádel 2':
        case 'Pabellón Polideportivo':
        case 'Pabellón Multiusos':
            $attachment = NULL;
            break;
    }
    $to = 'latorredeestebanhambran@gmail.com';
    $subject = __('Reserva '.$event_id.' de '.$calendar, 'ltdeh');
    $body = 'Reserva '.$event_id.'<br><br>';
    $body .= '<strong>Instalación</strong>: '.$calendar.'<br>';
    $body .= '<strong>Día</strong>: '.$details['event_time']['day'].' de '.$details['event_time']['month'].' de '.date('Y').'<br>';
    $body .= '<strong>Hora inicio</strong>: '.$details['event_time']['start_time'].' h.<br>';
    $body .= '<strong>Duración</strong>: '.$details['event_time']['duration'].' h.<br>';
    $body .= '<strong>Nombre</strong>: '.$details['title'].'<br>';
    $body .= '<strong>Email</strong>: '.$details['mail'].'<br>';
    $body .= '<strong>Teléfono</strong>: '.$details['phone'].'<br>';
    $body .= '<strong>D.N.I.:</strong>: '.$details['dni'].'<br>';
    $body .= '<strong>En representación de</strong>: '.$details['representation'].'<br>';
    $body .= '<strong>Actividad</strong>: '.$details['activity'].'<br>';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'Cc: oficinatorre@gmail.com';
    $headers[] = 'Bcc: '.$details['mail'];
    $headers[] = 'Bcc: works.alonsog@gmail.com';
    $headers[] = 'Bcc: arantza.fernandezmerino@gmail.com';
    $headers[] = 'Bcc: chaleco199879@gmail.com';
    wp_mail( $to, $subject, $body, $headers, $attachment );
}