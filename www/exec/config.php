<?php
  @include('host.php');
  if (!defined('db_host'))
  {
    define('db_host', 'localhost');
    define('db_name', 'orders'); //'orders';
    define('db_username', 'local');
    define('db_password', '');
  }
  define('db_prefix', '');
  define('db_permanent', false);
  define('db_type', 'mysql');

  define('app_name', 'tootyfruity');
  define('app_title', 'Farms online orders');
  
  define('cookie_domain', '');
  define('cookie_path', '/');
  define('cookie_expire',time()+60*60*24*7);
  
  define('use_url_page', false);
  
  define('user_hash', 'test1234');
  define('item_per_page', 40);
  define('redirect_delay', 1);
?>