<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  if (isset($_REQUEST['action']))
    define('action', $_REQUEST['action']);
  else
    define('action', '');

  if (array_key_exists('page', $_REQUEST))
    define('page', $_REQUEST['page']);
  else
    define('page', 'main');

  if (isset($_REQUEST['error']))
    define('error', $_REQUEST['error']);
  else
    define('error', '');

  if (action == 'logout') //move to check.php
    include('exec/logout.php');
?>