    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block"> 
                	<?php 
                	if (isset($_GET['deluser'])) {
           				 $deluser =$_GET['deluser'];

           				 $query ="delete from tbl_user where id='$deluser'";
           				 $delusers = $db->delete($query);
           				 if ($delusers) {
                        	echo "<span class='success'>Category Deleted Sucessfully !</span>";
	                    }else{
	                        echo "<span class='error'>Category NOT Deleted !</span>";
	                    }
        			}
                	 ?>       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>UserName</th>
							<th>Email</th>
							<th>Details</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$query ="select * from tbl_user order by id desc";
							$userlist = $db->select($query);
							if ($userlist) {
								$i=0;
								while ($result = $userlist->fetch_assoc()) {
									$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><?php echo $result['username']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textShorten($result['details'],50); ?></td>
							<td>

								<?php 
								if ($result['role'] == '0') {
									echo "Admin";
								}elseif ($result['role'] == '1') {
									echo "Author";
								}elseif($result['role'] == '2'){
									echo "Editor";
								} 
								?>
									
							</td>
							<td><a href="viewuser.php?userview=<?php echo $result['id']; ?>">View</a> <?php if (Session::get('userrole')=='1' || Session::get('userrole')=='0') { ?>
								|| <a onclick="return confirm('Are You Sure To Delet !')" href="?deluser=<?php echo $result['id']; ?>">Delete</a></td>
							<?php } ?>
						</tr>
						<?php }} ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
    <?php include "inc/footer.php"; ?>