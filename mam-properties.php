<?php
/**
 * Plugin Name: MAM Properties
 * Plugin URI: https://github.com/AliSal92/mam-properties
 * Description: a Wordpress plugin to easily add properties to your website.
 * Version: 1.0
 * Author: AliSal
 * Author URI: https://github.com/AliSal92/
 * MAM Properties is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * MAM Properties is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with MAM Properties. If not, see <http://www.gnu.org/licenses/>.
 */

namespace MAM;

use MAM\Plugin\Init;
use MAM\Plugin\Base\ActivateDeactivate;

/**
 * Prevent direct access
 */
defined('ABSPATH') or die('</3');

/**
 * Require once the Composer Autoload
 */
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_mam_property_plugin() {
    ActivateDeactivate::activate();
}
register_activation_hook( __FILE__, 'activate_mam_property_plugin' );


/**
 * The code that runs during plugin deactivation
 */
function deactivate_mam_property_plugin() {
    ActivateDeactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_mam_property_plugin' );

/**
 * Initialize and run all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
    Init::register_services();
}
