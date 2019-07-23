<?php
$capi = new GoogleCalendarApi();	
if(isset($_GET['code'])){
    $data = $capi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
    update_option( 'google_access_token', $data['access_token'], true );
    wp_redirect( get_permalink(120) );
    exit;
}