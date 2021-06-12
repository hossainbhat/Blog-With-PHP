<?php include "inc/header.php";?>
		    <?php 
		    	$pageid = mysqli_real_escape_string($db->link,$_GET["pageid"]);
                if (!isset($pageid) || $pageid == null) {
                    header("location:404.php");
                }else{
                    $id = $pageid;
                }

            ?>
	<div class="contentsection contemplete clear">
         <?php 
            $query = "select * from tbl_addpage where id='$id'";
            $show_pages = $db->select($query);
                if ($show_pages) {
                    while ($result = $show_pages->fetch_assoc()) {

         ?> 
		<div class="maincontent clear">
			<div class="about">
				<h2><?php echo $result['name']; ?></h2>
	
				<?php echo $result['body']; ?>
		</div>

	</div>
	<?php } } else{ header("location:404.php");} ?>
	<?php include "inc/sitbar.php";?>
	<?php include "inc/footer.php";?>