<div class="posts form">
  <h2><?php __('Edit Post'); ?></h2>
  <?php echo $this->Form->create('Post');?>
	<fieldset>
	<?php
    echo $this->Form->input('status', array('options' => array(1 => 'Approved', 2 => 'Awaiting Moderation', 3 => 'Denied'), 'default' => $post['Post']['status']));
    echo $this->Form->input('title',array('default' => $post['Post']['title']));
    echo $this->Form->input('body',array('default' => $post['Post']['body'], 'rows' => 10, 'cols' => 80));
echo $this->Form->input('slug',array('default' => $post['Post']['slug'],'label' => 'URL Slug', 'disabled' => 'disabled','after' => "<a href=\"#\" onclick=\"if (confirm('Are you sure you want to edit this field?  It may break incoming links.')) { $('PostSlug').disabled = false;}return false;\">Edit</a>"));
	?>
  
	</fieldset>
  <input type="hidden" name="data[Post][id]" value="<?=$post['Post']['id'];?>" />
  <input type="hidden" name="data[Post][user_id]" value="<?=$post['Post']['user_id'];?>" />
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<script type="text/javascript">
  tinyMCE.init({
    mode: "textareas",
    theme: "simple"
  });
</script>
