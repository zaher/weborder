<h1>Items list</h1>

<form method="post" action="<?php print(url_page('items', 'action=submit')) ?>">
<div class="filter">
  <span>
    <label for="form[group]">Group</label>
    <?php $page->add_select($db, 'Groups', 'GrpName', 'GrpID', 'form[group]', $group, 'All Groups'); ?>
  </span>
  <span>
    <label for="form[itemname]">Item name</label>
    <input type="text" name="form[itemname]" id="form[itemname]" value="<?php echo $name; ?>" class="inputtext" size="26" />
  </span>
  <input type="submit" class="inputbutton" value="Filter" />
  <?php $page->add_link(url_page('item','action=add'), 'Add new Item'); ?>
</div>
</form>
<div class="spliter"></div>
<table class="table_list" width="100%" align="center" cellspacing="0">
<tr>
  <th>Name</th>
  <th>Group</th>
  <th>Price</th>
  <th>Unit name</th>
  <th>Description</th>
  <th>Operation</th>
</tr>

<?php
  $sql = 'select * from Materials
          left join Groups on MatGroup = GrpID';
  $where = ''; // write functions instead
  if ($name != '')
    $where = '(MatName like "%' .$name .'%"' .')';
  if ($group != 0) {
    if ($where != '')
      $where = $where .' and ';
    $where = $where .'(' .'MatGroup=' .$group .')';
  }
  if ($where != '')
    $sql = $sql .' where ' .$where;
  $sql = $sql .' order by MatName';
  
  $cmd = $db->query($sql);
  if ($cmd) {
    while (($row = $cmd->fetch())) {
    ?>
      <tr>
        <td><?php echo $row['MatName']; ?></td>
        <td><?php echo $row['GrpName']; ?></td>
        <td><?php echo $row['MatPrice']; ?></td>
        <td><?php echo $row['MatUnitName']; ?></td>
        <td><?php echo $row['MatDescription']; ?></td>
        <td class="Operation"><?php $page->add_link(url_page('item','action=edit&id='.$row['MatID']), 'Edit');?> | <?php $page->add_link(url_page('item', 'action=delete&id='.$row['MatID']), 'Delete');?></td>
      </tr>
    <?php
    //$cmd->free($row);
    }
  }
  //$db->mysql_free_result($cmd);
?>
</table>