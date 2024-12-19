<?php
include("../../config/config.php");
    $tensp = $_POST['tensp'];
    $masp = $_POST['masp'];
    $giasp = $_POST['giasp'];
    $soluong = $_POST['soluong'];
    // Xu ly hinh anh
$hinhanh=$_FILES['hinhanh']['name'];
$hinhanh_tmp=$_FILES['hinhanh']['tmp_name'];
$hinhanh = time().'_'.$hinhanh;
    $noidung = $_POST['noidung'];
    if(isset($_POST['size'])){
        $sizes = $_POST['size'];
    }else{
        $sizes = 0;
    }
    
    if(isset($_POST['size1'])){
        $size1 = $_POST['size1'];
    }else{
        $size1 = 0;
    }

    if(isset($_POST['size2'])){
        $size2 = $_POST['size2'];
    }else{
        $size2 = 0;
    }

    if(isset($_POST['size3'])){
        $size3 = $_POST['size3'];
    }else{
        $size3 = 0;
    }
    $tinhtrang= $_POST['tinhtrang'];
    $danhmuc= $_POST['danhmuc'];




if(isset($_POST['themsp'])){
    $sql_them = "insert into tbl_sanpham(tensanpham,masanpham,giasp, soluong, hinhanh, noidung,size, size1, size2, size3,tinhtrang,id_danhmuc)
    value('".$tensp."','".$masp."','".$giasp."','".$soluong."','".$hinhanh."','".$noidung."','".$sizes."','".$size1."','".$size2."','".$size3."','".$tinhtrang."','".$danhmuc."')";

    mysqli_query($mysqli, $sql_them);

    move_uploaded_file($hinhanh_tmp, 'uploads/'.$hinhanh);
    header('Location:../../index.php?action=quanlysp&query=them');
}elseif(isset($_POST['suasanpham'])){
    if($hinhanh !=''){
        move_uploaded_file($hinhanh_tmp, 'uploads/'.$hinhanh);
        $sql_update = "update tbl_sanpham set tensanpham='".$tensp."', masanpham='".$masp."', giasp='".$giasp."'
        , soluong='".$soluong."', hinhanh='".$hinhanh."', noidung='".$noidung."', size='".$sizes."', size1='".$size1."', size2='".$size2."', size3='".$size3."', tinhtrang='".$tinhtrang."' , id_danhmuc='".$danhmuc."'
        where id_sanpham=$_GET[idsanpham]";
        
        $sql = "select * from tbl_sanpham where id_sanpham = '$_GET[idsanpham]' limit 1";
        $query = mysqli_query($mysqli, $sql);
        while($row = mysqli_fetch_array($query)){
            unlink('uploads/'.$row['hinhdanh']);
        }

    }else{
        $sql_update = "update tbl_sanpham set tensanpham='".$tensp."', masanpham='".$masp."', giasp='".$giasp."'
        , soluong='".$soluong."', noidung='".$noidung."', size='".$sizes."', size1='".$size1."', size2='".$size2."', size3='".$size3."', tinhtrang='".$tinhtrang."', id_danhmuc='".$danhmuc."' 
        where id_sanpham=$_GET[idsanpham]";
    
    }

    mysqli_query($mysqli, $sql_update);
    header('Location:../../index.php?action=quanlysp&query=them');
}else{
    $id = $_GET['idsanpham'];
    $sql = "select * from tbl_sanpham where id_sanpham= '$id' limit 1";
    $query = mysqli_query($mysqli, $sql);
    while($row = mysqli_fetch_array($query))
    {
        unlink(('uploads/'.$row['hinhanh']));
    }
    $sql_xoa = "delete from tbl_sanpham where id_sanpham = '".$id."'";
    mysqli_query($mysqli, $sql_xoa);
    header('Location:../../index.php?action=quanlysp&query=them');
}
?>