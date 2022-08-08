<?php
	session_start();
    include("DatabaseControl/ConnectDatabase.php");
    include("DatabaseControl/AccountCotroller.php");
    require("Classes/PHPExcel.php");
    if (isset($_POST["submit"])) {
        $file_url = $_POST["filename"];
        $file_name = basename($file_url);
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        readfile($file_url);
    }
?> 
<!DOCTYPE html>
<html class="h-100" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    <?php
        if(!isset($_SESSION['checkLogin']))
            echo"Đăng nhập";
        else
            echo"Trang chủ";
    ?>
    </title>
    <link rel="shortcut icon" href="../StudentSystem/Images/icon-iuh.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<style>
    *
    {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    #header
    {
        width: 100%;
        height: 5rem;
        padding: 0.5rem;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100;
        display: flex;
        justify-content: space-between;
        background-color: white;
        box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.1);
    }
    #iconContainer
    {
        line-height: 4rem;
    }
    #iconContainer img
    {
        padding: 0.2rem;
    }
    #listCourseContainer
    {
        width: 100%;
        margin-top: 6rem;
    }
    #listCourseContainer h2, #listActivityContainer h2
    {
        border-left: 0.5rem solid rgb(10, 6, 24);
    }
    #listCourse
    {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr));
        gap:1.5rem;
        padding: 2rem 1%;
    }
    .course
    {
        border: rgba(0,0,0,.1) 1px solid;
        border-radius: 10px;
        box-shadow: 0.5rem 0.5rem 0.5rem rgba(0,0,0,.1);
    }
    .course img
    {
        width: 100%;
        border-radius: 10px 10px 0 0;
    }
    .course h5
    {
        padding: 0.3rem 0.5rem;
    }
    .course a
    {
        text-decoration: none;
        padding: 0 0.5rem;
        color: rgb(42, 22, 59);
    }
    .course a:hover
    {
        text-decoration: none;
        padding: 0 0.5rem;
        color: rgb(144, 46, 230);
    }
    .footer
    {
        width: 100%;
        height: 4rem;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 1.5rem 0 0 0;
        text-align: center;
        background-color: rgb(10, 6, 24);
        color: aliceblue;
    }
    @media (max-width:600px){
        #nameUser
        {
            display: none;
        }
    }
</style>
<?php
    if(isset($_SESSION['checkLogin']) && $_SESSION['checkLogin'] == "false")
        include("ComponentGUI/LoginGUI.php");
    else if(isset($_SESSION['checkLogin']) && $_SESSION['checkLogin'] == "true")
    {
        if($_SESSION['typeAccount'] == "Sinh Viên")
        {
            if(isset($_GET['parameter']) && $_GET['parameter'] == "detailCourse")
                include("ComponentGUI/CourseGUI.php");
            else
                include("ComponentGUI/StudentGUI.php");
        }
        else if($_SESSION['typeAccount'] == "Giảng Viên")
        {
            if(isset($_GET['parameter']) && $_GET['parameter'] == "detailCourse")
                include("ComponentGUI/TeacherCourseGUI.php");
            else if(isset($_GET['parameter']) && $_GET['parameter'] == "addCourse")
                include("ComponentGUI/AddCourseGUI.php");
            else
                include("ComponentGUI/TeacherGUI.php");
        }
    }
    else
        include("ComponentGUI/LoginGUI.php");   
?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    config = {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    }
    flatpickr("input[type=datetime-local]", config);
</script>
<script>
    $(document).ready(function () {
        function checkIdStudent() {
            let regexIdStudent = /^[0-9]{8}$/;
            if($("#idStudent").val() == "")
            {
                $("#wrongIdStudent").html("Mã số sinh viên không được để trống!");
                return false;
            }
            else if(!regexIdStudent.test($("#idStudent").val()))
            {
                $("#wrongIdStudent").html("Mã số sinh viên chỉ chứa kí tự số và có độ dài là 8!");
                return false;
            }
            else
            {
                $("#wrongIdStudent").html("");
                return true;
            }
        }
        function checkPassword() {
            let regexPassword = /^[0-9a-zA-Z]{8}$/;
            if($("#password").val() == "")
            {
                $("#wrongPassword").html("Mật khẩu không được để trống!");
                return false;
            }
            else if(!regexPassword.test($("#password").val()))
            {
                $("#wrongPassword").html("Mật khẩu chỉ chứa kí tự số, chữ và có độ dài là 8!");
                return false;
            }
            else
            {
                $("#wrongPassword").html("");
                return true;
            }
        }
        $("#idStudent").blur(checkIdStudent);
        $("#password").blur(checkPassword);
        $("#login").click(function (e) { 
            if(checkIdStudent() == false || checkPassword() == false)
                return false;
            else
                return true;
        });
    });
</script>
<script>
    $(document).ready(function () {
        function checkFile() {
            let regexIdStudent = /[0-9a-zA-Z](.xlsx)/;
            if($("#filename").val() == "")
            {
                $("#wrongFile").html("File không được để trống!");
                return false;
            }
            else if(!regexIdStudent.test($("#filename").val()))
            {
                $("#wrongFile").html("File của bạn không phải là file excel!");
                return false;
            }
            else
            {
                $("#wrongFile").html("");
                return true;
            }
        }
        $("#filename").blur(checkFile);
        $("#themMH").click(function (e) { 
            if(checkFile() == false)
                return false;
            else
                return true;
        });
    });
</script>
<script>
    $(document).ready(function () {
        function checkFileNop() {
            let regexIdStudent = /[0-9a-zA-Z](.doc|.mp3|.mp4|.docx|.pptx|.jpg|.png|.pdf)/;
            if($("#linkBT").val() == "")
            {
                $("#wrongBaiNop").html("Đường dẫn không được để trống!");
                return false;
            }
            else if(!regexIdStudent.test($("#linkBT").val()))
            {
                $("#wrongBaiNop").html("Đường dẫn không hợp lệ!");
                return false;
            }
            else
            {
                $("#wrongBaiNop").html("");
                return true;
            }
        }
        $("#linkBT").blur(checkFileNop);
        $("#btnNopBai").click(function (e) { 
            if(checkFileNop() == false)
                return false;
            else
                return true;
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#notificationBtn").click(function (e) { 
            $("#my-modal").modal();
        });
        $("#userBtn").click(function (e) { 
            $("#my-modal-user").modal();
        });
    });
</script>
<script>
    $(document).ready(function () {
        let soLanPhatBieuBanDau;
        let count = 1;
        $("button").click(function (e) { 
            let idButton = e.target.id;
            let typeButton = e.target.type;
            let check = idButton.substr(0,4);
            if(typeButton == "submit")
            {
                let idInput = idButton.charAt(2);
                $("#" + idInput).prop('disabled', false);
            }
            else
            {
                if("btnt"== check)
                {
                    let idInput = idButton.charAt(4);
                    if(count == 1)
                        soLanPhatBieuBanDau = $("#" + idInput).val();
                    let soPhatBieu =  $("#" + idInput).val();
                    let soLanPhatBieuThem = Number(soPhatBieu) - 1;
                    if(soLanPhatBieuThem > soLanPhatBieuBanDau - 1)
                        $("#" + idInput).val(soLanPhatBieuThem);
                    count = 2;
                }
                else
                {
                    let idInput = idButton.charAt(4);
                    if(count == 1)
                        soLanPhatBieuBanDau = $("#" + idInput).val();
                    let soLanPhatBieu = $("#" + idInput).val();
                    soLanPhatBieu = 1 + Number(soLanPhatBieu);
                    $("#" + idInput).val(soLanPhatBieu);
                    count = 2;
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        let maRandom = "DD";
        for (let i = 0; i < 4; i++) {
            maRandom += Math.floor(Math.random() * 10);
        }
        $("#btnDD").click(function (e) {
            let maDiemDanh = $("#maDiemDanh").val();
            if(maDiemDanh == "")
                $("#maDiemDanh").val(maRandom);
        });
    });
</script>
<script>
    $(document).ready(function(){
        $("select").change(function(e)
        {
            let idSelect = e.target.id;
            let idhref = idSelect.charAt(3);
            var selected = $(this).children("option:selected").val();
            $("#" + idhref).val(selected);
        });
    });
    </script>
<?php
    if(isset($_POST['doiMK']))
    {
        $idUser = $_SESSION['idStudent'];
        $mkMoi = $_POST['mkMoi'];
        $query3 = "Update taikhoan set matKhau = '$mkMoi' where tenTaiKhoan = '$idUser'";
        $queryConnect3 = mysqli_query($connectDB, $query3);
        echo"<script type='text/javascript'>
                alert('Đổi mật khẩu thành công!');
            </script>";
    }
    if(isset($_POST['addBT']))
    {
        $maMonHoc = $_GET['id'];
        $tenBT = $_POST['tenBT'];
        $query3 = "Select count(*) from baitapngoaikhoa where tenNgoaiKhoa = '$tenBT' and maMonHoc = '$maMonHoc'";
        $queryConnect3 = mysqli_query($connectDB, $query3);
        $arrayResult3 = mysqli_fetch_array($queryConnect3);
        if($arrayResult3[0] == 0)
        {
            $query6 = "select maSinhVien from monhoc_sinhvien where maMonHoc = '$maMonHoc'";
            $queryConnect6 = mysqli_query($connectDB, $query6);
            while($arrayResult6 = mysqli_fetch_array($queryConnect6))
            {
                $query7 = "Insert into baitapngoaikhoa VALUES (null, '$tenBT', 'Chưa nộp', '', '$maMonHoc', '$arrayResult6[0]')";
                $queryConnect7 = mysqli_query($connectDB, $query7);
            }
            echo"<script type='text/javascript'>
                alert('Thêm bài tập thành công!');
                window.history.back();
            </script>";
        }
        else
        {
            echo"<script type='text/javascript'>
                alert('Bài tập đã tồn tại!');
                window.history.back();
            </script>";
        }
    }
    if(isset($_POST['btnCQ']))
    {
        $maMonHoc = $_GET['id'];
        $maSVCQ = $_POST['maSinhVienCQ'];
        $query3 = "Select count(*) from sinhvien where maSinhVien = '$maSVCQ'";
        $queryConnect3 = mysqli_query($connectDB, $query3);
        $arrayResult3 = mysqli_fetch_array($queryConnect3);
        if($arrayResult3[0] == 1)
        {
            $query4 = "Select count(*) from loptruong where maMonHoc = '$maMonHoc'";
            $queryConnect4 = mysqli_query($connectDB, $query4);
            $arrayResult4 = mysqli_fetch_array($queryConnect4);
            if($arrayResult4[0] == 1)
            {
                $query5 = "update loptruong set maSinhVien = '$maSVCQ' where maMonHoc = '$maMonHoc'";
                $queryConnect5 = mysqli_query($connectDB, $query5);
            }
            else
            {
                $query6 = "Insert into loptruong VALUES ('$maMonHoc', '$maSVCQ', 1)";
                $queryConnect6 = mysqli_query($connectDB, $query6);
            }
            echo"<script type='text/javascript'>
                alert('Cấp quyền lớp trưởng thành công!');
                window.history.back();
            </script>";
        }
        else
        {
            echo"<script type='text/javascript'>
                alert('Mã số sinh viên không tồn tại!');
                window.history.back();
            </script>";
        }
    }
    if(isset($_POST['btnMoDienDanh']))
    {
        $maMonHoc = $_GET['id'];
        $thoiGianBatDau = $_POST['thoiGianBatDau'];
        $thoiGianKetThuc = $_POST['thoiGianKetThuc'];
        $thoiGianBatDaufm = date_create($thoiGianBatDau);
        $thoiGianBatDaufmDate = date_format($thoiGianBatDaufm,"Y-m-d");
        $thoiGianKetThucfm = date_create($thoiGianKetThuc);
        $thoiGianKetThucfmDate = date_format($thoiGianKetThucfm,"Y-m-d");
        if($thoiGianBatDaufm > $thoiGianKetThucfm || $thoiGianBatDaufmDate != $thoiGianKetThucfmDate)
        {
            echo"<script type='text/javascript'>
                    alert('Mở điểm danh không thành công. Thời gian kết thúc phải lớn hơn thời gian bắt đầu và cùng ngày với nhau!');
                    window.history.back();
                </script>";
        }
        else
        {
            $maDiemDanh = $_POST['maDiemDanh'];
            $query3 = "Select maSinhVien from monhoc_sinhvien where maMonHoc = '$maMonHoc'";
            $queryConnect3 = mysqli_query($connectDB, $query3);
            while($arrayResult3 = mysqli_fetch_array($queryConnect3))
            {
                $query4 = "INSERT INTO diemdanh VALUES (null, 'Chưa điểm danh', '$thoiGianBatDau','$maDiemDanh', '$thoiGianKetThuc', '$maMonHoc', '$arrayResult3[0]')";
                $queryConnect4 = mysqli_query($connectDB, $query4);
            }
            echo"<script type='text/javascript'>
                    alert('Mở điểm danh thành công! Mật khẩu điểm danh: $maDiemDanh');
                    window.history.back();
                </script>";
        }
    }
    if(isset($_POST['ok']))
    {
        $check = 0;
        $maGiangVien = $_SESSION['idStudent'];
        $tenLop = $_POST['nameClass'];
        $tenMonHoc = $_POST['nameCourse'];
        $startDay = $_POST['startDay'];
        $startDayfm = date_create($startDay);
        $endDay = $_POST['endDay'];
        $endDayfm = date_create($endDay);
        if($startDayfm < $endDayfm)
        {
            $filename = $_FILES['file']['tmp_name'];
            $objReader = PHPExcel_IOFactory::createReaderForFile($filename);
            $listWorkSheets = $objReader->listWorksheetNames($filename);
            for ($i=0; $i < count($listWorkSheets); $i++) { 
                if($listWorkSheets[$i] == $tenLop)
                    $check = 1;
            }
            if($check == 1)
            {
                $objReader->setLoadSheetsOnly($tenLop);
                $objExcel = $objReader->load($filename);
                $sheetData = $objExcel->getActiveSheet()->toArray(null, true, true, true);
                $query3 = "Select count(*) from monhoc";
                $queryConnect3 = mysqli_query($connectDB, $query3);
                $arrayResult3 = mysqli_fetch_array($queryConnect3);
                $maMonHoc = $arrayResult3[0] + 1;
                for ($i=2; $i < count($sheetData); $i++) { 
                    $maSinhVien = $sheetData[$i]["A"];
                    $tenSinhVien = $sheetData[$i]["B"];
                    $emailSinhVien = $sheetData[$i]["C"];
                    $query1 = "INSERT INTO taikhoan VALUES ('$maSinhVien', '12345678', 'Sinh Viên')";
                    $queryConnect1 = mysqli_query($connectDB, $query1);
                    $query2 = "INSERT INTO sinhvien VALUES ('$maSinhVien', '$tenSinhVien', '$emailSinhVien')";
                    $queryConnect2 = mysqli_query($connectDB, $query2);
                    $query4 = "INSERT INTO monhoc VALUES ('$maMonHoc', '$tenLop', '$tenMonHoc', '$startDay', '$endDay', '$maGiangVien')";
                    $queryConnect4 = mysqli_query($connectDB, $query4);
                    $query5 = "INSERT INTO monhoc_sinhvien VALUES ('$maMonHoc', '$maSinhVien')";
                    $queryConnect5 = mysqli_query($connectDB, $query5);
                    $query6 = "INSERT INTO phatbieu VALUES ('$maMonHoc', '$maSinhVien', 0)";
                    $queryConnect6 = mysqli_query($connectDB, $query6);
                }
                echo"<script type='text/javascript'>
                        alert('Thêm học phần mới thành công!');
                        window.history.back();
                    </script>";
            }
            else
                echo"<script type='text/javascript'>
                        alert('Tên lớp không tồn tại trong file Excel!');
                        window.history.back();
                    </script>";
        }
        else
        {
            echo"<script type='text/javascript'>
                        alert('Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc!');
                        window.history.back();
                    </script>";
        }
    }
    if(isset($_GET['parameter']) && $_GET['parameter'] == "logout")
    {
        echo"<script type='text/javascript'>
            window.history.back();
        </script>";
    }
    if(isset($_SESSION['detailCourse']) && isset($_GET['parameter']) && $_GET['parameter'] == "detailCourse")
    {
        echo"<script type='text/javascript'>
            window.history.back();
        </script>";
    }
    if(isset($_SESSION['addCourse']) && isset($_GET['parameter']) && $_GET['parameter'] == "addCourse")
    {
        echo"<script type='text/javascript'>
            window.history.back();
        </script>";
    }
    if(isset($_POST['parameter']) && $_POST['parameter'] == "kiemTraDiemDanh")
    {
            $idDiemDanh = $_POST['idDiemDanh'];
            $maDiemDanh = $_POST['maDiemDanh'];
            $query = "SELECT count(*) from diemdanh where maDiemDanh = '$idDiemDanh' and matMaDiemDanh = '$maDiemDanh'";
            $queryConnect=mysqli_query($connectDB, $query);
            $arrayResult = mysqli_fetch_array($queryConnect);
            if($arrayResult[0] == 1)
            {
                $query1 = "UPDATE diemdanh
                            SET trangThai = 'Đã điểm danh'
                            WHERE maDiemDanh = '$idDiemDanh'";
                $queryConnect1 = mysqli_query($connectDB, $query1);
                $_SESSION['ktDiemDanh'] = "true";
            }
            else
            {
                $_SESSION['ktDiemDanh'] = "false";
            }
            echo"<script type='text/javascript'>
            window.history.back();
        </script>";      
    }
    if(isset($_POST['parameter']) && $_POST['parameter'] == "nopBai")
    {
            $idBaiTap = $_POST['idBaiTap'];
            $filename = $_POST['filename'];
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["filename"]["name"]);
            move_uploaded_file($_FILES['filename']['tmp_name'], $target_file);
            $query1 = "UPDATE baitapngoaikhoa
                        SET trangThaiBaiTap = 'Đã nộp', duongDanBaiTap = '$target_file'
                        WHERE maNgoaiKhoa = '$idBaiTap'";
            $queryConnect1 = mysqli_query($connectDB, $query1);
            echo"<script type='text/javascript'>
                alert('Nộp bài tập thành công!');
                window.history.back();
            </script>";
    }
    if(isset($_POST['parameter']) && $_POST['parameter'] == "capNhatPhatBieu")
    {
            $maSinhVien = $_POST['maSinhVien'];
            $soPhatBieu = $_POST['soPhatBieu'];
            $idMonHoc = $_GET['id'];
            $query1 = "UPDATE phatbieu
                        SET soLanPhatBieu = '$soPhatBieu'
                        WHERE maSinhVien = '$maSinhVien' and maMonHoc = '$idMonHoc'";
            $queryConnect1 = mysqli_query($connectDB, $query1);
            echo"<script type='text/javascript'>
                alert('Cập nhật phát biểu thành công!');
                window.history.back();
            </script>";
    }
    if(isset($_SESSION['checkLogin']))
        echo"<script type='text/javascript'>
                if ( window.history.replaceState ) 
                {
                    window.history.replaceState( null, null, window.location.href);
                }
             </script>";
?>
</html>