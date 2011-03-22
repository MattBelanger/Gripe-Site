<div class="comments form">
<?php echo $this->Form->create('Comment');?>
	<fieldset>
 		<legend><?php __('Edit Comment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('post_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('body');
		echo $this->Form->input('status', array('options' => array(1 => 'Approved', 2 => 'Denied')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>