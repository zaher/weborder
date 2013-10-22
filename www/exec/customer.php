<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  $done = false;
  if (defined('action')) {
    if (get_request('form', $f) or get_request('id', $id)) {
      require_once(_APP_.'exec/db.php');
      require_once(_APP_.'exec/auth.php');
      if (get_request('form', $f)) {
        get_value($f, 'username', $username);
        get_value($f, 'title', $title);
        get_value($f, 'email', $email);
        get_value($f, 'address', $address);
      }
      else if (empty($id))
        $error = 'Where is the form data?';
      switch (action) {
      case 'add':
          if (get_request('form', $f)) {
            $sql ="insert into Customers (CstName, CstTitle, CstEmail, CstAddress)
                   values('".$username."','".$title."','".$email."','".$address."')";
          }
          break;
      case 'edit':
          if (get_request('form', $f) && get_request('id', $id)) {
            $sql = "update Customers set CstName='".$username."', CstTitle='" .$title ."', CstEmail='" .$email ."', CstAddress='".$address."'";
            $sql = $sql ." where CstID=" .$id;
          }
          else
          {
            if (get_request('id', $id)) {
              $selectsql = "select * from Customers where CstID=" .$id;
              $cmd = $db->query($selectsql);
              if ($row = $cmd->fetch()) {
                $username = $row['CstName'];
                $title = $row['CstTitle'];
                $email = $row['CstEmail'];
                $address = $row['CstAddress'];
                //$cmd->free($row);
              }
            }
          }
          break;
      case 'delete':
          if (get_request('id', $id))
            $sql = "delete from Customers where CstID=" .$id;
          break;
      }

      if (empty($error) && !empty($sql)) {
        global $db, $app;
        $cmd = $db->execute($sql);
        $app->redirect('?page=customers');
        $done = true;
      }
    }
  }

  if (!$done) {
    $page=$app->new_page('addcustomer', 'Add Customer');
    $page->open();
    include(_APP_.'exec/html/header.php');
    require_once(_APP_.'exec/auth.php');
    $auth->auto(LEVEL_NORMAL);
    include(_APP_.'exec/title.php');
    require_once(_APP_.'exec/utils.php');
    if (!empty($error))
      print_div_error($error);
    include(_APP_.'exec/inc/customer_form.php');
    $page->close();
  }
?>