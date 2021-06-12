    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>

    <?php 
        $userid   = Session::get('id');

    ?>
        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Chenge Password</h2>
               <div class="block copyblock"> 
                <?php 
                if ($_SERVER['REQUEST_METHOD']=='POST') {

                $old_password  = $_POST['old_password'];
                $new_password  = $_POST['new_password'];

                $old_password  = mysqli_real_escape_string($db->link,$old_password);
                $new_password  = mysqli_real_escape_string($db->link,$new_password);

                if (empty($old_password) || empty($new_password)) {
                    echo "<span class='error'>Fild Must Not be Empty !</span>";
                }else{
                $old_password = md5($old_password);

                $query ="select password from tbl_user where id = '$userid' AND password ='$old_password'";
                $getpass = $db->select($query);

                if ($getpass == false) {
                    echo "<span class='error'>Old Password Not Exit !</span>";
                }elseif(strlen($new_password < 5)){
                    echo "<span class='error'>Password is too short !</span>";
                }else{
                    $password = md5($new_password);
                    $query ="update tbl_user 
                            set 
                            password ='$password '
                            where id ='$userid'";
                    $passupdate = $db->update($query);
                    if ($passupdate) {
                        echo "<span class='success'>Password Update Sucessfully !</span>";
                    }else{
                        echo "<span class='error'>Password NOT Updated !</span>";
                    }
                }

                }
                }
           
                 ?>

                 <form action="" method="post">
                    <table class="form">                    
                        <tr>
                            <td><label>Current Password</label></td>
                            <td>
                                <input type="password" name="old_password"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label>New Password</label></td>
                            <td>
                                <input type="password" name="new_password"  class="medium" />
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
                </div>
            </div>
        </div>
    <?php include "inc/footer.php"; ?>