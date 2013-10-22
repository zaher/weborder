<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  require_once(_ROOT_.'ui/classes.php');
  $app = new_application('html', 'orders', 'Orders');
  include(_APP_.'exec/addons.php');
  $app->open();
?>