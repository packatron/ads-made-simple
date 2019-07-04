<?php
namespace Packatron\AdsMadeSimple\Types;

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
        'action:wp_enqueue_scripts' => 'wpEnqueueScripts',
        'shortcode:advertising' => 'renderAdvertising',
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
            'advertising-meta-box',
            __( 'Banners', 'sitepoint' ),
            [$this, 'renderMetaBox'],
            'advertising'
        );
    }

    /**
     *
     */
    public function getAdvertising($id)
    {
        $advertising = [
            'width' => get_post_meta($id, 'width', true) ?: 250,
            'height' => get_post_meta($id, 'height', true) ?: 250,
            'bannerId' => [],
            'bannerSrc' => [],
            'bannerLink' => [],
        ];

        for ($i = 0; $i < 3; $i++) {
            $advertising['bannerId'][$i] = get_post_meta($id, 'banner_id_'.$i, true) ?: '';
            $advertising['bannerSrc'][$i] = get_post_meta($id, 'banner_src_'.$i, true) ?: '';
            $advertising['bannerLink'][$i] = get_post_meta($id, 'banner_link_'.$i, true) ?: '';
        }

        return $advertising;
    }

    /**
     * @param $ads
     */
    public function renderMetaBox($advertising)
    {
        $advertising = $this->getAdvertising($advertising->ID);

        include __DIR__.'/../../templates/advertising-meta-box.php';
    }

    /**
     *
     */
    public function renderAdvertising($attr)
    {
        if (empty($attr['id']) ||
            get_post_status($attr['id']) != 'publish' ||
            get_post_type($attr['id']) != 'advertising') {
            return '';
        }

        $advertising = $this->getAdvertising($attr['id']);

        ob_start();

        include __DIR__.'/../../templates/advertising.php';

        return ob_get_clean();
    }

    /**
     *
     */
    public function wpEnqueueScripts()
    {
        wp_enqueue_script(
            'jquery-cycle-lite-js',
            plugins_url('../../assets/js/jquery.cycle.lite.js', __FILE__),
            array( 'jquery' )
        );
    }

    /**
     *
     */
    public function adminEnqueueScripts()
    {
        if (!is_admin()) {
            return;
        }

        wp_enqueue_media('media-upload');
        wp_enqueue_media('thickbox');

        wp_enqueue_script(
            'ads-made-simple-advertising-admin-js',
            plugins_url('../../assets/js/advertising.admin.js', __FILE__),
            array('jquery','media-upload','thickbox')
        );

        wp_enqueue_style(
            'ads-made-simple-admin-css',
            plugins_url('../../assets/css/admin.css', __FILE__)
        );
    }

    /**
     * @param bool $postId
     * @param bool $post
     */
    public function savePost($postId = false, $post = false)
    {
        if (wp_is_post_revision($postId) ||
            wp_is_post_autosave($postId) ||
            $post->post_type != 'advertising' ||
            $post->post_status == 'auto-draft') {
            return;
        }

        update_post_meta($postId, 'width', $_POST['advertising_width']);
        update_post_meta($postId, 'height', $_POST['advertising_height']);

        for ($i = 0; $i < 3; $i++) {
            update_post_meta($postId, 'banner_id_'.$i, $_POST['advertising_banner_id_'.$i]);
            update_post_meta($postId, 'banner_src_'.$i, $_POST['advertising_banner_src_'.$i]);
            update_post_meta($postId, 'banner_link_'.$i, $_POST['advertising_banner_link_'.$i]);
        }
    }
}
