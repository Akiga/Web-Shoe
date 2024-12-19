<?php
    $sql_sua_sp = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$_GET[idsanpham]' LIMIT 1";
    $query_sua_sp = mysqli_query($mysqli, $sql_sua_sp);
?>

<h1 class="page-title">Edit Product</h1>

<div class="form-container">
    <?php while($row = mysqli_fetch_array($query_sua_sp)) { ?>
    <form method="post" action="modules/quanlysp/XuLy.php?idsanpham=<?php echo $_GET['idsanpham'] ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="masp">Product Code</label>
            <input type="text" id="masp" name="masp" value="<?php echo $row['masanpham']; ?>" required>
        </div>

        <div class="form-group">
            <label for="tensp">Product Name</label>
            <input type="text" id="tensp" name="tensp" value="<?php echo $row['tensanpham']; ?>" required>
        </div>

        <div class="form-group">
            <label for="hinhanh">Image</label>
            <input type="file" id="hinhanh" name="hinhanh">
            <img class="product-image" src="modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" alt="Product Image">
        </div>

        <div class="form-group">
            <label for="giasp">Product Price</label>
            <input type="text" id="giasp" name="giasp" value="<?php echo $row['giasp']; ?>" required>
        </div>

        <div class="form-group">
            <label>Shoe Size</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="size" value="39" <?php echo ($row['size'] == '39' ? 'checked' : ''); ?>> 39</label>
                <label><input type="checkbox" name="size1" value="40" <?php echo ($row['size1'] == '40' ? 'checked' : ''); ?>> 40</label>
                <label><input type="checkbox" name="size2" value="41" <?php echo ($row['size2'] == '41' ? 'checked' : ''); ?>> 41</label>
                <label><input type="checkbox" name="size3" value="42" <?php echo ($row['size3'] == '42' ? 'checked' : ''); ?>> 42</label>
            </div>
        </div>

        <div class="form-group">
            <label for="soluong">Quantity</label>
            <input type="text" id="soluong" name="soluong" value="<?php echo $row['soluong']; ?>" required>
        </div>

        <div class="form-group">
            <label for="noidung">Description</label>
            <textarea id="noidung" name="noidung" rows="5" required><?php echo $row['noidung']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="danhmuc">Product Category</label>
            <select id="danhmuc" name="danhmuc" required>
                <?php
                    $sql_danhmuc = "SELECT * FROM tbl_danhmuc";
                    $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                    while($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                        echo '<option value="' . $row_danhmuc['id_danhmuc'] . '" ' . ($row_danhmuc["id_danhmuc"] == $row["id_danhmuc"] ? 'selected' : '') . '>' . $row_danhmuc['tendanhmuc'] . '</option>';
                    }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="tinhtrang">Status</label>
            <select id="tinhtrang" name="tinhtrang" required>
                <option value="1" <?php echo ($row['tinhtrang'] == 1 ? 'selected' : ''); ?>>Active</option>
                <option value="0" <?php echo ($row['tinhtrang'] == 0 ? 'selected' : ''); ?>>Hidden</option>
            </select>
        </div>

        <div class="form-group submit-group">
            <button type="submit" name="suasanpham" class="submit-btn">Edit Product</button>
        </div>
    </form>
    <?php } ?>
</div>
