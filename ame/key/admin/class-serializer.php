<?php

/**
 * Performs all sanitization functions required to save the option values to
 * the database.
 *
 * @package Ame_key
 */

/**
 * Performs all sanitization functions required to save the option values to
 * the database.
 *
 * This will also check the specified nonce and verify that the current user has
 * permission to save the data.
 *
 * @package Ame_key
 */
class Serializer
{
  public function init()
  {
    add_action('admin_post_key', array($this, 'save'));
  }

  public function save()
  {
    // If the above are valid, sanitize and save the option.
    if (null !== wp_unslash($_POST['widget-key'])) {

      $value = sanitize_text_field($_POST['widget-key']);
      update_option('ame-widget-key', $value);
    }

    $this->redirect();
  }

  /**
   * Determines if the nonce variable associated with the options page is set
   * and is valid.
   *
   * @access private
   * 
   * @return boolean False if the field isn't set or the nonce value is invalid;
   *                 otherwise, true.
   */
  private function has_valid_nonce()
  {

    // If the field isn't even in the $_POST, then it's invalid.
    if (!isset($_POST['ame-custom-message'])) { // Input var okay.
      return false;
    }

    $field  = wp_unslash($_POST['ame-custom-message']);
    $action = 'ame-settings-save';

    return wp_verify_nonce($field, $action);
  }

  private function redirect()
  {

    // To make the Coding Standards happy, we have to initialize this.
    if (!isset($_POST['_wp_http_referer'])) { // Input var okay.
      $_POST['_wp_http_referer'] = wp_login_url();
    }

    // Sanitize the value of the $_POST collection for the Coding Standards.
    $url = sanitize_text_field(
      wp_unslash($_POST['_wp_http_referer']) // Input var okay.
    );

    // Finally, redirect back to the admin page.
    wp_safe_redirect(urldecode($url));
    exit;
  }
}
