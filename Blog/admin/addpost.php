    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
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

                    if ($title == "" || $cat == "" || $tags == "" || $body == "" || $auther == "" || $file_name == "") {
                        echo "<span class='error'>Fild Must Not be Empty !</span>";
                    }elseif ($file_size >1048567) {
                         echo "<span class='error'>Image Size should be less then 1MB!
                         </span>";
                    }elseif (in_array($file_ext, $permited) === false) {
                         echo "<span class='error'>You can upload only:-"
                         .implode(', ', $permited)."</span>";
                    } else{
                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "INSERT INTO tbl_post(cat,title,body,img,auther,tags,user_id) 
                        VALUES('$cat','$title','$body','$uploaded_image','$auther','$tags','$user_id')";
                        $inserted_rows = $db->insert($query);
                        if ($inserted_rows) {
                         echo "<span class='success'>Post Inserted Successfully.
                         </span>";
                        }else {
                         echo "<span class='error'>Post Not Inserted !</span>";
                        }
                    } 

                }
                 ?>
                <div class="block">               
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
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
                                    <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                <?php }} ?>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label>Tags</label>
                                </td>
                                <td>
                                    <input type="text" name="tags" placeholder="Enter Tags Title..." class="medium" />
                                </td>
                            </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="img" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="auther" readonly value="<?php echo Session::get('username'); ?>" class="medium" />
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
                </div>
            </div>
        </div>
    <?php include "inc/footer.php"; ?>