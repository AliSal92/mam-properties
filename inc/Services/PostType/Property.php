<?php


namespace MAM\Plugin\Services\PostType;


use MAM\Plugin\Config;
use MAM\Plugin\Services\ServiceInterface;

class Property implements ServiceInterface
{

    /**
     * @inheritDoc
     */
    public function register()
    {
        add_action('init', array($this, 'initPropertyPostType'), 0);
        add_action('acf/init', array($this, 'initACFMapAPI'));
    }

    /**
     * init property post type info (to be called by wordpress)
     */
    public static function initPropertyPostType()
    {
        $labels = array(
            'name' => _x('Properties', 'Post Type General Name', 'mam_property'),
            'singular_name' => _x('Property', 'Post Type Singular Name', 'mam_property'),
            'menu_name' => __('Properties', 'mam_property'),
            'name_admin_bar' => __('Property', 'mam_property'),
            'archives' => __('Item Archives', 'mam_property'),
            'attributes' => __('Item Attributes', 'mam_property'),
            'parent_item_colon' => __('Parent Property:', 'mam_property'),
            'all_items' => __('All Properties', 'mam_property'),
            'add_new_item' => __('Add New Property', 'mam_property'),
            'add_new' => __('Add New', 'mam_property'),
            'new_item' => __('New Property', 'mam_property'),
            'edit_item' => __('Edit Property', 'mam_property'),
            'update_item' => __('Update Property', 'mam_property'),
            'view_item' => __('View Property', 'mam_property'),
            'view_items' => __('View Properties', 'mam_property'),
            'search_items' => __('Search Property', 'mam_property'),
            'not_found' => __('Not found', 'mam_property'),
            'not_found_in_trash' => __('Not found in Trash', 'mam_property'),
            'featured_image' => __('Featured Image', 'mam_property'),
            'set_featured_image' => __('Set featured image', 'mam_property'),
            'remove_featured_image' => __('Remove featured image', 'mam_property'),
            'use_featured_image' => __('Use as featured image', 'mam_property'),
            'insert_into_item' => __('Insert into', 'mam_property'),
            'uploaded_to_this_item' => __('Uploaded to this Property', 'mam_property'),
            'items_list' => __('Items list', 'mam_property'),
            'items_list_navigation' => __('Items list navigation', 'mam_property'),
            'filter_items_list' => __('Filter Properties list', 'mam_property'),
        );
        $args = array(
            'label' => __('Property', 'mam_property'),
            'description' => __('Property post type by MAM Properties', 'mam_property'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'thumbnail'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_icon' => 'dashicons-building',
            'menu_position' => 5,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
        );
        register_post_type('property', $args);
    }

    /**
     * init property post type info (to be called by wordpress)
     */
    public static function initACFMapAPI() {
        $config = Config::getInstance()->getConfig();
        acf_update_setting('google_api_key', $config['google_api_key']);
    }
}