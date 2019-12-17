<?php
if( isset($_POST['inscription-request']) && wp_verify_nonce( $_POST['inscription-request'], 'noncename_inscription' ) ){

    $nonce = date('YmdHis');
    
    global $post;
    $members = get_post_meta( $post->ID, 'inscription_members', true );
    
    if(empty($members)){
        $members = array();
        $member = array($nonce,$_POST['name'],$_POST['surname'],$_POST['age'],$_POST['email'],$_POST['phone'],$_POST['notes']);
        array_push($members,$member);
    }else{
        $members = unserialize($members);
        $member = array($nonce,$_POST['name'],$_POST['surname'],$_POST['age'],$_POST['email'],$_POST['phone'],$_POST['notes']);
        array_push($members,$member);
    }

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
    $body .= 'Información adicional: '.$_POST['notes'].'<br>';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'Bcc: '.$_POST['email'];
    $headers[] = 'Bcc: works.alonsog@gmail.com';
    $headers[] = 'Bcc: chaleco199879@gmail.com';
    if (defined('WP_DEBUG') && WP_DEBUG === false) {
        wp_mail( $to, $subject, $body, $headers );
    }

    wp_redirect(ltdeh_get_permalink('redsys').'?payment_inscription='.$post->ID.'-'.$nonce);
    exit;

}