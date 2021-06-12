    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Slider List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Title</th>
							<th>Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$query ="select * from tbl_slider order by id desc";
						$slider = $db->select($query);
							if ($slider) {
								$i=0;
								while ($result = $slider->fetch_assoc()) {
									$i++;
						 
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $result['title']; ?></td>
							<td><img src="<?php echo $result['img']; ?>" width="300" height="70"></td>
							<td><a href="editslider.php?sliderid=<?php echo $result['id']; ?>">Edit</a>
							<?php if (Session::get('userrole')=='0') { ?>
							|| <a onclick="return confirm('Are You Sure To Delete !')" href="delslider.php?delid=<?php echo $result['id']; ?>">Delete</a>
						<?php } ?>
							

							</td>
						</tr>
						<?php } } ?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
     <?php include "inc/footer.php"; ?>
      