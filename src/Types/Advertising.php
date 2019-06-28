<?php
namespace WpQuality\AdsMadeSimple\Types;

use Javanile\Granular\Bindable;

class Advertising extends Bindable
{
    /**
     * @var array
     */
    public static $bindings = [
        'action:init' => 'init',
        'action:add_meta_boxes' => 'addMetaBox',
        'action:admin_enqueue_scripts' => 'adminEnqueueScripts',
        'action:save_post:10:2' => 'savePost',
    ];

    /**
     *
     */
    public function init()
    {
        $labels = array(
            'name'               => _x( 'Advertising', 'post type general name', 'ads-made-simple' ),
            'singular_name'      => _x( 'Advertising', 'post type singular name', 'ads-made-simple' ),
            'menu_name'          => _x( 'Advertising', 'admin menu', 'ads-made-simple' ),
            'name_admin_bar'     => _x( 'Advertising', 'add new on admin bar', 'ads-made-simple' ),
            'add_new'            => _x( 'Add New', 'ads', 'ads-made-simple' ),
            'add_new_item'       => __( 'Add New Advertising', 'ads-made-simple' ),
            'new_item'           => __( 'New Advertising', 'ads-made-simple' ),
            'edit_item'          => __( 'Edit Advertising', 'ads-made-simple' ),
            'view_item'          => __( 'View Advertising', 'ads-made-simple' ),
            'all_items'          => __( 'All Advertising', 'ads-made-simple' ),
            'search_items'       => __( 'Search Advertising', 'ads-made-simple' ),
            'parent_item_colon'  => __( 'Parent Advertising:', 'ads-made-simple' ),
            'not_found'          => __( 'No advertising found.', 'ads-made-simple' ),
            'not_found_in_trash' => __( 'No advertising found in Trash.', 'ads-made-simple' )
        );

        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'ads-made-simple' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'advertising' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-store',
            'supports'           => array(
                'title',
                //'editor',
                //'author',
                //'thumbnail',
                //'excerpt',
                //'comments'
            )
        );

        register_post_type('advertising', $args);
    }

    /**
     *
     */
    public function addMetaBox()
    {
        add_meta_box(
            'ads-panel',
            __( 'Global Notice', 'sitepoint' ),
            [$this, 'renderMetaBox'],
            'advertising'
        );
    }

    /**
     * @param $ads
     */
    public function renderMetaBox($ads)
    {
        $adsImageId = get_post_meta($ads->ID, 'ads_image_id', true);

        include __DIR__.'/../../templates/ads-meta-box.php';
    }

    /**
     *
     */
    public function adminEnqueueScripts()
    {
        if (is_admin()) {
            wp_enqueue_media();
            wp_enqueue_script('ads-admin-js', plugins_url('../../public/js/ads.admin.js', __FILE__));
        }
    }

    /**
     * @param bool $postId
     * @param bool $post
     */
    public function savePost($postId = false, $post = false)
    {
        if ($post->post_type != 'advertising') {
            return;
        }

        update_post_meta($postId, 'ads_image_id', $_POST['ads_image_id']);
    }
}