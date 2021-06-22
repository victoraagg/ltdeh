<footer class="dx-footer">
    <div class="dx-box-1">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-4 mb-30">
                    <div class="dx-widget-footer">
                        <div class="dx-widget-title">
                            <a href="<?= home_url(); ?>" class="dx-widget-logo">Ayuntamiento de La Torre de Esteban Hambrán</a>
                        </div>
                        <div class="dx-widget-text">
                            <p class="mt-30 mb-0">Plaza Constitución, 1</p>
                            <p class="mb-0">45920 - La Torre de Esteban Hambrán (Toledo)</p>
                            <p class="mb-0">CIF: P4517200D</p>
                            <p class="mb-0"><a href="tel:925795101">925 795 101</a></p>
                            <p class="mb-0">oficinatorre@gmail.com</p>
                            <p class="mb-0">Horario de atención al ciudadano:</p>
                            <p class="mb-0">L-V 9:00h - 14:00h</p>
                            <ul class="dx-social-links mnt-3">
                                <li><a href="https://www.facebook.com/latorredestebanhambran/" target="_blank"><span class="fab fa-facebook"></span></a></li>
                                <li><a href="https://www.instagram.com/noticias.latorredeeh/" target="_blank"><span class="fab fa-instagram"></span></a></li>
                                <li><a href="https://www.youtube.com/channel/UC7l--Q-5WcrJaldstAtNm0Q/" target="_blank"><span class="fab fa-youtube"></span></a></li>
                                <li><a href="https://github.com/victoraagg/ltdeh" target="_blank"><span class="fab fa-github"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-30">
                    <div class="dx-widget-footer">
                        <div class="dx-widget-title">Servicios</div>
                        <?php
                            $defaults = array(
                                'theme_location' => 'footer_menu',
                                'container' => 'ul',
                                'menu_class' => 'dx-widget-list'
                            );
                            wp_nav_menu($defaults);
                        ?>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-5 mb-30">
                    <div class="dx-widget-footer">
                        <div class="dx-widget-title">Buscador</div>
                        <div class="dx-widget-portfolio">
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="bg-primary-color dx-box-6 text-center">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="dx-widget-text">
                    <small class="mb-0 text-white">2019-<?= date('Y') ?> Ayuntamiento de La Torre de Esteban Hambrán - <span class="dib">Todos los derechos reservados.</span></small>
                    <hr>
                    <a target="_blank" rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">
                        <img alt="Licencia Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" />
                    </a>
                    <small class="text-white">Este proyecto está bajo una <a class="text-warning" target="_blank" rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Licencia Creative Commons Atribución-NoComercial-CompartirIgual 4.0 Internacional</a></small>
                </div>
            </div>
        </div>
    </div>
</div>