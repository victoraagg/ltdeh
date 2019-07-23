<div class="about_gallery_section">  
    <h1 class="text-center featured_categories"><?= get_query_var($title); ?></h1>
    <div class="container">  
        <div class="row">
            <?php 
                if(is_post_type_archive( 'idea' )){
                    get_template_part( 'template-parts/idea/form', 'filter' );
                }
            ?> 
            <?php get_template_part('template-parts/loop/post',''); ?>
            <?php get_template_part('template-parts/shared/pagination',''); ?>
            <div class="col-sm-12">
                <?= do_shortcode('[adrotate group="11"]'); ?>
            </div>
        </div>
    </div>    
</div>