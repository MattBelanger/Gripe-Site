<div id="UserInfo">
  <?php if ($activeUser) { ?>
  Welcome <?= $activeUser['User']['username']; ?>.<br> <? if ($activeUser['User']['usertype'] > 1) { print '<a href="/admin">Admin</a>'; } ?>
    <a id="profile" href="/users/profile/<?=$activeUser['User']['id'];?>">Profile</a>  <a id="logout" href="/users/logout">Logout</a>
  <?php } else { ?>
  <a href="/users/login">Login Now</a>
  <?php } ?>
</div>
