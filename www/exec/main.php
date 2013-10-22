<?php
/**
 * Web Orders
 *
 * @license   The MIT License (MIT) (http://opensource.org/licenses/MIT)
 * @author    Jihad Khalifa <jihad at parmaja dot com>
 * @author    Zaher Dirkey <zaher at parmaja dot com>
 **/
  $done=false;
  include(_APP_.'exec/db.php');
  include(_APP_.'exec/auth.php');
  require_once(_APP_.'exec/utils.php');
  $page = $app->new_page('main', 'Home page');
  $page->title = app_title;
  $page->add_script('js/forms.js');
  $page->open();
  include(_APP_.'exec/html/header.php');
  $auth->auto(LEVEL_NORMAL);
  include(_APP_.'exec/title.php');
?>
<div id="content">
  <div id="nav">
    <div class="box">
      <h4>Groups</h4>
      <ul>
      <?php
        $cmd = $db->query('select * from Groups');
        if ($cmd) {
          while (($row = $cmd->fetch())) {
          ?>
          <li>
            <?php $page->add_link(url_page('main', 'group='.$row['GrpID']), $row['GrpName']);?>
          </li>
          <?php
          }
          $cmd->free($row);
        }
      ?>
      </ul>
    </div>
    <div class="spliter"></div>
     <?php if ($auth->is_user) { ?>
    <div class="box">
      <h4>Carts</h4>
      <?php
        $cmd = $db->query('select count(*) c from Carts where CrtUser='.$auth->id);
        if ($cmd) {
          $cmd->query();
          $row = $cmd->fetch();
          $c = $row['c'];
          if ($c>0) {
          ?>
          You have cart opened with <?php print($c) ?> items.
          <?php
            $page->add_br();
            $page->add_link(url_page('cart', 'action=show'), 'Show');
            $page->add_br();
            $page->add_link(url_page('cart', 'action=order'), 'Order my cart');
            $page->add_br();
            $page->add_link(url_page('carts', 'action=cancel'), 'Cancel my cart');
          }
          else
          {
          ?>
          You have an empty cart.
          <?php
          }
        }
      ?>
    </div>
     <?php } ?>
  </div>

  <div id="main">
  <?php
    get_request('group', $items_group);
    include(_APP_.'exec/inc/show_items.php');
  ?>
  </div>
</div>
<?php
  include(_APP_.'exec/html/footer.php');
  $page->close();
?>