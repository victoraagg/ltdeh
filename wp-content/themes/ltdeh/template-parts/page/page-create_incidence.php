<div class="col-xl-12">
    <form action="" class="dx-form" method="post" enctype="multipart/form-data">
        <h1>Publicar nueva indicencia</h1>
        <?php if(isset($_GET['result'])): ?>
            <div class="alert dx-alert dx-alert-success" role="alert">Incidencia <?= $_GET['result'] ?> registrada, en breve gestionaremos su solicitud.</div>
        <?php endif; ?>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <label for="subject" class="mnt-7">Título</label>
                <input type="text" name="subject" class="form-control form-control-style-2" id="subject" placeholder="Título">
            </div>
        </div>
        <div class="dx-separator"></div>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <label for="direction" class="mnt-7">Dirección</label>
                <input type="text" name="direction" class="form-control form-control-style-2" id="direction" placeholder="Dirección">
            </div>
        </div>
        <div class="dx-separator"></div>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <label class="mnt-7">Descripción</label>
                <div class="dx-editor-quill">
                    <textarea name="description" class="dx-editor" name="" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
        </div>
        <div class="dx-separator"></div>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <label class="mnt-7">Imagen</label>
                <input type="file" name="image" accept="image/*" capture="environment">
            </div>
        </div>
        <?php wp_nonce_field( 'noncename_incidence', 'incidence-request'); ?>
        <button class="dx-btn dx-btn-lg" type="submit" name="button">Enviar incidencia</button>
    </form>
</div>