<?php
$currentPost = get_post();
$meta = get_post_meta($currentPost->ID);
$headerTemplate = '';
if(!empty($meta['header_template'])){
    $headerTemplate = $meta['header_template'][0];
    get_template_part( 'template-parts/headers/'.$headerTemplate, '' );
}
?>