<?php
// category: destacada
$args = array(
    'posts_per_page' => 2,
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => 22,
        ),
    ),
);
$featured_post = new WP_Query($args);
$regular_post = new WP_Query( array('posts_per_page' => 2) );
?>
<h2 class="text-center mb-60">Noticias destacadas</h2>
<?php
    if ( $featured_post->have_posts() ) {
        while ( $featured_post->have_posts() ) {
            $featured_post->the_post();
            get_template_part( 'template-parts/post/content', 'loop' );
        }
    }        
    while ( $regular_post->have_posts() ) {
        $regular_post->the_post();
        get_template_part( 'template-parts/post/content', 'loop' );
    }     
    wp_reset_postdata();
?>