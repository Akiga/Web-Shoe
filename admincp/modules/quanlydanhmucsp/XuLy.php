<?php
include("../../config/config.php");
    $tenloaisp = $_POST['tendanhmuc'];
if(isset($_POST['themdanhmuc'])){
    $sql_them = "insert into tbl_danhmuc(tendanhmuc) value('".$tenloaisp."')";
    mysqli_query($mysqli, $sql_them);

    header('Location:../../index.php?action=quanlydanhmucsp&query=them');
}elseif(isset($_POST['suadanhmuc'])){
    $sql_update = "update tbl_danhmuc set tendanhmuc='".$tenloaisp."' where id_danhmuc=$_GET[iddanhmuc]";
    mysqli_query($mysqli, $sql_update);

    header('Location:../../index.php?action=quanlydanhmucsp&query=them');
}else{
    $id = $_GET['iddanhmuc'];
    $sql_xoa = "delete from tbl_danhmuc where id_danhmuc = '".$id."'";
    mysqli_query($mysqli, $sql_xoa);
    header('Location:../../index.php?action=quanlydanhmucsp&query=them');

}
?>