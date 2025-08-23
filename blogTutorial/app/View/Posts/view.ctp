<h1><?php echo h($post['Post']['title']) ?></h1>
<p><small>Created: <?php echo $post['Post']['created'];?></small></p>
<p><?php echo h($post['Post']['body']);?></p>

<!-- h() - htmlspecialchats($string, ENT_QUOTES, 'UTF-8') -escapes special characters in the string, security measure against Cross-Site Scripting 
 -->
