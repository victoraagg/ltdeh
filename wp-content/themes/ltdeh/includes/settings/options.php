<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_menu', 'ltdeh_custom_menu_site_options_register');
function ltdeh_custom_menu_site_options_register() {
    add_menu_page(
        __('Opciones', 'ltdeh'), 
        __('Opciones', 'ltdeh'), 
        'manage_options', 
        'ltdeh_custom_menu_site_options', 
        'ltdeh_custom_menu_site_options_edit'
    );
}

function ltdeh_custom_menu_site_options_edit() {
    if (!current_user_can('manage_options')) {
        wp_die(__('Insufficient permissions'));
    }
    $options = [
        '_ltdeh_enable_books' => ['Activar Reservas (Valores admitidos: Y/N)', 'text'],
        '_ltdeh_notify_managers' => ['Notificar eventos (Valores admitidos: Y/N)', 'text'],
    ];
    ltdeh_build_custom_menu_site_options(__('Site options', 'ltdeh'), $options);
}

function ltdeh_build_custom_menu_site_options($title, $options) {

    $hidden_field_name = 'ltdeh_options_hidden';

    foreach ($options as $key => $option) {
        $opt_val = get_option($key);
        if (!empty($opt_val)) {
            array_push($options[$key], $opt_val);
        } else {
            array_push($options[$key], '');
        }
    }

    if (isset($_POST[$hidden_field_name]) && $_POST[$hidden_field_name] == 'Y') {
        foreach ($_POST as $key => $value) {
            $datatype = substr($key, 0, 7);
            if ($datatype == '_ltdeh_') {
                update_option($key, $value);
            }
        }
        echo '<div class="updated"><p><strong>'.__('Guardado', 'ltdeh').'</strong></p></div>';
    } ?>

    <div class="wrap">
        <form name="options" method="post" action="">
            <input type="hidden" name="<?= $hidden_field_name; ?>" value="Y">
            <?php foreach ($options as $key => $option) { ?>
                <label for="<?= $key ?>"><?= $option[0] ?></label>
                <br>
                <input id="<?= $key; ?>" type="<?= $option[1] ?>" name="<?= $key; ?>" value="<?= $option[2] ?>">
                <hr>
            <?php } ?>
            <input type="submit" name="submit" class="button-primary" value="<?= __('Guardar', 'ltdeh') ?>" />
        </form>
    </div>
    
    <?php
}