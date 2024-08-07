<?php 
if( !class_exists('ALPB_CPT') ):

    class ALPB_CPT{

        public function __construct(){
            add_action( 'init',  array($this,'alpb_cpt') );
        }

        public function alpb_cpt() {
            $labels = array(
                'name'                  => _x( 'Child Websites', 'Post type general name', 'website' ),
                'singular_name'         => _x( 'Website', 'Post type singular name', 'website' ),
                'menu_name'             => _x( 'Siti clienti', 'Admin Menu text', 'website' ),
                'name_admin_bar'        => _x( 'Website', 'Add New on Toolbar', 'website' ),
                'add_new'               => __( 'Aggiungi', 'website' ),
                'add_new_item'          => __( 'Aggiungi nuovo sito', 'website' ),
                'new_item'              => __( 'Nuovo sito', 'website' ),
                'edit_item'             => __( 'Modifica sito', 'website' ),
                'view_item'             => __( 'Vedi sito', 'website' ),
                'all_items'             => __( 'Tutti i siti clienti', 'website' ),
                'search_items'          => __( 'Ricerca siti', 'website' ),
                'parent_item_colon'     => __( 'Parent websites:', 'website' ),
                'not_found'             => __( 'No websites found.', 'website' ),
                'not_found_in_trash'    => __( 'No websites found in Trash.', 'website' ),
                'featured_image'        => _x( 'Website Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'website' ),
                'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'website' ),
                'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'website' ),
                'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'website' ),
                'archives'              => _x( 'Website archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'website' ),
                'insert_into_item'      => _x( 'Insert into website', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'website' ),
                'uploaded_to_this_item' => _x( 'Uploaded to this website', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'website' ),
                'filter_items_list'     => _x( 'Filter websites list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'website' ),
                'items_list_navigation' => _x( 'Websites list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'website' ),
                'items_list'            => _x( 'Websites list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'website' ),
            );     
            $args = array(
                'labels'             => $labels,
                'description'        => 'Child Website Credential.',
                'public'             => false,
                'publicly_queryable' => false,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'child_website' ),
                'capability_type'    => 'post',
                'has_archive'        => false,
                'hierarchical'       => false,
                'menu_position'      => 67,
                'supports'           => array( 'title' ),
                'taxonomies'         => array( ),
                'show_in_rest'       => false
            );
              
            register_post_type( 'child_website', $args );
        }
        
    }
endif;