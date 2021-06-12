<?php include "inc/header.php";?>
<?php 

			if ($_SERVER['REQUEST_METHOD']=='POST') {
				$fname 	  = $fm->validation($_POST['fname']);
				$lname 	  = $fm->validation($_POST['lname']);
				$email 	  = $fm->validation($_POST['email']);
				$body 	  = $fm->validation($_POST['body']);
				
				$fname 	  = mysqli_real_escape_string($db->link,$fname);
				$lname 	  = mysqli_real_escape_string($db->link,$lname);
				$email 	  = mysqli_real_escape_string($db->link,$email);
				$body 	  = mysqli_real_escape_string($db->link,$body);

				$error ="";
				if (empty($fname)) {
					$error ="Fast Name must not be empry !";
				}elseif (empty($lname)) {
					$error ="Last Name must not be empry !";
				}elseif (empty($email)) {
					$error ="Email must not be empry !";
				}elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
					$error ="Invalid Email Address !";
				}elseif (empty($body)) {
					$error ="Message must not be empry !";
				}else{
					 $query ="INSERT INTO tbl_contact(fname,lname,email,body) VALUES('$fname','$lname','$email','$body')";
                    $messages = $db->insert($query);
                    if ($messages) {
                       $msg ="Message Send Successfully !";
                    }else{
                        $error ="Message not Send !";
                    }
				}

			}
 ?>

			<div class="contentsection contemplete clear">
				<div class="maincontent clear">
					<div class="about">
						<h2>Contact us</h2>
					<?php 
						if (isset($error)) {
							echo "<span style='color:red;'>$error</span>";
						}
						if (isset($msg)) {
							echo "<span style='color:green;'>$msg</span>";
						}
					 ?>
					<form action="" method="post">
						<table>
						<tr>
							<td>Your First Name:</td>
							<td>
							<input type="text" name="fname" placeholder="Enter first name"/>
							</td>
						</tr>
						<tr>
							<td>Your Last Name:</td>
							<td>
							<input type="text" name="lname" placeholder="Enter Last name"/>
							</td>
						</tr>
						
						<tr>
							<td>Your Email Address:</td>
							<td>
							<input type="email" name="email" placeholder="Enter Email Address"/>
							</td>
						</tr>
						<tr>
							<td>Your Message:</td>
							<td>
							<textarea name="body"></textarea>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
							<input type="submit" name="submit" value="Submit"/>
							</td>
						</tr>
				</table>
			<form>				
		 </div>

	</div>
	<?php include "inc/sitbar.php";?>
	<?php include "inc/footer.php";?>