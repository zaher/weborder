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
        get_value($f, 'phone', $phone);
        get_value($f, 'mobile', $mobile);
        get_value($f, 'city', $city);
        get_value($f, 'state', $state);
        get_value($f, 'zip', $zip);
        get_value($f, 'note', $note);

      }
      else if (empty($id))
        $error = 'Where is the form data?';
      switch (action) {
      case 'add':
          if (get_request('form', $f)) {
            $sql ="insert into Users (UsrName, UsrTitle, UsrEmail, UsrPhone, UsrMobile, UsrCity, UsrState, UsrZip, UsrNote, UsrAddress)
                   values('".$username."','".$title."','".$email."','".$phone."','".$mobile."','".$city."','".$state."','".$zip."','".$note."','".$address."')";
          }
          break;
      case 'edit':
          if (get_request('form', $f) && get_request('id', $id)) {
            $sql = "update Users set UsrName='".$username."', UsrTitle='" .$title ."', UsrEmail='" .$email ."', UsrAddress='".$address ."', UsrPhone='".$phone."', UsrMobile='".$mobile."', UsrCity='".$city."', UsrState='".$state."', UsrZip='".$zip."', UsrNote='".$note."'";
            $sql = $sql ." where UsrID=" .$id;
          }
          else
          {
            if (get_request('id', $id)) {
              $selectsql = "select * from Users where UsrID=" .$id;
              $cmd = $db->query($selectsql);
              if ($row = $cmd->fetch()) {
                $username = $row['UsrName'];
                $title = $row['UsrTitle'];
                $email = $row['UsrEmail'];
                $address = $row['UsrAddress'];
                $phone = $row['UsrPhone'];
                $mobile = $row['UsrMobile'];
                $city = $row['UsrCity'];
                $state = $row['UsrState'];
                $zip = $row['UsrZip'];
                $note = $row['UsrNote'];
                //$cmd->free($row);
              }
            }
          }
          break;
      case 'delete':
          if (get_request('id', $id))
            $sql = "delete from Users where UsrID=" .$id;
          break;
      }

      if (empty($error) && !empty($sql)) {
        global $db, $app;
        $cmd = $db->execute($sql);
        $app->redirect('?page=users');
        $done = true;
      }
    }
  }

  if (!$done) {
    $page=$app->new_page('adduser', 'Add User');
    $page->open();
    include(_APP_.'exec/html/header.php');
    require_once(_APP_.'exec/auth.php');
    $auth->auto(LEVEL_NORMAL);
    include(_APP_.'exec/title.php');
    require_once(_APP_.'exec/utils.php');
    if (!empty($error))
      print_div_error($error);
    include(_APP_.'exec/inc/user_form.php');
    $page->close();
  }
?>