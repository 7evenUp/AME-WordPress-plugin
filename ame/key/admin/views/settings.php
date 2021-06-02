<div class="wrap">

  <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

  <form method="post" action="<?php echo esc_html(admin_url('admin-post.php?action=key')); ?>">

    <div id="key-container">
      <h2>Widget's key</h2>

      <div class="options">
        <p>
          <label for="key">Enter widget's key</label>
          <br />
          <input id="key" type="text" name="widget-key" value="<?php echo esc_attr($this->deserializer->get_value('ame-widget-key')); ?>" />
        </p>
      </div><!-- #key-container -->

      <?php
      wp_nonce_field('ame-settings-save', 'ame-custom-message');
      submit_button();
      ?>

    </div>

  </form>

</div><!-- .wrap -->