<?php
    $sql_sua_danhmucsp = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$_GET[iddanhmuc]' LIMIT 1";
    $query_sua_danhmucsp = mysqli_query($mysqli, $sql_sua_danhmucsp);
?>

<h1 class="form-title">Edit Product Category</h1>

<div class="form-container">
    <form method="post" action="modules/quanlydanhmucsp/XuLy.php?iddanhmuc=<?php echo $_GET['iddanhmuc']; ?>">
        <table>
            <?php while ($dong = mysqli_fetch_array($query_sua_danhmucsp)) { ?>
            <tr>
                <td><label for="tendanhmuc">Category Name</label></td>
                <td><input type="text" id="tendanhmuc" name="tendanhmuc" value="<?php echo $dong['tendanhmuc']; ?>" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" value="Edit Product Category" name="suadanhmuc">
                </td>
            </tr>
            <?php } ?>
        </table>
    </form>
</div>
