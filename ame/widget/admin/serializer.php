<?php

/**
 * Performs all sanitization functions required to save the option values to
 * the database.
 *
 * @package Ame_widget
 */

/**
 * Performs all sanitization functions required to save the option values to
 * the database.
 *
 * This will also check the specified nonce and verify that the current user has
 * permission to save the data.
 *
 * @package Ame_widget
 */
class Widget_Serializer
{
  public function __construct($deserializer)
  {
    $this->deserializer = $deserializer;
  }

  public function init()
  {
    add_action('admin_post_edit', array($this, 'edit'));
  }

  public function edit()
  {
    // If the above are valid, sanitize and save the option.
    if (null !== wp_unslash($_POST['name']) && null !== wp_unslash($_POST['color']) && null !== wp_unslash($_POST['bubble']) && null !== wp_unslash($_POST['zIndex'])) {
      $name = urlencode(sanitize_text_field($_POST['name']));
      $color = urlencode(sanitize_text_field($_POST['color']));
      $bubble = sanitize_text_field($_POST['bubble']);
      $zIndex = sanitize_text_field($_POST['zIndex']);
      $token = $this->deserializer->get_value('ame-secure-token');
      $widget_key = $this->deserializer->get_value('ame-widget-key');

      $newsettings = "https://i.ame.im/widget/edit?key=".$widget_key."&name=".$name."&color=".$color."&bubble=".$bubble."&z_index=".$zIndex."&security_token_admin=".$token;

      $result = file_get_contents($newsettings);
    }

    $this->redirect();
  }

  private function redirect()
  {
    if (!isset($_POST['_wp_http_referer'])) { // Input var okay.
      $_POST['_wp_http_referer'] = wp_login_url();
    }

    $url = sanitize_text_field(
      wp_unslash($_POST['_wp_http_referer']) // Input var okay.
    );

    // Finally, redirect back to the admin page.
    wp_safe_redirect(urldecode($url));
    exit;
  }
}
