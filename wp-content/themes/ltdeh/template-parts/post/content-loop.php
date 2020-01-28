<div class="dx-ticket-item dx-ticket-new dx-ticket-open dx-block-decorated">
    <span class="dx-ticket-cont">
        <span class="dx-ticket-name"><?php the_title(); ?></span>
        <span class="dx-ticket-title mt-20"><?php the_excerpt(); ?></span>
        <a class="dx-btn dx-btn-sm text-center mb-30" href="<?php the_permalink(); ?>">Ver noticia</a>
        <ul class="dx-ticket-info">
            <li><?php the_date(); ?></li>
            <li><?php the_category(); ?></li>
        </ul>
    </span>
</div>