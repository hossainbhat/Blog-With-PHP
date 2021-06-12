    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <div class="block copyblock"> 
                <?php 
                if ($_SERVER['REQUEST_METHOD']=='POST') {

                    $note   = $fm->validation($_POST['note']);

                    $note   = mysqli_real_escape_string($db->link,$note);

                    if ($note == "") {
                        echo "<span class='error'>Fild Must Not be Empty !</span>";
                    }else{
                         $query ="UPDATE copy_right 
                                    SET 
                                    note    = '$note'
                                    WHERE id = '1'
                                    ";
                            $update_row = $db->update($query);
                        if ($update_row) {
                             echo "<span class='success'>CopyRight Updated Successfully.
                             </span>";
                        }else {
                             echo "<span class='error'>CopyRight Not Updated !</span>";
                        }
                    }
                }
                 ?>
                <?php 
                    $query = "select * from copy_right where id = '1'";
                    $title_slogan = $db->select($query);
                        if ($title_slogan) {
                            while ($result = $title_slogan->fetch_assoc()) {

                ?>  
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['note']; ?>" name="note" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
    <?php include "inc/footer.php"; ?>