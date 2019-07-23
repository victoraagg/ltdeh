<?php
if( isset($_POST['inscription-request']) && wp_verify_nonce( $_POST['inscription-request'], 'noncename_inscription' ) ){

    $nonce = date('Ymd-His');
    
    global $post;
    $members = get_post_meta( $post->ID, 'inscription_members', true );
    
    if(empty($members)){
        $members = array();
        $member = array($_POST['name'],$_POST['email'],$_POST['duration']);
        array_push($members,$member);
    }else{
        $members = unserialize($members);
        $member = array($_POST['name'],$_POST['email'],$_POST['duration']);
        array_push($members,$member);
    }

    $members = serialize($members);
    update_post_meta( $post->ID, 'inscription_members', $members );

    $to = 'latorredeestebanhambran@gmail.com';
    $subject = __('Nueva inscripción WEB', 'ltdeh');
    $body = 'Nueva inscripción a evento - Consulta el panel de administración para acceder a los datos.';
    $headers = array(
        'Content-Type: text/html; charset=UTF-8'
    );
    wp_mail( $to, $subject, $body, $headers );

    wp_redirect( get_permalink().'?result='.$nonce ); 
    exit;

}