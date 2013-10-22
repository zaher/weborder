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
  $processed = false;
  if (defined('action')) {
    if (get_request('form', $f) or get_request('id', $id)) {
      if (get_request('form', $f)) {
        get_value($f, 'groupname', $groupname);
        get_value($f, 'desc', $desc);
      }
      else if (empty($id))
        $error = 'Where is the form data?';
      switch (action) {
      case 'add':
          if (get_request('form', $f)) {
            $sql = "insert into Groups (GrpName, GrpDescription)
                 values('".$groupname."','".$desc."')";
          }
          break;
      case 'edit':
          if (get_request('form', $f) && get_request('id', $id)) {
            $sql = "update Groups set GrpName='" .$groupname."', GrpDescription='" .$desc ."'";
            $sql = $sql ."where GrpID=" .$id;
          }
          else
          {
            if (get_request('id', $id)) {
              $selectsql = "select * from Groups where GrpID=" .$id;
              $cmd = $db->query($selectsql);
              if ($row = $cmd->fetch()) {
                $groupname = $row['GrpName'];
                $desc = $row['GrpDescription'];
                //$cmd->free($row);
              }
            }
          }
          break;
      case 'delete':
          if (get_request('id', $id))
            $sql = "delete from Groups where GrpID=" .$id;
          break;
      }

      if (empty($error) && !empty($sql)) {
        global $db, $app;
        $cmd = $db->execute($sql);
        $app->redirect('?page=groups');
        $processed = true;
      }
    }
  }

  if (!$processed) {
    $page=$app->new_page('group', 'Add Group');
    $page->open();
    include(_APP_.'exec/html/header.php');
    include(_APP_.'exec/title.php');
    require_once(_APP_.'exec/utils.php');
    if (!empty($error))
      print_div_error($error);
    include(_APP_.'exec/inc/group_form.php');
    $page->close();
  }
?>