   <?php
  include 'top.php';
  $msg = "";
  $category="";
  $order_number="";
  $id="";

  if (isset($_GET['id']) && $_GET['id']>0) {
  # code...
  $id=get_safe_value($_GET['id']);
   $row= mysqli_fetch_assoc(mysqli_query($con, "select * from category where id='$id'"));
   //pr($row);

     $category = $row['category'];
     $order_number = $row['order_number'];
}

  if (isset($_POST['submit'])) {
  

   $category = get_safe_value( $_POST['category']);
   $order_number = get_safe_value($_POST['order_number']);

   $added_on=date('Y-m-d h:i:s');


   if ($id=='') {

    $sql="select * from category where category='$category'";
     
   }else{

    $sql="select * from category where category='$category' and id !='$id'";
   }

   

   if (mysqli_num_rows(mysqli_query($con, $sql))>0) {
      $msg = "category already added";
   }else{



      if ($id=='') {
         mysqli_query($con, "insert into category(category,order_number,status,added_on) values('$category','$order_number',1,'$added_on')");


      }else{

         mysqli_query($con, "update category set category ='$category',order_number='$order_number' where id='$id'");
      }



   

    redirect('category.php');
  }
  }


   ?>
  
<div class="row">
			<h1 class="card-title ml10">Add Category</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Category</label>
                      <input type="text" class="form-control"  placeholder="category" name="category" required value="<?php echo $category?>">
                      <h3 style="color: green;"><?php echo $msg?></h3>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Order number</label>
                      <input type="text" class="form-control"  placeholder="order number" name="order_number" required value="<?php echo $order_number?>">
                    </div>
                   
                   
                   
                    
                    <button type="submit" class="badge badge-info " name="submit">Add Category</button>
                    
                  </form>
                </div>
              </div>
            </div>
            
		 </div>


     <?php include 'footer.php';?>