<?php

add_action('wp_ajax_nopriv_create_book', 'create_book_ajax');
add_action('wp_ajax_create_book', 'create_book_ajax');
function create_book_ajax(){
    // Get event details
    $event_id = date('ynjGi');
    $details = $_POST['event_details'];
    notify_event_managers($details, $event_id);
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

function notify_event_managers($details, $event_id){
    switch ($details['calendar']) {
        case 'gh6rh0jhfdc6mgj42occ5qctr4@group.calendar.google.com':
            $calendar = 'Pista Pádel';
            break;
        case 'l559o05ppas8815rp3dv94m6co@group.calendar.google.com':
            $calendar = 'Pabellón Polideportivo';
            break;
        case 'dq4085nmcb9svmd9pnkd9hb3g8@group.calendar.google.com':
            $calendar = 'Pabellón multiusos';
            break;
        case '7g63qi1hldp6ci6986olel5ijs@group.calendar.google.com':
            $calendar = 'Espacio "El Convento"';
            break;
        case '0t3vd0rve6ec4cipcdqka6dd9k@group.calendar.google.com':
            $calendar = 'Bajos Consultorio Médico';
            break;
    }
    $start = explode('T',$details['event_time']['start_time']);
    $start_hour = explode(':',$start[1]);
    $day = explode('-',$start[0]);
    $end = explode('T',$details['event_time']['end_time']);
    $end_hour = explode(':',$end[1]);
    $to = 'latorredeestebanhambran@gmail.com';
    $subject = __('Solicitud de reserva de '.$calendar, 'ltdeh');
    $body = 'Datos<br><br>';
    $body .= '<strong>Instalación</strong>: '.$calendar.'<br>';
    $body .= '<strong>Día</strong>: '.$day[2].'-'.$day[1].'-'.$day[0].'<br>';
    $body .= '<strong>Horario inicio</strong>: '.$start_hour[0].':'.$start_hour[1].'<br>';
    $body .= '<strong>Horario fin</strong>: '.$end_hour[0].':'.$end_hour[1].'<br>';
    $body .= '<strong>Nombre</strong>: '.$details['title'].'<br>';
    $body .= '<strong>Email</strong>: '.$details['mail'].'<br>';
    $body .= '<strong>Identificador de reserva</strong>: '.$event_id.'<br>';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'Cc: works.alonsog@gmail.com';
    $headers[] = 'Cc: arantza.fernandezmerino@gmail.com';
    $headers[] = 'Cc: chaleco199879@gmail.com';
    wp_mail( $to, $subject, $body, $headers );
}