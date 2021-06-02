<div class="wrap">

  <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

  <div>
    <h2>Login into Ame Service</h2>
    <form method="post" action="<?php echo esc_html(admin_url('admin-post.php?action=login')); ?>">
      <label for="email">Email</label>
      <input id="email" name="email" placeholder="Email" value="<?php echo esc_attr($this->deserializer->get_value('ame-email')); ?>" />
      <br />
      <label for="password">Password</label>
      <input id="password" name="password" placeholder="Password" />
      <?php
        wp_nonce_field('ame-login-save', 'ame-login-message');
        submit_button('Войти');
      ?>
    </form>
  </div>

</div><!-- .wrap -->