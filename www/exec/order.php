<?php
  $processed = false;
  if (defined('action')) {
    if (get_request('form', $f) or get_request('id', $id)) {
      require_once(_APP_.'exec/db.php');
      require_once(_APP_.'exec/auth.php');
      if (get_request('form', $f)) {
      }
      else if (empty($id))
        $error = 'Where is the form data?';
      switch (action) {
        case 'activate':
          if (get_request('id', $id))
            $sql = "update Orders set OrdIsActive=1 where OrdID=" .$id;
            $cmd = $db->execute($sql);
          $processed = true;
          break;
        case 'deliver':
          if (get_request('id', $id))
            $sql = "update Orders set OrdIsDelivered=1 where OrdID=" .$id;
            $cmd = $db->execute($sql);
          $processed = true;
          break;
        case 'pay':
          if (get_request('id', $id))
            $sql = "update Orders set OrdIsPaid=1 where OrdID=" .$id;
            $cmd = $db->execute($sql);
          $processed = true;
          break;
        case 'edit':
          if (get_request('id', $id)) {
            if (get_request('form_price', $f)) {
              get_request('form_buy_price', $b);
              foreach ($f as $k => $p) {
                if (isset($p)) {
                  $sql = "update OrderItems set OtmBuyPrice=" .$b[$k] .",OtmPrice=" .$p .", OtmTotal=OtmQnt*" .$p ." where OtmID=" .$k;
                  $cmd = $db->execute($sql);
                }
              }
              $sql = "update Orders set OrdTotal=(select sum(OtmTotal) from OrderItems where OtmMaster=" .$id .") where OrdID=" .$id;
              $cmd = $db->execute($sql);
            }
          }
          $processed = true;
          break;
        case 'delete':
          if (get_request('id', $id)) {
            $sql = "delete from Orders where OrdID=" .$id;
            $cmd = $db->execute($sql);

            $sql = "delete from OrderItems where OtmMaster=" .$id;
            $cmd = $db->execute($sql);

            $processed = true;
          }
          break;
        case 'print':
          $page = $app->new_page('Order', 'Order');
          $page->open();
          include(_APP_.'exec/html/header.php');
          include(_APP_.'exec/inc/order_print.php');
          $page->close();
          exit;
          break;
      }
      if ($processed && empty($error)) {
        //global $db, $app;
        $app->redirect('?page=orders');
      }
    }
  }

  if (!$processed) {
    $page=$app->new_page('Order', 'Order');
    $page->open();
    include(_APP_.'exec/html/header.php');
    require_once(_APP_.'exec/auth.php');
    $auth->auto(LEVEL_ADMIN);
    include(_APP_.'exec/title.php');
    require_once(_APP_.'exec/utils.php');
    if (!empty($error))
      print_div_error($error);
    include(_APP_.'exec/inc/order_form.php');
    $page->close();
  }
?>