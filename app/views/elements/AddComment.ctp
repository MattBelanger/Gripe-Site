<?php 
  if (!$user) {
    print '<a href="/users/login">Login</a> or <a href="/users/register">Register</a> to post a comment.';
    return;
  }
echo '<h4>Add Comment</h4>';
echo $this->Form->create('Comment', array('action' => 'add'));
echo $this->Form->input('post_id', array('type' => 'hidden','default' => $post['Post']['id']));
echo $this->Form->input('user_id', array('type' => 'hidden','default' => $user['User']['id']));
echo $this->Form->input('status', array('type' => 'hidden','default' => 1));
echo $this->Form->input('body', array('label' => '', 'rows' => 6, 'cols' => 80));
echo $this->Form->input('return_to', array('type' => 'hidden', 'default' => $return_to));
echo $this->Form->submit('Save');
echo $this->Form->end();
?>

<?php echo $this->element('tinymce_javascript'); ?>