<h1>Groups list</h1>

<form method="post" action="<?php print(url_page('groups', 'action=submit')) ?>">
<div class="filter">
  <span>
    <label for="form[groupname]">Group name</label>
    <input type="text" name="form[groupname]" id="form[groupname]" value="<?php echo $name; ?>" class="inputtext" size="26" />
  </span>
  <input type="submit" class="inputbutton" value="Filter" />
  <?php $page->add_link(url_page('group','action=add'), 'Add new Group'); ?>
</div>
</form>
<div class="spliter"></div>
<table class="table_list" width="100%" align="center" cellspacing="0">
<tr>
  <th>Name</th>
  <th>Description</th>
  <th>Operation</th>
</tr>

<?php
  $sql = 'select * from Groups';
  $where = ''; // write functions instead
  if ($name != '')
    $where = '(GrpName like "%' .$name .'%"' .')';
  if ($where != '')
    $sql = $sql .' where ' .$where;
  $sql = $sql .' order by GrpName';
  $cmd = $db->query($sql);
  if ($cmd) {
    while (($row = $cmd->fetch())) {
    ?>
      <tr>
        <td><?php echo $row['GrpName']; ?></td>
        <td><?php echo $row['GrpDescription']; ?></td>
        <td class="Operation"><?php $page->add_link(url_page('group','action=edit&id='.$row['GrpID']), 'Edit');?> | <?php $page->add_link(url_page('group', 'action=delete&id='.$row['GrpID']), 'Delete');?></td>
      </tr>
    <?php
    //$cmd->free($row);
    }
  }
  //$db->mysql_free_result($cmd);
?>
</table>