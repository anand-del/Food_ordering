<?php 
include 'top.php'; 



  if (isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0) {
  	
           $type= get_safe_value($_GET['type']);
           $id=get_safe_value($_GET['id']);
           if ($type=='delete') {
           	
           	mysqli_query($con, "delete from category where id='$id'");
           	redirect('category.php');
           }

           if ($type=='active' || $type=='deactive') {
           	$status=1;
           	if ($type=='deactive') {
           		
           		$status=0;
           	}

           	mysqli_query($con, "update category set status= '$status' where id = '$id'");
           	redirect('category.php');
           }

  }

  $sql = "select * from category order by order_number";

$res=mysqli_query($con, $sql);





?>      



<div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title" style="font-size: 24px; color: red; margin-top: 10px;">Category</h4>
             <a href="add_category.php" style="margin-top: -50px"> <button type="button" class="btn btn-primary btn-lg">Add category</button></a>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="15%">S.No</th>
                            <th width="25%">Category</th>
                            <th width="25%">Order Number</th>
                            
                            <th width="35%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                         
                         <?php  if (mysqli_num_rows($res)>0) {
                         	 $i=1;
                         	while ($row=mysqli_fetch_assoc($res)) {
                      
                         	
                          ?>

                        <tr>
                            <td><?php  echo $i ?></td>
                            
                            <td><?php echo $row['category'] ?></td>
                            <td><?php echo $row['order_number'] ?></td>

                            <td>
                            	<a href="add_category.php?id=<?php echo $row['id']?>"><label class="badge badge-success hand_cursor">Edit</label></a>&nbsp;

                                  <?php
                                   if ($row['status']==1) {
                                   	# code...
                                   	?>
                                     <a href="?id=<?php echo $row['id']?>&type=deactive"><label class="badge badge-primary hand_cursor">Active</label></a>&nbsp;
                                   	<?php
                                   }else{
                                      
                                      ?>
                                     <a href="?id=<?php echo $row['id']?>&type=active"><label class="badge badge-warning hand_cursor">Deactive</label></a>&nbsp;
                                   	<?php

                                   }

                                  ?>

                            	
                            	<a href="?id=<?php echo $row['id']?>&type=delete"><label class="badge badge-danger hand_cursor delete_red">Delete</label></a>
                            </td>
                           
                           
                        </tr>
                      
                       
                       <?php $i++; } } else{?>

                       	 <tr>
                       	 	<td colspan="5">No Data found</td>
                       	 </tr>
                       <?php  }?>
                       
                       
                       
                      </tbody>
                    </table>
                  </div>
				</div>
              </div>
            </div>
          </div>
  
  <?php include 'footer.php'; ?>      