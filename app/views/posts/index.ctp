<div class="posts index">
	<h2><?php __('Latest Gripes');?></h2>
	<?php
    $first = true;
	  foreach ($posts as $post) {
      if (!$first) print '<div class="separator"></div>';
      $first = false;
      ?>
  <div id="Post<?php echo $post['Post']['id']; ?>" class="post">
  <h3><?php echo $this->Html->link(__($post['Post']['title'], true), array('action' => 'view', $post['Post']['slug'])); ?></h3>
      <div class="postbit">Posted On <?php echo date('Y-m-d',strtotime($post['Post']['time_posted'])); ?> by <?=$this->Html->link($post['User']['username'],array('controller' => 'users', 'action' => 'profile',$post["User"]['id']));?>  
      <?php
        if ($isAdmin) {
          print '  <a class="modlink" href="/admin/posts/edit/'.$post['Post']['id'].'">Moderate</a></p>';
        }
      ?>
    </div>
    <div class="teaser"><?php echo $post['Post']['teaser']; ?></div>
    <p class="readmore"><?php echo $this->Html->link(__('read more', true), array('action' => 'view', $post['Post']['slug'])); ?></p>
  </div>
<?php } ?>

  <?php if ($this->Paginator->hasNext() || $this->Paginator->hasPrev()) { ?>
  <div id="Pager">
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
  </div>
  <?php } ?>
</div>