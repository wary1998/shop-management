<style>
.alert {
  padding: 20px;
  background-color: #00AB08;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}

div.slide-slow {
  width:100%;
  overflow:hidden;
}
div.slide-slow div.inner {
  animation: slide-slow 5s;
  margin-top:0%;
}

@keyframes slide-slow {
  from {
    margin-left: 80%;
  }

  to {
    margin-left: 0%;
  }
}
</style>

<?php 
    $obj_adminBack = new adminBack();
    $ctg_info = $obj_adminBack->display_category();
    if(isset($_GET['prostatus'])){
        $id = $_GET['id'];
        if($_GET['prostatus']=='edit'){
            $pdtInfo = $obj_adminBack->getEditProduct_info($id);
        }
    }
    if(isset($_POST['u_pdt_btn'])){
        $update_msg = $obj_adminBack->update_product($_POST);
    }

?>
<h2>Edit Product</h2><br>
<h5>Product Name:   <?php echo $pdtInfo['pdt_name'] ; ?> </h5>
<h5>Product ID Number:   <?php echo $pdtInfo['pdt_id'] ; ?> </h5>

<form class="form" action="" method="post" enctype="multipart/form-data">
<div class="form-group">
        <input hidden type="text" name="u_pdt_id" class="form-control" value="<?php echo $pdtInfo['pdt_id']; ?>">
    </div>
    <div class="form-group">
        <label for="u_pdt_name">Product Name</label>
        <input type="text" name="u_pdt_name" class="form-control" value="<?php echo $pdtInfo['pdt_name']; ?>">
    </div>
    <div class="form-group">
        <label for="u_pdt_price">Product Price</label>
        <input type="number" name="u_pdt_price" class="form-control" value="<?php echo $pdtInfo['pdt_price']; ?>">
    </div>
    <div class="form-group">
        <label for="u_pdt_des">Product Description</label>
        <input type="text" class="form-control" name="u_pdt_des" value="<?php echo $pdtInfo['pdt_des']; ?>">
    </div>
    <div class="form-group">
        <label for="u_pdt_ctg">Product Category</label>
        <select name="u_pdt_ctg" class="form-control">
            <option>Please Select a Category</option>
            <?php 
                while($ctg= mysqli_fetch_assoc($ctg_info)){
                
            ?>
            <option value="<?php echo $ctg['ctg_id']; ?>"><?php echo $ctg['ctg_name']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="u_pdt_image">Product Image</label>
        <input type="file" name="u_pdt_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="u_pdt_status">Product Status</label>
        <select name="u_pdt_status" class="form-control">
            <option value="1">Published</option>
            <option value="0">Unpublished</option>
        </select>
    </div>
    <input name="u_pdt_btn" type="submit" value="Update Product" class="btn btn-primary btn-block"><br>

    <?php if(isset($update_msg)){
    ?>
     <div class="slide-slow">
    <div class="inner">
        
    <div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
    <?php echo $update_msg; ?>
    </div>
    </div>
    </div>
    <?php  } ?>

</form>
  