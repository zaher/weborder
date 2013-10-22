<?php
  if (defined('action'))
    $action = action;
  if (empty($action))
    $action = 'add';
  else $action;
?>
<h1>
<?php
  if ($action == 'edit') echo "Edit Group";
  else echo "Add new Group";
?>
</h1>

<div class="page_form">
  <form method="post" action="<?php print(url_page('group', 'action=' .$action)) ?>">
    <div>
      <table class="table_form">
      <tr>
          <th><label for="form[groupname]">Group name</label></th>
          <?php if (!empty($id)) { ?>
          <input type="hidden" name="id" id="id" value="<?php print_value($id) ?>" />
          <?php }?>
          <td><input type="text" name="form[groupname]" id="form[groupname]" class="inputtext" value="<?php print_value($groupname) ?>" size="26" /></td>
      </tr>
      <tr>
        <th><label for="form[desc]">Description</label></th>
        <td><input type="text" name="form[desc]" id="form[desc]" class="inputtext" value="<?php print_value($desc) ?>" size="26" /></td>
      </tr>
      <tr>
        <th></th>
        <td><input type="submit" name="form[add]" class="inputbutton" value="<?php if ($action == 'edit') echo 'Save'; else echo 'Add'; ?>" /></td>
      </tr>
      </table>
    </div>
  </form>
</div>