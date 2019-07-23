<?php
$args = array(
    'posts_per_page' => 2
);
$featured_query = new WP_Query($args);
?>
<h2 class="text-center mb-60">Noticias destacadas</h2>
<?php
    if ( $featured_query->have_posts() ) {
        while ( $featured_query->have_posts() ) {
            $featured_query->the_post();
            get_template_part( 'template-parts/post/content', 'loop' );
        }
    }                 
    wp_reset_postdata();
?>