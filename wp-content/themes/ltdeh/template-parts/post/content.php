<?php
while ( have_posts() ) :
the_post();
?>
<div class="col-lg-8">
    <div class="dx-blog-post dx-box dx-box-decorated">
        <div class="dx-blog-post-box pb-30">
            <h1 class="h3 dx-blog-post-title"><?= the_title(); ?></h1>
            <ul class="dx-blog-post-info">
                <li><?php the_date(); ?></li>
                <li><?php the_tags() ?></li>
            </ul>
        </div>
        <div class="dx-blog-post-box">
            <?php the_content(); ?>
            <?php the_post_thumbnail('large'); ?>
        </div>
    </div>
</div>
<?php
endwhile; // End of the loop.
?>