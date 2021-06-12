<?php include "inc/header.php";?>
			<?php 
			 $id     = mysqli_real_escape_string($db->link,$_GET["id"]);
			if (!isset($id) || $id == null) {
				header("location:404.php");
			}else{
				$id = $id;
			}

			 ?>
			<div class="contentsection contemplete clear">
				<div class="maincontent clear">
					<div class="about">
						<?php 
							$query ="select * from tbl_post where id=$id";
							$post = $db->select($query); 

							if ($post) {
								while ($result = $post->fetch_assoc()) {
						 ?>
						<h2><?php echo $result["title"]; ?></h2>
						<h4><?php echo $fm->formatDate($result["date"]); ?>, By Delowar</h4>
						<img src="admin/<?php echo $result["img"]; ?>" alt="MyImage"/>
						<p><?php echo $result["body"]; ?></p>
						
						
						<div class="relatedpost clear">
							<h2>Related articles</h2>
							<?php 
							$cat = $result["cat"];
							$catid ="select * from tbl_post where cat='$cat' order by rand() limit 6";
							$catpost = $db->select($catid); 

							if ($catpost) {
								while ($catresult = $catpost->fetch_assoc()) {

							 ?>
							<a href="post.php?id=<?php echo $catresult["id"]; ?>"><img src="admin/<?php echo $catresult["img"]; ?>" alt="post image"/></a>
						<?php }} else{ echo "No Related Post Avalable !!"; } ?>
						<?php }} else{ header("location:404.php"); } ?>
						</div>
			</div>

	</div>
	<?php include "inc/sitbar.php";?>
	<?php include "inc/footer.php";?>