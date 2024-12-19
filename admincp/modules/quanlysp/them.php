<h1 class="form-title">Add Product</h1>

<div class="form-container">
    <form method="post" action="modules/quanlysp/XuLy.php" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="masp">Product Code</label></td>
                <td><input type="text" id="masp" name="masp" required></td>
            </tr>
            <tr>
                <td><label for="tensp">Product Name</label></td>
                <td><input type="text" id="tensp" name="tensp" required></td>
            </tr>
            <tr>
                <td><label for="hinhanh">Image</label></td>
                <td><input type="file" id="hinhanh" name="hinhanh" required></td>
            </tr>
            <tr>
                <td><label for="giasp">Product Price</label></td>
                <td><input type="text" id="giasp" name="giasp" required></td>
            </tr>
            <tr>
                <td>Shoe Size</td>
                <td>
                <label><input type="checkbox" name="size" value="39"> 39</label>
                <label><input type="checkbox" name="size1" value="40"> 40</label>
                <label><input type="checkbox" name="size2" value="41"> 41</label>
                <label><input type="checkbox" name="size3" value="42"> 42</label>
                </td>
            </tr>
            <tr>
                <td><label for="soluong">Quantity</label></td>
                <td><input type="text" id="soluong" name="soluong" required></td>
            </tr>
            <tr>
                <td><label for="noidung">Description</label></td>
                <td><textarea id="noidung" rows="5" style="resize: none;" name="noidung" required></textarea></td>
            </tr>
            <tr>
                <td><label for="tinhtrang">Status</label></td>
                <td>
                    <select id="tinhtrang" name="tinhtrang">
                        <option value="1">Active</option>
                        <option value="0">Hidden</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="danhmuc">Product Category</label></td>
                <td>
                    <select id="danhmuc" name="danhmuc">
                        <?php
                            $sql_danhmuc = "SELECT * FROM tbl_danhmuc";
                            $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                            while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                        ?>
                        <option value="<?php echo $row_danhmuc['id_danhmuc']; ?>"><?php echo $row_danhmuc['tendanhmuc']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;"><input type="submit" value="Add Product" name="themsp"></td>
            </tr>
        </table>
    </form>
</div>
