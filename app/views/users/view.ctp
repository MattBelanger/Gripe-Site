<div class="users view">
  <h2><?php echo $user['User']['username']; ?></h2>
  <p><strong>Member Since: </strong> <?=date('M d, Y', strtotime($user['User']['created']));?>
  <?php echo $this->element('UserPosts',array('user',$user)); ?>
</div>