<?php
while ( have_posts() ) :
the_post();
?>
<div class="col-lg-8">
    <form action="" class="dx-form" method="post">
        <h1><?= get_the_title() ?></h1>
        <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <label for="name" class="mnt-7">Nombre</label>
                <input type="text" name="name" class="form-control form-control-style-2" id="name" placeholder="Nombre">
            </div>
        </div>
        <div class="dx-separator"></div>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <label for="surname" class="mnt-7">Apellidos</label>
                <input type="text" name="surname" class="form-control form-control-style-2" id="surname" placeholder="Apellidos">
            </div>
        </div>
        <div class="dx-separator"></div>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <label for="age" class="mnt-7">Edad</label>
                <input type="text" name="age" class="form-control form-control-style-2" id="age" placeholder="Edad">
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
                <label for="phone" class="mnt-7">Teléfono</label>
                <input type="text" name="phone" class="form-control form-control-style-2" id="phone" placeholder="Teléfono">
            </div>
        </div>
        <div class="dx-separator"></div>
        <?php
        	global $post;
			$placeholder = get_post_meta( $post->ID, 'notes_inscription', true );
            if($placeholder): 
                echo '<div class="dx-box-content">';
                echo '<div class="dx-form-group">';
                echo '<label for="notes" class="mnt-7">'.$placeholder.'</label>';
                echo '<textarea class="form-control form-control-style-2" name="notes" id="notes" cols="30" rows="10"></textarea>';
                echo '</div>';
                echo '</div>';
                echo '<div class="dx-separator mb-30"></div>';
            endif; 
        ?>
        <?php wp_nonce_field( 'noncename_inscription', 'inscription-request'); ?>
        <input type="hidden" name="event" value="<?= get_the_title() ?>">
        <button class="dx-btn dx-btn-xl dx-btn-block" type="submit" name="button">Inscribirme</button>
    </form>
</div>
<?php
endwhile;
?>