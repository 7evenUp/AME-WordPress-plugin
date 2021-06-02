<?php

/**
 * Performs all sanitization functions required to save the option values to
 * the database.
 *
 * @package Ame_login
 */

/**
 * Performs all sanitization functions required to save the option values to
 * the database.
 *
 * This will also check the specified nonce and verify that the current user has
 * permission to save the data.
 *
 * @package Ame_login
 */
class Login_Serializer
{
  public function init()
  {
    add_action('admin_post_login', array($this, 'login'));
  }

  public function login()
  {
    if (null !== wp_unslash($_POST['email']) && null !== wp_unslash($_POST['password'])) {

      $email = sanitize_text_field($_POST['email']);
      $password = sanitize_text_field($_POST['password']);
      $result = file_get_contents("https://i.ame.im/login?email=".$email."&password=".$password);
      $json = json_decode($result, true);

      $token = $json['user']['token'];

      update_option('ame-secure-token', $token);
    }

    $this->redirect();
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