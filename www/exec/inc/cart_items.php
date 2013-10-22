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
  $submit = 'add';
  if ($action == 'order')
    $submit = 'order';
?>

<?php
  $sql = 'select * from Materials';
  $sql = $sql.' left join Carts on MatID = CrtMaterial';
  $sql = $sql.' where CrtUser='.$auth->id;
  $cmd = $db->query($sql);
?>
<div id="items_list">
<script type="text/javascript">
  window.addEvent('domready', function(){
   $$('input.DatePicker').each( function(el){
      new DatePicker(el);
  });
});
</script>
  <form method="post" name="cart" action="<?php print(url_page('carts', 'action='. $submit)) ?>" >
    <div class="title">Cart items</div>
    <div class="filter">
      <div class="date_cont">
        <label for="delivery_date">Delivery date</label>
        <div>
          <input id="delivery_date" name="delivery_date" type="text" class="DatePicker inputtext" tabindex="1" value="" />
        </div>
      </div>
    <?php if (($auth->is_admin)&& ($action == 'order')) { ?>
      <span>
        <label for="form[user]">User</label>
        <?php $page->add_select($db, 'Users', 'UsrName', 'UsrID', 'form[user]', $auth->id, ''); ?>
      </span>
    <?php }?>
    </div>
    <table width = "100%">
    <?php
      while (($row = $cmd->fetch())) {
        $id = $row["MatID"];
        $photo = $row["MatPhoto"];
        $cart_qnt=$row["CrtQnt"];
    ?>
      <tr id="bm<?php print($id) ?>">
        <?php $photo_filename = get_photo_filename($photo); ?>
        <td><img border="0" src=<? echo $photo_filename; ?> ></td>
        <td><?php echo $row["MatName"]; ?></td>
        <td>
          <div class="qnt">
        <?php
          if ($auth->is_user)
          {
          ?>  Qnt <input type="text" value="<?php print($cart_qnt) ?>" id="qnt_<?php print($id) ?>" class="inputtext" name="form_qnt[<?php print($id) ?>]" size="5" />
          </div>
          <div class ="actions">
          <?php
            if ($row['CrtMaterial'] > 0)
              $caption = 'Modify';
            else
              $caption = 'Add';
              
            $page->add_link('javascript:submit_fld('.'\'carts?action=add&mat='.$id.'&qnt=\''.', \'qnt_'.$id.'\', 1)', $caption);
            
            if ($row['CrtMaterial'] > 0)
            {
              ?> | <?php
              $page->add_link('carts?action=del&mat='.$id, 'Remove');
            }
          }
        ?>
          </div>
        </td>
      </tr>
      <?php
        }
      ?>
    </table>
    <?php
    if ($auth->is_user)
    {
     ?> <div class="filter">
        <?php
          if ($action == 'order') { ?>
            <BUTTON name="submit" value="order" type="submit">Order cart</BUTTON>
          <?php }
          else { ?>
            <BUTTON name="submit" value="update" type="submit">Update cart</BUTTON>
          <?php }?>
        </div><?php
    }
    ?>
  </form>
</div>