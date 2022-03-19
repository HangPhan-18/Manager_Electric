<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/user.php'; ?>
<?php
    $quantri = new user();//goi class trong file adminlogin
    //su dung phuong thuc gui tap tin, du lieu bang phuong thuc get hay post
    // trả về phương thức nào truy vấn đến Server như POST, GET, HEAD, PUT
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $them_user = $quantri->them_user($_POST) ;
    }  
 ?>
<style>
    .box.round.first.grid {
    width: 222%;
}
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm người dùng quản trị mới</h2>
    <div class="block">  
    <?php
    if(isset($them_user)){
        echo $them_user;
    } 
     ?>             
         <form action="" method="post">
            <table class="form">     
                <tr>
                    <td>
                        <label>Họ và tên</label>
                    </td>
                    <td>
                        <input type="text" name="adminname" placeholder="Nhập vào họ và tên..." class="medium" />
                    </td>
                </tr>   
                <tr>
                    <td>
                        <label>Tên người dùng</label>
                    </td>
                    <td>
                        <input type="text" name="adminuser" placeholder="Tên người dùng đăng nhập vào hệ thống...">
                    </td>
                </tr>        
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" name ="adminemail" placeholder="Nhập vào họ tên...">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Password</label>
                    </td>
                    <td>
                        <input type="text" name="password" placeholder="Nhập vào password...">
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Level</label>
                    </td>
                    <td>
                       <select name ="level">
                           <option selected="0">0</option>
                           <option>1</option>
                       </select>
                    </td>
                </tr>   	
                <tr>
                    <td>
                        <input type="submit" name="submit" Value="Lưu" />
                    </td>
                </tr>
                 		
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>