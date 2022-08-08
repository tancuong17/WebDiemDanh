<body class="h-100" style="background-image: url('../StudentSystem/Images/bg1.jpg');">
    <div class="container h-100">
        <div class="row h-100 d-flex justify-content-center align-items-center">
            <div class="col-lg-4 m-2 border rounded-lg shadow p-3 bg-white">
                <form method="post" action="">
                    <input class="form-control" type="hidden" name="parameter" value="login">
                    <div class="row">
                        <div class="col-sm-8 pb-2">
                            <img class="img-fluid" src="../StudentSystem/Images/Logo_IUH.png" alt="Logo">
                        </div>
                        <div class="col-sm-12">
                            <input class="form-control mb-2 pt-4 pb-4" type="text" id="idStudent" name="idStudent" placeholder="Mã sinh viên...">
                            <p id="wrongIdStudent"></p>
                        </div>
                        <div class="col-sm-12">
                            <input class="form-control mb-2 pt-4 pb-4" type="password" id="password" name="password" placeholder="Mật khẩu...">
                            <p id="wrongPassword"></p>
                            <?php
                                if(isset($_SESSION['checkLogin']) && $_SESSION['checkLogin'] == "false")
                                    echo"<p>Tài khoản hoặc mật khẩu không chính xác!</p>"
                            ?>
                        </div>
                        <div class="col-sm-12">
                            <button class="btn btn-primary mb-2" id="login" type="submit">Đăng nhập</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
