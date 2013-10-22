<h1>Users list</h1>

<form method="post" action="<?php print(url_page('users', 'action=submit')) ?>">
<div class="filter">
  <span>
    <label for="form[username]">User name</label>
    <input type="text" name="form[username]" id="form[username]" value="<?php echo $name; ?>" class="inputtext" size="26" />
  </span>
  <input type="submit" class="inputbutton" value="Filter" />
  <?php $page->add_link(url_page('user','action=add'), 'Add new User'); ?>
</div>
</form>
<div class="spliter"></div>
<table class="table_list" width="100%" align="center" cellspacing="0">
<tr>
  <th>Name</th>
  <th>Full name</th>
  <th>Email</th>
  <th>Address</th>
  <th>City</th>
  <th>State</th>
  <th>Zip</th>
  <th>Phone</th>
  <th>Admin</th>
  <th>Operation</th>
</tr>

<?php
  $sql = 'select * from Users';
  $where = ''; // write functions instead
  if ($name != '')
    $where = '(UsrName like "%' .$name .'%"' .')';
  if ($where != '')
    $sql = $sql .' where ' .$where;
  $sql = $sql .' order by UsrName';
  
  $cmd = $db->query($sql);
  if ($cmd) {
    while (($row = $cmd->fetch())) {
    ?>
      <tr>
        <td><?php echo $row['UsrName']; ?></td>
        <td><?php echo $row['UsrTitle']; ?></td>
        <td><?php echo $row['UsrEmail']; ?></td>
        <td><?php echo $row['UsrAddress']; ?></td>
        <td><?php echo $row['UsrCity']; ?></td>
        <td><?php echo $row['UsrState']; ?></td>
        <td><?php echo $row['UsrZip']; ?></td>
        <td><?php echo $row['UsrPhone']; ?></td>
        <td><?php if ($row['UsrIsAdmin']) echo "Admin"; ?></td>
        <td class="Operation"><?php $page->add_link(url_page('user','action=edit&id='.$row['UsrID']), 'Edit');?> | <?php $page->add_link(url_page('user', 'action=delete&id='.$row['UsrID']), 'Delete');?></td>
      </tr>
    <?php
    //$cmd->free($row);
    }
  }
  //$db->mysql_free_result($cmd);
?>
</table>