<?php
get_header();
?>

<div class="dx-main">
    <div class="dx-box-5 bg-grey-6">
        <div class="container">

            <header class="page-header mb-50">
                <h1>Incidencias</h1>
                <a href="<?php the_permalink(103) ?>" class="dx-btn dx-btn-grey-1 dx-article-btn">Informar de nueva incidencia</a>
            </header>

            <div class="row justify-content-center vertical-gap">

                <?php if ( have_posts() ) : ?>
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <table class="dx-table dx-table-default">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Incidencia</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ( have_posts() ) :
                                    the_post();
                                    if(get_status_incidence(get_the_ID()) == 'Publicada'):
                                    ?>
                                    <tr>
                                        <th scope="row" class="dx-table-topics">
                                            <p><?= the_ID(); ?></p>
                                        </th>
                                        <th scope="row" class="dx-table-topics">
                                            <a href="<?= the_permalink(); ?>"><?= the_title(); ?></a>
                                        </th>
                                        <td><span class="dib"><?= the_date(); ?></span></td>
                                        <td class="dx-table-lastPost">
                                            <div class="dx-table-default-info">
                                                <p class="badge badge-info"><?= get_status_incidence(get_the_ID()); ?></p>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    endif;
                                    endwhile;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php get_sidebar(); ?>
                <?php
                else :
                    get_template_part( 'template-parts/content/content', 'none' );
                endif;
                ?>

            </div>
        </div>
    </div>
</div>

<?php
get_footer();