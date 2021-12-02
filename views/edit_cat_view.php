<style>
.alert {
  padding: 20px;
  background-color: #00AB08;
  color: white;
  width:100%;
  overflow:hidden;
  animation: slide-left 10s;
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
if(isset($_GET['status'])){
    $get_id = $_GET['id'];
    if($_GET['status']=='edit'){
        $return_data = $obj_adminBack->getCatinfo_toupdate($get_id);
    }
}
if(isset($_POST['u_ctg_btn'])){
    $return_msg = $obj_adminBack->update_category($_POST);
}
?>

<h2>Edit Category</h2><br>

<h5>Category Name:   <?php echo $return_data['ctg_name'] ; ?> </h5>
<h5>Category ID Number:   <?php echo $return_data['ctg_id'] ; ?> </h5>

<form action="" method="post">
<div class="form-group">
        <input hidden type="text" name="u_ctg_id" class="form-control" value="<?php echo $return_data['ctg_id']; ?>">
    </div>
<div class="form-group">
        <label for="u_ctg_name">Category Name</label>
        <input type="text" name="u_ctg_name" class="form-control" value="<?php echo $return_data['ctg_name']; ?>">
  </div>
    <div class="form-group">
        <label for="u_ctg_des">Category Description</label>
        <input type="text" name="u_ctg_des" class="form-control" value="<?php echo $return_data['ctg_des']; ?>">
    </div>
    <input type="submit" value="Update Category" name="u_ctg_btn" class="btn btn-primary btn-block" action="manage-cat.php"><br>

    <?php if(isset($return_msg)){
    ?>

    <div class="slide-slow">
    <div class="inner">

    <div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
    <?php echo $return_msg; ?>

    </div>
    </div>
    </div>
    <?php  } ?>

    
</form>