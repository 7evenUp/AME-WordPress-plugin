<?php

/**
 * Creates the submenu page for the plugin.
 *
 * @package Ame
 */

/**
 * Creates the submenu page for the plugin.
 *
 * Provides the functionality necessary for rendering the page corresponding
 * to the submenu with which this page is associated.
 *
 * @package Ame
 */
class Submenu_Page
{
  public function __construct($deserializer)
  {
    $this->deserializer = $deserializer;
  }

  /**
   * This function renders the contents of the page associated with the Submenu
   * that invokes the render method. In the context of this plugin, this is the
   * Submenu class.
   */
  public function render()
  {
    include_once('views/settings.php');
  }
}
