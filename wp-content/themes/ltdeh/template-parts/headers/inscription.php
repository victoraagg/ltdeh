<?php
if( isset($_POST['inscription-request']) && wp_verify_nonce( $_POST['inscription-request'], 'noncename_inscription' ) ){

    $nonce = date('Ymd-His');
    
    global $post;
    $members = get_post_meta( $post->ID, 'inscription_members', true );
    
    if(empty($members)){
        $members = array();
        $member = array($_POST['name'],$_POST['surname'],$_POST['age'],$_POST['email'],$_POST['gender'],$_POST['notes']);
        array_push($members,$member);
    }else{
        $members = unserialize($members);
        $member = array($_POST['name'],$_POST['surname'],$_POST['age'],$_POST['email'],$_POST['gender'],$_POST['notes']);
        array_push($members,$member);
    }

    $members = serialize($members);
    update_post_meta( $post->ID, 'inscription_members', $members );

    $to = 'latorredeestebanhambran@gmail.com';
    $subject = __('Nueva inscripción a '.$_POST['event'], 'ltdeh');
    $body = '<strong>Datos</strong><br><br>';
    $body .= 'Nombre: '.$_POST['name'].'<br>';
    $body .= 'Apellidos: '.$_POST['surname'].'<br>';
    $body .= 'Edad: '.$_POST['age'].'<br>';
    $body .= 'Email: '.$_POST['email'].'<br>';
    $body .= 'Género: '.$_POST['gender'].'<br>';
    $body .= 'Información adicional: '.$_POST['notes'].'<br>';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'Cc: works.alonsog@gmail.com';
    $headers[] = 'Cc: arantza.fernandezmerino@gmail.com';
    $headers[] = 'Cc: chaleco199879@gmail.com';
    wp_mail( $to, $subject, $body, $headers );

    wp_redirect( get_permalink().'?result='.$nonce ); 
    exit;

}