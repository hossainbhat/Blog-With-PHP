
<?php include "config/config.php";?>
<?php include "lib/Database.php";?>
<?php include "helpers/Format.php";?>
<?php 
	$db = new Database(); 
	$fm = new Format();
?>


<!DOCTYPE html>
<html>
<head>
	<?php include "scripts/meta.php"; ?>
	<?php include "scripts/css.php"; ?>
	<?php include "scripts/js.php"; ?>
</head>

<body>
	<div class="headersection templete clear">
		<a href="#">
			<div class="logo">
				<?php 
				$query = "select * from tbl_slogan where id = '1'";
                    $blog_slogan = $db->select($query);
                    if ($blog_slogan) {
                       while ($result = $blog_slogan->fetch_assoc()) {
				 ?>
				<img src="admin/<?php echo $result['logo']; ?>" alt="Logo"/>
				<h2><?php echo $result['title']; ?></h2>
				<p><?php echo $result['slogan']; ?></p>
			<?php }} ?>
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
				<?php 
                    $query = "select * from tbl_socal where id = '1'";
                    $title_slogan = $db->select($query);
                    if ($title_slogan) {
                       while ($result = $title_slogan->fetch_assoc()) {

                 ?>     
				<a href="<?php echo $result['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $result['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $result['ln']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $result['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			<?php } } ?>
			</div>
			<div class="searchbtn clear">
			<form action="serch.php" method="get">
				<input type="text" name="serch" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<?php 
		$path = $_SERVER['SCRIPT_FILENAME'];
 		 $currentpage = basename($path, '.php');
	 ?>
	<ul>
		<li><a  <?php if ($currentpage == 'index') { echo "id='active'"; } ?> href="index.php">Home</a></li>
		<?php 
            $query = "select * from tbl_addpage";
            $show_pages = $db->select($query);
                if ($show_pages) {
                    while ($result = $show_pages->fetch_assoc()) {

        ?>  
            <li><a 
            	<?php 
            		if (isset($_GET['pageid']) && $_GET['pageid'] == $result['id']) {
            			echo "id='active'";
            		}
            	 ?>
            	href="page.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
         <?php } } ?>

		<li><a <?php if ($currentpage == 'contact') { echo "id='active'"; } ?> href="contact.php">Contact</a></li>
	</ul>
</div>
