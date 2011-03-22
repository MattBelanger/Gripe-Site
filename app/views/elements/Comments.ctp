<div id="Comments">
  <h3>Comments</h3>
  <?php foreach ($comments as $c) { ?>
<div class="acomment">
  <div class="postbit">Posted On <?php echo date('Y-m-d', strtotime($c['created'])); ?> by <?=$c['User']['username'];
    if ($isAdmin) {
      print '  <a class="modlink" href="/admin/comments/edit/' . $c['id'] . '">Moderate</a>';
    }
    ?></div>
  <div class="commentbody"><?=$c['body'];?></div>
</div>
  <?php }
  echo $this->element('AddComment', array('user' => $activeUser, 'post' => $post, 'return_to' => $return_to));
  ?>
</div>
</div>
