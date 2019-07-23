<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		get_template_part( 'template-parts/post/content', 'loop' );
	endwhile;
else :
	get_template_part( 'template-parts/post/content', 'none' );
endif;