<?php 
    include "../lib/Session.php";
    Session::checkSession();

	include "../config/config.php";
	include "../lib/Database.php";

	$db = new Database(); 
?>

<?php 
    $delpageid = mysqli_real_escape_string($db->link,$_GET["delpageid"]);
	if (!isset($delpageid) || $delpageid == null) {
            header("location:index.php");
        }else{
            $pagetid = $delpageid;

             
             $query ="delete from tbl_addpage where id='$pagetid'";
             $delpage = $db->delete($query);
             if ($delpage) {
               echo "<script>alert('Data Deleted Successfully !');</script>";
               echo "<script>window.location = 'index.php';</script>";
            }else{
            	echo "<script>alert('Data Not Deleted!');</script>";
               echo "<script>window.location = 'index.php';</script>";
            }                              
        }
				 
?>
