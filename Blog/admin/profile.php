    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>

    <?php 
        $userid   = Session::get('id');
        $userrole = Session::get('userrole');

    ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>User Profile</h2>
               <div class="block copyblock"> 
                <?php 
                if ($_SERVER['REQUEST_METHOD']=='POST') {

                $name     = $_POST['name'];
                $username     = $_POST['username'];
                $email     = $_POST['email'];
                $details     = $_POST['details'];

                $name     = mysqli_real_escape_string($db->link,$name);
                $username     = mysqli_real_escape_string($db->link,$username);
                $email     = mysqli_real_escape_string($db->link,$email);
                $details     = mysqli_real_escape_string($db->link,$details);

                if (empty($name)) {
                    echo "<span class='error'>Fild Must Not be Empty !</span>";
                }else{
                    $query ="update tbl_user 
                            set 
                            name='$name' ,
                            username='$username' ,
                            email='$email' ,
                            details='$details' 
                            where id='$userid'";
                    $catupdate = $db->update($query);
                    if ($catupdate) {
                        echo "<span class='success'>Profile Update Sucessfully !</span>";
                    }else{
                        echo "<span class='error'>Profile NOT Updated !</span>";
                    }
                }

                }

                //show category 
                $query ="select * from tbl_user where id = '$userid' AND role ='$userrole'";
                $getuser = $db->select($query);
                    if ($getuser) {
                      while ($result = $getuser->fetch_assoc()) {
                                
                 ?>

                 <form action="#" method="post">
                    <table class="form">					
                        <tr>
                            <td><label>Name</label></td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label>UserName</label></td>
                            <td>
                                <input type="text" name="username" value="<?php echo $result['username']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label>Email</label></td>
                            <td>
                                <input type="email" name="email" value="<?php echo $result['email']; ?>" class="medium" />
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