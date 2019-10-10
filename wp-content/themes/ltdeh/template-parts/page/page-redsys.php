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
                        switch ($post_site) {
                            case 'Pista Pádel 1':
                            case 'Pista Pádel 2':
                                echo '<p>Para completar la reserva es necesario realizar el pago</p>';
                                if($hours[0] >= '20'){
                                    echo do_shortcode('[redsysbutton id=208 qty='.$post_duration.' order="RSRVE-'.$post_id.'"]');
                                    break;
                                }else{
                                    echo do_shortcode('[redsysbutton id=199 qty='.$post_duration.' order="RSRVE-'.$post_id.'"]');
                                    break;
                                }
                            case 'Pabellón Polideportivo':
                                echo '<p>Para completar la reserva es necesario realizar el pago</p>';
                                if($hours[0] >= '20'){
                                    echo do_shortcode('[redsysbutton id=212 qty='.$post_duration.' order="RSRVE-'.$post_id.'"]');
                                    break;
                                }else{
                                    echo do_shortcode('[redsysbutton id=211 qty='.$post_duration.' order="RSRVE-'.$post_id.'"]');
                                    break;
                                }
                            default:
                                update_post_meta( $post_id, '_book_active', 'Y' );
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
                    $order_id = $post_id.substr($nonce,-6);
                    $button = get_post_meta( $post_id, 'redsys_button', true );
                    if($button){
                        echo '<p>Para completar la inscripción es necesario realizar el pago</p>';
                        echo do_shortcode('[redsysbutton id='.$button.' qty=1 order="N-'.$order_id.'"]');
                    }else{
                        echo '<div class="alert dx-alert dx-alert-info">Inscripción completada</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>