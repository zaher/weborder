<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  if (defined('action')) {
    include(_APP_.'exec/db.php');
    include(_APP_.'exec/auth.php');
    require_once(_APP_.'exec/utils.php');
    $page = $app->new_page('main', 'Home page');
    $page->title = app_title;
    $page->add_script('js/forms.js');
    $page->add_script('js/mootools.v1.11.js');
    $page->add_script('js/DatePicker.js');
    $page->add_style('style/DatePicker.css');
    $page->open();
    include(_APP_.'exec/html/header.php');
    $auth->auto(LEVEL_NORMAL);
    include(_APP_.'exec/title.php');
    include(_APP_.'exec/inc/cart_items.php');
  }
?>