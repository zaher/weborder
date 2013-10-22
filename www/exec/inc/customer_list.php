<h1>Items list</h1>

<form method="post" action="<?php print(url_page('customers', 'action=submit')) ?>">
<div class="filter">
  <span>
    <label for="form[username]">Item name</label>
    <input type="text" name="form[username]" id="form[username]" value="<?php echo $name; ?>" class="inputtext" size="26" />
  </span>
  <input type="submit" class="inputbutton" value="Filter" />
  <?php $page->add_link(url_page('customer','action=add'), 'Add new User'); ?>
</div>
</form>
<div class="spliter"></div>
<table class="table_list" width="100%" align="center" cellspacing="0">
<tr>
  <th>Name</th>
  <th>Full name</th>
  <th>Email</th>
  <th>Address</th>
  <th>Admin</th>
  <th>Operation</th>
</tr>

<?php
  $sql = 'select * from Customers';
  $where = ''; // write functions instead
  if ($name != '')
    $where = '(CstName like "%' .$name .'%"' .')';
  if ($where != '')
    $sql = $sql .' where ' .$where;
  $sql = $sql .' order by CstName';
  
  $cmd = $db->query($sql);
  if ($cmd) {
    while (($row = $cmd->fetch())) {
    ?>
      <tr>
        <td><?php echo $row['CstName']; ?></td>
        <td><?php echo $row['CstTitle']; ?></td>
        <td><?php echo $row['CstEmail']; ?></td>
        <td><?php echo $row['CstAddress']; ?></td>
        <td><?php if ($row['CstIsAdmin']) echo "Admin"; ?></td>
        <td class="Operation"><?php $page->add_link(url_page('customer','action=edit&id='.$row['CstID']), 'Edit');?> | <?php $page->add_link(url_page('customer', 'action=delete&id='.$row['CstID']), 'Delete');?></td>
      </tr>
    <?php
    //$cmd->free($row);
    }
  }
  //$db->mysql_free_result($cmd);
?>
</table>