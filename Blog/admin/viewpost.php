    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>
        <?php 
        $viewid = mysqli_real_escape_string($db->link,$_GET["viewid"]);
        if (!isset($viewid) ||  $viewid == null) {
            header("location:postlist.php");
        }else{
            $viewid = $viewid;
        }

        ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Post</h2>
                <?php 
                    if ($_SERVER['REQUEST_METHOD']=='POST') {
                    echo "<script>window.location = 'postlist.php';</script>";

                } ?>
                <div class="block"> 
                <?php 
                    $query ="select * from tbl_post where id='$viewid'";
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
                                <input type="text" readonly value="<?php echo $postresult['title']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" readonly>
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
                                    <input type="text" readonly value="<?php echo $postresult['tags']; ?>" class="medium" />
                                </td>
                            </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $postresult['img']; ?>" width="100" height="70"><br>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" readonly><?php echo $postresult['body']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly name="auther" value="<?php echo $postresult['auther']; ?>" class="medium" />
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
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php include "inc/footer.php"; ?>