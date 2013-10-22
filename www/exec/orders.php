<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  $user = 0;
  $from_date = '';
  $to_date = '';
  if (defined('action')) {
    require_once(_APP_.'exec/db.php');
    require_once(_APP_.'exec/auth.php');
    if (get_request('form', $f)) {
      get_value($f, 'user', $user);
      $from_date = $_REQUEST['from_date']; //temporary
      $to_date = $_REQUEST['to_date']; //temporary
      $processed = true;
    }
  }
  $page=$app->new_page('orders', 'Orders list');
  $page->add_script('js/mootools.v1.11.js');
  $page->add_script('js/DatePicker.js');
  $page->add_style('style/DatePicker.css');
  $page->open();
  include(_APP_.'exec/html/header.php');
  require_once(_APP_.'exec/auth.php');
  $auth->auto(LEVEL_MODERATOR);
  include(_APP_.'exec/title.php');
  require_once(_APP_.'exec/utils.php');
  if (!empty($error))
    print_div_error($error);
  include(_APP_.'exec/inc/order_list.php');
  $page->close();
?>