<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('init', 'create_document_tax', 0);
function create_document_tax() {
    
    $labels = array(
        'name' => _x( 'Categorias', 'taxonomy general name' ),
        'singular_name' => _x( 'Categoria', 'taxonomy singular name' ),
        'search_items' =>  __( 'Buscar por Categorias' ),
        'all_items' => __( 'Todos las Categorias' ),
        'parent_item' => __( 'Categoria padre' ),
        'parent_item_colon' => __( 'Categoria padre:' ),
        'edit_item' => __( 'Editar Categoria' ),
        'update_item' => __( 'Actualizar Categoria' ),
        'add_new_item' => __( 'Añadir nueva Categoria' ),
        'new_item_name' => __( 'Nombre de la nueva Categoria' )
    ); 
    register_taxonomy( 'category_document', array( 'document' ), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 
            'slug' => 'tipo-documento', 
            'with_front' => true
        )
    ));

}

//Show filter in admin cpt list
function ltdeh_add_taxonomy_filters() {
    global $typenow;
    // an array of all the taxonomies you want to display. Use the taxonomy name or slug
    $taxonomies = array('category_document');
    // must set this to the post type you want the filter(s) displayed on
    if ($typenow == 'document') {
        foreach ($taxonomies as $tax_slug) {
            $tax_obj = get_taxonomy($tax_slug);
            $tax_name = $tax_obj->labels->name;
            $terms = get_terms($tax_slug);
            if (count($terms) > 0) {
                echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
                echo "<option value=''>".__('Show all', 'ltdeh')." $tax_name</option>";
                foreach ($terms as $term) {
                    echo '<option value="' . $term->slug . '">' . $term->name . ' (' . $term->count . ')</option>';
                }
                echo "</select>";
            }
        }
    }
}

add_action('restrict_manage_posts', 'ltdeh_add_taxonomy_filters');

//Add column and column info
add_filter( 'manage_document_posts_columns', 'set_custom_edit_document_columns' );
add_action( 'manage_document_posts_custom_column' , 'custom_document_column', 10, 2 );

function set_custom_edit_document_columns($columns) {
    $columns['category_document'] = __( 'Category', 'ltdeh' );
    return $columns;
}

function custom_document_column( $column, $post_id ) {
    switch ( $column ) {
        case 'category_document' :
            $terms = get_the_term_list( $post_id , 'category_document' , '' , ',' , '' );
            if ( is_string( $terms ) )
                echo $terms;
            else
                _e( 'Without category', 'ltdeh' );
            break;
    }
}