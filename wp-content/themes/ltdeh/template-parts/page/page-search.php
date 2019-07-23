<div class="col-lg-12 mb-30">
    <div class="dx-box dx-box-decorated">
        <div class="dx-blog-post">
            <div class="dx-blog-post-box pt-40 pb-40">
                <h2 class="h4 mb-0"><?= the_title(); ?></h2>
            </div>
            <div class="dx-separator"></div>
            <div class="p-25">
                <?php the_excerpt(); ?>
                <?php if( get_post_type(get_the_ID()) == 'document' ): ?>
                    <a target="_blank" class="dx-btn" href="<?= content_url('/').get_post_meta(get_the_ID(), '_document_link',true) ?>">Descargar</a>
                <?php else: ?>
                    <a href="<?= get_the_permalink(); ?>" class="dx-btn">Ver entrada</a>
                <?php endif; ?>
            </div>
            <div class="dx-separator"></div>
            <div class="dx-blog-post-box pt-30 pb-30">
                <ul class="dx-blog-post-info mnt-15 mnb-2">
                    <li>Fecha: <?= get_the_date() ?></li>
                </ul>
            </div>  
        </div>
    </div>
</div>