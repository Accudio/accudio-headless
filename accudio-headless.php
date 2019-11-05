<?php
/**
 * @link        https://accudio.com
 * @since       1.0.0
 * @package     Accudio_Headless
 *
 * @wordpress-plugin
 * Plugin Name:         Accudio Headless
 * Plugin URI:          https://accudio.com
 * Description:         Tweaks for a headless WordPress install
 * Version:             1.0.0
 * Author:              Alistair Shepherd — Accudio
 * Author URI:          https://accudio.com/about
 * License:             GPL-3.0+
 * License URI:         http://www.gnu.org/licenses/gpl-3.0.txt
 * GitHub Plugin URI:   Accudio/accudio-headless
 */

// If this file is called directly, abort.
if(!defined('ABSPATH')) {
  exit;
}

// yoast meta fields added to REST
require_once 'wp-api-yoast-meta/plugin.php';

class Accudio_Headless {
  const DEFAULT_SITE_STRUCTURE = '47';

  public static function init()
  {
    // actions
    add_action('init', ['Accudio_Headless', 'add_menus']);
    add_action('init', ['Accudio_Headless', 'acf_options']);

    // filters
    add_filter('acf/format_value', ['Accudio_Headless', 'acf_null'], 100, 1);
    add_filter('the_content_more_link', ['Accudio_Headless', 'excerpt_end']);
    add_filter('excerpt_more', ['Accudio_Headless', 'excerpt_end']);
    add_filter('parse_query', ['Accudio_Headless', 'hide_sitestructure']);
  }

  public static function add_menus()
  {
    register_nav_menu('primary-menu', __('Primary Menu'));
    register_nav_menu('secondary-menu', __('Secondary Menu'));
    register_nav_menu('tertiary-menu', __('Tertiary Menu'));
    register_nav_menu('quandary-menu', __('Quandary Menu'));
    register_nav_menu('quintessential-menu', __('Quintessential Menu'));
  }

  public static function acf_options()
  {
    if(function_exists('acf_add_options_page')) {
      acf_add_options_page(array(
        'page_title'  => 'Theme Options',
        'menu_title'  => 'Theme Options',
        'menu-slug'   => 'accudio-headless-options'
      ));
    }
  }

  /**
   * return null if an empty value is returned from ACF, fixing issue with GraphQL
   */
  public static function acf_null($value)
  {
    if (empty($value)) {
      return null;
    }
    return $value;
  }

  public static function excerpt_end()
  {
    return '...';
  }

  public static function hide_sitestructure($id)
  {
    global $pagenow, $post_type;

    $site_structure = apply_filters('accudio_headless_site_structure_id', self::DEFAULT_SITE_STRUCTURE);
    if ($site_structure) {
      if (is_admin() && !current_user_can('manage_options') && $pagenow=='edit.php' && $post_type =='page') {
        $query->query_vars['post__not_in'] = array($site_structure);
      }
    }
  }
}

class Accudio_Headless_API {
  public static function init()
  {
    add_action('rest_api_init', ['Accudio_Headless_API', 'register']);
  }

  public static function register()
  {
    register_rest_route('accudio/v1', '/options', [
      'methods'  => 'GET',
      'callback' => ['Accudio_Headless_API', 'options']
    ]);
  }

  public static function options()
  {
    return [
      'name'  => get_bloginfo('name'),
      'description' => get_bloginfo('description'),
      'admin_url' => get_bloginfo('wpurl'),
      'site_url' => get_bloginfo('url'),
      'feed' => get_bloginfo('rss2_url'),
      'acf' => get_fields('options')
    ];
  }
}

Accudio_Headless::init();
Accudio_Headless_API::init();
