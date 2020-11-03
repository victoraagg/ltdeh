<div class="col-xl-12">
    <form action="" class="dx-form" method="post">
        <h1>Contáctanos</h1>
        <?php if(isset($_GET['result'])): ?>
            <div class="alert dx-alert dx-alert-success" role="alert">Mensaje enviado, en breve responderemos su solicitud.</div>
        <?php endif; ?>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <label for="subject" class="mnt-7">Asunto</label>
                <input type="text" name="subject" class="form-control form-control-style-2" id="subject" placeholder="Asunto">
            </div>
        </div>
        <div class="dx-separator"></div>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <label for="direction" class="mnt-7">Email</label>
                <input type="text" name="direction" class="form-control form-control-style-2" id="mail" placeholder="Email">
            </div>
        </div>
        <div class="dx-separator"></div>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <label class="mnt-7">Mensaje</label>
                <div class="dx-editor-quill">
                    <textarea name="description" class="dx-editor" name="" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
        </div>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="privacy" required class="custom-control-input" id="privacy">
                    <label class="custom-control-label" for="privacy">Consiento el uso de mis datos para los fines indicados en la <a href="<?= get_privacy_policy_url(); ?>">Política de Privacidad</a>.</label>
                </div>
            </div>
        </div>
        <?php wp_nonce_field( 'noncename_contact', 'contact-request'); ?>
        <button class="dx-btn dx-btn-lg" type="submit" name="button">Enviar</button>
    </form>
</div>