<?
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  class user_addon extends addon_class
  {
    function get_title()
    {
      global $auth;
      return $auth->name;
    }
  }

  $user_addon = new user_addon;
  
  $app->add_addon('main', 'Home', 'mainbar', '', 'exec/main.php', LEVEL_NORMAL, '');
  $app->add_addon('orders', 'Orders', 'mainbar', '', 'exec/orders.php', LEVEL_USER, '');
  $app->add_addon('order', 'Order', 'orders', 'orders', 'exec/order.php', LEVEL_USER, '');
  
  $app->add_addon('cart', 'My Cart', 'mainbar', '', 'exec/cart.php', LEVEL_USER, 'Show my cart items');
  $app->add_addon('user', 'User', 'mainbar', '', 'exec/users.php', LEVEL_USER, 'Go to user panel');
  $app->add_addon('admin', 'Admin', 'mainbar', '', 'exec/admin.php', LEVEL_MODERATOR, 'Go to admin panel');
  
  $app->add_addon('logout', 'Logout', 'mainbar', '', 'exec/logout.php', LEVEL_USER, '');
  $app->add_addon('login', 'Login', 'mainbar', '', 'exec/login.php', LEVEL_GUEST, 'Login as user');
  $app->add_addon('register', 'Register', 'mainbar', '', 'exec/register.php', LEVEL_GUEST, '');
  $app->add_addon('about', 'About', 'mainbar', '', 'exec/about.php', LEVEL_NORMAL, '');

  $app->add_addon('myorders', 'My Orders', 'user', '', 'exec/myorders.php', LEVEL_USER, '');
  $app->add_addon('profile', 'Profile', 'user', '', 'exec/Profile.php', LEVEL_USER, '');


  $app->add_addon('users', 'Users', 'admin', '', 'exec/users.php', LEVEL_ADMIN, '');
  $app->add_addon('groups', 'Groups', 'admin', '', 'exec/groups.php', LEVEL_MODERATOR, '');
  $app->add_addon('items', 'Items', 'admin', '', 'exec/items.php', LEVEL_MODERATOR, '');
  $app->add_addon('group', 'Add Group', 'groups', 'groups', 'exec/group.php', LEVEL_MODERATOR, '');
  $app->add_addon('user', 'Add User', 'users', 'users', 'exec/user.php', LEVEL_MODERATOR, '');
  $app->add_addon('item', 'Add Item', 'items', 'items', 'exec/item.php', LEVEL_MODERATOR, '');
  $app->add_addon('upload', 'Upload', 'items', '', 'exec/upload_pic.php', LEVEL_MODERATOR, '');

  $app->add_addon('carts', '', '', '', 'exec/carts.php', LEVEL_USER, '');
  $app->addons['carts']['visible']=false;

?>