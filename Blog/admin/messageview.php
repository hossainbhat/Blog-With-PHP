    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>
    <?php 
       $msgid = mysqli_real_escape_string($db->link,$_GET["msgid"]);
        if (!isset($msgid) || $msgid == null) {
            header("location:inbox.php");
        }else{
            $id = $msgid;
        }
        ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Post</h2>
                <?php 
                    if ($_SERVER['REQUEST_METHOD']=='POST') {
                    echo "<script>window.location = 'inbox.php';</script>";

                }
                 ?>
                <div class="block">   
                <?php 
                     $query ="select * from tbl_contact where id='$id'";
                     $getmessage = $db->select($query);

                        if ($getmessage) {
                           while ($result = $getmessage->fetch_assoc()) {
                 ?>
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['fname'].' '.$result['lname']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        
                        <tr>
                            <td>
                                <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['email']; ?>" class="medium" />
                                </td>
                            </tr>
                        
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $result['body'];?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $fm->formatDate($result['date']); ?>" class="medium" />
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
                <?php }} ?>
                </div>
            </div>
        </div>
    <?php include "inc/footer.php"; ?>