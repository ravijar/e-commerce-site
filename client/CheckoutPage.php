<?php 
session_start();
include('../client/inc/header.php');

?>

<div>
    <div class="container mt-5">
      <span class="h1 mb-3">
        Checkout
      </span>
      <div class="createAcc d-flex gap-5 justify-content-around my-5">
        <div class="card bg-light pt-2 pb-3 px-4 w-50 text-start">
          <table class="table caption-top mb-4">
            <caption class="mb-2 fs-4">
              Order Summary
            </caption>
            <thead>
              <tr>
                <th scope="col">Product Number</th>
                <th scope="col">Item</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Units</th>
                <th scope="col">Sub total</th>
              </tr>
            </thead>
            <tbody>
            <?php
        if(!empty($_SESSION['cart'])){
          $varient_id = array_column($_SESSION['cart'],'VariantDetails');
          $variant_count;
         $variant_count=0;
        if(!empty($varient_id)){
          $cart_total = 0;
          foreach($varient_id as $id){
            $variant_count++;
            $cart_total = load_checkout_items($id,$variant_count,$cart_total);
          }
          
        }
        }
        $_SESSION["cart_total"] = $cart_total;
        
        
        
        ?>
            </tbody>
          </table>
          <div class="row text-secondary lead justify-content-end">
            <div class="col-2 text-end ">Total:</div>

            <?php
      if(!empty($_SESSION['cart'])){
        echo "<div class='col-3'>$cart_total LKR</div> ";
      }
      else{
        echo "<div class='col-3'>0</div>  ";
      }
       ?>
          </div>
          <div class="row text-secondary lead justify-content-end">
            <div class="col-6 text-end">Estimated Delivery Time:</div>
            <?php
              $select_delivery_city= "Select * from delivery where City='".$_SESSION['login_user_city']."'";;
              $result_delivery_city = mysqli_query($adminconnection, $select_delivery_city);
              while ($row_data = mysqli_fetch_assoc($result_delivery_city)) {
                $days = $row_data['Days'];
              }
            ?>
            <div class="col-3"><?php echo $days; ?> Days</div>
          </div>
          <div class="row mt-4 mb-2">
            <div class="col align-self-center">Select Payment Method:</div>
            <div class="col">
              <select class="form-select" aria-label="Default select example">
                <option selected class="d-none">Payment Method</option>
                <option value="1">Cash</option>
                <option value="2">Card</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col align-self-center">Select Delivery Method:</div>
            <div class="col">
              <select class="form-select" aria-label="Default select example">
                <option selected class="d-none">Delivery Method</option>
                <option value="1">Store Pickup</option>
                <option value="2">Delivery</option>
              </select>
            </div>
          </div>

          <div class="ms-auto py-3">
            <button type="submit" class="btn btn-primary ms-auto">
              Place Order
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

      </div>
    </div>
  </div>
</body>
</html>

<?php 
  include('../client/inc/footer.php');
?>

<!-- <?php
if(!isset($_SESSION["user_id"])){
  $_SESSION["user_id"] = null;
}

if(!isset($_SESSION["guest_id"])){
  $_SESSION["guest_id"] = null;
}
?>
<?php
$adminconnection;

// Turn autocommit off
$mysqli -> autocommit(FALSE);

// Insert some values
$mysqli -> query("INSERT INTO cart (User_ID,Guest_ID,Total_Value)
VALUES ('{$_SESSION['user_id']}','{$_SESSION['guest_id']}','{$_SESSION['cart_total']}')");
$mysqli -> query("INSERT INTO cart_item (Cart_ID,VariantID, Quantity, Item_Total_Price)
VALUES ('Glenn','Quagmire',33,)");
$mysqli -> query("UPDATE inventory SET Quantity = 1 WHERE Variant_ID = 2");
$date = date("Y-m-d");
$mysqli -> query("INSERT INTO order (Cart_ID, Date_Of_Order, User_ID, Guest_ID, Payment_type, Delivery_type)
VALUES ('Glenn',$date,'{$_SESSION['user_id']}','{$_SESSION['guest_id']}'),,");
// Commit transaction
if (!$mysqli -> commit()) {
  echo "Commit transaction failed";
  exit();
}

$mysqli -> close();
?> -->
