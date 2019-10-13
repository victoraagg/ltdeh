<?php
if( isset($_POST['notifications-request']) && wp_verify_nonce( $_POST['notifications-request'], 'noncename_notifications' ) ){

    $phone = filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_SPECIAL_CHARS);
    if(!preg_match("/^[0-9\ +]*$/", $phone)) {
        wp_redirect( get_permalink().'?result=invalid' ); 
        exit;
    }

    $subscriptions = get_option( 'subscriptions_phone' );
    if($subscriptions){
        $numbers = unserialize($subscriptions);
        if (in_array($phone, $numbers)) {
            wp_redirect( get_permalink().'?result=exist' ); 
            exit;
        }else{
            array_push($numbers,$phone);
            $numbers = serialize($numbers);
            update_option( 'subscriptions_phone', $numbers, false );
            wp_redirect( get_permalink().'?result=ok' ); 
            exit;
        }
    }else{
        $numbers = serialize(array($phone));
        update_option( 'subscriptions_phone', $numbers, false );
        wp_redirect( get_permalink().'?result=ok' ); 
        exit;
    }

}