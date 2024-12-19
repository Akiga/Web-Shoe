<?php
    $sql_list_order_details = "SELECT * FROM tbl_cart_details, tbl_sanpham WHERE tbl_cart_details.id_sanpham = tbl_sanpham.id_sanpham 
    AND tbl_cart_details.code_cart = '$_GET[code]'";
    $query_list_order_details = mysqli_query($mysqli, $sql_list_order_details);
?>
<h1 class="page-title">Order Details</h1>

<table class="order-details-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Order Code</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Size shoe</th>
            <th>Unit Price</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_list_order_details)) {
            $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['code_cart'] ?></td>
            <td><?php echo $row['tensanpham'] ?></td>
            <td><?php echo $row['soluongmua'] ?></td>
            <td><?php echo $row['sizeOwn'] ?></td>
            <td><?php echo number_format($row['giasp'], 0, ',', '.') . ' $' ?></td>
            <td><?php echo number_format($row['giasp'] * $row['soluongmua'], 0, ',', '.') . ' $' ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<div class="h" style="min-height: 300px;"></div>
