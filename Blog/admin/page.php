    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>
    <style>
        .btn-danger{
                border: 1px solid #ddd;
                color: #444;
                cursor: pointer;
                font-size: 20px;
                padding: 2px 10px;
                font-weight: 0px;
        }
    </style>
        <div class="grid_10">
		    <?php 
                $pageid = mysqli_real_escape_string($db->link,$_GET["pageid"]);
                if (!isset($pageid) || $pageid == null) {
                    header("location:index.php");
                }else{
                    $id = $pageid;
                }

            ?>
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <?php 
                    if ($_SERVER['REQUEST_METHOD']=='POST') {

                    $name      = $_POST['name'];
                    $body      = $_POST['body'];


                    $name      = mysqli_real_escape_string($db->link,$name);
                    $body      = mysqli_real_escape_string($db->link,$body);


                   
                    
                    if ($name == "" || $body == "") {
                        echo "<span class='error'>Fild Must Not be Empty !</span>";
                    }else{  
                        $query ="UPDATE tbl_addpage 
                                    SET 
                                    name    = '$name',
                                    body  = '$body'
                                    WHERE id = '$id'
                                    ";
                            $update_row = $db->update($query);
                        if ($update_row) {
                             echo "<span class='success'>Post Updated Successfully.
                             </span>";
                        }else {
                             echo "<span class='error'>Post Not Updated !</span>";
                        }
                    }
                }
                 ?>
                <div class="block">    
                <?php 
                $query = "select * from tbl_addpage where id='$id'";
                $show_pages = $db->select($query);
                    if ($show_pages) {
                        while ($result = $show_pages->fetch_assoc()) {

                ?>           
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Body</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $result['body']; ?></textarea>
                            </td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                                <span class="btn-danger"><a onclick="return confirm('Are You Sure To Delet !')"  href="delpage.php?delpageid=<?php echo $result['id']; ?>">Delete</a></span>
                            </td>

                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
    <?php include "inc/footer.php"; ?>