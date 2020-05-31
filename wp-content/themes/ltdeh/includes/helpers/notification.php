<?php
require_once ABSPATH.'vendor/autoload.php';
if (!defined('ABSPATH')) {
    exit;
}

function generate_doc_auth($event_id, $details){
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
    $mpdf->Output('./wp-content/solicitudes/'.$event_id.'.pdf', \Mpdf\Output\Destination::FILE);
}

function get_doc_auth($event_id){
    return array(ABSPATH.'/wp-content/solicitudes/'.$event_id.'.pdf');
}

function notify_event_managers($post_id){

    $post_info = get_post($post_id);
    $post_meta = get_post_meta($post_id);
    $event_id = $post_info->post_title;
    $calendar = $post_meta['_book_site'][0];

    switch ($calendar) {
        case 'Pista Pádel 1':
        case 'Pista Pádel 2':
        case 'Pabellón Polideportivo':
        case 'Pabellón Multiusos':
            $attachment = NULL;
            break;
    }

    $attachment = get_doc_auth($event_id);

    $to = 'oficinatorre@gmail.com';
    $subject = __('Reserva '.$event_id.' de '.$calendar, 'ltdeh');
    $body = 'Reserva '.$event_id.'<br><br>';
    $body .= '<strong>Instalación</strong>: '.$calendar.'<br>';
    $body .= '<strong>Día</strong>: '.$post_meta['_book_day'][0].' de '.ltdeh_replace_name_months($post_meta['_book_month'][0]).' de '.$post_meta['_book_year'][0].'<br>';
    $body .= '<strong>Hora inicio</strong>: '.$post_meta['_book_hour'][0].' h.<br>';
    $body .= '<strong>Duración</strong>: '.$post_meta['_book_duration'][0].' h.<br>';
    $body .= '<strong>Nombre</strong>: '.$post_meta['_book_name'][0].'<br>';
    $body .= '<strong>Email</strong>: '.$post_meta['_book_mail'][0].'<br>';
    $body .= '<strong>Teléfono</strong>: '.$post_meta['_book_phone'][0].'<br>';
    $body .= '<strong>D.N.I.:</strong>: '.$post_meta['_book_dni'][0].'<br>';
    $body .= '<strong>En representación de</strong>: '.$post_meta['_book_representation'][0].'<br>';
    $body .= '<strong>Actividad</strong>: '.$post_meta['_book_activity'][0].'<br>';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'Bcc: '.$post_meta['_book_mail'][0];
    $headers[] = 'Bcc: works.alonsog@gmail.com';
    $headers[] = 'Bcc: arantza.fernandezmerino@gmail.com';
    $headers[] = 'Bcc: chaleco199879@gmail.com';
    if($calendar == 'Pista Pádel 1' || $calendar == 'Pista Pádel 2' || $calendar == 'Pabellón Polideportivo'){
        $headers[] = 'Bcc: adrian_1.6.98@hotmail.com';
    }
    if (get_option( '_ltdeh_notify_managers' ) == 'Y') {
        if($post_meta['_book_active'][0] == 'Y'){
            wp_mail( $to, $subject, $body, $headers, $attachment );
        }
    }

}