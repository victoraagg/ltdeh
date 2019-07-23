<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>
<form role="search" method="get" action="<?= esc_url( home_url( '/' ) ); ?>" class="dx-form dx-form-group-inputs">
	<input class="form-control form-control-style-2" value="" id="<?= $unique_id; ?>" name="s" placeholder="<?= esc_attr_x( 'Buscar', 'placeholder', 'banium' ); ?>" type="search">
    <button class="dx-btn dx-btn-lg dx-btn-grey dx-btn-grey-style-2 dx-btn-icon"><span class="icon fas fa-search"></span></button>
    <input type="hidden" class="field" name="post_type[]" id="post_type" value="post">
    <input type="hidden" class="field" name="post_type[]" id="post_type" value="document">  
    <input type="hidden" class="field" name="post_type[]" id="post_type" value="inscription">  
</form>