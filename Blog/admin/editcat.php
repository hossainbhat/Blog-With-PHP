    <?php include "inc/header.php"; ?>
    <?php include "inc/sitbar.php"; ?>
    <?php if (!Session::get('userrole')=='0') { ?> 
        echo "<script>window.location = 'inbox.php';</script>";
    <?php } ?>
    <?php 
        $editcat = mysqli_real_escape_string($db->link,$_GET["editcat"]);
        if (!isset($editcat) ||  $editcat == null) {
            header("location:catlist.php");
        }else{
            $id =  $editcat;
        }

    ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock"> 
                <?php 
                if ($_SERVER['REQUEST_METHOD']=='POST') {

                $name     = $_POST['name'];
                $name     = mysqli_real_escape_string($db->link,$name);

                if (empty($name)) {
                    echo "<span class='error'>Fild Must Not be Empty !</span>";
                }else{
                    $query ="update tbl_cat set name='$name' where id='$id'";
                    $catupdate = $db->update($query);
                    if ($catupdate) {
                        echo "<span class='success'>Category Update Sucessfully !</span>";
                    }else{
                        echo "<span class='error'>Category NOT Updated !</span>";
                    }
                }

                }

                //show category 
                $query ="select * from tbl_cat where id = '$id' order by id desc";
                $category = $db->select($query);
                        
                      while ($result = $category->fetch_assoc()) {
                                
                 ?>

                 <form action="#" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } ?>
                </div>
            </div>
        </div>
    <?php include "inc/footer.php"; ?>