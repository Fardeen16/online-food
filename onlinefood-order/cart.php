<?php
include('partials-front/menu.php'); 

if(isset($_GET["action"])){
    if($_GET["action"] == "delete"){
        foreach($_SESSION["shopping_cart"] as $keys => $values){
            if($values["item_id"] == $_GET["id"]){
                unset($_SESSION["shopping_cart"]["$keys"]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="cart.php"</script>';
            }
        }
    }
}

?>
    

<link rel="stylesheet" href="css/admin.css">
    
<div class="container">
    <h3>Food Cart</h3>
    <table class="tbl-full">
            <tr>
                <th width="40%">Item Name</th>
                <th width="10%">Quantity</th>
                <th width="20%">Price</th>
                <th width="15%">Total</th>
                <th width="5%">Action</th>
            </tr>
            <?php
            if(!empty($_SESSION["shopping_cart"])){
                $total = 0;
                foreach($_SESSION["shopping_cart"] as $keys => $values){
            ?>
            <tr>
                <td><?php echo $values["item_name"]; ?></td>
                <td><?php echo $values["item_quantity"]; ?></td>
                <td>$ <?php echo $values["item_price"]; ?></td>
                <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
            </tr>
            <?php
                $total = $total + ($values["item_quantity"] * $values["item_price"]);
                }
            ?>
            <tr>
                <td colspan="3" align="right">Total</td>
                <td align="right">$ <?php echo number_format($total,2);?></td>
                <td></td>
            </tr>
            <?php
            }
            ?>
        </table>
    
</div>
<br>
<div class="payment">
<a href="<?php echo SITEURL; ?>final.php" class="btn btn-secondary">Order Now</a>
</div>

<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<?php include('partials-front/footer.php'); ?>
