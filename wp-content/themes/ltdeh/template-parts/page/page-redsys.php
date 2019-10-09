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
                    $post_id = $post->ID;
                    $post_site = get_post_meta( $post_id, '_book_site', true );
                    $post_duration = (int)get_post_meta( $post_id, '_book_duration', true );
                    $post_hour = get_post_meta( $post_id, '_book_hour', true );
                    $hours = explode(':',$post_hour);
                    switch ($post_site) {
                        case 'Pista Pádel 1':
                        case 'Pista Pádel 2':
                            if($hours[0] >= '20'){
                                echo do_shortcode('[redsysbutton id=208 qty='.$post_duration.' book='.$post_id.']');
                                break;
                            }else{
                                echo do_shortcode('[redsysbutton id=199 qty='.$post_duration.' book='.$post_id.']');
                                break;
                            }
                        case 'Pabellón Polideportivo':
                            if($hours[0] >= '20'){
                                echo do_shortcode('[redsysbutton id=212 qty='.$post_duration.' book='.$post_id.']');
                                break;
                            }else{
                                echo do_shortcode('[redsysbutton id=211 qty='.$post_duration.' book='.$post_id.']');
                                break;
                            }
                        default:
                            update_post_meta( $post_id, '_book_active', 'Y' );
                            echo '<div class="alert dx-alert dx-alert-success">Reserva correcta</div>';
                            break;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>