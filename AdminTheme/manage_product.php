<?php
require_once 'top.php';
$catagories_id='';
$name='';
$mrp='';
$price='';
$qty='';
$image='';
$short_desc='';
$description='';
$meta_title='';
$meta_desc='';
$meta_keyword='';


$msg='';
$image_required='required';

if(isset($_GET['id']) && $_GET['id']!=null){
   $image_required='';
   $id = get_safe_value($con,$_GET['id']);
   $res =mysqli_query($con,"SELECT * FROM product WHERE id= '$id'");
   $check=mysqli_num_rows($res);
   if($check>0){
    
      $row=mysqli_fetch_assoc($res);
      $catagories_id=$row['catagories_id']; 

      $name=$row['name']; 
      $mrp=$row['mrp']; 
      $price=$row['price']; 
      $qty=$row['qty']; 
      $image=$row['image']; 
      $short_desc=$row['short_desc']; 
      $description=$row['description']; 
      $meta_title=$row['meta_title']; 
      $meta_desc=$row['meta_desc']; 
      $meta_keyword=$row['meta_keyword']; 
     
   }
    else{
      header('location:product.php');
         die();
   } 
}


if(isset($_POST['submit'])){
    $catagories_id=get_safe_value($con,$_POST['catagories_id']);
    $name=get_safe_value($con,$_POST['name']);
    $mrp=get_safe_value($con,$_POST['mrp']);
    $price=get_safe_value($con,$_POST['price']);
    $qty=get_safe_value($con,$_POST['qty']);
    // $image=get_safe_value($con,$_POST['image']);
    $short_desc=get_safe_value($con,$_POST['short_desc']);
    $description=get_safe_value($con,$_POST['description']);
    $meta_title=get_safe_value($con,$_POST['meta_title']);
    $meta_desc=get_safe_value($con,$_POST['meta_desc']);
    $meta_keyword=get_safe_value($con,$_POST['meta_keyword']);
   


   $res =mysqli_query($con,"SELECT * FROM product WHERE name= '$name'");
   $check=mysqli_num_rows($res); 
   if($check>0){
       if(isset($_GET['id']) && $_GET['id']!=null){
         $getData = mysqli_fetch_assoc($res);
            if($id==$getData['id']){

            } else{
               $msg='product already exist';
             }
       }
       else{
            $msg='Product already exist';
       }

   }


   // if($_FILES['image']['type']!=''  && ($_FILES['image']['type']!='image/png' || $_FILES['image']['type']!='image/jpeg' || $_FILES['image']['type']!='image/jpg')){
   //  $msg="Only png,jpg,jpeg format allowed";
   // }

   if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=null){
            if($_FILES['image']['name']!=''){
                  $image = rand(111111111,999999999).'_'.$_FILES['image']['name'];
                  move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH.$image);
                  $update_sql= "UPDATE product SET catagories_id = '$catagories_id',name = '$name',mrp = '$mrp',price = '$price',qty = '$qty',image = '$image',short_desc = '$short_desc',description = '$description',meta_title = '$meta_title',meta_desc = '$meta_desc',meta_keyword = '$meta_keyword',image = '$image' WHERE id='$id'";
     
            }
            else{
            $update_sql= "UPDATE product SET catagories_id = '$catagories_id',name = '$name',mrp = '$mrp',price = '$price',qty = '$qty',image = '$image',short_desc = '$short_desc',description = '$description',meta_title = '$meta_title',meta_desc = '$meta_desc',meta_keyword = '$meta_keyword' WHERE id='$id'";
            }
        mysqli_query($con,$update_sql);
        header('location:product.php');
         }
         else{

              $image = rand(111111111,999999999).'_'.$_FILES['image']['name'];
              move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH.$image);
              mysqli_query($con,"INSERT INTO product(catagories_id,name,mrp,price,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,image) VALUES ('$catagories_id','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword','1','$image')");
         }
         header('location:product.php');
         die();
   }
}
?>

   <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-body card-block">

                          <div class="form-group">
                            <label for="company" class=" form-control-label">Categories</label>
                             <select class="form-control" name="catagories_id">
                                <option>Select Categories</option>
                                <?php
                                  $res=mysqli_query($con,"SELECT id,catagories FROM catagories ORDER BY catagories ASC");
                                  while($row=mysqli_fetch_assoc($res)){
                                    if($row['id']==$catagories_id){
                                    echo "<option selected value=".$row['id'].">".$row['catagories']."</option>";
                                    }
                                    else{
                                    echo "<option value=".$row['id'].">".$row['catagories']."</option>";
                                    }
                                       
                                  }
                                
                                ?>
                             </select>
                          </div>

                           <div class="form-group">
                            <label for="company" class=" form-control-label"> Product Name</label>
                              <input type="text" name="name" id="company" placeholder="Enter Product name" class="form-control" required value="<?php echo $name ?>">
                          </div>

                            <div class="form-group">
                            <label for="company" class=" form-control-label"> MRP</label>
                              <input type="text" name="mrp" id="company" placeholder="Enter Product MRP" class="form-control" required value="<?php echo $mrp ?>">
                          </div>

                            <div class="form-group">
                            <label for="company" class=" form-control-label"> Price</label>
                              <input type="text" name="price" id="company" placeholder="Enter Product Price" class="form-control" required value="<?php echo $price ?>">
                          </div>

                            <div class="form-group">
                            <label for="company" class=" form-control-label"> Qty</label>
                              <input type="text" name="qty" id="company" placeholder="Enter Qty" class="form-control" required value="<?php echo $qty ?>">
                          </div>

                            <div class="form-group">
                            <label for="company" class=" form-control-label"> Image</label>
                              <input type="file" name="image"  class="form-control" <?php echo $image_required ?>>
                          </div>

                            <div class="form-group">
                            <label for="company" class=" form-control-label"> Short Description</label>
                              <textarea name="short_desc" id="company" placeholder="Enter Product Short Description" class="form-control" ><?php echo $short_desc?></textarea>
                          </div>

                          <div class="form-group">
                            <label for="company" class=" form-control-label"> Description</label>
                              <textarea name="description" id="company" placeholder="Enter Product Description" class="form-control" ><?php echo $description?></textarea>
                          </div>

                          <div class="form-group">
                            <label for="company" class=" form-control-label"> Meta Title</label>
                              <textarea name="meta_title" id="company" placeholder="Enter Product Meta Title" class="form-control"><?php echo $meta_title?></textarea>
                          </div>

                          <div class="form-group">
                            <label for="company" class=" form-control-label"> Meta Description</label>
                              <textarea name="meta_desc" id="company" placeholder="Enter Product Meta Description" class="form-control"><?php echo $meta_desc?></textarea>
                          </div>

                          <div class="form-group">
                            <label for="company" class=" form-control-label"> Meta Keyword</label>
                              <textarea name="meta_keyword" id="company" placeholder="Enter Product Meta Keyword" class="form-control" ><?php echo $meta_keyword?></textarea>
                          </div>

                           <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount">Submit</span>
                           </button>
               <div class="field_error"><?php echo $msg; ?></div>

                        </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>


<?php
require('footer.php');
?>


