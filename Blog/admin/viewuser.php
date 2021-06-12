    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>

    <?php 
        $userview = mysqli_real_escape_string($db->link,$_GET["userview"]);
        if (!isset($userview) || $userview == null) {
            header("location:userlist.php");
        }else{
            $id = $userview;
        }

    ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>User Profile</h2>
               <div class="block copyblock"> 
                <?php 
                if ($_SERVER['REQUEST_METHOD']=='POST') {
                     echo "<script>window.location = 'userlist.php';</script>";

                }

                //show category 
                $query ="select * from tbl_user where id = '$id'";
                $getuser = $db->select($query);
                    if ($getuser) {
                      while ($result = $getuser->fetch_assoc()) {
                                
                 ?>

                 <form action="#" method="post">
                    <table class="form">					
                        <tr>
                            <td><label>Name</label></td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label>UserName</label></td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['username']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label>Email</label></td>
                            <td>
                                <input type="email" readonly value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details"><?php echo $result['details']; ?></textarea>
                            </td>
                        </tr>
						<tr> 
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
    <?php include "inc/footer.php"; ?>