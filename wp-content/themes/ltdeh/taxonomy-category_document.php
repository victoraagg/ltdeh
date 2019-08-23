<?php
get_header();
?>

<div class="dx-main">
    <div class="dx-box-5 bg-grey-6">
        <div class="container">
            <div class="row justify-content-center vertical-gap">
                <div class="col-lg-8">
                    <?php if ( have_posts() ) : ?>
                        <div class="table-responsive mb-30">
                            <table class="table dx-table dx-table-default">
                                <thead>
                                    <tr>
                                        <th scope="col">Documento</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ( have_posts() ) :
                                        the_post();
                                    ?>
                                    <tr>
                                        <th scope="row" class="dx-table-topics p-10"><?= the_title(); ?></th>
                                        <td class="dx-table-lastPost p-10"><a target="_blank" href="<?= content_url('/').get_post_meta(get_the_ID(), '_document_link',true) ?>">Descargar</a></td>
                                    </tr>
                                    <?php
                                    endwhile;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                            $args = array(
                                'show_all' => false,
                                'end_size' => 1,
                                'mid_size' => 2,
                                'prev_next' => true,
                                'prev_text' => __('Anterior', 'ltdeh'),
                                'next_text' => __('Siguiente', 'ltdeh'),
                                'type' => 'plain',
                                'add_args' => true,
                                'add_fragment' => '',
                                'before_page_number' => '',
                                'after_page_number' => '',
                                'screen_reader_text' => __('Navegación', 'ltdeh')
                            );
                            the_posts_pagination($args);
                        ?>
                    <?php endif; ?>
				</div>
				<?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();