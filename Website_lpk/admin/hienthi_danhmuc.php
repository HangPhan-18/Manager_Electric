<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/danhmuc.php'; ?>

<?php
    $danhmuc = new danhmuc();//goi class trong file adminlogin
    //su dung phuong thuc gui tap tin, du lieu bang phuong thuc get hay post
  	 if(isset($_GET['idxoa'])){
         $id = $_GET['idxoa'];
         $xoadanhmuc = $danhmuc->xoa_danhmuc($id);
    }

 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách danh mục</h2>
                <div class="block"> 
                	<?php
                		if(isset($xoadanhmuc)){
                			echo $xoadanhmuc;
                		} 
                	 ?>

                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Tên danh mục</th>
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$hienthi_danhmuc = $danhmuc->hienthi_danhmuc();
							if($hienthi_danhmuc) {
								$i=0;
								while($result = $hienthi_danhmuc->fetch_assoc()){
									$i++;
							
							
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['Ten_Danhmuc'] ?></td>
							<td><a href="suadanhmuc.php?iddanhmuc=<?php echo $result['ID_Danhmuc'] ?>">Sửa</a> || <a onclick="return confirm('Bạn chắc có muốn xóa nó chứ?')"href="?idxoa=<?php echo $result['ID_Danhmuc']?>">Xóa</a></td>
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

