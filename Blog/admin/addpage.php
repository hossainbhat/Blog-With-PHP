    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>
        <?php if (!Session::get('userrole')=='1' && !Session::get('userrole')=='0') { ?>
        echo "<script>window.location = 'index.php';</script>";
     <?php } ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <?php 
                    if ($_SERVER['REQUEST_METHOD']=='POST') {

                    $name      = $_POST['name'];
                    $body      = $_POST['body'];


                    $name      = mysqli_real_escape_string($db->link,$name);
                    $body       = mysqli_real_escape_string($db->link,$body);


                   
                    
                    if ($name == "" || $body == "") {
                        echo "<span class='error'>Fild Must Not be Empty !</span>";
                    }else{
                        $query = "INSERT INTO tbl_addpage(name,body) 
                        VALUES('$name','$body')";
                        $inserted_rows = $db->insert($query);
                        if ($inserted_rows) {
                         echo "<span class='success'>Add Page Created Successfully.
                         </span>";
                        }else {
                         echo "<span class='error'>Page Not Created !</span>";
                        }
                    } 

                }
                 ?>
                <div class="block">               
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" placeholder="Enter Name..." class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Body</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    <?php include "inc/footer.php"; ?>