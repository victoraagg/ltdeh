<?php get_sidebar(); ?>
<div class="col-lg-8">
    <div class="dx-box dx-box-decorated">
        <div class="dx-blog-post">
            <div class="dx-blog-post-box">
                <?php 
                if( isset($_GET['Ds_MerchantParameters']) ){

                    do_action( 'access_api_redsys_public', $_GET['Ds_MerchantParameters'] );

                }elseif( isset($_GET['payment_book']) ){

                    $post = get_page_by_title($_GET['payment_book'], OBJECT, 'book');
                    if($post){
                        $post_id = $post->ID;
                        $post_site = get_post_meta( $post_id, '_book_site', true );
                        $post_duration = (int)get_post_meta( $post_id, '_book_duration', true );
                        $post_hour = get_post_meta( $post_id, '_book_hour', true );
                        $hours = explode(':',$post_hour);
                        //$order = date('His').substr($post_id,0,6);
                        $order = '0'.$post_id;
                        $order = str_pad($order, 12, "X", STR_PAD_RIGHT);
                        //$order = str_pad($post_id, 8, "0", STR_PAD_LEFT) . date("is");
                        /*
                        $len_order = strlen($order);
                        $rest_chars = 12 - $len_order;
                        for ($i=0; $i < $rest_chars ; $i++) { 
                            $order .= 'X';
                        }
                        */
                        echo '<h1>Información del pago:</h1>';
                        echo '<p>Espacio: '.$post_site.'</p>';
                        echo '<p>Duración: '.$post_duration.'h.</p>';
                        echo '<p>Pedido: '.$order.'</p>';
                        switch ($post_site) {
                            case 'Pista Pádel 1':
                            case 'Pista Pádel 2':
                                echo '<p>Para completar la reserva es necesario realizar el pago</p>';
                                if($post_duration == 3){
                                    $post_duration = 2; 
                                }
                                if($hours[0] >= '19'){
                                    echo do_shortcode('[redsysbutton desc="Pista Padel - '.$post_id.'" id='.get_redsys_button_id('padel-luz').' qty='.$post_duration.' order="'.$order.'"]');
                                    break;
                                }else{
                                    echo do_shortcode('[redsysbutton desc="Pista Padel - '.$post_id.'" id='.get_redsys_button_id('padel').' qty='.$post_duration.' order="'.$order.'"]');
                                    break;
                                }
                            case 'Pabellón Polideportivo':
                                echo '<p>Para completar la reserva es necesario realizar el pago</p>';
                                if($hours[0] >= '19'){
                                    echo do_shortcode('[redsysbutton desc="Pabellon - '.$post_id.'" id='.get_redsys_button_id('pabellon-luz').' qty='.$post_duration.' order="'.$order.'"]');
                                    break;
                                }else{
                                    echo do_shortcode('[redsysbutton desc="Pabellon - '.$post_id.'" id='.get_redsys_button_id('pabellon').' qty='.$post_duration.' order="'.$order.'"]');
                                    break;
                                }
                            default:
                                update_post_meta( $post_id, '_book_active', 'Y' );
                                notify_event_managers($post_id);
                                echo '<div class="alert dx-alert dx-alert-info">Reserva completada</div>';
                                break;
                        }
                    }else{
                        echo '<div class="alert dx-alert dx-alert-danger">Reserva errónea</div>';
                    }

                }elseif( isset($_GET['payment_inscription']) ){

                    global $post;
                    $data_inscription = explode('-',$_GET['payment_inscription']);
                    $post_id = $data_inscription[0];
                    $nonce = $data_inscription[1];
                    $button = get_post_meta( $post_id, 'redsys_button', true );
                    $order = date('His').substr($post_id,0,6);
                    if($button){
                        echo '<p>Para completar la inscripción es necesario realizar el pago</p>';
                        echo do_shortcode('[redsysbutton desc="Inscripcion - '.$post_id.' - '.$nonce.'" id='.$button.' qty=1 order="'.$order.'"]');
                    }else{
                        echo '<div class="alert dx-alert dx-alert-info">Inscripción completada</div>';
                    }

                }
                ?>
            </div>
        </div>
    </div>
</div>