<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
 
function print_div_error($error)
{
  ?>
    <div id="login" class="error">
    <?php print $error ?>
    </div>
  <?php
}

/*-----------*/

function get_key_array($db, $tale_name, $id_field, $code_field) {
  $ary = array();
  $sql = "select " .$id_field ."," .$code_field ." from " .$tale_name;
  $qry = $db->query($sql);
  if ($qry)
    while ($row = $db->fetch_assoc($qry)) {
      $ary[trim($row[$code_field])] = $row[$id_field];
      //echo '"' .trim($row[$code_field]) .'"' .'<br />';
  }
  $db->free_result($qry);
  return $ary;
}

function  add_select($db, $table, $col, $id, $cond, $order, $select_name, $selected_value, $xmlfile){
  $myarray = table_to_array($db, $table, $col, $id, $cond, $order, $xmlfile);
  add_select_from_array($myarray, $select_name, $selected_value);
  unset($myarray);
}

function table_to_array($db, $table, $col, $id, $cond, $order, $xmlfile) {
  $ary = array();
  $sql = 'select '.$id.','.$col.' from '.$table.''.$cond.' '.$order.'';
  $cmd = $db->query($sql);
  while ($row = $cmd->fetch()) {
    $ary[$row[$id]] = $row[$col];
  }
  $cmd->free($row);
  return $ary;
}

function add_select_from_array($ary, $select_name, $selected_value) {
  echo '<select name="' .$select_name .'">';
  echo '<option value="0"></option>';
  foreach ($ary as $Key => $value) {
    if ($selected_value == $Key)
      $selected = ' selected="selected"';
    else
      $selected = '';
    echo '<option value="' .$Key .'"' .$selected .'>' .$value .'</option>';
  }
  echo '</select>';
}

function viewscroll($num_rows, $start, $url, $params=''){
?>
  <table id="nav">
    <tr>
    <?
      $st = 0;
      $i = 1;
      while ($st < $num_rows)
      {
        if ($st == $start)
          echo '<td id="nav_active">' .$i .'</td>' ."\n";
        else
          echo '<td><a href="' .$url .'?start=' .$st .'&' .$params .'">' .$i .'</a></td>' ."\n";
        if ($i % 32 == 0)
          echo '</tr><tr>';
        $st = $st + item_per_page;
        $i++;
      }
    ?>
    </tr>
  </table>
<?}

function get_db_rowscount($db, $sql) {
  if ($sql != '') {
    $sql = 'select count(*) from ( ' .$sql .') tbl';
    $cmd = $db->query($sql);
    if ($row = $cmd->fetch($cmd))
      return 0; //$row[0]
    else
      return 0;
    $db->free($row);
  }
}

function update_mat_photo($db, $id, $photo) {
  $sql = "update Materials set MatPhoto='". strtolower($photo)."'";
  $sql = $sql ." where MatID=" .$id;
  $db->execute($sql);
}

function get_photo_filename($photo) {
  $filename = "data/images/items/" .$photo;
  if (($photo != '') && (file_exists($filename)))
    return $filename;
  else
    return "images/no_photo.jpg";
}
?>