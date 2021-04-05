<?php 
include 'top.php'; 



  if (isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0) {
  	
           $type= get_safe_value($_GET['type']);
           $id=get_safe_value($_GET['id']);
           
           if ($type=='active' || $type=='deactive') {
           	$status=1;
           	if ($type=='deactive') {
           		
           		$status=0;
           	}

           	mysqli_query($con, "update delivery_boy set status= '$status' where id = '$id'");
           	redirect('user.php');
           }

  }

  $sql = "select * from delivery_boy order by id desc";

$res=mysqli_query($con, $sql);





?>      



<div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title" >Delivery Boy</h4>

              <a href="add_delivery_boy.php" style="margin-top: -50px"> Add Delivery Boy</a>
             
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="10%">S.No</th>
                            <th width="20%">Name</th>
                            
                            <th width="20%">Mobile</th>

                            <th width="15%">Added On</th>

                            
                            <th width="25%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                         
                         <?php  if (mysqli_num_rows($res)>0) {
                         	 $i=1;
                         	while ($row=mysqli_fetch_assoc($res)) {
                      
                         	
                          ?>

                        <tr>
                            <td><?php  echo $i ?></td>
                            
                            <td><?php echo $row['name'] ?></td>
                            
                            <td><?php echo $row['mobile'] ?></td>

                            <td>
                              <?php 
                               $dateStr=strtotime($row['added_on']);
                              echo date('d-m-y',$dateStr)  
                              ?>
                              
                                
                              </td>


                            <td>
                            	

                              <a href="add_delivery_boy.php?id=<?php echo $row['id']?>"><label class="badge badge-success hand_cursor">Edit</label></a>&nbsp;
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