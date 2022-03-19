<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/thuonghieu.php'; ?>

<?php
    $thuonghieu = new thuonghieu();//goi class trong file adminlogin
    //su dung phuong thuc gui tap tin, du lieu bang phuong thuc get hay post
  	 if(isset($_GET['idxoa'])){
         $id = $_GET['idxoa'];
         $xoathuonghieu = $thuonghieu->xoa_thuonghieu($id);
    }

 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách thương hiệu</h2>
                <div class="block"> 
                	<?php
                		if(isset($xoathuonghieu)){
                			echo $xoathuonghieu;
                		} 
                	 ?>

                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Tên thương hiệu</th>
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$hienthi_thuonghieu = $thuonghieu->hienthi_thuonghieu();
							if($hienthi_thuonghieu) {
								$i=0;
								while($result = $hienthi_thuonghieu->fetch_assoc()){
									$i++;
							
							
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['Ten_Thuonghieu'] ?></td>
							<td><a href="suathuonghieu.php?idthuonghieu=<?php echo $result['ID_Thuonghieu'] ?>">Sửa</a> || <a onclick="return confirm('Bạn chắc có muốn xóa nó chứ?')"href="?idxoa=<?php echo $result['ID_Thuonghieu']?>">Xóa</a></td>
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

