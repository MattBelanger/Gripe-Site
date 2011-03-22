<div class="posts view">
  <h2><?php  echo $post['Post']['title']; ?></h2>
  <div class="postbit">Posted On <?php echo date('Y-m-d',strtotime($post['Post']['time_posted'])); ?> by <?=$post['User']['username'];?>
  <?php
    if ($isAdmin) {
      print '  <a class="modlink" href="/admin/posts/edit/'.$post['Post']['id'].'">Moderate</a></p>';
    }
  ?>
  </div>
  <div class="postbody"><?=$post['Post']['body'];?></div>
    <?php
      echo $this->element('Comments',array('comments' => $post['Comment'], 'return_to' => '/posts/view/'.$post['Post']['slug']));
    ?>
</div>
