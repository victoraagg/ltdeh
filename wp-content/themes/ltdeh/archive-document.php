<?php
$_terms = get_terms( 'category_document', array(
    'parent' => 0
) );
get_header();
?>

<div class="dx-main">
    <div class="dx-box-5 bg-grey-6">
        <div class="container">
            <div class="row justify-content-center vertical-gap">
                <?php get_sidebar(); ?>
                <div class="col-lg-8">
                    <h1 class="mb-50">Listado de documentación disponible</h1>
                    <?php foreach ($_terms as $term) : ?>
                        <div class="col-12 dx-feature-variable mb-10">
                            <div class="dx-feature dx-feature-3 dx-feature-color-1 dx-block-decorated">
                                <div class="dx-feature-cont">
                                    <div class="dx-feature-title"><a href="<?= get_term_link($term->term_id) ?>"><?= $term->name; ?></a></div>
                                    <div class="dx-feature-text"><?= $term->description; ?></div>
                                    <a href="<?= get_term_link($term->term_id) ?>" class="dx-btn dx-btn-md">Ver documentos <span class="fas fa-angle-right"></span></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();