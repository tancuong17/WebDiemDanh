<body>
    <header id="header">
        <img src="../StudentSystem/Images/Logo_IUH.png" alt="Logo" id="logo">
        <div id="iconContainer">
            <a href="http://localhost/StudentSystem/"><img src="../StudentSystem/Images/home.svg" alt="Icon"></a>
            <?php
                if($_SESSION['typeAccount'] == "Giảng Viên")
                    echo"<a href='?parameter=addCourse'><img src='../StudentSystem/Images/plus-circle.svg' alt='Icon' id='addBtn'></a>";
            ?>
            <span></span>
            <img src="../StudentSystem/Images/user.svg" alt="Icon" id="userBtn">
            <span id="nameUser"><?php echo $_SESSION['nameStudent']?></span>
            <a href="?parameter=logout"><img src="../StudentSystem/Images/log-out.svg" alt="Icon"></a>
        </div>
    </header>
    <div class="container-fluid mt-5 pt-5 h-auto">
        <div class="row m-1 pt-3 pb-3">
            <div class="col-sm-4 bg-info"></div>
            <div class="col-sm-4">
                <h4 class="text-center">PHÁT TRIỂN ỨNG DỤNG<br>DHTH15K</h4>
            </div>
            <div class="col-sm-4 bg-info"></div>
        </div>
        <div class="row border ml-1 mr-1 pt-3 pb-3">
            <div class="col-12">
                <h4>MỞ ĐIỂM DANH</h4>
            </div>
        </div>
        <form method="POST" action="">
            <div class="row ml-1 mr-1 pt-3 pb-3 border-bottom border-left border-right rounded">
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-6">
                            <p>Thời gian bắt đầu:</p>
                        </div>
                        <div class="col-6">
                            <input class="form-control" type="datetime-local" id="gioBD" name="thoiGianBatDau">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-6">
                            <p>Thời gian kết thúc:</p>
                        </div>
                        <div class="col-6">
                            <input class="form-control" type="datetime-local" id="gioKT" name="thoiGianKetThuc">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-7">
                            <input class="form-control" type="text" id="maDiemDanh" name="maDiemDanh" placeholder="Mã điểm danh...">
                        </div>
                        <div class="col-5">
                            <button class="btn btn-primary" type="submit" name="btnMoDienDanh" id="btnDD">Mở điểm danh</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row border ml-1 mr-1 mt-3 pt-3 pb-3">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <h4>THỐNG KÊ</h4>
                    </div>
                </div>
                <div class="row vh-100 overflow-auto">
		        <div class="col-12">
                <?php
                    $count = 1;
                    $linkDau = "";
                    $maMonHoc = $_GET['id'];
                    $query3 = "SELECT DISTINCT sinhvien.hoTenSinhVien, sinhvien.maSinhVien, phatbieu.soLanPhatBieu
                    FROM monhoc_sinhvien
                    INNER JOIN sinhvien ON monhoc_sinhvien.maSinhVien = sinhvien.maSinhVien
                    INNER JOIN phatbieu ON monhoc_sinhvien.maSinhVien = phatbieu.maSinhVien
                    where monhoc_sinhvien.maMonHoc = '$maMonHoc' and phatbieu.maMonHoc = '$maMonHoc'";
                    $queryConnect3 = mysqli_query($connectDB, $query3);
                    while($arrayResult3 = mysqli_fetch_array($queryConnect3))
                    {
                        $check = 0;
                        $query4 = "SELECT count(maDiemDanh) FROM diemdanh where maSinhVien = '$arrayResult3[1]' and maMonHoc = '$maMonHoc' and trangThai ='Đã điểm danh'";
                        $queryConnect4 = mysqli_query($connectDB, $query4);
                        $arrayResult4 = mysqli_fetch_array($queryConnect4);
                        $query5 = "SELECT count(*) FROM loptruong where maSinhVien = '$arrayResult3[1]' and maMonHoc = '$maMonHoc'";
                        $queryConnect5 = mysqli_query($connectDB, $query5);
                        $arrayResult5 = mysqli_fetch_array($queryConnect5);
                        $bg = "";
                        if($arrayResult5[0] == 1)
                            $bg = "bg-danger text-white";
                        else
                            $bg = "bg-white";
                        echo"<div class='row'>
                                <div class='col-12'>
                                    <div class='row m-1 pt-2 pb-2 border $bg rounded'>
                                        <div class='col-sm-3'>
                                            <p>Họ và tên: $arrayResult3[0]</p>
                                        </div>
                                        <div class='col-sm-2'>
                                            <p>Mã số: $arrayResult3[1]</p>
                                        </div>
                                        <div class='col-sm-2'>
                                            <p>Số điểm danh: $arrayResult4[0]</p>
                                        </div>
                                        <div class='col-sm-2'>
                                            <p>Số phát biểu: $arrayResult3[2]</p>
                                        </div>
                                        <div class='col-sm-3'>
                                            <div class='row'>
                                                <div class='col-8'>
                                                    <select class='form-control' id='sel$count'>";
                                                    $query5 = "SELECT tenNgoaiKhoa, duongDanBaiTap FROM baitapngoaikhoa where maSinhVien = '$arrayResult3[1]' and maMonHoc = '$maMonHoc' and trangThaiBaiTap = 'Đã nộp'";
                                                    $queryConnect5 = mysqli_query($connectDB, $query5);
                                                    while($arrayResult5 = mysqli_fetch_array($queryConnect5))
                                                    {
                                                        if($check == 0)
                                                        {
                                                            $linkDau = $arrayResult5[1];
                                                            $check = 1;
                                                        }
                                                        echo"<option value='$arrayResult5[1]'>$arrayResult5[0]</option>";
                                                    }
                                                    echo"
                                                    </select>
                                                </div>
                                                <div class='col-4'>
                                                    <form method='post' action=''>
                                                        <input class='form-control' type='hidden' name='filename' id='$count' value='http://localhost/StudentSystem/Images/a.pdf'>
                                                        <button class='btn btn-primary' type='submit' name='submit'>Tải về</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                            $count = $count + 1;
                            $linkDau = "";
                    }
                ?>
                </div>
                </div>
            </div>
        </div>
        <div class="row border ml-1 mr-1 mt-3 pt-3 pb-3">
            <div class="col-12">
                <h4>CẤP QUYỀN LỚP TRƯỞNG</h4>
            </div>
        </div>
        <form method="POST" action="">
            <div class="row ml-1 mr-1 pt-3 pb-3 border-bottom border-left border-right">
                <div class="col-sm-10 mb-1 mt-1">
                    <div class="row">
                        <div class="col-sm-3">
                            <p>Mã số sinh viên: </p>
                        </div>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="maSinhVienCQ">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 mb-1 mt-1">
                <button class="btn btn-block btn-primary" type="submit" name="btnCQ">Cấp quyền</button>
                </div>
            </div>
        </form>
        <div class="row border ml-1 mr-1 mt-3 pt-3 pb-3">
            <div class="col-12">
                <h4>THÊM BÀI TẬP NGOẠI KHÓA</h4>
            </div>
        </div>
        <form method="POST" action="">
            <div class="row ml-1 mr-1 pt-3 pb-3 border-bottom border-left border-right">
                <div class="col-sm-10 mb-1 mt-1">
                    <div class="row">
                        <div class="col-sm-3">
                            <p>Tên bài tập ngoại khóa: </p>
                        </div>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="tenBT">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 mb-1 mt-1">
                <button class="btn btn-block btn-primary" type="submit" name="addBT">Thêm</button>
                </div>
            </div>
        </form>
    </div>
    <section class="footer">
        <h5>&copy2022 - All Rights Reserved by Nhom7</h5>
    </section>
    <div id="my-modal-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Thông tin sinh viên</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <img class="img-fluid mx-auto d-block rounded-circle" src="../StudentSystem/Images/user3.jpg" alt="User">
                        </div>
                        <div class="col-9">
                            <h5>Họ và tên: <?php echo $_SESSION['nameStudent']?></h5>
                            <p>Mã số giảng viên: <?php echo $_SESSION['idStudent']?></p>
                            <form method="POST" action="">
                                <div class="row">
                                    <div class="col-sm-7 pt-1 pb-1">
                                        <input class="form-control" type="text" name="mkMoi" placeholder="Mật khẩu mới...">
                                    </div>
                                    <div class="col-sm-5 pt-1 pb-1">
                                        <button class="btn btn-primary" type="submit" name="doiMK">Đổi mật khẩu</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="get" action="">
                        <input class="form-control" type="hidden" name="parameter" value="logout">
                        <button class="btn btn-danger">Đăng xuất</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>