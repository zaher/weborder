<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  require 'exec/check.php';
 $auth->auto(ADDON_MODERATOR);
  include 'exec/header.php';

  $sql = 'select * from orders
          inner join customers on OrdCustomer = CstID';

  $row_count = get_db_rowscount($db, $sql);
  if (isset($_REQUEST['start']))
    $start = $_REQUEST['start'];
  else
    $start = 0;
  $sql .= ' limit ' .$start .', ' .(item_per_page);
?>
<div class="container"><?php include 'filter_form.php';?></div>
<div class="spliter"></div>
<table class="table_default" width="100%" align="center" cellspacing="0">
<tr>
  <th width="10%">ID</th>
  <th width="20%">Customer</th>
  <th width="15%">Date</th>
  <th width="15%">State</th>
  <th width="25%">Note</th>
</tr>

<?php
  $Qry = $db->query($sql);
  if ($Qry) {
    while (($row = $db->fetch_assoc($Qry))) {
    ?>
      <tr>
        <td><?php echo $row['OrdID']; ?></td>
        <td><?php echo $row['CstName']; ?></td>
        <td><?php echo $row['OrdDate']; ?></td>
        <td><?php echo $row['OrdState']; ?></td>
        <td><?php echo $row['OrdNote']; ?></td>
      </tr>
    <?php
    }
  }
  $db->free_result($Qry);
  $db->close();
?>
  </table>
<?
  if (isset($_REQUEST['action']))
    $params = 'action=' .$_REQUEST['action'];
  viewscroll($row_count, $start, '', $params);
?>