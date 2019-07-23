<?php
while ( have_posts() ) :
the_post();
?>
<div class="col-lg-8">
    <form action="" class="dx-form" method="post">
        <h1><?= get_the_title() ?></h1>
        <?php if(isset($_GET['result'])): ?>
            <div class="alert dx-alert dx-alert-success" role="alert">Inscripción recogida, muchas gracias.</div>
        <?php endif; ?>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <label for="name" class="mnt-7">Nombre</label>
                <input type="text" name="name" class="form-control form-control-style-2" id="name" placeholder="Nombre">
            </div>
        </div>
        <div class="dx-separator"></div>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <label for="email" class="mnt-7">Email</label>
                <input type="text" name="email" class="form-control form-control-style-2" id="email" placeholder="Email">
            </div>
        </div>
        <div class="dx-separator"></div>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <label for="duration" class="mnt-7">Clases</label>
                <select id="duration" name="duration" autocomplete="off">
                    <option value="1">1 clase</option>
                    <option value="2">2 clases</option>
                </select>
            </div>
        </div>
        <div class="dx-separator mb-30"></div>
        <?php wp_nonce_field( 'noncename_inscription', 'inscription-request'); ?>
        <button class="dx-btn dx-btn-lg" type="submit" name="button">Inscribirme</button>
    </form>
</div>
<?php
endwhile;
?>