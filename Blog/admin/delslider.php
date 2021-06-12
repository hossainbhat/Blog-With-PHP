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
            $sliderid = $delid;

             $query ="select * from tbl_slider where id='$sliderid'";
             $sliderimg = $db->select($query);
             if ($sliderimg) {
             	while ($imglink = $sliderimg->fetch_assoc()) {
             		$dellink = $imglink['img'];
             		unlink($dellink);
             	}
             }
             $query ="delete from tbl_slider where id='$sliderid'";
             $slideimg = $db->delete($query);
             if ($slideimg) {
               echo "<script>alert('Data Deleted Successfully !');</script>";
               echo "<script>window.location = 'sliderlist.php';</script>";
            }else{
            	echo "<script>alert('Data Not Deleted!');</script>";
               echo "<script>window.location = 'sliderlist.php';</script>";
            }                              
        }
				 
?>
