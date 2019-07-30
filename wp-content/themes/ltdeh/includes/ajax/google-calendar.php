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

    switch ($details['calendar']) {
        case 'gh6rh0jhfdc6mgj42occ5qctr4@group.calendar.google.com':
            $calendar = 'Pista Pádel';
            $footer = $footer_1;
            break;
        case 'l559o05ppas8815rp3dv94m6co@group.calendar.google.com':
            $calendar = 'Pabellón Polideportivo';
            $footer = $footer_1;
            break;
        case 'dq4085nmcb9svmd9pnkd9hb3g8@group.calendar.google.com':
            $calendar = 'Pabellón multiusos';
            $footer = $footer_1;
            break;
        case '7g63qi1hldp6ci6986olel5ijs@group.calendar.google.com':
            $calendar = 'Claustro "El Convento"';
            $footer = $footer_2;
            $footer .= '<p>9.- El usuario abonará una fianza de 60 euros y un cargo por el alquiler de 100 euros.</p>';
            break;
        case 'hm8m3t1o667so9loes15kfb42o@group.calendar.google.com':
            $calendar = 'Salón de Actos "El Convento"';
            $footer = $footer_1;
            break;
        case '0t3vd0rve6ec4cipcdqka6dd9k@group.calendar.google.com':
            $calendar = 'Casa de la Juventud';
            $footer = $footer_2;
            $footer .= '<p>9.- El usuario abonará una fianza de 60 euros y un cargo por el alquiler de 40 euros.</p>';
            break;
        case 'hcq4uc70s28gu6j4kpcab1l7ds@group.calendar.google.com':
            $calendar = 'Hogar del Jubilado';
            $footer = $footer_1;
            break;
        case '7p9lca7q3rsavhqdal1ftd0dn0@group.calendar.google.com':
            $calendar = 'Hogar del Jubilado - Aula de informática';
            $footer = $footer_1;
            break;
    }

    $start = explode('T',$details['event_time']['start_time']);
    $start_hour = explode(':',$start[1]);
    $day = explode('-',$start[0]);
    $end = explode('T',$details['event_time']['end_time']);
    $end_hour = explode(':',$end[1]);

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
                .mb-20 { margin-bottom: 20px; }
                .nomargin { margin: 0 }
                .text-center { text-align: center }
                .logo-header { display: inline }
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
                <div class="clear mb-20"></div>
                <small>P-4517200-D</small>
                <small>R.E.L. Nº: 01451719</small>
            </div>
            <div class="col-1">
                <p><strong>AUTORIZACIÓN DE USO - '.$calendar.'</strong></p>
                <p>D./Dª.: '.$details['title'].'</p>
                <p>D.N.I.: '.$details['dni'].'</p>
                <p>Email: '.$details['mail'].'</p>
                <p>Teléfono: '.$details['phone'].'</p>
                <p>En representación de: '.$details['representation'].'</p>
                <p>Actividad: '.$details['activity'].'</p>
                <p>Día: '.$day[2].'-'.$day[1].'-'.$day[0].'</p>
                <p>Horario: '.$start_hour[0].':'.$start_hour[1].' - '.$end_hour[0].':'.$end_hour[1].'</p>
                <div class="clear mb-20"></div>
                '.$footer.'
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

    notify_event_managers($details, $event_id, $calendar, $day, $start_hour, $end_hour, $attachment);
    wp_send_json( array('message' => __($event_id, 'ltdeh') ) );

    /*
    $capi = new GoogleCalendarApi();
    // Get user calendar timezone
    $user_timezone = $capi->GetUserCalendarTimezone(ACCESS_TOKEN);
    if($capi->checkAvailability($event['calendar'], $event['event_time'], ACCESS_TOKEN) == true){
        // Create event on specific calendar - default value: 'primary' 
        $event_id = $capi->CreateCalendarEvent($event['calendar'], $event['title'], $event['event_time'], $user_timezone, ACCESS_TOKEN);
        wp_send_json( array('message' => __($event_id, 'ltdeh') ) );
    }else{
        wp_send_json( array('message' => __('Error', 'ltdeh') ) );
    }
    */
}

function notify_event_managers($details, $event_id, $calendar, $day, $start_hour, $end_hour, $attachment){
    switch ($calendar) {
        case 'Pista Pádel':
            $attachment = NULL;
            break;
        case 'Pabellón Polideportivo':
            $attachment = NULL;
            break;
        case 'Pabellón multiusos':
            $attachment = NULL;
            break;
    }
    $to = 'latorredeestebanhambran@gmail.com';
    $subject = __('Reserva '.$event_id.' de '.$calendar, 'ltdeh');
    $body = 'Reserva '.$event_id.'<br><br>';
    $body .= '<strong>Instalación</strong>: '.$calendar.'<br>';
    $body .= '<strong>Día</strong>: '.$day[2].'-'.$day[1].'-'.$day[0].'<br>';
    $body .= '<strong>Horario inicio</strong>: '.$start_hour[0].':'.$start_hour[1].'<br>';
    $body .= '<strong>Horario fin</strong>: '.$end_hour[0].':'.$end_hour[1].'<br>';
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