<?php
	require_once("../../nodefy_beta/header_files/header.php");
	require_once("../../nodefy_beta/config_database/config.php");
	
	$pk_node = $_GET["node"];
	$comment_query = "SELECT comment_comment from comment where (frn_node = '$pk_node')";
	//$comment_query = "SELECT * from comment c Innerjoin users u on c.frn_node = n.pk_node, innerjoin users u on c.fm_human = u.pk_human where c.fm_node = $passed";
	$comments = $mysqli->query($comment_query);
	echo "<div class=\"commentbox\">";
	foreach($comments as $comment){
		echo "<div class=\"comment\">"."<br/>";
		echo $comment;
		echo "</div>";
	}
	echo "</div>";
	
	/*foreach ($comments as $comment){
		//echo $comment."</br>";
	}
		
	$node_comment_query = "SELECT node_comments"
	$node_comments = #GET NODE COMMENTS
	$node_pictures = #GET NODE PICTURES-->*/
?>

<link rel="stylesheet" type="text/css" href="something.css" />
<a href="something.css">blarg</a>

<div class="commentform">
<form action="commentquery.php" method="post">
  <p>Comments:<br /></p>
  <textarea name="comments" id="comments">
  </textarea>

  <input type="hidden" value="<?php echo $pk_node ?>" name="pk_node"/>
    <input type="submit" value="Submit" />
</form></div>

<div class="commentform">
