<body>
    <header id="header">
        <img src="../StudentSystem/Images/Logo_IUH.png" alt="Logo" id="logo">
        <div id="iconContainer">
            <a href="http://localhost/StudentSystem/"><img src="../StudentSystem/Images/home.svg" alt="Icon"></a>
            <a href="?parameter=addCourse"><img src="../StudentSystem/Images/plus-circle.svg" alt="Icon" id="addBtn"></a>
            <span></span>
            <img src="../StudentSystem/Images/user.svg" alt="Icon" id="userBtn">
            <span id="nameUser"><?php echo $_SESSION['nameStudent']?></span>
            <a href="?parameter=logout"><img src="../StudentSystem/Images/log-out.svg" alt="Icon" id="logOutBtn"></a>
        </div>
    </header>
    <div class="container-fluid mt-5 pt-5 mb-5 pb-5">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row border ml-1 mr-1 mt-3 pt-3 pb-3">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>THÊM HỌC PHẦN</h4>
                            <p>*File Excel phải chứa 3 cột theo thứ tự Mã sinh viên, Họ và tên, Địa chỉ Email(Mã sinh viên phải là số và có độ dài là 8)</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>Nhập tên học phần:</p>
                        </div>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="nameCourse">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>Nhập tên lớp học phần:</p>
                        </div>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="nameClass">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>Ngày bắt đầu:</p>
                        </div>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" name="startDay">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>Ngày kết thúc:</p>
                        </div>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" name="endDay">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>Danh sách sinh viên:</p>
                        </div>
                        <div class="col-sm-10">
                            <input class="form-control pb-5" type="file" name="file" id="filename">
                            <p id="wrongFile"></p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-12">
                            <button class="btn btn-block btn-lg btn-primary" type="submit" name="ok" id="themMH">Hoàn thành</button>
                        </div>
                    </div>
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