<?php get_sidebar(); ?>
<div class="col-lg-8">
    <div class="dx-box dx-box-decorated">
        <div class="dx-blog-post">
            <div class="dx-blog-post-box">
                <?php
                if (isset($_REQUEST['Ds_MerchantParameters']) || isset($_REQUEST['result'])) {
                    do_action('access_api_redsys_public');
                } elseif (isset($_GET['payment_book'])) {
                    $post = get_page_by_title($_GET['payment_book'], OBJECT, 'book');
                    if ($post) {
                        $post_id = $post->ID;
                        $is_sunday = ltdeh_check_book_is_sunday($post_id);
                        $_book_day = get_post_meta($post_id, '_book_day', true);
                        $_book_month = get_post_meta($post_id, '_book_month', true);
                        $_book_year = get_post_meta($post_id, '_book_year', true);
                        $enable_books = is_enable_books($_book_month, $_book_day, $_book_year);
                        if (!$is_sunday && $enable_books) {
                            $post_site = get_post_meta($post_id, '_book_site', true);
                            $post_duration = (int)get_post_meta($post_id, '_book_duration', true);
                            $post_hour = get_post_meta($post_id, '_book_hour', true);
                            $hours = explode(':', $post_hour);
                            echo '<h1>Información del pago:</h1>';
                            echo '<p>Instalación: ' . $post_site . '</p>';
                            echo '<p>Duración: ' . $post_duration . 'h.</p>';
                            switch ($post_site) {
                                case 'Pista Pádel 1':
                                case 'Pista Pádel 2':
                                    echo '<p><strong>Para completar la reserva es necesario realizar el pago</strong></p>';
                                    if ($post_duration == 3) {
                                        $post_duration = 2;
                                    }
                                    if ($hours[0] >= get_option('_ltdeh_hour_lights')) {
                                        echo do_shortcode('[redsysbutton desc="' . $post_site . '" id=' . get_redsys_button_id('padel-luz') . ' qty=' . $post_duration . ' post_id="' . $post_id . '"]');
                                        break;
                                    } else {
                                        echo do_shortcode('[redsysbutton desc="' . $post_site . '" id=' . get_redsys_button_id('padel') . ' qty=' . $post_duration . ' post_id="' . $post_id . '"]');
                                        break;
                                    }
                                case 'Pabellón Polideportivo':
                                    echo '<p>Para completar la reserva es necesario realizar el pago</p>';
                                    if ($hours[0] >= get_option('_ltdeh_hour_lights')) {
                                        echo do_shortcode('[redsysbutton desc="' . $post_site . '" id=' . get_redsys_button_id('pabellon-luz') . ' qty=' . $post_duration . ' post_id="' . $post_id . '"]');
                                        break;
                                    } else {
                                        echo do_shortcode('[redsysbutton desc="' . $post_site . '" id=' . get_redsys_button_id('pabellon') . ' qty=' . $post_duration . ' post_id="' . $post_id . '"]');
                                        break;
                                    }
                                default:
                                    update_post_meta($post_id, '_book_active', 'Y');
                                    notify_event_managers($post_id);
                                    echo '<div class="alert dx-alert dx-alert-info">Reserva completada</div>';
                                    break;
                            }
                        } else {
                            echo '<div class="alert dx-alert dx-alert-danger">Reserva errónea - Fuera del periodo permitido</div>';
                        }
                    } else {
                        echo '<div class="alert dx-alert dx-alert-danger">Reserva errónea</div>';
                    }
                } elseif (isset($_GET['payment_inscription'])) {
                    global $post;
                    $data_inscription = explode('-', $_GET['payment_inscription']);
                    $post_id = $data_inscription[0];
                    $nonce = $data_inscription[1];
                    $button = get_post_meta($post_id, 'redsys_button', true);
                    $order = date('His') . substr($post_id, 0, 6);
                    if ($button) {
                        echo '<p>Para completar la inscripción es necesario realizar el pago</p>';
                        echo do_shortcode('[redsysbutton desc="Inscripción" id=' . $button . ' qty=1 post_id="' . $post_id . '"]');
                    } else {
                        echo '<div class="alert dx-alert dx-alert-info">Inscripción completada</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>