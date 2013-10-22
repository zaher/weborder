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
        get_value($f, 'itemname', $itemname);
        get_value($f, 'group', $group);
        get_value($f, 'price', $price);
        get_value($f, 'unitname', $unitname);
        get_value($f, 'desc', $desc);
        get_value($f, 'not_available', $not_available);
        get_value($f, 'photo', $photo);
        if (empty($price))
          $price = 0;
      }
      else if (empty($id))
        $error = 'Where is the form data?';
      switch (action) {
      case 'add':
          if (empty($not_available))
            $not_available = 0;
          else
            $not_available = 1;
          if (get_request('form', $f)) {
            $sql = "insert into Materials (MatName, MatGroup, MatPrice, MatUnitName, MatDescription, MatNotAvailable)
                    values('".$itemname."',".$group.",'".$price."','".$unitname."','".$desc ."','".$not_available."')";
          }
          break;
      case 'edit':
          if (empty($not_available))
            $not_available = 0;
          else
            $not_available = 1;
          if (get_request('form', $f) && get_request('id', $id)) {
            $sql = "update Materials set MatName='".$itemname."', MatGroup=" .$group .", MatPrice=" .$price .", MatUnitName='".$unitname."', MatDescription='".$desc."', MatNotAvailable='" .$not_available ."'";
            $sql = $sql ." where MatID=" .$id;
          }
          else
          {
            if (get_request('id', $id)) {
              $selectsql = "select * from Materials where MatID=" .$id;
              $cmd = $db->query($selectsql);
              if ($row = $cmd->fetch()) {
                $itemname = $row['MatName'];
                $group = $row['MatGroup'];
                $price = $row['MatPrice'];
                $unitname = $row['MatUnitName'];
                $desc = $row['MatDescription'];
                $photo = $row['MatPhoto'];
                $not_available = $row['MatNotAvailable'];
                //$cmd->free($row);
              }
            }
          }
          break;
      case 'delete':
          if (get_request('id', $id))
            $sql = "delete from Materials where MatID=" .$id;
          break;
      }

      if (empty($error) && !empty($sql)) {
        global $db, $app;
        $cmd = $db->execute($sql);
        $app->redirect('?page=items');
        $done = true;
      }
    }
  }

  if (!$done) {
    $page=$app->new_page('additem', 'Add Item');
    $page->open();
    include(_APP_.'exec/html/header.php');
    require_once(_APP_.'exec/auth.php');
    $auth->auto(LEVEL_MODERATOR);
    include(_APP_.'exec/title.php');
    require_once(_APP_.'exec/utils.php');
    if (!empty($error))
      print_div_error($error);
    include(_APP_.'exec/inc/item_form.php');
    $page->close();
  }
?>