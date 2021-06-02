<?php

class Content_Messenger {
  /**
   * A reference to the class for retrieving our option values.
   *
   * @access private
   * @var    Deserializer
   */
  private $deserializer;

  /**
   * Initializes the class by setting a reference to the incoming deserializer.
   *
   * @param Deserializer $deserializer Retrieves a value from the database.
   */
  public function __construct($deserializer)
  {
    $this->deserializer = $deserializer;
  }

  /**
   * Initializes the hook responsible for prepending the content with the
   * option created on the options page.
   */
  public function init()
  {
    add_action('wp_footer', array($this, 'display'));
  }

  public function display($key) {
    $key = esc_attr($this->deserializer->get_value('ame-widget-key'));
    echo "<script src='https://i.ame.im/users_widget/base/ame.js'></script>";
    echo "<script>ameChatSiteObject.init('$key');</script>";
  }
}