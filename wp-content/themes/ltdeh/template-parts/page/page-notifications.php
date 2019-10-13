<?php get_sidebar(); ?>
<div class="col-lg-8">
    <div class="dx-box dx-box-decorated">
        <div class="dx-blog-post">
            <div class="dx-blog-post-box pt-40 pb-40">
                <h1>Servicio de notificaciones</h1>
            </div>
            <div class="dx-separator"></div>
            <div class="dx-blog-post-box">
                <p>Mediante este servicio, podrás suscribirte a las notificaciones oficiales que se emitan desde el Ayuntamiento.</p>
                <p>De este modo, podrás estar informado de toda la actualidad, eventos, o información que sea de utilidad para todos los ciudadanos.</p>
                <?php 
                    if(isset($_GET['result'])): 
                        switch ($_GET['result']) {
                            case 'ok':
                                echo '<div class="alert dx-alert dx-alert-success" role="alert">Suscripción añadida, muchas gracias.</div>';
                                break;
                            case 'exist':
                                echo '<div class="alert dx-alert dx-alert-danger" role="alert">El número de teléfono ya está incluido</div>';
                                break;
                            case 'invalid':
                                echo '<div class="alert dx-alert dx-alert-danger" role="alert">El número de teléfono no es correcto</div>';
                                break;
                        }
                    endif;
                ?>
                <form action="" class="dx-form" method="post">
                    <div class="dx-box-content">
                        <div class="dx-form-group">
                            <label for="phone" class="mnt-7">Teléfono</label>
                            <input type="tel" name="phone_number" class="form-control form-control-style-2" id="phone" placeholder="Nº Teléfono">
                        </div>
                    </div>
                    <?php wp_nonce_field( 'noncename_notifications', 'notifications-request'); ?>
                    <button class="dx-btn dx-btn-lg" type="submit" name="button">Suscribirme</button>
                </form>
                <small>Responsable de los datos:</small>
                <small>Ayuntamiento de La Torre de Esteban Hambrán. Plaza Constitución, 1. 45920 - La Torre de Esteban Hambrán (Toledo). CIF: P4517200D.</small>
                <small>Finalidad: Envío y gestión de notificaciones a través de SMS o WhatsApp®.</small>
                <small>Legitimación: Consentimiento del interesado.</small>
                <small>Destinatarios: No se cederán datos a terceros, salvo requerimiento legal.</small>
                <small>Los datos quedarán almacenados en los servidores de Hospedaje y Dominios S.L., situados en la Unión Europea y de acuerdo a su política de privacidad.</small>
                <small>Derechos: Tienes derecho a acceder, rectificar y suprimir tus datos, derechos que puedes ejercer enviando un correo electrónico a <a href="mailto:latorredeestebanhambran@gmail.com">latorredeestebanhambran@gmail.com</a>.</small>
                <small>Puedes consultar la información adicional y detallada sobre protección de datos en el aviso legal de este sitio.</small>
            </div>
        </div>
    </div>
</div>