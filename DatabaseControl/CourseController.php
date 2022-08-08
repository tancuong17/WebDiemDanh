<?php
    if(isset($_SESSION['checkLogin']) && $_SESSION['typeAccount'] == "Sinh Viên")
    {
        $idStudent = (int)$_SESSION['idStudent'];
        $query = "SELECT * 
        FROM monhoc_sinhvien 
        INNER JOIN sinhvien ON monhoc_sinhvien.maSinhVien = sinhvien.maSinhVien
        INNER JOIN monhoc ON monhoc_sinhvien.maMonHoc = monhoc.maMonHoc
        WHERE monhoc_sinhvien.maSinhVien = '$idStudent'";
        $queryConnect=mysqli_query($connectDB, $query);
        while($arrayResult = mysqli_fetch_array($queryConnect))
        {
            $linkCourse = "?parameter=detailCourse&id=".$arrayResult['maMonHoc'];
            $nameCourse = $arrayResult['tenMonHoc'];
            $classCourse = $arrayResult['tenLopHoc'];
            echo"<div class='col-sm-4 pl-4 pr-4 pt-2 pb-2'>
                    <div class='row'>
                        <div class='col-sm-12 border p-0'>
                            <a class='text-decoration-none' href='$linkCourse'>
                                <img class='img-fluid' src='../StudentSystem/Images/bg.jpg' alt='Ảnh môn học'>
                                <h6 class='text-dark pl-2'>Môn học: $nameCourse</h6>
                                <p class='text-dark pl-2'>Lớp: $classCourse</p>
                            </a>
                        </div>
                    </div>
                </div>";
        }
    }
    else if(isset($_SESSION['checkLogin']) && $_SESSION['typeAccount'] == "Giảng Viên")
    {
        
        $idGiangVien = (int)$_SESSION['idStudent'];
        $query = "SELECT * 
        FROM monhoc where maGiangVien = '$idGiangVien'";
        $queryConnect=mysqli_query($connectDB, $query);
        while($arrayResult = mysqli_fetch_array($queryConnect))
        {
            $linkCourse = "?parameter=detailCourse&id=".$arrayResult['maMonHoc'];
            $nameCourse = $arrayResult['tenMonHoc'];
            $classCourse = $arrayResult['tenLopHoc'];
            echo"<div class='col-sm-4 pl-4 pr-4 pt-2 pb-2'>
                    <div class='row'>
                        <div class='col-sm-12 border p-0'>
                            <a class='text-decoration-none' href='$linkCourse'>
                                <img class='img-fluid' src='../StudentSystem/Images/bg.jpg' alt='Ảnh môn học'>
                                <h6 class='text-dark pl-2'>Môn học: $nameCourse</h6>
                                <p class='text-dark pl-2'>Lớp: $classCourse</p>
                            </a>
                        </div>
                    </div>
                </div>";
        }
    }
?>