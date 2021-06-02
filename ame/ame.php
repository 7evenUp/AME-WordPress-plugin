<?php

/*
Plugin Name: Ame
Description: Это плагин для работы с сервисом Ame
Author: Artyom Sheludeshev
*/

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

// Include the shared and public dependencies.
include_once (plugin_dir_path(__FILE__) . 'key/shared/class-deserializer.php');
include_once (plugin_dir_path(__FILE__) . 'key/public/class-content-messenger.php');
include_once (plugin_dir_path(__FILE__) . 'login/shared/deserializer.php');
include_once(plugin_dir_path(__FILE__) . 'widget/shared/deserializer.php');



// Include the dependencies needed to instantiate the plugin.
foreach (glob(plugin_dir_path(__FILE__) . 'key/admin/*.php') as $file) {
  include_once $file;
}
foreach (glob(plugin_dir_path(__FILE__) . 'login/admin/*.php') as $file) {
  include_once $file;
}
foreach (glob(plugin_dir_path(__FILE__) . 'widget/admin/*.php') as $file) {
  include_once $file;
}

add_action('plugins_loaded', 'ame_admin_settings');
/**
 * Starts the plugin.
 *
 * @since 1.0.0
 */
function ame_admin_settings()
{
  // Enter key widget
  $key_serializer = new Serializer();
  $key_serializer->init();

  $key_deserializer = new Deserializer();

  $key_plugin = new Submenu(new Submenu_Page($key_deserializer));
  $key_plugin->init();

  $key_public = new Content_Messenger($key_deserializer);
  $key_public->init();

  // Login
  $login_Serializer = new Login_Serializer();
  $login_Serializer->init();

  $login_deserializer = new Login_Deserializer();

  $login_plugin = new Login_Submenu(new Login_Submenu_Page($login_deserializer));
  $login_plugin->init();

  // Widget
  $widget_deserializer = new Widget_Deserializer();

  $widget_Serializer = new Widget_Serializer($widget_deserializer);
  $widget_Serializer->init();

  $widget_plugin = new Widget_Submenu(new Widget_Submenu_Page($widget_deserializer));
  $widget_plugin->init();
}