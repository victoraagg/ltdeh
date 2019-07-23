<?php
if ( have_posts() ) :

    while ( have_posts() ) : the_post();
        
        $meta = get_post_meta(get_the_ID());
        $template = '';
        if(!empty($meta['page_template'])){
            $template = $meta['page_template'][0];
		}
		if(is_search()){
			$template = 'search';
		}
		get_template_part( 'template-parts/page/page', $template );

	endwhile;

	$args = array(
		'show_all' => false,
		'end_size' => 1,
		'mid_size' => 2,
		'prev_next' => true,
		'prev_text' => __('Anterior', 'ltdeh'),
		'next_text' => __('Siguiente', 'ltdeh'),
		'type' => 'plain',
		'add_args' => true,
		'add_fragment' => '',
		'before_page_number' => '',
		'after_page_number' => '',
		'screen_reader_text' => __('Navegación', 'ltdeh')
	);
	the_posts_pagination($args);

else :

	get_template_part( 'template-parts/post/content', 'none' );

endif;
?>