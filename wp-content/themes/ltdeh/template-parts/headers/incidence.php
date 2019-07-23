<?php
if( isset($_POST['subject']) && wp_verify_nonce( $_POST['incidence-request'], 'noncename_incidence' ) ){

    $nonce = date('Ymd-His');

    // Upload file
    if($_FILES['image']['name'] != ''){
        if ( ! function_exists( 'wp_handle_upload' ) ) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
        }
        $uploadedfile = $_FILES['image'];
        $upload_overrides = array( 'test_form' => false );
        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
        $imageurl = "";
        if ( $movefile && ! isset( $movefile['error'] ) ) {
            $imageurl = $movefile['url'];
        } else {
            $imageurl = '';
        }
    }

    $new_incidence = array(
        'post_title' => 'Incidencia '.$nonce,
        'post_content' => wp_strip_all_tags(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS)),
        'post_status' => 'publish',
        'post_type' => 'incidence',
        'meta_input' => array(
            'incidence_direction' => filter_input(INPUT_POST, 'direction', FILTER_SANITIZE_SPECIAL_CHARS),
            'incidence_title' => filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS),
            'incidence_image' => $imageurl
        )
    );
    $new_post_id = wp_insert_post( $new_incidence );

    if($new_post_id):
        wp_set_object_terms( $new_post_id, 14, 'status_incidence' );
    endif;

    $to = 'latorredeestebanhambran@gmail.com';
    $subject = __('Nueva incidencia WEB', 'ltdeh');
    $body = 'Nueva incidencia publicada - Consulta el panel de administración para acceder a los datos.';
    $headers = array(
        'Content-Type: text/html; charset=UTF-8'
    );
    wp_mail( $to, $subject, $body, $headers );

    wp_redirect( get_permalink().'?result='.$nonce ); 
    exit;

}