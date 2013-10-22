<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  $done = false;
  if (defined('action') and (get_request('form', $f))) {
    require_once(_APP_.'exec/db.php');
    require_once(_APP_.'exec/auth.php');
    if (!get_request('form', $f))
      $error = 'Where is the form data?';
    else
    {
      $username=$f['username'];
      $password=$f['password'];
      $done = $auth->login($username, $password);
      if ($done) {
        require_once(_ROOT_.'ui/utils.php');
        $app->redirect(url_page('main'));
      }
      else
        $login_error='Invalid User name or Password';
    }
  }
  
  if (!$done)
  {
  $page=$app->new_page('login', 'Login');
  $page->open();
  include(_APP_.'exec/html/header.php');
  require_once(_APP_.'exec/auth.php');
  include(_APP_.'exec/title.php');
  require_once(_APP_.'exec/utils.php');
  if (!empty($login_error))
    print_div_error($login_error);
?>
<div id="page_login">
    <span><center>Enter your Username and Password</center></span>
     <form method="post" action="<?php print(url_page('login', 'action=login')) ?>" >
      <table class="table_form">
      <tr>
        <th><label for="form[username]">User name</label></th>
        <td><input type="text" name="form[username]" id="form[username]" class="inputtext"  size="26" /></td>
      </tr>
      <tr>
        <th><label for="form[password]">Password</label></th>
        <td><input type="password" name="form[password]" id="form[password]" class="inputtext" " size="26" /></td>
      </tr>
      <tr>
        <td>
        </td>
        <td>
          <BUTTON name="submit" value="submit" type="submit">Login</BUTTON>
        </td>
      </tr>
      </table>
  </form>
</div>
<?php
  $page->close();
  include(_APP_.'exec/html/footer.php');
}
?>