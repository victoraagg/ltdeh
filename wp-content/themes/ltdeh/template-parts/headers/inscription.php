<?php
if( isset($_POST['inscription-request']) && wp_verify_nonce( $_POST['inscription-request'], 'noncename_inscription' ) ){

    $nonce = date('ynjGi');
    
    global $post;
    $members = get_post_meta( $post->ID, 'inscription_members', true );
    
    if(empty($members)){
        $members = array();
        $member = array($nonce,$_POST['name'],$_POST['surname'],$_POST['age'],$_POST['email'],$_POST['phone'],$_POST['mode'],$_POST['notes']);
        array_push($members,$member);
    }else{
        $members = unserialize($members);
        $member = array($nonce,$_POST['name'],$_POST['surname'],$_POST['age'],$_POST['email'],$_POST['phone'],$_POST['mode'],$_POST['notes']);
        array_push($members,$member);
    }

    if($_POST['mode'] == 'P'){ $mode = 'Perfeccionamiento'; }else{ $mode = 'Iniciación'; }

    $members = serialize($members);
    update_post_meta( $post->ID, 'inscription_members', $members );

    $to = 'oficinatorre@gmail.com';
    $subject = __('Inscripción '.$nonce.' a '.$_POST['event'], 'ltdeh');
    $body = 'Inscripción '.$nonce.'<br><br>';
    $body .= 'Nombre: '.$_POST['name'].'<br>';
    $body .= 'Apellidos: '.$_POST['surname'].'<br>';
    $body .= 'Edad: '.$_POST['age'].'<br>';
    $body .= 'Email: '.$_POST['email'].'<br>';
    $body .= 'Teléfono: '.$_POST['phone'].'<br>';
    $body .= 'Modalidad: '.$mode.'<br>';
    $body .= 'Información adicional: '.$_POST['notes'].'<br>';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'Bcc: '.$_POST['email'];
    $headers[] = 'Bcc: works.alonsog@gmail.com';
    $headers[] = 'Bcc: arantza.fernandezmerino@gmail.com';
    $headers[] = 'Bcc: chaleco199879@gmail.com';
    wp_mail( $to, $subject, $body, $headers );

    wp_redirect( get_permalink().'?result='.$nonce ); 
    exit;

}