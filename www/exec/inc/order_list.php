<script type="text/javascript">
  window.addEvent('domready', function(){
   $$('input.DatePicker').each( function(el){
      new DatePicker(el);
  });
});
</script>
<h1>Orders list</h1>

<?php if ($auth->is_admin) { ?>
<form method="post" action="<?php print(url_page('orders', 'action=submit')) ?>">
<div class="filter">
    <label for="form[user]">User</label>
    <?php $page->add_select($db, 'Users', 'UsrName', 'UsrID', 'form[user]', $user, 'All Users'); ?>
  <div class="date_cont">
    <label for="to_date">From date</label>
    <div><input id="to_date" name="from_date" type="text" class="DatePicker inputtext" tabindex="1" value="<?php echo $from_date; ?>" /></div>
  </div>

  <div class="date_cont">
    <label for="to_date">To date</label>
    <div><input id="from_date" name="to_date" type="text" class="DatePicker inputtext" tabindex="1" value="<?php echo $to_date; ?>" /></div>
  </div>
  <input type="submit" class="inputbutton" value="Filter" />
</div>
</form>
<?php }?>
<div class="spliter"></div>
<table class="table_list" width="100%" align="center" cellspacing="0">
<tr>
  <th>ID</th>
  <th>User</th>
  <th>Date</th>
  <th>Delivery Date</th>
  <th>Total</th>
  <th>Note</th>
  <?php if ($auth->is_admin) { ?>
  <th>Operation</th> <?php }?>
</tr>
<?php
  $sql = 'select * from Orders
          inner join Users on OrdUser = UsrID';
  $where = '';
  if ($auth->is_admin)
    append_and_data($where, 'OrdUser', $user);
  else
    append_and_data($where, 'OrdUser', $auth->id);
  append_and_date($where, 'OrdDate', $from_date, '>=');
  append_and_date($where, 'OrdDate', $to_date, '<=');
  if ($where != '')
    $sql = $sql .' where ' .$where;
  $sql = $sql .' order by OrdDate desc';
  $cmd = $db->query($sql);
  if ($cmd) {
    while (($row = $cmd->fetch())) {
    ?>
      <tr>
        <td><?php $page->add_link(url_page('order','action=show&id='.$row['OrdID']), $row['OrdID']); ?></td>
        <td><?php echo $row['UsrName']; ?></td>
        <td><?php echo $row['OrdDate']; ?></td>
        <td><?php echo $row['OrdDeliveryDate']; ?></td>
        <td><?php echo $row['OrdTotal']; ?></td>
        <td><?php echo $row['OrdNote']; ?></td>
        <?php if ($auth->is_admin) { ?>
        <td class="Operation">
          <?php if ($row['OrdIsActive']) echo "Activated"; else $page->add_link(url_page('order','action=activate&id='.$row['OrdID']), 'Activate');?> |
          <?php if ($row['OrdIsDelivered']) echo "Delivered"; else $page->add_link(url_page('order', 'action=deliver&id='.$row['OrdID']), 'Deliver');?> |
          <?php if ($row['OrdIsPaid']) echo "Paid"; else $page->add_link(url_page('order', 'action=pay&id='.$row['OrdID']), 'Pay');?> |
          <?php $page->add_link(url_page('order', 'action=delete&id='.$row['OrdID']), 'Delete');?>
        </td>
        <?php } ?>
      </tr>
    <?php
    }
  }
  $cmd->free($row);
?>
  </table>