<div class="users form">
  <h2><?php __('Edit User'); ?></h2>
  <?php echo $this->Form->create('User', array('action' => 'save'));?>
	<fieldset>
	<?php
		echo $this->Form->input('username',array('default' => $user['User']['username']));
		echo $this->Form->input('email',array('default' => $user['User']['email']));
    echo $this->Form->input('id',array('default' => $user['User']['id'],'type' => 'hidden'));
    echo $this->Form->input('password', array('disabled' => true, 'after' => '  <a href="#" onclick="$(\'UserPassword\').disabled=(!$(\'UserPassword\').disabled);return false;">Change Password</a>'));
	  ?>

	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
      <?php echo $this->element('UserPosts',array('user' => $user)); ?>