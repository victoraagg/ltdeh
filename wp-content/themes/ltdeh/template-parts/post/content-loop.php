<div class="dx-ticket-item dx-ticket-new dx-ticket-open dx-block-decorated">
    <span class="dx-ticket-cont">
        <a href="<?php the_permalink(); ?>">
            <span class="dx-ticket-name"><?php the_title(); ?></span>
        </a>
        <span class="dx-ticket-title mt-20"><?php the_excerpt(); ?></span>
        <ul class="dx-ticket-info">
            <li><?php the_date(); ?></li>
            <li><?php the_category(); ?></li>
        </ul>
    </span>
</div>