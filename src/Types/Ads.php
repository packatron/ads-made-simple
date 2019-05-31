<?php
namespace WpQuality\AdsMadeSimple\Types;

use Javanile\Granular\Bindable;

class Ads extends Bindable
{
    public static $bindings = [
        'action:init' => 'init',
        'action:add_meta_boxes' => 'addMetaBox',
        'action:admin_enqueue_scripts' => 'adminEnqueueScripts',
    ];

    public function init()
    {
        $labels = array(
            'name'               => _x( 'Books', 'post type general name', 'your-plugin-textdomain' ),
            'singular_name'      => _x( 'Book', 'post type singular name', 'your-plugin-textdomain' ),
            'menu_name'          => _x( 'Books', 'admin menu', 'your-plugin-textdomain' ),
            'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'your-plugin-textdomain' ),
            'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
            'add_new_item'       => __( 'Add New Book', 'your-plugin-textdomain' ),
            'new_item'           => __( 'New Book', 'your-plugin-textdomain' ),
            'edit_item'          => __( 'Edit Book', 'your-plugin-textdomain' ),
            'view_item'          => __( 'View Book', 'your-plugin-textdomain' ),
            'all_items'          => __( 'All Books', 'your-plugin-textdomain' ),
            'search_items'       => __( 'Search Books', 'your-plugin-textdomain' ),
            'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),
            'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),
            'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )
        );

        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'your-plugin-textdomain' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'book' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array(
                'title',
                //'editor',
                //'author',
                //'thumbnail',
                //'excerpt',
                //'comments'
            )
        );

        register_post_type('ads', $args);
    }

    public function addMetaBox()
    {
        add_meta_box(
            'ads-panel',
            __( 'Global Notice', 'sitepoint' ),
            [$this, 'renderMetaBox'],
            'ads'
        );
    }

    public function renderMetaBox($ads)
    {
        include __DIR__.'/../../templates/ads-meta-box.php';
    }

    public function adminEnqueueScripts()
    {
        if (is_admin()) {
            wp_enqueue_media();
            wp_enqueue_script( 'ads-admin-js', plugins_url('../../public/js/ads.admin.js', __FILE__));
        }
    }
}
