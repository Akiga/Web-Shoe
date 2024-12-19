<?php
    $sql_lietke_sp = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc";
    $query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
?>
<h1 class="page-title">Product List</h1>

<div class="product-table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product Code</th>
                <th>Image</th>
                <th>Price</th>
                <th>Shoe Size</th>
                <th>Quantity</th>
                <th>Category</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($query_lietke_sp)) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['tensanpham']; ?></td>
                <td><?php echo $row['masanpham']; ?></td>
                <td><img class="product-image" src="modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" alt="Product Image"></td>
                <td><?php echo number_format($row['giasp'], 0, ',', '.'); ?> $</td>
                <td><?php 
                    $sizes = [];
                    if ($row['size'] != '0') $sizes[] = $row['size'];
                    if ($row['size1'] != '0') $sizes[] = $row['size1'];
                    if ($row['size2'] != '0') $sizes[] = $row['size2'];
                    if ($row['size3'] != '0') $sizes[] = $row['size3'];
                    echo implode(', ', $sizes);
                ?></td>
                <td><?php echo $row['soluong']; ?></td>
                <td><?php echo $row['tendanhmuc']; ?></td>
                <td><?php echo $row['noidung']; ?></td>
                <td><?php echo $row['tinhtrang'] == 1 ? 'Active' : 'Hidden'; ?></td>
                <td>
                    <a href="modules/quanlysp/XuLy.php?idsanpham=<?php echo $row['id_sanpham']; ?>" class="delete-btn">Delete</a> | 
                    <a href="?action=quanlysp&query=sua&idsanpham=<?php echo $row['id_sanpham']; ?>" class="edit-btn">Edit</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
