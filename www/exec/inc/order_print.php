<div class="heade-info">
<?php
  $total = 0;
  $sql = 'select * from Orders
          inner join Users on OrdUser = UsrID
          where OrdID=' .$id;
  $cmd = $db->query($sql);
  if ($row = $cmd->fetch()) {
    if ($row['OrdIsPaid'])
      $state = "Paid";
    else if ($row['OrdIsDelivered'])
      $state = "Delivered";
    else if ($row['OrdIsActive'])
      $state = "Activated";
    else
      $state = "Not Activated";
    $total = $row['OrdTotal'];
?>
<table width="100%" align="center" cellspacing="0">
  <tr>
    <th>User</th>
    <td><?php echo $row["UsrName"]; ?></td>
    <th>Note</th>
    <td><?php echo $row["OrdNote"]; ?></td>
  </tr>
  <tr>
    <th>Date</th>
    <td><?php echo $row["OrdDate"]; ?></td>
    <th>State</th>
    <td><?php echo $state; ?></td>
  </tr>
</table>
<?php } ?>
</div>
<div class="spliter"></div>
<table class="table_list" width="100%" align="center" cellspacing="0">
<tr>
  <th>Material</th>
  <th>Quantity</th>
  <th>Price</th>
  <th>Total</th>
</tr>
<?php
  $sql = 'select * from OrderItems
          inner join Materials on OtmMaterial = MatID';
  $where = 'OtmMaster=' .$id; // write functions instead
  if ($where != '')
    $sql = $sql .' where ' .$where;
  $sql = $sql .' order by OtmID';
  
  $cmd = $db->query($sql);
  if ($cmd) {
    while (($row = $cmd->fetch())) {
      $id = $row['OtmID'];
    ?>
      <tr>
        <td><?php echo $row['MatName']; ?></td>
        <td><?php echo $row['OtmQnt']; ?></td>
        <td><?php echo($row['OtmPrice']); ?></td>
        <td><span id="total_<?php print($id) ?>"><?php echo $row['OtmTotal']; ?></span></td>
      </tr>
    <?php
    }
  }
  $cmd->free($row);
?>
    <tr id="footer">
      <td></td>
      <td></td>
      <td></td>
      <td>
        <span id="total_value"><?php echo $total; ?></span>
      </td>
    </tr>
  </table>
<script language="JavaScript" type="text/javascript">
  window.print();
</script>
