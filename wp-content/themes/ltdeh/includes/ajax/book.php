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
    set_query_var('details', $details);
    set_query_var('footer', $footer);
    ob_start();
    get_template_part('template-parts/shared/doc', 'mail');
    $html = ob_get_contents();
    ob_end_clean();
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
            '_book_active' => 'Y',
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

    notify_event_managers($details, $event_id, $details['calendar'], $attachment);
    wp_send_json( array('message' => __($event_id, 'ltdeh') ) );

}

function notify_event_managers($details, $event_id, $calendar, $attachment){
    switch ($calendar) {
        case 'Pista Pádel 1':
        case 'Pista Pádel 2':
        case 'Pabellón Polideportivo':
        case 'Pabellón Multiusos':
            $attachment = NULL;
            break;
    }
    $to = 'oficinatorre@gmail.com';
    $subject = __('Reserva '.$event_id.' de '.$calendar, 'ltdeh');
    $body = 'Reserva '.$event_id.'<br><br>';
    $body .= '<strong>Instalación</strong>: '.$calendar.'<br>';
    $body .= '<strong>Día</strong>: '.$details['event_time']['day'].' de '.ltdeh_replace_name_months($details['event_time']['month']).' de '.date('Y').'<br>';
    $body .= '<strong>Hora inicio</strong>: '.$details['event_time']['start_time'].' h.<br>';
    $body .= '<strong>Duración</strong>: '.$details['event_time']['duration'].' h.<br>';
    $body .= '<strong>Nombre</strong>: '.$details['title'].'<br>';
    $body .= '<strong>Email</strong>: '.$details['mail'].'<br>';
    $body .= '<strong>Teléfono</strong>: '.$details['phone'].'<br>';
    $body .= '<strong>D.N.I.:</strong>: '.$details['dni'].'<br>';
    $body .= '<strong>En representación de</strong>: '.$details['representation'].'<br>';
    $body .= '<strong>Actividad</strong>: '.$details['activity'].'<br>';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'Bcc: '.$details['mail'];
    $headers[] = 'Bcc: works.alonsog@gmail.com';
    $headers[] = 'Bcc: arantza.fernandezmerino@gmail.com';
    $headers[] = 'Bcc: chaleco199879@gmail.com';
    if($calendar == 'Pista Pádel 1' || $calendar == 'Pista Pádel 2'){
        $headers[] = 'Bcc: laurlocoloco@gmail.com';
    }
    wp_mail( $to, $subject, $body, $headers, $attachment );
}