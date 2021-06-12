
<?php 
	include "../lib/Session.php";
	Session::checkLogin();
?>
<?php include "../config/config.php";?>
<?php include "../lib/Database.php";?>
<?php include "../helpers/Format.php";?>
<?php 
	$db = new Database(); 
	$fm = new Format();
?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php 
			if ($_SERVER['REQUEST_METHOD']=='POST') {
				$email = $fm->validation($_POST['email']);
				$email = mysqli_real_escape_string($db->link,$email);

				if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
					echo "<span style='color:red;font-size:18px;'>Invalid Email Address !</span>";
				}else{
				$query ="select * from tbl_user where email='$email' limit 1";
                $mailchk = $db->select($query);

				if ($mailchk != false) {
					while ($value = $mailchk->fetch_assoc()) {
						$userid   = $value['id'];
						$username = $value['username'];
					}
					$text = substr($email,0,3);
					$rand = rand(10000,99999);
					$newpass = "$text$rand";
					$password = md5($newpass);

					 $query ="update tbl_user 
					 		set 
					 		password='$password' 
					 		where id='$userid'";
                    $forgotpass = $db->update($query);

                    $to       = "$email";
                    $from     = "codemartz.com";
                    $headers  = "From : $from\n";
                    $headers .= 'MIME-Version: 1.0';
					$headers .= 'Content-type: text/html; charset=iso-8859-1';
					$subject  ="Your Password";
					$message  = "User name is ".$username." and password is ".$newpass."please visite wesite login";

                    $sendmail = mail($to, $subject, $message, $headers);
                    if ($sendmail) {
                    	echo "<span style='color:green;font-size:18px;'>Please check your email !</span>";
                    }else{
                    	echo "<span style='color:red;font-size:18px;'>Email not send!</span>";
                    }
				}else{
					echo "<span style='color:red;font-size:18px;'>Email not Exist!</span>";
				}
			  }
			}
		 ?>
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="email" required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="send" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div>
	</section><!-- content -->
</div><!-- container -->
</body>
</html>