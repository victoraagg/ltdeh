<?php
$args = array(
    'posts_per_page' => 3,
);
$featured_post = new WP_Query($args);
?>
<h2 class="text-center mb-60">Últimas noticias</h2>
<?php
    if ( $featured_post->have_posts() ) {
        while ( $featured_post->have_posts() ) {
            $featured_post->the_post();
            get_template_part( 'template-parts/post/content', 'loop' );
        }
    }          
    wp_reset_postdata();
?>