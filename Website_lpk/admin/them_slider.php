<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/sanpham.php'; ?>
<?php
    $sanpham = new sanpham();//goi class trong file adminlogin
    //su dung phuong thuc gui tap tin, du lieu bang phuong thuc get hay post
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $them_slider = $sanpham->them_slider($_POST, $_FILES) ;
    }  
 ?>



<style>
    .box.round.first.grid {
    width: 222%;
}
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Slider mới</h2>
    <div class="block">  
    <?php
    if(isset($them_slider)){
        echo $them_slider;
    } 
     ?>             
         <form action="them_slider.php" method="post" enctype="multipart/form-data">
            <table class="form">     
                <tr>
                    <td>
                        <label>Tiêu đề </label>
                    </td>
                    <td>
                        <input type="text" name="tenslider" placeholder="Tiêu đề của Slider..." class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Tải hình ảnh</label>
                    </td>
                    <td>
                        <input type="file" name="image"/>
                    </td>
                </tr>
                <tr>
                     <td>
                        <label>Ẩn/Hiện</label>
                    </td>
                    <td>
                        <select name="type">
                            <option value="1">Hiện</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </td>
                </tr>
               
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
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