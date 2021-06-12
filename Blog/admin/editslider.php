    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>
        <div class="grid_10">
        <?php 
            $sliderid = mysqli_real_escape_string($db->link,$_GET["sliderid"]);
            if (!isset($sliderid) || $sliderid == null) {
                header("location:sliderlist.php");
            }else{
                $sliderid = $sliderid;
            }

        ?>
            <div class="box round first grid">
                <h2>Update Slider</h2>
                 <?php 
                    if ($_SERVER['REQUEST_METHOD']=='POST') {

                    $title      = $_POST['title'];
                    $title      = mysqli_real_escape_string($db->link,$title);

                    $permited  = array('jpg', 'jpeg', 'png', 'gif');
                    $file_name = $_FILES['img']['name'];
                    $file_size = $_FILES['img']['size'];
                    $file_temp = $_FILES['img']['tmp_name'];

                    $div = explode('.', $file_name);
                    $file_ext = strtolower(end($div));
                    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                    $uploaded_image = "uploads/slider/".$unique_image;

                    if ($title == "") {
                        echo "<span class='error'>Fild Must Not be Empty !</span>";
                    }else{
                        if (!empty($file_name)) {
                           if ($file_size >1048567) {
                             echo "<span class='error'>Image Size should be less then 1MB!
                             </span>";
                        }elseif (in_array($file_ext, $permited) === false) {
                             echo "<span class='error'>You can upload only:-"
                             .implode(', ', $permited)."</span>";
                        } else{
                            move_uploaded_file($file_temp, $uploaded_image);
                            $query ="UPDATE tbl_slider 
                                    SET 
                                    title  = '$title',
                                    img    = '$uploaded_image'
                                    WHERE id = '$sliderid'
                                    ";
                            $update_row = $db->update($query);
                        if ($update_row) {
                             echo "<span class='success'>slider Updated Successfully.
                             </span>";
                        }else {
                             echo "<span class='error'>slider Not Updated !</span>";
                        }
                    }
                }else{
                        $query ="UPDATE tbl_slider 
                                    SET 
                                    title  = '$title'
                                    WHERE id = '$sliderid'
                                    ";
                            $update_row = $db->update($query);
                        if ($update_row) {
                             echo "<span class='success'>slider Updated Successfully.
                             </span>";
                        }else {
                             echo "<span class='error'>slider Not Updated !</span>";
                        }
                    }
                        
                }

                }
                 ?>
                <div class="block"> 
                <?php 
                    $query ="select * from tbl_slider where id = '$sliderid'";
                    $getslider = $db->select($query);
                    while ($sliderresult = $getslider->fetch_assoc()) {
                                             
                 ?>                
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $sliderresult['title'];?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $sliderresult['img']; ?>" width="300" height="70"><br>
                                <input type="file" name="img" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } ?>
                </div>
            </div>
        </div>
    <?php include "inc/footer.php"; ?>
