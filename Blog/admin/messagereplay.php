    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>
    <?php 
        $replyid = mysqli_real_escape_string($db->link,$_GET["replyid"]);
        if (!isset($replyid) || $replyid == null) {
            header("location:inbox.php");
        }else{
            $id = $replyid;
        }
        ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Post</h2>
                <?php 
                    if ($_SERVER['REQUEST_METHOD']=='POST') {
                    $To       = $fm->validation($_POST['tomail']);
                    $From     = $fm->validation($_POST['frommail']);
                    $Subject  = $fm->validation($_POST['subject']);
                    $Message  = $fm->validation($_POST['body']); 

                    $sendmail = mail($To,$Subject,$Message,$From);

                    if ($sendmail) {
                       echo "<span class='success'>Message Send Sucessfully !</span>";
                    }else{
                        echo "<span class='error'>Message NOT Send !</span>";
                    }
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
                                <label>To</label>
                                </td>
                                <td>
                                    <input type="text" name="tomail" readonly value="<?php echo $result['email']; ?>" class="medium" />
                                </td>
                        </tr>
                        <tr>
                            <td>
                                <label>From</label>
                                </td>
                                <td>
                                    <input type="text" name="frommail" class="medium" />
                                </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Subject</label>
                                </td>
                                <td>
                                    <input type="text" name="subject" class="medium" />
                                </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
                        
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php }} ?>
                </div>
            </div>
        </div>
    <?php include "inc/footer.php"; ?>