    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>
    <?php if (!Session::get('userrole')=='0') { ?>
        echo "<script>window.location = 'inbox.php';</script>";
     <?php } ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                <?php 
                if ($_SERVER['REQUEST_METHOD']=='POST') {

                $username = $fm->validation($_POST['username']);
                $password = $fm->validation(md5($_POST['password']));
                $email     = $fm->validation($_POST['email']);
                $role     = $fm->validation($_POST['role']);

                $username = mysqli_real_escape_string($db->link,$username);
                $password = mysqli_real_escape_string($db->link,$password);
                $email     = mysqli_real_escape_string($db->link,$email);
                $role     = mysqli_real_escape_string($db->link,$role);

                if (empty($username) || empty($password) || empty($role) || empty($email)) {
                    echo "<span class='error'>Fild Must Not be Empty !</span>";
                }else{

                $query ="select * from tbl_user where email='$email' limit 1";
                $mailchk = $db->select($query);
                if ($mailchk != false) {
                    echo "<span class='error'>Email Already Eaxist!</span>";
                }

                else{
                    $query ="INSERT INTO tbl_user(username,password,email,role) VALUES('$username','$password','$email','$role')";
                    $catinsert = $db->insert($query);
                    if ($catinsert) {
                        echo "<span class='success'>User Create Sucessfully !</span>";
                    }else{
                        echo "<span class='error'>User Not Created!</span>";
                    }
                 }
                }

                }
                 ?>
                 <form action="#" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>User Name</label>
                            </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter User Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" name="email" placeholder="Enter email..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Password</label>
                            </td>
                            <td>
                                <input type="password" name="password" placeholder="Enter password..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>User Role</label>
                            </td>
                            <td>
                                <select name="role" id="select">
                                    <option>Select Role</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Author</option>
                                    <option value="2">Editor</option>
                                </select>
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