<h2>Current Stats:</h2>
<table id="AdminStats">
  <tr><td><strong>Total Registered Users: </strong></td><td> <?= $userCount; ?></td><td> <a href="/admin/users"><img title="Go" src="/img/go.gif" /></a></td></tr>
  <tr class="even"><td><strong>Total Admin Users: </strong></td><td> <?= $adminCount; ?></td><td></td></tr>
  <tr><td><strong>Total Banned Users: </strong></td><td> <?= $bannedCount; ?></td><td></td></tr>
  <tr class="even"><td><strong>Total Posts: </strong></td><td> <?= $postCount; ?></td><td> <a href="/admin/posts"><img  title="Go" src="/img/go.gif" /></a></td></tr>
  <tr><td><strong>Total Visible Posts : </strong></td><td> <?= $visPostCount; ?></td><td></td></tr>
  <tr class="even"><td><strong>Posts in Moderation : </strong></td><td> <?= $queueCount; ?></td><td> <a href="/admin/posts/modqueue"><img  title="Go" src="/img/go.gif" /></a></td></tr>
  <tr><td><strong>Denied Posts : </strong></td><td> <?= $denPostCount; ?></td><td></td></tr>
  <tr class="even"><td><strong>Total Comments: </strong></td><td> <?= $commentCount; ?></td><td> <a href="/admin/comments"><img  title="Go" src="/img/go.gif" /></a></td></tr>
  <tr><td><strong>Comments in Moderation: </strong></td><td> <?= $queueCommentCount; ?></td><td></td></tr>
</table>