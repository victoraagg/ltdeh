<?php
require_once ABSPATH.'vendor/autoload.php';

add_action('wp_ajax_nopriv_create_book', 'create_book_ajax');
add_action('wp_ajax_create_book', 'create_book_ajax');
function create_book_ajax(){
    $html = '
    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <style>
                * {
                    white-space: normal;
                    font-family: serif
                }
                h1{
                    font-size: 18px;
                }
                p{
                    font-size: 12px;
                }
                ul {
                    margin: 0px;
                    padding: 0px;
                }
                ul li,
                ol li {
                    list-style-type: none;
                }
                .col-1 {
                    clear: both;
                    display: block;
                    width: 100%;
                    margin-bottom: 10px;
                }
                .clear {
                    clear: both;
                    margin: 0;
                    height: 0
                }
                .pr-2 {
                    padding-right: 2%;
                }
                .mb-20 {
                    margin-bottom: 20px;
                }
                .mb-40 {
                    margin-bottom: 40px;
                }
                .small {
                    font-size: 8px;
                    margin: 0
                }
                .nomargin {
                    margin: 0
                }
                .text-center {
                    text-align: center
                }
                .logo-header {
                    display: inline
                }
            </style>
        </head>
        <body>
            <div class="col-1 text-center">
                <img class="logo-header" src="'.get_stylesheet_directory_uri().'/assets/images/escudo.jpg" /> 
            </div>
            <div class="col-1 text-center">
                <h1>AYUNTAMIENTO DE LA TORRE DE ESTEBAN HAMBRÁN</h1>
                <p class="nomargin">PLAZA DE LA CONSTITUCIÓN, NÚM. 1</p>
                <p class="nomargin">45920 (TOLEDO)</p>
                <p class="nomargin">TEL: 925 79 51 01 – FAX: 925 79 52 05</p>
                <div class="clear mb-20"></div>
                <small>P-4517200-D</small>
                <div class="clear"></div>
                <small>R.E.L. Nº: 01451719</small>
            </div>
            <div class="col-1">
                <p><strong>AUTORIZACIÓN DE USO</strong></p>
                <p><strong>HOGAR DEL JUBILADO – AULA PLANTA BAJA</strong></p>
                <div class="clear"></div>
                <p>D./Dª.: ELENA COLLADO FERNANDEZ</p>
                <p>D.N.I.: 50.124.543-E</p>
                <p>Teléfono: 619016980</p>
                <p>En representación de: TALLER PERDIDA DE PESO </p>
                <p>ACTIVIDAD: Reunión </p>
                <p>Día: 24 de JUNIO de 2019</p>
                <p>Horario: de 19:00 a 20:30</p>
                <div class="clear mb-40"></div>
                <p>Al solicitar el uso de dichos locales se compromete a cumplir las normas establecidas para su uso que, en síntesis, son las siguientes:</p>
                <p>1.- Compromiso de respetar el mobiliario y enseres de las dependencias.</p>
                <p>2.- Compromiso de dejar el mobiliario tal y como se encuentre, sin alterar su orden.</p>
                <p>3.- Prohibición de fumar e introducir bebidas en las dependencias.</p>
                <p>4.- Cualquier desperfecto ocasionado en el desarrollo de la actividad será de la responsabilidad del peticionario, que deberá asumir los gastos ocasionados en su reparación.</p>
            </div>
            <div class="clear mb-40"></div>
            <div class="footer text-center">
                <p>El Ayuntamiento</p>
                <p>(Documento firmado digitalmente)</p>
            </div>
        </body>
    </html>
    ';
    // Send PDF to administration
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    //$mpdf->Output('', \Mpdf\Output\Destination::DOWNLOAD);
    //$attachment = $mpdf->Output('', \Mpdf\Output\Destination::STRING_RETURN);
    $attachment = array($mpdf->Output('', 'S'));

    // Get event details
    $event_id = date('ynjGi');
    $details = $_POST['event_details'];
    notify_event_managers($details, $event_id, $attachment);
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

function notify_event_managers($details, $event_id, $attachment){
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
            $calendar = 'Casa de la Juventud';
            break;
    }
    $start = explode('T',$details['event_time']['start_time']);
    $start_hour = explode(':',$start[1]);
    $day = explode('-',$start[0]);
    $end = explode('T',$details['event_time']['end_time']);
    $end_hour = explode(':',$end[1]);
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
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'Cc: oficinatorre@gmail.com';
    $headers[] = 'Bcc: '.$details['mail'];
    $headers[] = 'Bcc: works.alonsog@gmail.com';
    $headers[] = 'Bcc: arantza.fernandezmerino@gmail.com';
    $headers[] = 'Bcc: chaleco199879@gmail.com';
    wp_mail( $to, $subject, $body, $headers, $attachment );
}