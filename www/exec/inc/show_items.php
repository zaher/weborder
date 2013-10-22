<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/

  $sql = 'select GrpID, GrpName from Groups';
  if (!empty($items_group))
    $sql = $sql . ' where GrpID=' .$items_group;
  $sql = $sql . ' order by GrpID';
  $sql = $sql . ' limit 1';
  $cmd = $db->query($sql);
  $row = $cmd->fetch();
  if ($row) {
    $items_group = $row['GrpID'];
    $group_name = $row['GrpName'];
  }
  else
    $group_name = '';
    
  $sql = 'select * from Materials';
  $sql = $sql.' left join Carts on MatID = CrtMaterial';
  if ($auth->is_user)
    $sql = $sql.' and CrtUser='.$auth->id;
  $sql = $sql.' where MatGroup=' .$items_group;
  $cmd = $db->query($sql);
?>
<div id="items_list">
  <div class="title"> <?php echo $group_name; ?></div>
  <form method="post" name="choose_form" action="<?php print(url_page('carts', 'action=add')) ?>" >
    <table width="99%">
    <?php
      while (($row = $cmd->fetch())) {
        $id = $row["MatID"];
        $photo = $row["MatPhoto"];
        $cart_qnt=$row["CrtQnt"];
    ?>
      <tr id="bm<?php print($id) ?>">
        <td>
        <?php $photo_filename = get_photo_filename($photo); ?>
          <img border="0" src=<?php echo $photo_filename; ?>>
        </td>
        <td><?php echo $row["MatName"]; ?></td>
        <?php
          if ($auth->is_user)
          {
          ?>
          <td>
            <? if ($row["MatNotAvailable"]) {
                echo "Not Available";
            }
            else { ?>
            <div class="qnt">
            Qnt <input type="text" value="<?php print($cart_qnt) ?>" id="qnt_<?php print($id) ?>" class="inputtext" name="form_qnt[<?php print($id) ?>]" size="5" />
          </div>
          <div class ="actions">
          <?php
            if ($row['CrtMaterial'] > 0)
              $caption = 'Modify';
            else
              $caption = 'Add';
              
            $page->add_link('javascript:submit_fld('.'\'?page=carts&action=add&mat='.$id.'&qnt=\''.', \'qnt_'.$id.'\', 1)', $caption);
            
            if ($row['CrtMaterial'] > 0)
            {
              ?> | <?php
              $page->add_link('?page=carts&action=del&mat='.$id, 'Remove');
            }
          ?>
          </div>
          <?php } ?>
        </td>
        <?php } ?>
      </tr>
      <?php
        }
      ?>
    </table>
    <?php
    if ($auth->is_user)
    {
     ?> <div class="filter">
          <BUTTON name="submit" value="add" type="submit">Submit to my cart</BUTTON>
        </div>
     <?php
    }
    ?>
  </form>
</div>