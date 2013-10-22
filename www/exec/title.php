    <div id="header">
  <div id="menu">
    <ul><?php $app->create_menu(use_url_page, 'mainbar', '', page, $auth->level); ?></ul>
  </div>
  <?php
    if ($auth->is_user) { ?>
      <div id="sub-menu">
        <span class="align-left"><?php print('Logged as '.$auth->name); ?></span>
        <span class="align-right">My Cart:
        <?php

          $page->add_link(url_page('cart', 'action=show'), 'Show');
          echo ' | ';
          $page->add_link(url_page('cart', 'action=order'), 'Order');
          echo ' | ';
          $page->add_link(url_page('carts', 'action=cancel'), 'Cancel');
        ?>
        </span>
      </div>
    <?php }
  ?>
</div>
<div class="spliter"></div>
<div id="page">