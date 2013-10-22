<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  $done=false;
  include(_APP_.'exec/db.php');
  include(_APP_.'exec/auth.php');
  require_once(_APP_.'exec/utils.php');
  $page = $app->new_page('main', 'Home page');
  $page->title = app_title;
  $page->add_script('js/forms.js');
  $page->open();
  include(_APP_.'exec/html/header.php');
  $auth->auto(LEVEL_NORMAL);
  include(_APP_.'exec/title.php');
?>
<div id="content">
  <div id="nav">
    <div class="box">
      <ul>
      <?php $app->create_menu(use_url_page, 'admin', '', page, $auth->level); ?>
      </ul>
    </div>
  </div>
</div>
<?php
  include(_APP_.'exec/html/footer.php');
  $page->close();
?>