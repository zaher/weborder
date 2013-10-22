<?php
/**
 * Web Orders
 *
 * @license   PPL (http://www.parmaja.com/licenses/ppl.html)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
/*
  Load the session for user security
*/
  require_once(_ROOT_.'ui/classes.php');
  require_once(_APP_.'exec/db.php');
  class my_authenticate_class extends authenticate_class
  {
    function do_login($load, $by_id, $id, $password)
    {
      global $db, $app;
      $sql ='select * from Users where ';
      if ($by_id)
        $sql = $sql.'UsrID=\''.$id."'";
      else
        $sql = $sql.'UsrName=\''.$id."'";

      $cmd = $db->query($sql);
      $row = $cmd->fetch();
      if ($row == false) {
        return false;
      }
      else
      {
        if ($by_id)
          $hash = $password;
        else
          $hash = $this->hash($id, $password);
        $with_hash = $this->hash($row['UsrName'], $row['UsrPassword']);
        $ok = $hash == $with_hash;
        if ($ok and $load)
        {
          $this->id = $row['UsrID'];
          $this->hash = $hash;
          $this->name = $row['UsrName'];
          $this->title = $row['UsrTitle'];
          $this->is_admin = $row['UsrIsAdmin'] > 0;
          if ($this->is_admin)
            $this->is_moderator = true;
        }
        return $ok;
      }
    }
    
    function do_logout()
    {
    }
  }
  $auth = new my_authenticate_class;
?>