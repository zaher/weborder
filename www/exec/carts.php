<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  $done = false;
  require_once(_APP_.'exec/db.php');
  require_once(_APP_.'exec/auth.php');
  $auth->auto(LEVEL_USER);
  $user = $auth->id;
  global $db, $app;
  $values = array();
  if (defined('action'))
  {
    if ((action == 'add') || (action == 'del'))
    {
      get_request('ret', $ret);
  //    print_r($_REQUEST);
      if (get_request('form_qnt', $f))
      {
        foreach ($f as $k => $q) {
          if (isset($q)) {
            $value['mat']=$k;
            $value['qnt']=$q;
            $values[] = $value;
          }
        }
        $ret='main';
      }
      else
      {
        if (!get_request('mat', $mat))
          $error = 'Material ID is required';
        else if (!get_request('qnt', $qnt))
          $error = 'Qnt is required';
        $value['mat'] = $mat;
        $value['qnt'] = $qnt;
        $values[] = $value;
        $ret='main#bm'.$mat;
      }

      {
        foreach ($values as $value)
        {
          $mat = $value['mat'];
          $qnt = $value['qnt'];
          $action = action;
          if ($qnt == 0)
            $action = 'del';

          if (($action == 'add') || ($action == 'edit'))
            $sql ="replace into Carts (CrtUser, CrtMaterial, CrtQnt) values(".$user.",".$mat.",".$qnt.")";
          else if ($action == 'del')
            $sql ="delete from Carts where CrtUser=".$user." and CrtMaterial=".$mat;
          $cmd = $db->execute($sql);
        }

        $app->redirect('?page=main');
        $done = true;
      }
    }
    else if (action == 'cancel')
    {
      $sql ="delete from Carts where CrtUser=".$user;
      $cmd = $db->execute($sql);
      $app->redirect('');
    }
    else if (action == 'show')
    {

    }
    else if (action == 'order')
    {
      if (isset($_REQUEST['delivery_date']))
        $delivery_date = $_REQUEST['delivery_date'];
      if (get_request('form', $f)) {
        get_value($f, 'user', $custom_user);
      }
      if (empty($custom_user))
        $custom_user = $user;
      $sql ="insert into Orders (OrdUser, OrdDeliveryDate, OrdNote) values(".$custom_user.",'" .$delivery_date ."','')";
      //echo $sql; die();
      $db->execute($sql);
      $master = $db->insert_id();
      $sql ="select * from Carts where CrtUser=".$user;
      $cmd = $db->query($sql);
      if ($cmd) {
        while (($row = $cmd->fetch())) {
          $sql = "insert into OrderItems (OtmMaster, OtmMaterial, OtmQnt, OtmPrice)
                  values(" .$master ."," .$row['CrtMaterial'] ."," .$row['CrtQnt'] ."," .$row['CrtPrice']  .")";
          $db->execute($sql);
        }
      }
      $sql ="delete from Carts where CrtUser=".$user;
      $cmd = $db->execute($sql);
      $app->redirect('');
    }
  }
?>