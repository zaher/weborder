<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  require_once(_APP_.'exec/db.php');
  require_once(_APP_.'exec/auth.php');
  $auth->auto(LEVEL_MODERATOR);
  require_once(_APP_.'exec/utils.php');

  if (isset($_REQUEST['name']))
    $name = $_REQUEST['name'];
  if (in_array($_FILES["file"]["type"], $allowed_photos)) {
    if ($_FILES["file"]["error"] > 0)
      echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    else {
      $fileInfo = pathinfo($_FILES["file"]["name"]);
      $extension = $fileInfo["extension"];
      $filename = $name .'.' .strtolower($extension);
      move_uploaded_file($_FILES["file"]["tmp_name"], _APP_."data/images/items/" .$filename);
      update_mat_photo($db, $name, $filename);
      $app->redirect(url_page('item', 'action=edit&id=' .$name));
    }
  }
  else {
    echo "Invalid file";
  }
?>