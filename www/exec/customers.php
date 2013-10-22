<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  //$processed = false;
  $group = 0;
  $name = '';
  if (defined('action')) {
    require_once(_APP_.'exec/db.php');
    require_once(_APP_.'exec/auth.php');
    if (get_request('form', $f)) {
      get_value($f, 'username', $name);
      //$app->redirect('?page=items');
      $processed = true;
    }
  }
  //if (!$processed) {
    {$page=$app->new_page('Customers', 'Customers list');
    $page->open();
    include(_APP_.'exec/html/header.php');
    require_once(_APP_.'exec/auth.php');
    $auth->auto(LEVEL_NORMAL);
    include(_APP_.'exec/title.php');
    require_once(_APP_.'exec/utils.php');
    if (!empty($error))
      print_div_error($error);
    include(_APP_.'exec/inc/customer_list.php');
    $page->close();
  }
?>