<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/

  $group = 0;
  $name = '';
  if (defined('action')) {
    require_once(_APP_.'exec/db.php');
    require_once(_APP_.'exec/auth.php');
    if (get_request('form', $f)) {
      get_value($f, 'itemname', $name);
      get_value($f, 'group', $group);
      //$app->redirect('?page=items');
    }
  }
  $page=$app->new_page('items', 'Items list');
  $page->open();
  include(_APP_.'exec/html/header.php');
  require_once(_APP_.'exec/auth.php');
  $auth->auto(LEVEL_MODERATOR);
  include(_APP_.'exec/title.php');
  require_once(_APP_.'exec/utils.php');
  if (!empty($error))
    print_div_error($error);
  include(_APP_.'exec/inc/item_list.php');
  $page->close();
?>