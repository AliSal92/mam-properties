<?php


namespace MAM\Plugin\Services\SearchForm;


use MAM\Plugin\Config;
use MAM\Plugin\Services\ServiceInterface;

class SearchForm implements ServiceInterface
{

    /**
     * @inheritDoc
     */
    public function register()
    {
        add_filter('mam-property-form-data', [$this, 'get_form_data']);
        add_shortcode('mam-property-form', [$this, 'mam_property_form']);
    }

    public function mam_property_form()
    {
        $config = Config::getInstance()->getConfig();
        $theme_files = array('mam-search-form.php', 'mam-property/mam-search-form.php');
        $exists_in_theme = locate_template($theme_files, false);

        ob_start();
        if ($exists_in_theme != '') {
            /** @noinspection PhpIncludeInspection */
            include $exists_in_theme;
        } else {
            // nope, load the content
            include $config['plugin_path'] . 'templates/mam-search-form.php';
        }
        return ob_get_clean();
    }

    public function get_form_data()
    {
        // init data
        $data = [];

        // init static options
        $data['property_type'] = ['Condo', 'House', 'Apartment'];
        $data['status'] = ['For Sale', 'For Rent'];
        $data['price-from'] = [
            '5000' => '5,000',
            '10000' => '10,000',
            '15000' => '15,000',
            '20000' => '20,000',
            '30000' => '30,000',
            '50000' => '50,000'
        ];
        $data['price-to'] = [
            '5000' => '5,000',
            '10000' => '10,000',
            '15000' => '15,000',
            '20000' => '20,000',
            '30000' => '30,000',
            '50000' => '50,000'
        ];

        // init dynamic options from posts
        $btsA = [];
        $locationA = [];
        $bedroomsA = [];

        // WP_Query arguments
        $args = array(
            'post_type' => array('mam-property'),
            'nopaging' => true,
            'posts_per_page' => '9999',
        );

        // The Query
        $query = new \WP_Query($args);

        // The Loop
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $bts = get_field('bts');
                $location = get_field('location');
                $bedrooms = get_field('bedrooms');
                if (!in_array($bts, $btsA)) {
                    $btsA[] = $bts;
                }
                if (!in_array($location, $locationA)) {
                    $locationA[] = $location;
                }
                if (!in_array($bedrooms, $bedroomsA)) {
                    $bedroomsA[] = $bedrooms;
                }
            }
        }

        // Restore original Post Data
        wp_reset_postdata();
        sort($btsA);
        sort($locationA);
        sort($bedroomsA);

        $data['bts'] = $btsA;
        $data['location'] = $locationA;
        $data['bedrooms'] = $bedroomsA;
        return $data;
    }
}