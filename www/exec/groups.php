<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  require_once(_APP_.'exec/db.php');
  require_once(_APP_.'exec/auth.php');
  $auth->auto(LEVEL_MODERATOR);
  //$processed = false;
  $group = 0;
  $name = '';
  if (defined('action')) {
    if (get_request('form', $f)) {
      get_value($f, 'groupname', $name);
      //$app->redirect('?page=groups');
      $processed = true;
    }
  }
  //if (!$processed) {
    {$page=$app->new_page('groups', 'Groups list');
    $page->open();
    include(_APP_.'exec/html/header.php');
    include(_APP_.'exec/title.php');
    require_once(_APP_.'exec/utils.php');
    if (!empty($error))
      print_div_error($error);
    include(_APP_.'exec/inc/group_list.php');
    $page->close();
  }
?>