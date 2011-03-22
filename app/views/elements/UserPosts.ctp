  <div id="UserPosts">
    <h2>Posts</h2>
    <?php 
      foreach ($user['Post'] as $p) { 
        if (!$isAdmin && $p['status'] != 1) continue;
    ?>
    <div class="post <?=$p['status'] == 2?'inmoderation':$p['status']==3?'denied':'';?>">
      <h3><?php echo $this->Html->link(__($p['title'], true), array('controller' => 'posts','action' => 'view', $p['slug'])); ?></h3>
      <div class="postbit">Posted On <?php echo date('Y-m-d',strtotime($p['time_posted'])); ?>
      <?php
        if ($isAdmin) {
          print '<a class="modlink" href="/admin/posts/edit/'.$p['id'].'">Moderate</a></p>';
        }
      ?>
    </div>
    </div>
      <?php } ?>
  </div>
