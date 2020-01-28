<?php
// category: destacada
$args = array(
    'posts_per_page' => 3,
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => 22,
        ),
    ),
);
$featured_post = new WP_Query($args);
?>
<h2 class="text-center mb-60">Noticias destacadas</h2>
<?php
    if ( $featured_post->have_posts() ) {
        while ( $featured_post->have_posts() ) {
            $featured_post->the_post();
            get_template_part( 'template-parts/post/content', 'loop' );
        }
    }          
    wp_reset_postdata();
?>