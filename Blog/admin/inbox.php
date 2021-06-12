    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php 
                if (isset($_GET['msgseen'])) {
                	$seenid =$_GET['msgseen'];

                	$query ="UPDATE tbl_contact SET status = '1' WHERE id = '$seenid'";
                     $update_row = $db->update($query);
                        if ($update_row) {
                             echo "<span class='success'>Message Seen Successfully.
                             </span>";
                        }else {
                             echo "<span class='error'>Message Not Seen !</span>";
                        }                
                    }
                 ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$query ="select * from tbl_contact where status ='0'";
						$contmsg = $db->select($query);
							if ($contmsg) {
								$i=0;
							while ($result = $contmsg->fetch_assoc()) {
								$i++;
						 
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['fname'].' '.$result['lname'] ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textShorten($result['body'],50); ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td>
								<a href="messageview.php?msgid=<?php echo $result['id']; ?>">View</a> ||
								<a href="messagereplay.php?replyid=<?php echo $result['id']; ?>">Replay</a> ||
								<a onclick="return confirm('Are You Move To Send Box!')" href="?msgseen=<?php echo $result['id']; ?>">Seen</a>
							</td>
						</tr>
						<?php }} ?>
					</tbody>
				</table>
               </div>
            </div>
             <div class="box round first grid">
                <h2>Seen</h2>
                   <?php 
                	if (isset($_GET['msgdelete'])) {
           				 $delid =$_GET['msgdelete'];

           				 $query ="delete from tbl_contact where id='$delid' order by id desc";
           				 $delmail = $db->delete($query);
           				 if ($delmail) {
                        	echo "<span class='success'>Email Deleted Sucessfully !</span>";
	                    }else{
	                        echo "<span class='error'>Email NOT Deleted !</span>";
	                    }
        			}
                	 ?>  
                <?php 
                if (isset($_GET['msgunseen'])) {
                	$unseenid =$_GET['msgunseen'];

                	$query ="UPDATE tbl_contact SET status = '0' WHERE id = '$unseenid'";
                     $update_row = $db->update($query);
                        if ($update_row) {
                             echo "<span class='success'>Message Seen Successfully.
                             </span>";
                        }else {
                             echo "<span class='error'>Message Not Seen !</span>";
                        }                
                    }
                 ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$query ="select * from tbl_contact where status ='1' order by id desc";
						$contmsg = $db->select($query);
							if ($contmsg) {
								$i=0;
							while ($result = $contmsg->fetch_assoc()) {
								$i++;
						 
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['fname'].' '.$result['lname'] ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textShorten($result['body'],50); ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td>
								<a href="messageview.php?msgid=<?php echo $result['id']; ?>">View</a> || <a onclick="return confirm('Are You Move To Unseen Box!')" href="?msgunseen=<?php echo $result['id']; ?>">UnSeen</a> || <a onclick="return confirm('Are You Sure To Delete !')" href="?msgdelete=<?php echo $result['id']; ?>">Delete</a>
							</td>
						</tr>
						<?php }} ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
     <?php include "inc/footer.php"; ?>