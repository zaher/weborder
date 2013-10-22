<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  include(_ROOT_.'db/classes.php');
  require_once(_ROOT_.'db/sql_utils.php');
  $connection = new_connection(db_type, db_host, db_username, db_password, db_name, db_prefix, db_permanent);
  $connection->connect();
  $db = $connection->new_session();
  $db->start();
  $db->execute('SET NAMES cp1256;');//move to connection
?>