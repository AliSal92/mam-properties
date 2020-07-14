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
        add_filter('single_template', array($this, 'initPropertyTemplate'));
        add_filter('template_include', array($this, 'archive_template'));
        add_filter('mam-property-filtered-posts', array($this, 'filtered_posts'));
        add_action('acf/init', array($this, 'initACFMapAPI'));
        add_action('acf/init', array($this, 'addPropertyCustomFields'));
    }

    /**
     * init property post type info (to be called by wordpress)
     */
    public static function initPropertyPostType()
    {
        $labels = array(
            'name' => _x('Properties', 'Post Type General Name', 'mam-properties'),
            'singular_name' => _x('Property', 'Post Type Singular Name', 'mam-properties'),
            'menu_name' => __('Properties', 'mam-properties'),
            'name_admin_bar' => __('Property', 'mam-properties'),
            'archives' => __('Item Archives', 'mam-properties'),
            'attributes' => __('Item Attributes', 'mam-properties'),
            'parent_item_colon' => __('Parent Property:', 'mam-properties'),
            'all_items' => __('All Properties', 'mam-properties'),
            'add_new_item' => __('Add New Property', 'mam-properties'),
            'add_new' => __('Add New', 'mam-properties'),
            'new_item' => __('New Property', 'mam-properties'),
            'edit_item' => __('Edit Property', 'mam-properties'),
            'update_item' => __('Update Property', 'mam-properties'),
            'view_item' => __('View Property', 'mam-properties'),
            'view_items' => __('View Properties', 'mam-properties'),
            'search_items' => __('Search Property', 'mam-properties'),
            'not_found' => __('Not found', 'mam-properties'),
            'not_found_in_trash' => __('Not found in Trash', 'mam-properties'),
            'featured_image' => __('Featured Image', 'mam-properties'),
            'set_featured_image' => __('Set featured image', 'mam-properties'),
            'remove_featured_image' => __('Remove featured image', 'mam-properties'),
            'use_featured_image' => __('Use as featured image', 'mam-properties'),
            'insert_into_item' => __('Insert into', 'mam-properties'),
            'uploaded_to_this_item' => __('Uploaded to this Property', 'mam-properties'),
            'items_list' => __('Items list', 'mam-properties'),
            'items_list_navigation' => __('Items list navigation', 'mam-properties'),
            'filter_items_list' => __('Filter Properties list', 'mam-properties'),
        );
        $args = array(
            'label' => __('Property', 'mam-properties'),
            'description' => __('Property post type by MAM Properties', 'mam-properties'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'excerpt', 'custom-fields'),
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
        register_post_type('mam-property', $args);
    }

    /**
     * init post type template file single-property.php
     */
    function initPropertyTemplate($template)
    {
        global $post;
        $config = Config::getInstance()->getConfig();
        $theme_files = array('archive-mam-property.php', 'mam-property/single-mam-property.php');
        if ('mam-property' === $post->post_type && locate_template($theme_files) !== $template) {
            return $config['plugin_path'] . 'templates/single-mam-property.php';
        }

        return $template;
    }


    /**
     * init property post type info (to be called by wordpress)
     */
    public static function initACFMapAPI()
    {
        $config = Config::getInstance()->getConfig();
        acf_update_setting('google_api_key', $config['google_api_key']);
    }


    /**
     * add property archive template
     */
    public function archive_template($template)
    {
        if (is_post_type_archive('mam-property')) {
            $theme_files = array('archive-mam-property.php', 'mam-property/archive-mam-property.php');
            $exists_in_theme = locate_template($theme_files, false);
            if ($exists_in_theme != '') {
                return $exists_in_theme;
            } else {
                $config = Config::getInstance()->getConfig();
                return $config['plugin_path'] . 'templates/archive-mam-property.php';
            }
        }
        return $template;
    }

    /**
     * add property post type custom fields (using ACF Pro)
     */
    public function addPropertyCustomFields()
    {
        if (function_exists('acf_add_local_field_group')):

            acf_add_local_field_group(array(
                'key' => 'group_5f03ecac8f094',
                'title' => 'Property Options',
                'fields' => array(
                    array(
                        'key' => 'field_5f03ecba1a4ee',
                        'label' => 'Property Type',
                        'name' => 'property_type',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'Condo' => 'Condo',
                            'House' => 'House',
                            'Apartment' => 'Apartment',
                        ),
                        'default_value' => false,
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'return_format' => 'value',
                        'ajax' => 0,
                        'placeholder' => '',
                    ),
                    array(
                        'key' => 'field_5f03ece91a4ef',
                        'label' => 'Property Status',
                        'name' => 'property_status',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'For Sale' => 'For Sale',
                            'For Rent' => 'For Rent',
                        ),
                        'default_value' => false,
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'return_format' => 'value',
                        'ajax' => 0,
                        'placeholder' => '',
                    ),
                    array(
                        'key' => 'field_5f03ed181a4f0',
                        'label' => 'BTS',
                        'name' => 'bts',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5f03ed881a4f1',
                        'label' => 'Location',
                        'name' => 'location',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5f03ed921a4f2',
                        'label' => 'Price',
                        'name' => 'price',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_5f03ed9e1a4f3',
                        'label' => 'Bedrooms',
                        'name' => 'bedrooms',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5f03edcc1a4f4',
                        'label' => 'Gallery',
                        'name' => 'gallery',
                        'type' => 'gallery',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'url',
                        'preview_size' => 'full',
                        'insert' => 'append',
                        'library' => 'all',
                        'min' => '',
                        'max' => '',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                    array(
                        'key' => 'field_5f03ee071a4f5',
                        'label' => 'Size',
                        'name' => 'size',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5f03ee271a4f6',
                        'label' => 'Building',
                        'name' => 'building',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5f03ee371a4f7',
                        'label' => 'Floor',
                        'name' => 'floor',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5f03ee461a4f8',
                        'label' => 'Map',
                        'name' => 'map',
                        'type' => 'google_map',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'center_lat' => '',
                        'center_lng' => '',
                        'zoom' => '',
                        'height' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'mam-property',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));

        endif;
    }

    public function filtered_posts($getData)
    {
        $type = '';
        if (isset($getData['property_type'])) {
            $type = $getData['property_type'];
        }
        $status = '';
        if (isset($getData['status'])) {
            $status = $getData['status'];
        }
        $bts = '';
        if (isset($getData['bts'])) {
            $bts = $getData['bts'];
        }
        $location = '';
        if (isset($getData['location'])) {
            $location = $getData['location'];
        }
        $priceFrom = '';
        if (isset($getData['pricefrom'])) {
            $priceFrom = $getData['pricefrom'];
        }
        $priceTo = '';
        if (isset($getData['priceto'])) {
            $priceTo = $getData['priceto'];
        }
        $bedrooms = '';
        if (isset($getData['bedrooms'])) {
            $bedrooms = $getData['bedrooms'];
        }
        $meta_query = [];
        $meta_query['relation'] = 'AND';

        if ($type != '') {
            $meta_query[] = [
                'key' => 'property_type',
                'value' => $type,
                'compare' => '='
            ];
        }

        if ($status != '') {
            $meta_query[] = [
                'key' => 'status',
                'value' => $status,
                'compare' => '='
            ];
        }

        if ($bts != '') {
            $meta_query[] = [
                'key' => 'bts',
                'value' => $bts,
                'compare' => '='
            ];
        }

        if ($location != '') {
            $meta_query[] = [
                'key' => 'location',
                'value' => $location,
                'compare' => '='
            ];
        }

        if ($priceFrom != '') {
            $meta_query[] = [
                'key' => 'price',
                'value' => $priceFrom,
                'compare' => '>='
            ];
        }

        if ($priceTo != '') {
            $meta_query[] = [
                'key' => 'price',
                'value' => $priceTo,
                'compare' => '<='
            ];
        }

        if ($bedrooms != '') {
            $meta_query[] = [
                'key' => 'bedrooms',
                'value' => $bedrooms,
                'compare' => '='
            ];
        }
        // args
        $args = array(
            'numberposts' => -1,
            'post_type' => 'mam-property',
            'meta_query' => $meta_query
        );

        // query
        return new \WP_Query($args);
    }
}