<body>
    <header id="header">
        <img src="../StudentSystem/Images/Logo_IUH.png" alt="Logo" id="logo">
        <div id="iconContainer">
            <a href="http://localhost/StudentSystem/"><img src="../StudentSystem/Images/home.svg" alt="Icon"></a>
            <span></span>
            <img src="../StudentSystem/Images/user.svg" alt="Icon" id="userBtn">
            <span id="nameUser"><?php echo $_SESSION['nameStudent']?></span>
            <a href="?parameter=logout"><img src="../StudentSystem/Images/log-out.svg" alt="Icon"></a>
        </div>
    </header>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-sm-9 pt-5 pl-4 pr-4 pb-5">
                <div class="row border-left border-top border-right">
                    <div class="col-sm-12">
                        <h4 class="pt-3 pb-3">DANH SÁCH MÔN HỌC</h4>
                    </div>
                </div>
                <div class="row vh-100 overflow-auto border p-0">
                    <?php
                        include("DatabaseControl/CourseController.php");
                    ?>
                </div>
            </div>
            <div class="col-sm-3 pl-4 pr-4 pb-5 pt-xl-5">
                <div class="row border">
                    <div class="col-sm-12">
                        <h4 class="pt-3 pb-3">SỰ KIỆN TRONG NGÀY</h4>
                    </div>
                </div>
                <?php
                    date_default_timezone_set("Asia/Bangkok");
                    $query = "Select * from diemdanh where maSinhVien = '$idStudent'";
                    $queryConnect = mysqli_query($connectDB, $query);
                    while($arrayResult = mysqli_fetch_array($queryConnect))
                    {
                        $query1 = "UPDATE diemdanh
                                      SET trangThai = 'Không điểm danh'
                                      WHERE maSinhVien = '$idStudent' and trangThai='Chưa điểm danh' and now() > thoiGianDiemDanh";
                        $queryConnect1 = mysqli_query($connectDB, $query1);
                        $linkCourse = "?parameter=detailCourse&id=".$arrayResult['maMonHoc'];
                        $ngayDiemDanh = date_create($arrayResult['ngayDiemDanh']);
                        $thoiGianDiemDanh = date_create($arrayResult['thoiGianDiemDanh']);
                        $thoiGianDiemDanhformat = date_format($thoiGianDiemDanh,"H:i");
                        $ngayDiemDanhformat = date_format($ngayDiemDanh,"Y-m-d");
                        $thoiGianformat2 = date_format($ngayDiemDanh,"H:i");
                        $thoiGianformat = date_format($ngayDiemDanh,"d/m/Y");
                        $date = date("Y-m-d");
                        if($ngayDiemDanhformat == $date)
                            echo"<div class='row border-left border-bottom border-right p-1'>
                                    <div class='col-2'>
                                        <a href='$linkCourse'>
                                            <img src='../StudentSystem/Images/calendar.svg' class='img-fluid' alt=''>
                                        </a>
                                    </div>
                                    <div class='col-10 p-0'>
                                        <a href='$linkCourse' class='text-decoration-none text-dark'>Điểm danh lý thuyết($thoiGianformat $thoiGianformat2-$thoiGianDiemDanhformat)</a>
                                    </div>
                                </div>";
                    }
                ?>
            </div>
        </div>
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
                            <p>Mã số sinh viên: <?php echo $_SESSION['idStudent']?></p>
                            <form method="POST" action="">
                                <div class="row">
                                    <div class="col-sm-7 pt-1 pb-1">
                                        <input class="form-control" type="text" name="mkMoi" name="parameter" placeholder="Mật khẩu mới...">
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