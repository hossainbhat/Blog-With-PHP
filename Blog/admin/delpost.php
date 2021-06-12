<?php 
    include "../lib/Session.php";
    Session::checkSession();

	include "../config/config.php";
	include "../lib/Database.php";

	$db = new Database(); 
?>

<?php 
    $delid = mysqli_real_escape_string($db->link,$_GET["delid"]);
	if (!isset($delid) || $delid == null) {
            header("location:postlist.php");
        }else{
            $postid = $delid;

             $query ="select * from tbl_post where id='$postid'";
             $postimg = $db->select($query);
             if ($postimg) {
             	while ($imglink = $postimg->fetch_assoc()) {
             		$dellink = $imglink['img'];
             		unlink($dellink);
             	}
             }
             $query ="delete from tbl_post where id='$postid'";
             $postimg = $db->delete($query);
             if ($postimg) {
               echo "<script>alert('Data Deleted Successfully !');</script>";
               echo "<script>window.location = 'postlist.php';</script>";
            }else{
            	echo "<script>alert('Data Not Deleted!');</script>";
               echo "<script>window.location = 'postlist.php';</script>";
            }                              
        }
				 
?>
