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
    if(isset($_POST['ctg_btn'])){
        $return_message=$obj_adminBack->add_category($_POST);
    }

?>
<h1>Add Category</h1> <br>

<form action="" method="post">
    <div class="form-group">
        <label for="ctg_name">Category Name</label>
        <input type="text" name="ctg_name" class="form-control">
    </div>
    <div class="form-group">
        <label for="ctg_des">Category Description</label>
        <input type="text" name="ctg_des" class="form-control">
    </div>
    <div class="form-group">
        <label for="ctg_status">Category Status</label>
        <select name="ctg_status" class="form-control">
            <option value="1">Published</option>
            <option value="0">Unpublished</option>
        </select>
    </div>
    <input type="submit" value="Add Category" name="ctg_btn" class="btn btn-primary btn-block"><br>
    
    <?php if(isset($return_message)){
    ?>
    <div class="slide-slow">
    <div class="inner">

    <div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
    <?php echo $return_message; ?>
    </div>
    </div>
    </div>
    <?php  } ?>
    
</form>