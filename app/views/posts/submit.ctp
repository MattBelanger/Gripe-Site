<div class="posts form">
  <h2><?php __('Tell us your Story'); ?></h2>
  <p class="form-note"><strong>Note:</strong> All submissions are reviewed by our Moderators before posting.  They may be edited for clarity, to ensure privacy, or to remove objectionable language.
  We will endeavour to maintain the original content of the story when posting.</p>
  <?php echo $this->Form->create('Post',array('action' => 'save'));?>
	<fieldset>
	<?php
   echo $this->Form->input('email',array('default' => $user['User']['email'], 'type' => ($user?'hidden':'text')));
   if (!$user) { 
  ?>
  <div class="form-note">
    If you do not yet have an account, we will create one for you, and send you the login information.<br>
    If you already have an account, please <a href="/users/login">Login now</a>.
  </div>
   <?php
   }
    echo $this->Form->input('title',array('default' => $post['Post']['title']));
    echo $this->Form->input('body',array('default' => $post['Post']['body'], 'rows' => 10, 'cols' => 80));
	?>
	</fieldset>
  <?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php echo $this->element('tinymce_javascript'); ?>