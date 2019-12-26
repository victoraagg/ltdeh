<?php
if (!defined('ABSPATH')) {
    exit;
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
    if($calendar == 'Pista Pádel 1' || $calendar == 'Pista Pádel 2' || $calendar == 'Pabellón Polideportivo'){
        $headers[] = 'Bcc: laurlocoloco@gmail.com';
    }
    if (defined('WP_DEBUG') && WP_DEBUG === false) {
        wp_mail( $to, $subject, $body, $headers, $attachment );
    }
}

function notify_payment($post_id){
    $post = get_post($post_id);
    $to = 'oficinatorre@gmail.com';
    $subject = __('Pago de reserva', 'ltdeh');
    $body = 'Reserva '.$post->post_title.' pagada<br><br>';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'Bcc: works.alonsog@gmail.com';
    $headers[] = 'Bcc: arantza.fernandezmerino@gmail.com';
    $headers[] = 'Bcc: chaleco199879@gmail.com';
    if (defined('WP_DEBUG') && WP_DEBUG === false) {
        wp_mail( $to, $subject, $body, $headers );
    }
}