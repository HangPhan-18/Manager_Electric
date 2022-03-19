<div class="grid_2">
    <div class="box sidemenu">
        <div class="block" id="section-menu">
            <ul class="section menu">
                <?php
                    $login_check=session::get('check_admin');
                    if($login_check==false){
                        echo '';
                    }else{
                        echo '<li><a class="menuitem">Quyền quản trị</a>
                              <ul class="submenu">
                                    <li><a href="them_quantri.php">Thêm người dùng quản trị</a></li> 
                                    <li><a href="hienthi_quantri.php">Danh sách quản trị viên</a></li> 
                            </ul>
                             </li>';
                    }
                ?>

                   <li><a class="menuitem">Danh mục sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="themdanhmuc.php">Thêm danh mục</a> </li>
                        <li><a href="hienthi_danhmuc.php">Danh mục sản phẩm</a> </li>
                    </ul>
                </li>
                 <li><a class="menuitem">Thương hiệu sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="themthuonghieu.php">Thêm thương hiệu</a> </li>
                        <li><a href="hienthi_thuonghieu.php">Danh sách thương hiệu</a> </li>
                    </ul>
                </li>
                 <li><a class="menuitem">Sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="themsanpham.php">Thêm sản phẩm</a> </li>
                        <li><a href="hienthi_sanpham.php">Danh sách sản phẩm</a> </li>
                    </ul>
                </li>
                <li><a class="menuitem">Slider</a>
                    <ul class="submenu">
                        <li><a href="them_slider.php">Thêm Slider</a> </li>
                        <li><a href="lietke_slider.php">Danh sách Slider</a> </li>
                    </ul>
                </li>
              <li><a class="menuitem">Bình luận</a>
                    <ul class="submenu">
                        <li><a href="ds_binhluan.php">Danh sách bình luận</a></li> 
                    </ul>
                </li>
				
                <!-- <li><a class="menuitem">Update Pages</a>
                    <ul class="submenu">
                        <li><a>About Us</a></li>
                        <li><a>Contact Us</a></li>
                    </ul>
                </li> -->
				
             
               
            </ul>
        </div>
    </div>
</div>