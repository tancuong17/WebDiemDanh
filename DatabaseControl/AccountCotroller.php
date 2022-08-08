<?php
    if(isset($_POST['parameter']) && $_POST['parameter'] == "login")
    {
        $idStudent = $_POST['idStudent'];
        $password = $_POST['password'];
        $query = "SELECT count(*), taikhoan.loaiTaiKhoan FROM taikhoan where
        taikhoan.tenTaiKhoan = '$idStudent' and taikhoan.matKhau = '$password'";
        $queryConnect=mysqli_query($connectDB, $query);
        $arrayResult = mysqli_fetch_array($queryConnect);
        if($arrayResult[0] == 1)
        {
            if($arrayResult[1] == "Sinh Viên")
            {
                $queryStudent = "Select sinhvien.hoTenSinhVien from sinhvien where maSinhVien = '$idStudent'";
                $queryConnectStudent = mysqli_query($connectDB, $queryStudent);
                $arrayResultStudent = mysqli_fetch_array($queryConnectStudent);
                $_SESSION['idStudent'] = $idStudent;
                $_SESSION['nameStudent'] = $arrayResultStudent[0];
            }
            else if($arrayResult[1] == "Giảng Viên")
            {
                $queryTeacher = "Select giangvien.tenGiangVien from giangvien where maGiangVien = '$idStudent'";
                $queryConnectTeacher = mysqli_query($connectDB, $queryTeacher);
                $arrayResultTeacher = mysqli_fetch_array($queryConnectTeacher);
                $_SESSION['idStudent'] = $idStudent;
                $_SESSION['nameStudent'] = $arrayResultTeacher[0];
            }
            $_SESSION['checkLogin'] = "true";
            $_SESSION['typeAccount'] = $arrayResult[1];
            unset($_SESSION['detailCourse']);
            unset($_SESSION['addCourse']);
        }
        else
        {
            $_SESSION['checkLogin'] = "false";
        }
    }
    else if(isset($_GET['parameter']) && $_GET['parameter'] == "logout")
    {
        unset($_SESSION['checkLogin']);
        unset($_SESSION['idStudent']);
        unset($_SESSION['typeAccount']);
        unset($_SESSION['nameStudent']);
        $_SESSION['detailCourse'] = "false";
        $_SESSION['addCourse'] = "false";
    }
?>