<?php get_sidebar(); ?>
<div class="col-lg-8">
    <div class="dx-box dx-box-decorated">
        <div class="dx-blog-post">
            <div class="dx-blog-post-box pt-40 pb-40">
                <h2 class="h4 mb-0"><?= the_title(); ?></h2>
            </div>
            <div class="dx-separator"></div>
            <div class="dx-blog-post-box">
                <?php
                    the_content( sprintf(
                        __( 'Continuar leyendo<span class="screen-reader-text"> "%s"</span>', 'ltdeh' ),
                        get_the_title()
                    ) );
                ?>
            </div>
            <div class="trails">
                <iframe frameBorder="0" scrolling="no" src="https://www.wikiloc.com/wikiloc/spatialArtifacts.do?event=view&id=76075400&measures=off&title=on&near=on&images=off&maptype=H" width="726" height="400"></iframe>
                <div class="dx-separator pt-30 pb-30"></div>
                <iframe frameBorder="0" scrolling="no" src="https://www.wikiloc.com/wikiloc/spatialArtifacts.do?event=view&id=75214208&measures=off&title=on&near=on&images=off&maptype=H" width="726" height="400"></iframe>
            </div>
            <div class="dx-separator pt-30 mb-30"></div>
            <div class="dx-blog-post-box pt-30 pb-30">
                <ul class="dx-blog-post-info mnt-15 mnb-2">
                    <li>Fecha: <?= get_the_date() ?></li>
                </ul>
            </div>  
        </div>
    </div>
</div>