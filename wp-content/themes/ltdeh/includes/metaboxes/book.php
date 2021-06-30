<?php
if (!defined('ABSPATH')) {
    exit;
}

function ltdeh_custom_metabox_book_name() {
    add_meta_box(
        '_book_data', 
        __('Información', 'ltdeh'), 
        'ltdeh_custom_metabox_book_data_callback', 
        'book', 
        'advanced', 
        'default', 
        []
    );
}
add_action('add_meta_boxes_book', 'ltdeh_custom_metabox_book_name');

function ltdeh_custom_metabox_book_data_callback($post, $data) {

    $postMeta = get_post_meta($post->ID);

    $_book_active = isset($postMeta['_book_active']) ? $postMeta['_book_active'][0] : '';
    $_book_name = isset($postMeta['_book_name']) ? $postMeta['_book_name'][0] : '';
    $_book_mail = isset($postMeta['_book_mail']) ? $postMeta['_book_mail'][0] : '';
    $_book_phone = isset($postMeta['_book_phone']) ? $postMeta['_book_phone'][0] : '';
    $_book_day = isset($postMeta['_book_day']) ? $postMeta['_book_day'][0] : '';
    $_book_month = isset($postMeta['_book_month']) ? $postMeta['_book_month'][0] : '';
    $_book_year = isset($postMeta['_book_year']) ? $postMeta['_book_year'][0] : '';
    $_book_hour = isset($postMeta['_book_hour']) ? $postMeta['_book_hour'][0] : '';
    $_book_duration = isset($postMeta['_book_duration']) ? $postMeta['_book_duration'][0] : '';
    $_book_site = isset($postMeta['_book_site']) ? $postMeta['_book_site'][0] : '';
    $_book_dni = isset($postMeta['_book_dni']) ? $postMeta['_book_dni'][0] : '';
    $_book_representation = isset($postMeta['_book_representation']) ? $postMeta['_book_representation'][0] : '';
    $_book_activity = isset($postMeta['_book_activity']) ? $postMeta['_book_activity'][0] : '';
    $_book_recurrence = isset($postMeta['_book_recurrence']) ? $postMeta['_book_recurrence'][0] : '';
    $_book_end_recurrence = isset($postMeta['_book_end_recurrence']) ? $postMeta['_book_end_recurrence'][0] : '';
    $_book_days_recurrence = isset($postMeta['_book_days_recurrence']) ? $postMeta['_book_days_recurrence'][0] : '';

    echo '<p>Estado</p>';
    echo '<select name="_book_active">';
    if(!$_book_active || $_book_active == 'N'){ $selected = 'selected'; }else{ $selected = ''; }
    echo '<option value="Y">Activa</option>';
    echo '<option '.$selected.' value="N">Pendiente</option>';
    echo '</select>';
    echo '<p>Nombre</p>';
    echo '<input type="text" name="_book_name" value="'.$_book_name.'" style="width: 100%;">';
    echo '<p>Email</p>';
    echo '<input type="text" name="_book_mail" value="'.$_book_mail.'" style="width: 100%;">';
    echo '<p>Teléfono</p>';
    echo '<input type="text" name="_book_phone" value="'.$_book_phone.'" style="width: 100%;">';
    echo '<p>Día</p>';
    echo '<input type="text" name="_book_day" value="'.$_book_day.'" style="width: 100%;">';
    echo '<p>Mes</p>';
    echo '<input type="text" name="_book_month" value="'.$_book_month.'" style="width: 100%;">';
    echo '<p>Año</p>';
    echo '<input type="text" name="_book_year" value="'.$_book_year.'" style="width: 100%;">';
    echo '<p>Hora</p>';
    echo '<input type="text" name="_book_hour" value="'.$_book_hour.'" style="width: 100%;">';
    echo '<p>Duración</p>';
    echo '<input type="text" name="_book_duration" value="'.$_book_duration.'" style="width: 100%;">';
    echo '<p>Instalación</p>';
    echo '<select name="_book_site">';
    foreach(get_all_spaces() as $site){
        if($_book_site == $site){ $selected = 'selected'; }else{ $selected = ''; }
        echo '<option '.$selected.' value="'.$site.'">'.$site.'</option>';
    }
    echo '</select>';
    echo '<p>DNI</p>';
    echo '<input type="text" name="_book_dni" value="'.$_book_dni.'" style="width: 100%;">';
    echo '<p>En representación de</p>';
    echo '<input type="text" name="_book_representation" value="'.$_book_representation.'" style="width: 100%;">';
    echo '<p>Actividad</p>';
    echo '<input type="text" name="_book_activity" value="'.$_book_activity.'" style="width: 100%;">';
    echo '<p>Recurrente</p>';
    echo '<select name="_book_recurrence">';
    if(!$_book_recurrence || $_book_recurrence == 'N'){ $selected = 'selected'; }else{ $selected = ''; }
    echo '<option value="Y">SI</option>';
    echo '<option '.$selected.' value="N">NO</option>';
    echo '</select>';
    echo '<p>Fin recurrencia (AAAA-mm-dd)</p>';
    echo '<input type="text" name="_book_end_recurrence" value="'.$_book_end_recurrence.'" style="width: 100%;">';
    echo '<p>Días de recurrencia (0=Domingo y separados por comas)</p>';
    echo '<input type="text" name="_book_days_recurrence" value="'.$_book_days_recurrence.'" style="width: 100%;">';
}

function ltdeh_custom_metabox_book_link_list_save($post_id, $post) {
    if (isset($_POST['_book_active'])){
        update_post_meta($post_id, '_book_active', $_POST['_book_active']);
    }
    if (isset($_POST['_book_name'])){
        update_post_meta($post_id, '_book_name', $_POST['_book_name']);
    }
    if (isset($_POST['_book_mail'])){
        update_post_meta($post_id, '_book_mail', $_POST['_book_mail']);
    }
    if (isset($_POST['_book_phone'])){
        update_post_meta($post_id, '_book_phone', $_POST['_book_phone']);
    }
    if (isset($_POST['_book_day'])){
        update_post_meta($post_id, '_book_day', $_POST['_book_day']);
    }
    if (isset($_POST['_book_month'])){
        update_post_meta($post_id, '_book_month', $_POST['_book_month']);
    }
    if (isset($_POST['_book_year'])){
        update_post_meta($post_id, '_book_year', $_POST['_book_year']);
    }
    if (isset($_POST['_book_hour'])){
        update_post_meta($post_id, '_book_hour', $_POST['_book_hour']);
    }
    if (isset($_POST['_book_duration'])){
        update_post_meta($post_id, '_book_duration', $_POST['_book_duration']);
    }
    if (isset($_POST['_book_site'])){
        update_post_meta($post_id, '_book_site', $_POST['_book_site']);
    }
    if (isset($_POST['_book_dni'])){
        update_post_meta($post_id, '_book_dni', $_POST['_book_dni']);
    }
    if (isset($_POST['_book_representation'])){
        update_post_meta($post_id, '_book_representation', $_POST['_book_representation']);
    }
    if (isset($_POST['_book_activity'])){
        update_post_meta($post_id, '_book_activity', $_POST['_book_activity']);
    }
    if (isset($_POST['_book_recurrence'])){
        update_post_meta($post_id, '_book_recurrence', $_POST['_book_recurrence']);
    }
    if (isset($_POST['_book_end_recurrence'])){
        update_post_meta($post_id, '_book_end_recurrence', $_POST['_book_end_recurrence']);
    }
    if (isset($_POST['_book_days_recurrence'])){
        update_post_meta($post_id, '_book_days_recurrence', $_POST['_book_days_recurrence']);
    }
}
add_action('save_post_book', 'ltdeh_custom_metabox_book_link_list_save', 10, 2);