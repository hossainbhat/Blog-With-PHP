    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Name</th>
							<th>Title</th>
							<th>Body</th>
							<th>Image</th>
							<th>Author</th>
							<th>Tags</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$query ="select tbl_post.*,tbl_cat.name from tbl_post inner join tbl_cat on tbl_post.cat = tbl_cat.id order by tbl_post.title desc";
						$post = $db->select($query);
							if ($post) {
								$i=0;
								while ($result = $post->fetch_assoc()) {
									$i++;
						 
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><?php echo $result['title']; ?></td>
							<td><?php echo $fm->textShorten($result['body'],30); ?></td>
							<td><img src="<?php echo $result['img']; ?>" width="60" height="50"></td>
							<td><?php echo $result['auther']; ?></td>
							<td><?php echo $result['tags']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><a href="viewpost.php?viewid=<?php echo $result['id']; ?>">view</a>
							<?php if (Session::get('id')== $result['user_id'] || Session::get('userrole') == '0') { ?>
							|| <a href="editpost.php?postid=<?php echo $result['id']; ?>">Edit</a>
							
							|| <a onclick="return confirm('Are You Sure To Delete !')" href="delpost.php?delid=<?php echo $result['id']; ?>">Delete</a>
							

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
      