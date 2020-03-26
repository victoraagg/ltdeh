<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		get_template_part( 'template-parts/post/content', 'loop' );
	endwhile;
	$args = array(
		'show_all' => false,
		'end_size' => 1,
		'mid_size' => 2,
		'prev_next' => true,
		'prev_text' => __('<', 'commseek'),
		'next_text' => __('>', 'commseek'),
		'type' => 'list',
	);
	the_posts_pagination($args);
else :
	get_template_part( 'template-parts/post/content', 'none' );
endif;