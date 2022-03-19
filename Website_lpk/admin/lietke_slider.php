<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/sanpham.php'; ?>
<?php
$sanpham = new sanpham();
if(isset($_GET['capnhat_slider'])&&isset($_GET['type'])){
	$id = $_GET['capnhat_slider'];
	$type = $_GET['type'];
	$capnhat_slider = $sanpham->capnhat_slider($id, $type);
} 

if(isset($_GET['xoa_slider'])){
	$id = $_GET['xoa_slider'];
	$xoa_slider = $sanpham->xoa_slider($id);
} 
 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
        	<?php
        	if(isset($xoa_slider)){
        		echo $xoa_slider;
        	} 
        	 ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Thứ tự</th>
					<th>Tên Slider</th>
					<th>Hình ảnh Slider</th>
					<th>Ẩn_hiện</th>
					<th>Quản lý</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sanpham = new sanpham();
					$slider = $sanpham->danhsach_slider();
					if($slider){
						$i= 0;
						while($result = $slider->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['Ten_Slider'] ?></td>
					<td><img src="upload/<?php echo $result['Hinhanh_Slider']?>" height="60px" width="120px" style="margin-top: 20px;"/></td>		
					<td>
						<?php
						if($result['An_Hien']==1){
						?>
						<a href="?capnhat_slider=<?php echo $result['ID_Slider']?>&type=1">Hiện</a> 
						<?php
						 }else{
						 ?>
						 <a href="?capnhat_slider=<?php echo $result['ID_Slider']?>&type=0">Ẩn</a> 
						 <?php
						} 

						 ?>
					</td>		
				<td>
					<a href="?xoa_slider=<?php echo $result['ID_Slider']?>" onclick="return confirm('Are you sure to Delete!');" >Xóa</a> 
				</td>
					</tr>	
					<?php
					}
				} 
					 ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
