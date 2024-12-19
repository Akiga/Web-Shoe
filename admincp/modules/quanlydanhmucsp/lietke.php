<?php
    $sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc";
    $query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);
?>

<h1 class="table-title">Product Categories</h1>

<div class="table-container">
    <table class="styled-table">
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Management</th>
        </tr>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_danhmucsp)) {
            $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['tendanhmuc']; ?></td>
            <td>
                <a class="action-link delete" href="modules/quanlydanhmucsp/XuLy.php?iddanhmuc=<?php echo $row['id_danhmuc']; ?>">Delete</a>
                |
                <a class="action-link edit" href="?action=quanlydanhmucsp&query=sua&iddanhmuc=<?php echo $row['id_danhmuc']; ?>">Edit</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
