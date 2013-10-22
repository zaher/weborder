<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  $done = false;
  if (defined('action') and (get_request('form', $f)))
  {
    require_once(_APP_.'exec/db.php');
    require_once(_APP_.'exec/auth.php');
    get_value($f, 'username', $username);
    get_value($f, 'password', $password);
    get_value($f, 'confirm_password', $confirm_password);
    get_value($f, 'title', $title);
    get_value($f, 'email', $email);
    get_value($f, 'address', $address);
    if (empty($username))
      $error = 'User name is required';
    else if (empty($password))
      $error = 'Password is required';
    else if ($password <> $confirm_password)
      $error = 'Password not identical';
    else
    {
      global $db, $app;
      $sql ="insert into Users (UsrName, UsrTitle, UsrPassword, UsrEmail, UsrAddress)
values('".$username."','".$title."','".$password."','".$email."','".$address."')";
      $cmd = $db->execute($sql);
      $id = $db->insert_id();
      if ($auth->login($username, $password));
        $app->redirect('?page=main');
      $done = true;
    }
  }
  
  if (!$done)
  {
  $page=$app->new_page('register', 'Register');
  $page->open();
  include(_APP_.'exec/html/header.php');
  require_once(_APP_.'exec/auth.php');
  $auth->auto(LEVEL_NORMAL);
  include(_APP_.'exec/title.php');
  require_once(_APP_.'exec/utils.php');
  if (!empty($error))
    print_div_error($error);
?>
<div id="page_register">
  <h1>Register as user in our Farms</h4>
  <form method="post" action="?page=register&action=submit">
    <div class="page_form">
      <table class="table_form">
      <tr>
        <th>User name</th>
        <td><input type="text" class="inputtext" name="form[username]" value="<?php print_value($username) ?>" size="26" /></td>
      </tr>
      <tr>
        <th>Password</th>
        <td><input type="password" class="inputtext" name="form[password]" size="26" /></td>
      </tr>
      <tr>
        <th>Confirm Password</th>
        <td><input type="password" class="inputtext" name="form[confirm_password]" size="26" /></td>
      </tr>
      <tr>
        <th>Full name</th>
        <td><input type="text" class="inputtext" name="form[fullname]" size="26" /></td>
      </tr>
      <tr>
        <th>Email Address</th>
        <td><input type="text" class="inputtext" name="form[email]" size="40" /></td>
      </tr>
      <tr>
        <th>Address</th>
        <td><input type="text" class="inputtext" name="form[address]" size="80" /></td>
      </tr>
      <tr>
        <th></th>
        <td><input type="submit" class="inputbutton" name="form[register]" value="Register" /></td>
      </tr>
      </table>
    </div>
  </form>
</div>
<?php
  $page->close();
  include(_APP_.'exec/html/footer.php');
}
?>