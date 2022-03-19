<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/danhmuc.php'; ?>
<?php include '../classes/thuonghieu.php'; ?> 
<?php include '../classes/sanpham.php'; ?>
<?php
    $sanpham = new sanpham();
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $themsanpham = $sanpham->them_sanpham($_POST, $_FILES);
    } 
 ?>
<style>
    .box.round.first.grid {
    width: 222%;
}
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <div class="block">   
        <?php
            if(isset($themsanpham)){
                echo $themsanpham;
            } 
         ?>            
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="tensanpham" placeholder="Nhập vào tên sản phẩm..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Loại danh mục</label>
                    </td>
                    <td>
                        <select id="select" name="danhmuc">
                            <option>---Chọn danh mục---</option>
                            <?php 
                                $danhmuc = new danhmuc();
                                $dsdanhmuc = $danhmuc->hienthi_danhmuc();
                                if($dsdanhmuc){
                                    while($result = $dsdanhmuc->fetch_assoc()){

                             ?>
                            <option value="<?php echo $result['ID_Danhmuc']?>"><?php echo $result['Ten_Danhmuc'] ?></option>
                            <?php
                                }
                            } 
                             ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Thương hiệu</label>
                    </td>
                    <td>
                        <select id="select" name="thuonghieu">
                            <option>---Chọn thương hiệu---</option>
                            <?php
                                $thuonghieu = new thuonghieu();
                                $dsthuonghieu = $thuonghieu->hienthi_thuonghieu();
                                if($dsthuonghieu){
                                    while($result = $dsthuonghieu->fetch_assoc()) {
                             ?>
                            
                            <option value="<?php echo $result['ID_Thuonghieu']?>"><?php echo $result['Ten_Thuonghieu'] ?></option>
                            <?php
                                }
                            } 
                             ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả</label>
                    </td>
                    <td>
                        <textarea name = "mota_sanpham" class="tinymce"></textarea>
                    </td> 
                </tr>
				<tr>
                    <td>
                        <label>Giá sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name ="gia" placeholder="Nhập vào giá sản phẩm..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Hình ảnh</label>
                    </td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Sản phẩm nổi bật</label>
                    </td>
                    <td>
                        <select id="select" name="noibat">
                            <option>Tùy chọn</option>
                            <option value="1">Nổi bật</option>
                            <option value="0">Không nổi bật</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
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


