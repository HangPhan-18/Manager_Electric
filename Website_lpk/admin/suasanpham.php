<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/danhmuc.php'; ?>
<?php include '../classes/thuonghieu.php'; ?> 
<?php include '../classes/sanpham.php'; ?>
<?php
    $sanpham = new sanpham();
    if(!isset($_GET['idsanpham']) || $_GET['idsanpham']== NULL){
        echo "<script>window.location= 'hienthi_sanpham.php';</script>";
    }else{
         $id = $_GET['idsanpham'];
    }
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $suasanpham = $sanpham->sua_sanpham($_POST, $_FILES, $id);
    } 
 ?>
<style>
    .box.round.first.grid {
    width: 222%;
}
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block">   
        <?php
            if(isset($suasanpham)){
                echo $suasanpham;
            } 
         ?>  
         <?php 
            $get_idsanpham = $sanpham->Layid_sanpham($id);
            if($get_idsanpham){
                while($result_sanpham = $get_idsanpham->fetch_assoc()){
          ?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="tensanpham" value="<?php echo $result_sanpham['Ten_Sanpham']?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Thuộc loại danh mục</label>
                    </td>
                    <td>
                        <select id="select" name="danhmuc">
                            <option>---Chọn loại danh mục---</option>
                            <?php 
                                $danhmuc = new danhmuc();
                                $dsdanhmuc = $danhmuc->hienthi_danhmuc();
                                if($dsdanhmuc){
                                    while($result = $dsdanhmuc->fetch_assoc()){

                             ?>
                            <option
                              <?php
                                    if($result['ID_Danhmuc']==$result_sanpham['ID_Danhmuc']){   echo 'selected';} 
                                 ?>
                             value="<?php echo $result['ID_Danhmuc']?>"><?php echo $result['Ten_Danhmuc'] ?></option>
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
                           
                            <option
                                <?php
                                    if($result['ID_Thuonghieu']==$result_sanpham['ID_Thuonghieu']){   echo 'selected';} 
                                 ?>
                             value="<?php echo $result['ID_Thuonghieu']?>"><?php echo $result['Ten_Thuonghieu'] ?></option>
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
                        <textarea name= "mota_sanpham" class="tinymce"><?php echo $result_sanpham['Mota_Sanpham']?></textarea>
                    </td> 
                </tr>
				<tr>
                    <td>
                        <label>Giá sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name ="gia" value="<?php echo $result_sanpham['Gia_Sanpham']?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Hình ảnh</label>
                    </td>
                    <td><img src="upload/<?php echo $result_sanpham['Hinhanh_Sanpham'] ?>" width="100px"><br>
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
                            <?php
                            if($result_sanpham['Noibat_Sanpham']==1){ 
                             ?>
                            <option selected value="1">Nổi bật</option>
                            <option value="0">Không nổi bật</option>
                            <?php
                            }else{
                             ?>
                            <option value="1">Nổi bật</option>
                            <option selected value="0">Không nổi bật</option>
                            <?php
                            } 
                             ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Cập nhật" />
                    </td>
                </tr>
            </table>
            </form>
            <?php
        }
            } 
             ?>
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


