    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block"> 
                	<?php 
                	if (isset($_GET['delcat'])) {
           				 $id =$_GET['delcat'];

           				 $query ="delete from tbl_cat where id='$id'";
           				 $delcat = $db->delete($query);
           				 if ($delcat) {
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
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$query ="select * from tbl_cat order by id desc";
							$category = $db->select($query);
							if ($category) {
								$i=0;
								while ($result = $category->fetch_assoc()) {
									$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']; ?></td>
							 
							<td><a href="editcat.php?editcat=<?php echo $result['id']; ?>">Edit</a>
							<?php if (Session::get('userrole')=='0') { ?>
							 || <a onclick="return confirm('Are You Sure To Delet !')" href="?delcat=<?php echo $result['id']; ?>">Delete</a>
							 <?php } ?>
							</td>
						
						</tr>
						<?php }} ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
    <?php include "inc/footer.php"; ?>