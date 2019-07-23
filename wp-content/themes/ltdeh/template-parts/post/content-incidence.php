<?php
while ( have_posts() ) :
the_post();
?>
<div class="col-lg-8">
    <div class="dx-box dx-box-decorated">
        <div class="dx-blog-post dx-ticket dx-ticket-open">
            <div class="dx-blog-post-box pt-30 pb-30">
                <h2 class="h4 mnt-5 mb-9 dx-ticket-title"><?= get_the_title() ?></h2>
            </div>
            <div class="dx-separator"></div>
            <div style="background-color: #fafafa;">
                <ul class="dx-blog-post-info dx-blog-post-info-style-2 mb-0 mt-0">
                    <li><span><span class="dx-blog-post-info-title">ID</span>#<?= get_the_ID() ?></span></li>
                    <li><span><span class="dx-blog-post-info-title">Estado</span><?= get_status_incidence(get_the_ID()); ?></span></li>
                    <li><span><span class="dx-blog-post-info-title">Fecha</span><?= get_the_date() ?></span></li>
                </ul>
            </div>
            <div class="dx-separator"></div>
            <div class="dx-comment dx-ticket-comment">
                <div>
                    <div class="dx-comment-img">
                        <img src="assets/images/avatar-1.png" alt="">
                    </div>
                    <div class="dx-comment-cont">
                        <p class="dx-comment-name">Dirección: <?= get_post_meta(get_the_ID(), 'incidence_direction',true) ?></p>
                        <div class="dx-comment-date">Asunto: <?= get_post_meta(get_the_ID(), 'incidence_title',true) ?></div>
                        <div class="dx-comment-text">
                            <?php the_content(); ?>
                        </div>
                        <?php if(get_post_meta(get_the_ID(), 'incidence_image',true)): ?>
                            <a href="<?= get_post_meta(get_the_ID(), 'incidence_image',true) ?>" target="_blank" class="dx-comment-file dx-comment-file-jpg">
                                <span class="dx-comment-file-img"><img src="<?= get_post_meta(get_the_ID(), 'incidence_image',true) ?>" alt="" width="36"></span>
                                <span class="dx-comment-file-name"><?= end(explode('/', get_post_meta(get_the_ID(), 'incidence_image',true))); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
endwhile;
?>