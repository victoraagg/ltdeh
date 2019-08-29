<?php
if( isset($_POST['subject']) && wp_verify_nonce( $_POST['contact-request'], 'noncename_contact' ) ){

    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS);
    $mail = filter_input(INPUT_POST, 'direction', FILTER_SANITIZE_SPECIAL_CHARS);
    $desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

    $to = 'oficinatorre@gmail.com';
    $subject = __('Información WEB', 'ltdeh');
    $body = 'Nuevo mensaje desde la web<br><br>';
    $body .= 'Asunto: '.$subject.'<br>';
    $body .= 'Email: '.$mail.'<br>';
    $body .= 'Mensaje: '.$desc.'<br>';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'Cc: latorredeestebanhambran@gmail.com';
    wp_mail( $to, $subject, $body, $headers );

    wp_redirect( get_permalink().'?result=ok' ); 
    exit;

}