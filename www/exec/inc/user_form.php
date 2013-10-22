<?php
  if (defined('action'))
    $action = action;
  if (empty($action))
    $action = 'add';
  else $action;
  if (empty($group))
    $group = 0;
?>
<h1>
<?php
  if ($action == 'edit') echo "Edit User";
  else echo "Add new User";
?>
</h1>
<div class="page_form">
  <form method="post" action="<?php print(url_page('user', 'action=' .$action)) ?>">
    <div>
      <table class="table_form">
      <tr>
      <th><label for="form[username]">User name</label></th>
        <td>
          <?php if (!empty($id)) { ?>
          <input type="hidden" name="id" id="id" value="<?php print_value($id) ?>" />
          <?php }?>
          <input type="text" name="form[username]" id="form[username]" class="inputtext" value="<?php print_value($username) ?>" size="26" />
          </td>
      </tr>
      <tr>
        <th><label for="form[title]">Full name</label></th>
        <td><input type="text" name="form[title]" id="form[title]" class="inputtext" value="<?php print_value($title); ?>" size="26" /></td>
      </tr>
      <tr>
        <th><label for="form[email]">Email Address</label></th>
        <td><input type="text" name="form[email]" id="form[email]" class="inputtext" value="<?php print_value($email); ?>" size="26" /></td>
      </tr>
      <tr>
        <th><label for="form[city]">City</label></th>
        <td><input type="text" name="form[city]" id="form[city]" class="inputtext" value="<?php print_value($city); ?>" size="26" /></td>
      </tr>
      <tr>
        <th><label for="form[state]">State</label></th>
        <td><input type="text" name="form[state]" id="form[state]" class="inputtext" value="<?php print_value($state); ?>" size="26" /></td>
      </tr>
      <tr>
        <th><label for="form[address]">Address</label></th>
        <td><input type="text" name="form[address]" id="form[address]" class="inputtext" value="<?php print_value($address); ?>" size="26" /></td>
      </tr>
      <tr>
        <th><label for="form[phone]">Phone</label></th>
        <td><input type="text" name="form[phone]" id="form[phone]" class="inputtext" value="<?php print_value($phone); ?>" size="26" /></td>
      </tr>
      <tr>
        <th><label for="form[mobile]">Mobile</label></th>
        <td><input type="text" name="form[mobile]" id="form[mobile]" class="inputtext" value="<?php print_value($mobile); ?>" size="26" /></td>
      </tr>
      <tr>
        <th><label for="form[zip]">Zip</label></th>
        <td><input type="text" name="form[zip]" id="form[zip]" class="inputtext" value="<?php print_value($zip); ?>" size="26" /></td>
      </tr>
      <tr>
        <th><label for="form[note]">Note</label></th>
        <td><input type="text" name="form[note]" id="form[note]" class="inputtext" value="<?php print_value($note); ?>" size="26" /></td>
      </tr>
      <tr>
        <th></th>
        <td><input type="submit" name="form[add]" class="inputbutton" value="<?php if ($action == 'edit') echo 'Save'; else echo 'Add'; ?>" /></td>
      </tr>
      </table>
    </div>
  </form>
</div>