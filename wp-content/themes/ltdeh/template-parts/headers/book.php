<?php
if (!defined('ABSPATH')) {
    exit;
}

if( isset($_POST['book-request']) && wp_verify_nonce( $_POST['book-request'], 'noncename_book' ) ){

    $empty = false;
    if(empty($_POST['book-name'])){
        $empty = true;
    }

    if($empty){
        wp_redirect(ltdeh_get_permalink('reserva').'?error-book=data');
        exit();
    }

    $event_id = date('ynjGis');
    $details = array(
        'title' => $_POST['book-name'],
        'mail' => $_POST['book-mail'],
        'phone' => $_POST['book-phone'],
        'event_time' => array(
            'day' => $_POST['book-day'],
            'month' => $_POST['book-month'],
            'start_time' => $_POST['book-start'],
            'duration' => $_POST['book-duration'],
        ),
        'calendar' => $_POST['book-calendar'],
        'dni' => $_POST['book-dni'],
        'representation' => $_POST['book-representation'],
        'activity' => $_POST['book-activity'],
    );

    $availability = ltdeh_check_availability_book($details['event_time'], $details['calendar']);
    if(!$availability){
        wp_redirect(ltdeh_get_permalink('reserva').'?error-book=availability');
        exit();
    }
    
    if(strlen($details['event_time']['day'])==1){ 
        $day = '0'.$details['event_time']['day']; 
    }else{ 
        $day = $details['event_time']['day']; 
    }

    if(strlen($details['event_time']['month'])==1){ 
        $month = '0'.$details['event_time']['month']; 
    }else{ 
        $month = $details['event_time']['month']; 
    }
    
    $new_book = array(
        'post_title' => $event_id,
        'post_status' => 'publish',
        'post_type' => 'book',
        'meta_input' => array(
            '_book_active' => 'N',
            '_book_name' => $details['title'],
            '_book_mail' => $details['mail'],
            '_book_phone' => $details['phone'],
            '_book_day' => $day,
            '_book_month' => $month,
            '_book_year' => date('Y'),
            '_book_hour' => $details['event_time']['start_time'],
            '_book_duration' => $details['event_time']['duration'],
            '_book_site' => $details['calendar'],
            '_book_dni' => $details['dni'],
            '_book_representation' => $details['representation'],
            '_book_activity' => $details['activity']
        )
    );    
    $post_id = wp_insert_post( $new_book );
    generate_doc_auth($event_id, $details);
    wp_redirect(ltdeh_get_permalink('redsys').'?payment_book='.$event_id);
    
}