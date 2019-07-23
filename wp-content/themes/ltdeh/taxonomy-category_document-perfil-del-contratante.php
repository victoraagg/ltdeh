<?php
$_terms = get_term_children( '8', 'category_document');
get_header();
?>

<div class="dx-main">
    <div class="dx-box-5 bg-grey-6">
        <div class="container">
            <div class="row justify-content-center vertical-gap">
                <?php foreach ($_terms as $term) : ?>
                    <?php $current_term = get_term($term);?>
                    <div class="col-12 col-md-4 col-lg-3 dx-feature-variable">
                        <div class="dx-feature dx-feature-3 dx-feature-color-1 dx-block-decorated">
                            <div class="dx-feature-cont">
                                <div class="dx-feature-title"><a href="<?= get_term_link($current_term->term_id) ?>"><?= $current_term->name; ?></a></div>
                                <div class="dx-feature-text"><?= $current_term->description; ?></div>
                                <a href="<?= get_term_link($current_term->term_id) ?>" class="dx-btn dx-btn-md">Ver documentos <span class="icon pe-7s-angle-right"></span></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();