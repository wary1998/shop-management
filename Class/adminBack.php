<?php

class adminBack{
    private $conn;

    public function __construct()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "khan";

        $this->conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

        if(!$this->conn){
            die("Database Connection Error!");
        }
    }

    function admin_login($data){
        $admin_email = $data['admin_email'];
        $admin_pass = md5($data['admin_pass']);

        $query= "SELECT * FROM adminlog WHERE admin_email='$admin_email' AND admin_pass='$admin_pass'";

        if(mysqli_query($this->conn,$query)){
            $result = mysqli_query($this->conn,$query);
            $admin_info = mysqli_fetch_assoc($result);

            if($admin_info){
                header('location:dashboard.php');
                session_start();
                $_SESSION['id'] = $admin_info['id'];
                $_SESSION['adminEmail'] = $admin_info['admin_email'];
                $_SESSION['adminPass'] = $admin_info['admin_pass'];
            }else{
                $errmsg = "Your username or Password is incorrect!";
                return $errmsg;
            }
        }
        
    }

    function adminLogout(){ 
        unset($_SESSION['id']);
        unset($_SESSION['adminEmail']);
        unset($_SESSION['adminPass']);
        header('location:index.php');
    }

    function add_category($data){
        $ctg_name = $data['ctg_name'];
        $ctg_des = $data['ctg_des'];
        $ctg_status = $data['ctg_status'];

        $query = "INSERT INTO category(ctg_name,ctg_des,ctg_status) VALUE('$ctg_name','$ctg_des',$ctg_status)";

        if(mysqli_query($this->conn, $query)){
            $message = "Category Added Successfully.";
            return $message;
        }else{
            $message = "Category Not Added";
            return $message;
        }
    }

    function display_category(){
        $query = "SELECT * FROM category";
        if(mysqli_query($this->conn, $query)){
            $return_ctg = mysqli_query($this->conn, $query);
            return $return_ctg;
        }
    }
    function p_display_category(){
        $query = "SELECT * FROM category WHERE ctg_status=1";
        if(mysqli_query($this->conn, $query)){
            $return_ctg = mysqli_query($this->conn, $query);
            return $return_ctg;
        }
    }

    function publish_category($id){
        $query = "UPDATE category SET ctg_status=1 WHERE ctg_id=$id";
        mysqli_query($this->conn, $query);
    }
    function unpublish_category($id){
        $query = "UPDATE category SET ctg_status=0 WHERE ctg_id=$id";
        mysqli_query($this->conn, $query);        
    }
    function delete_category($id){
        $query = "DELETE FROM category WHERE ctg_id=$id";
        if(mysqli_query($this->conn, $query)){
            $msg = "Category Deleted Successfully";
            return $msg;
        }
    }

    function getCatinfo_toupdate($id){
        $query = "SELECT * FROM category WHERE ctg_id=$id";
        if(mysqli_query($this->conn, $query)){
            $cat_info = mysqli_query($this->conn, $query);
            $ct_info = mysqli_fetch_assoc($cat_info);
            return $ct_info;
        }
    }
    function update_category($receive_data){
        $ctg_name = $receive_data['u_ctg_name'];
        $ctg_des = $receive_data['u_ctg_des'];
        $ctg_id = $receive_data['u_ctg_id'];

        $query = "UPDATE category SET ctg_name='$ctg_name',ctg_des='$ctg_des' WHERE ctg_id=$ctg_id";
        if(mysqli_query($this->conn, $query)){
            $msg = "Category Updated Successfully";
            return $msg;
        }
       
    }

    function add_product($data){
        $pdt_name = $data['pdt_name'];
        $pdt_price = $data['pdt_price'];
        $pdt_des = $data['pdt_des'];
        $pdt_ctg = $data['pdt_ctg'];
        $pdt_img_name = $_FILES['pdt_image']['name'];
        $pdt_img_size = $_FILES['pdt_image']['size'];
        $pdt_tmp_name = $_FILES['pdt_image']['tmp_name'];
        $pdt_ext = pathinfo($pdt_img_name, PATHINFO_EXTENSION);
        $pdt_status = $data['pdt_status'];

        if($pdt_ext == 'jpg' or  $pdt_ext == 'png' or $pdt_ext == 'jpeg'){
            if($pdt_img_size <= 2097152){
                $query= "INSERT INTO products(pdt_name,pdt_price,pdt_des,pdt_ctg,pdt_img,pdt_status) VALUE('$pdt_name','$pdt_price',' $pdt_des','$pdt_ctg','$pdt_img_name',$pdt_status)";
                if(mysqli_query($this->conn, $query)){
                    move_uploaded_file($pdt_tmp_name,'upload/'.$pdt_img_name);
                    $msg = "Product added successfully.";
                    return $msg;
                }
            }else{
                $msg = "Your file size should be less or equal 2 MB.";
            }
        }else{
            $msg = "Your file must be a JPG or PNG file.";
        }
    }

    function display_product(){
        $query = "SELECT * FROM product_info_ctg";
        if(mysqli_query($this->conn, $query)){
            $product = mysqli_query($this->conn, $query);
            return $product;
        }
    }

    function delete_product($id){
        $query = "DELETE FROM products WHERE pdt_id=$id";
        if(mysqli_query($this->conn, $query)){
            $msg = "Product Deleted Successfully";
            return $msg;
        }
    }

    function getEditProduct_info($id){
        $query = "SELECT * FROM product_info_ctg WHERE pdt_id=$id";
        if(mysqli_query($this->conn, $query)){
            $product_info = mysqli_query($this->conn, $query);
            $pdt_data = mysqli_fetch_assoc($product_info);
            return $pdt_data;
        }
    }

    function update_product($data){
        $pdt_id = $data['u_pdt_id'];
        $pdt_name = $data['u_pdt_name'];
        $pdt_price = $data['u_pdt_price'];
        $pdt_des = $data['u_pdt_des'];
        $pdt_ctg = $data['u_pdt_ctg'];
        $pdt_img_name = $_FILES['u_pdt_image']['name'];
        $pdt_img_size = $_FILES['u_pdt_image']['size'];
        $pdt_tmp_name = $_FILES['u_pdt_image']['tmp_name'];
        $pdt_ext = pathinfo($pdt_img_name, PATHINFO_EXTENSION);

        $pdt_status = $data['u_pdt_status'];

        if($pdt_ext == 'jpg' or $pdt_ext== 'png' or $pdt_ext== 'jpeg'){
            if($pdt_img_size <= 2097152){
                $query= "UPDATE products SET pdt_name='$pdt_name',pdt_price=$pdt_price,pdt_des='$pdt_des',pdt_ctg=$pdt_ctg,pdt_img='$pdt_img_name',pdt_status=$pdt_status WHERE pdt_id=$pdt_id";

                if(mysqli_query($this->conn, $query)){
                    move_uploaded_file($pdt_tmp_name,'upload/'.$pdt_img_name);
                    $msg = "Product Updated Successfully!";
                    return $msg;
                }
            }else{
                $msg = "Your File Size Should Be Less or Equal 2 MB!";
            }
        }else{
            $msg = "Your File Must Be a JPG or PNG File!";
            return $msg;
        }

    }

    function product_by_ctg($id){
        $query = "SELECT * FROM product_info_ctg WHERE ctg_id=$id";
        if(mysqli_query($this->conn, $query)){
           $proinfo = mysqli_query($this->conn, $query);
           return $proinfo;
        }
    }

    function product_by_id($id){
        $query = "SELECT * FROM product_info_ctg WHERE pdt_id=$id";
        if(mysqli_query($this->conn, $query)){
           $proinfo = mysqli_query($this->conn, $query);
           return $proinfo;
        }
    }

    function related_product($id){
        $query = "SELECT * FROM product_info_ctg WHERE ctg_id=$id";
        if(mysqli_query($this->conn, $query)){
           $proinfo = mysqli_query($this->conn, $query);
           return $proinfo;
        }
    }


}
?>
