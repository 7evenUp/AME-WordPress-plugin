<div class="wrap">

  <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

  <div>
    <h2>Widget Settings</h2>
    <form method="post" action="<?php echo esc_html(admin_url('admin-post.php?action=edit')); ?>">
      <label for="name">Widget name</label>
      <input id="name" name="name" placeholder="Widget name" value="<?php echo esc_attr($this->deserializer->get_value('ame-email')); ?>" />
      <br />
      <label for="color">Color</label>
      <input id="color" name="color" type="color" />
      <br />
      <label for="bubble">Bubble type</label>
      <select id="bubble" name="bubble">
        <option value="1" selected="true">Лупа</option>
        <option value="2">Вопрос</option>
        <option value="3">Утка</option>
        <option value="4">Диалог</option>
      </select>
      <br />
      <label for="zIndex">Z-index</label>
      <input id="zIndex" name="zIndex" placeholder="Z-index" />
      <?php
      wp_nonce_field('ame-edit-save', 'ame-edit-message');
      submit_button('Сохранить изменения  ');
      ?>
    </form>
  </div>

</div><!-- .wrap -->