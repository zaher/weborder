<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/

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
  if ($action == 'edit') echo "Edit Item";
  else echo "Add new Item";
?>
</h1>
<div class="page_form">
  <form method="post" action="<?php print(url_page('item', 'action=' .$action)) ?>">
    <div>
      <table class="table_form">
      <tr>
          <th><label for="form[itemname]">Item name</label></th>
          <td>
            <?php if (!empty($id)) { ?>
            <input type="hidden" name="id" id="id" value="<?php print_value($id) ?>" />
            <?php }?>
            <input type="text" name="form[itemname]" id="form[itemname]" class="inputtext" value="<?php print_value($itemname) ?>" size="26" />
          </td>
      </tr>
      <tr>
        <th><label for="form[group]">Group</label></th>
        <td><?php $page->add_select($db, 'Groups', 'GrpName', 'GrpID', 'form[group]', $group, ''); ?></td>
      </tr>
      <tr>
        <th><label for="form[price]">Price</label></th>
        <td><input type="text" name="form[price]" id="form[price]" class="inputtext" value="<?php print_value($price); ?>" size="26" /></td>
      </tr>
      <tr>
        <th><label for="form[unitname]">Unit Name</label></th>
        <td><input type="text" name="form[unitname]" id="form[unitname]" class="inputtext" value="<?php print_value($unitname); ?>" size="26" /></td>
      </tr>
      <tr>
        <th><label for="form[desc]">Description</label></th>
        <td><input type="text" name="form[desc]" id="form[desc]" class="inputtext" value="<?php print_value($desc); ?>" size="26" /></td>
      </tr>
      <tr>
        <th><label for="form[not_available]">Not Available</label></th>
        <td><input type="checkbox" name="form[not_available]" id="form[not_available]" size="26" <?php if ($not_available) echo 'checked="checked"'; ?> /></td>
      </tr>
      <tr>
        <th></th>
        <td><input type="submit" name="form[add]" class="inputbutton" value="<?php if ($action == 'edit') echo 'Save'; else echo 'Add'; ?>" /></td>
      </tr>
      </table>
    </div>
  </form>
</div>

<?php if ($action == 'edit') { ?>
<div class="spliter"></div>
  <div class="page_form">

  <form action="index.php?page=upload&name=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <table class="table_form">
      <tr>
        <td colspan="2">
          <?php
            $filename = 'data/images/items/' .$photo;
            //if (file_exists($filename))
            if ($photo != '')
              $page->add_link($filename, 'View picture');
            else
              print('No picture for this Item.');
          ?>
        </td>
      </tr>
      <tr>
        <th><label for="form[photo]">File Name</label></th>
        <td>
          <input type="file" name="file" id="file" size="40"/>
        </td>
      <tr>
      <tr>
        <th></th>
        <td>
          <input type="submit" name="upload" value="Upload" />
        </td>
      <tr>
    </table>
  </form>
  <?php } ?>
</div>