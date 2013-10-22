<script language="JavaScript"
  type="text/javascript">
function calcTotal(id) {
  var priceElm = document.getElementById("price_" + id);
  var qntElm = document.getElementById("qnt_" + id);
  var totalElm = document.getElementById("total_" + id);
  totalElm.innerHTML = qntElm.value * priceElm.value;
}
</script>
    <h1>Order Items</h1>

<form method="post" action="<?php print(url_page('order', 'action=edit')) ?>">
<div class="heade-info">
<?php
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
<input type="hidden" name="id" id="id" value="<?php print_value($id) ?>" />
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
  <tr>
    <th>Delivery Date</th>
    <td><?php echo $row["OrdDeliveryDate"]; ?></td>
    <th></th>
    <td></td>
  </tr>
</table>
<?php } ?>
</div>
<div class="spliter"></div>
<table class="table_list" width="100%" align="center" cellspacing="0">
<tr>
  <th>Material</th>
  <th>Quantity</th>
  <?php if ($auth->is_admin) { ?>
  <th>Buy Price</th>
  <?php } ?>
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
      $item_id = $row['OtmID'];
    ?>
      <tr>
        <td><?php echo $row['MatName']; ?></td>
        <td><?php echo $row['OtmQnt']; ?></td>
        <?php if ($auth->is_admin) { ?>
        <td>
          <input type="text" value="<?php echo($row['OtmBuyPrice']) ?>" class="inputtext" name="form_buy_price[<?php print($item_id) ?>]" size="5" />
        </td>
        <?php } ?>
        <td>
        <?php if ($auth->is_admin) { ?>
          <input type="hidden" value="<?php echo($row['OtmQnt']) ?>" id="qnt_<?php print($item_id) ?>"/>
          <input type="text" value="<?php echo($row['OtmPrice']) ?>" id="price_<?php print($item_id) ?>" class="inputtext" name="form_price[<?php print($item_id) ?>]" size="5" onchange="calcTotal(<?php print($item_id) ?>)"/>
        <?php } else echo($row['OtmPrice']); ?>
        </td>
        <td><span id="total_<?php print($item_id) ?>"><?php echo $row['OtmTotal']; ?></span></td>
      </tr>
    <?php
    }
  }
  $cmd->free($row);
?>
    <tr id="footer">
      <td></td>
      <td></td>
      <?php if ($auth->is_admin) { ?>
      <td></td>
      <?php } ?>
      <td></td>
      <td>
        <input type="hidden" value="<?php echo $total; ?>" id="order_total"/>
        <span id="total_value"><?php echo $total; ?></span>
      </td>
    </tr>
  </table>
<div class="spliter"></div>
<div class="filter">
  <?php if ($auth->is_admin) { ?>
  <input type="submit" class="inputbutton" value="Save" />
  <?php }
    ?><a href="<?php echo url_page('order', 'action=print&id='.$id); ?>">Print Order</a><?php
  ?>
  
</div>
</form>