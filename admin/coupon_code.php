  <?php 
  include 'top.php'; 



  if (isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0) {

  $type= get_safe_value($_GET['type']);
  $id=get_safe_value($_GET['id']);


      /*  $type= get_safe_value($_GET['type']);
           $id=get_safe_value($_GET['id']);*/
           if ($type=='delete') {
            
            mysqli_query($con, "delete from coupon_code where id='$id'");
            redirect('coupon_code.php');
           }



  if ($type=='active' || $type=='deactive') {
  $status=1;
  if ($type=='deactive') {

  $status=0;
  }

  mysqli_query($con, "update coupon_code set status= '$status' where id = '$id'");
  redirect('coupon_code.php');
  }

  }

  $sql = "select * from coupon_code order by id desc";

  $res=mysqli_query($con, $sql);





  ?>      



  <div class="main-panel">
  <div class="content-wrapper">
  <div class="card">
  <div class="card-body">
  <h4 class="card-title" >Coupon Code</h4>

  <a href="add_coupon_code.php" style="margin-top: -50px"> Add Coupon Code</a>

  <div class="row">
  <div class="col-12">
  <div class="table-responsive">
  <table id="order-listing" class="table">
  <thead>
  <tr>
  <th width="1%">S.No</th>
  <th width="12%">Coupon Code</th>

  <th width="12%">C_Type</th>
  <th width="13%">C_Value</th>
  <th width="19%">CartValue</th>
  <th width="14%">Expired On</th>

  <th width="9%">Added On</th>


  <th width="26%">Actions</th>
  </tr>
  </thead>
  <tbody>

  <?php  if (mysqli_num_rows($res)>0) {
  $i=1;
  while ($row=mysqli_fetch_assoc($res)) {


  ?>

  <tr>
  <td><?php  echo $i ?></td>

  <td><?php echo $row['coupon_code'] ?></td>
  <td><?php echo $row['coupon_type'] ?></td>
  <td><?php echo $row['coupon_value'] ?></td>
  <td><?php echo $row['cart_min_value'] ?></td>
  <td><?php echo $row['expired_on'] ?></td>
  <td>
  <?php 
  $dateStr=strtotime($row['added_on']);
  echo date('d-m-y',$dateStr)  
  ?>
  </td>


  <td>


  <a href="add_coupon_code.php?id=<?php echo $row['id']?>"><label class="badge badge-success hand_cursor">Edit</label></a>&nbsp;
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
    &nbsp;
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