<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('The OLP Gripe Site'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('reset');
		echo $this->Html->css('style');
	?>
  <script type="text/javascript" src="/js/prototype.js"></script >
  <script type="text/javascript" src="/js/tiny_mce/tiny_mce.js"></script >
</head>
<body>
	<div id="container">
		<div id="header">
      <div id="menu">
        <ul>
          <li><a href="/">Home</a></li>
          <li><a href="/admin/posts">Posts</a></li>
          <li><a href="/admin/users">Users</a></li>
          <li><a href="/admin/comments">Comments</a></li>
          <li><a href="/admin/posts/modqueue">Moderation Queue</a></li>
        </ul>
      </div>
      <?php echo $this->element('UserInfo',array('activeUser' => $activeUser)); ?>
			<h1>OLP Gripe Site - Admin</h1>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
      A project of <a href="http://libertarian.on.ca" target="_blank">The Ontario Libertarian Party</a>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>