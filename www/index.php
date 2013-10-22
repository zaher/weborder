<?php
/**
 * Web Orders
 *
 * @license   PPL (http://www.parmaja.com/licenses/ppl.html)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  require_once('exec/header.php');
  require_once(_APP_.'exec/process.php');
  require_once(_APP_.'exec/config.php');
  require_once(_APP_.'exec/init.php');
  $page = $app->get_forward(page);
  include($page);
  include(_APP_.'exec/footer.php');
  require_once(_APP_.'exec/finish.php');
?>