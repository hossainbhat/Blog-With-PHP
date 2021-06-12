    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>
        <?php 
        $postid = mysqli_real_escape_string($db->link,$_GET["postid"]);
        if (!isset($postid) || $postid == null) {
            header("location:postlist.php");
        }else{
            $postid = $postid;
        }

        ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Post</h2>
                <?php 
                    if ($_SERVER['REQUEST_METHOD']=='POST') {

                    $title      = $_POST['title'];
                    $cat        = $_POST['cat'];
                    $tags       = $_POST['tags'];
                    $body       = $_POST['body'];
                    $auther     = $_POST['auther'];
                    $user_id     = $_POST['user_id'];

                    $title      = mysqli_real_escape_string($db->link,$title);
                    $cat        = mysqli_real_escape_string($db->link,$cat);
                    $tags       = mysqli_real_escape_string($db->link,$tags);
                    $body       = mysqli_real_escape_string($db->link,$body);
                    $auther     = mysqli_real_escape_string($db->link,$auther);
                    $user_id     = mysqli_real_escape_string($db->link,$user_id);

                    $permited  = array('jpg', 'jpeg', 'png', 'gif');
                    $file_name = $_FILES['img']['name'];
                    $file_size = $_FILES['img']['size'];
                    $file_temp = $_FILES['img']['tmp_name'];

                    $div = explode('.', $file_name);
                    $file_ext = strtolower(end($div));
                    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                    $uploaded_image = "uploads/".$unique_image;

                    if ($title == "" || $cat == "" || $tags == "" || $body == "" || $auther == "") {
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
                            $query ="UPDATE tbl_post 
                                    SET 
                                    cat    = '$cat',
                                    title  = '$title',
                                    body   = '$body',
                                    img    = '$uploaded_image',
                                    auther = '$auther',
                                    tags   = '$tags',
                                    user_id= '$user_id'
                                    WHERE id = '$postid'
                                    ";
                            $update_row = $db->update($query);
                        if ($update_row) {
                             echo "<span class='success'>Post Updated Successfully.
                             </span>";
                        }else {
                             echo "<span class='error'>Post Not Updated !</span>";
                        }
                    }
                }else{
                        $query ="UPDATE tbl_post 
                                    SET 
                                    cat    = '$cat',
                                    title  = '$title',
                                    body   = '$body',
                                    auther = '$auther',
                                    tags   = '$tags',
                                    user_id= '$user_id'
                                    WHERE id = '$postid'
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

                }
                 ?>
                <div class="block"> 
                <?php 
                    $query ="select * from tbl_post where id='$postid'";
                    $post = $db->select($query);
                    while ($postresult = $post->fetch_assoc()) {
                                             
                 ?>              
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $postresult['title']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option>Select Category</option>
                                    <?php 
                                    $query ="select * from tbl_cat";
                                    $category = $db->select($query);

                                    if ($category) {
                                    while ($result = $category->fetch_assoc()) {
                                     ?>
                                    <option 
                                    <?php if ($postresult['cat'] == $result['id']) { ?>
                                       selected='selected'
                                   <?php } ?>
                                    value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                <?php }} ?>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label>Tags</label>
                                </td>
                                <td>
                                    <input type="text" name="tags" value="<?php echo $postresult['tags']; ?>" class="medium" />
                                </td>
                            </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $postresult['img']; ?>" width="100" height="70"><br>
                                <input type="file" name="img" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $postresult['body']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly name="auther" value="<?php echo $postresult['auther']; ?>" class="medium" />
                                <input type="hidden" name="user_id" readonly value="<?php echo Session::get('id'); ?>" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php include "inc/footer.php"; ?>