
<?php include "inc/header.php";?>

	<?php 
		$serch = mysqli_real_escape_string($db->link,$_GET["serch"]);
		if (!isset($serch) || $serch == null) {
			header("location:404.php");
		}else{
			$serch = $serch;
		}

	?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
		
		<?php 

		$query ="select * from tbl_post where title like '%$serch%' or body like '%$serch%'";
		$post = $db->select($query); 
		if ($post) {
			while ($result = $post->fetch_assoc()) {
		 ?>

			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result["id"]; ?>"><?php echo $result["title"]; ?></a></h2>
				<h4><?php echo $fm->formatDate($result["date"]); ?> By <a href="#"><?php echo $result["auther"]; ?></a></h4>
				 <a href="#"><img src="admin/<?php echo $result["img"]; ?>" alt="post image"/></a>
				<p>
					<?php echo $fm->textShorten($result["body"]); ?>
				</p>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result["id"]; ?>">Read More</a>
				</div>
			</div>
			<?php }} else { ?>
			<p>Your serch not found !!</p>
			<?php } ?>

		</div>
		
	<?php include "inc/sitbar.php";?>
	<?php include "inc/footer.php";?>