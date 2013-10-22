<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  $action = './';//$_SERVER['PHP_SELF'];
  $user = 0;
  if (isset($_REQUEST['user']))
    $user = $_REQUEST['user'];
?>
  <form action="<?php $action; ?>" method="post" name="fform">
  <?php
    if (isset($_REQUEST['action']))
      echo '<input type="hidden" name="action" value="' .$_REQUEST['action'] .'" />';
  ?>
    <label>User</label><?php add_select($db, 'Users', 'UsrName', 'UsrID', '', '', 'user', $user, ''); ?>
    <label>Date</label><input type="text" class="inputtext" maxlength="1024" size="36" name="date" value="" />
    <input type="submit" class="inputbutton" value="Search" />
  </form>