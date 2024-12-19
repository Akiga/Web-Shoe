<?php
    $sql_list_orders = "SELECT * FROM tbl_cart, user WHERE tbl_cart.userid = user.userid";
    $query_list_orders = mysqli_query($mysqli, $sql_list_orders);
?>
<h1 class="page-title">Orders</h1>

<table class="order-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Order Code</th>
            <th>Customer Name</th>
            <th>Address</th>
            <th>Email</th>
            <th>Payment Method</th>
            <th>Status</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_list_orders)) {
            $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['code_cart'] ?></td>
            <td><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></td>
            <td><?php echo $row['diachi'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['ThanhToan'] ?></td>
            <td>
                <?php 
                if ($row['cart_status'] == 1) {
                    echo '<a class="btn btn-accept" href="modules/quanlydonhang/xuly.php?cart_status=0&code='.$row['code_cart'].'">Accept</a>';
                    echo '<a class="btn btn-cancel" href="modules/quanlydonhang/xuly.php?cart_status=3&code='.$row['code_cart'].'">Cancel</a>';
                } elseif ($row['cart_status'] == 0) {
                    echo '<a class="btn btn-shipping" href="modules/quanlydonhang/xuly.php?cart_status=2&code='.$row['code_cart'].'">Waiting for Delivery</a>';
                } elseif ($row['cart_status'] == 2) {
                    echo '<a class="btn btn-complete" href="modules/quanlydonhang/xuly.php?cart_status=5&code='.$row['code_cart'].'">Complete</a>';
                    echo '<a class="btn btn-return" href="modules/quanlydonhang/xuly.php?cart_status=4&code='.$row['code_cart'].'">Return</a>';
                } elseif ($row['cart_status'] == 3) {
                    echo '<span class="status cancelled">Cancelled</span>';
                } elseif ($row['cart_status'] == 4) {
                    echo '<span class="status returned">Returned</span>';
                } elseif ($row['cart_status'] == 5) {
                    echo '<span class="status completed">Completed</span>';
                }
                ?>
            </td>
            <td>
                <a href="index.php?action=donhang&query=xemdonhang&code=<?php echo $row['code_cart'] ?>" class="btn btn-view">View Order</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
