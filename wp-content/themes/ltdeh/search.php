<?php
get_header();
?>

<div class="dx-main">
    <div class="dx-box-5 pb-100 bg-grey-6">
        <div class="container">
            <div class="row justify-content-center vertical-gap md-gap">
                <?php get_sidebar(); ?>
                <div class="col-lg-8">
                    <?php get_template_part('template-parts/loop/page',''); ?>			
                </div>	
            </div>
        </div>
	</div>
</div>

<?php
get_footer();