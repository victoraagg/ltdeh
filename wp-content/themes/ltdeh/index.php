<?php
get_header();
?>

<div class="dx-main">
	<div class="dx-box-5 pb-100 bg-grey-6">
		<div class="container">
			<div class="row vertical-gap md-gap">
				<div class="col-lg-8">
					<?php get_template_part('template-parts/loop/post',''); ?>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
