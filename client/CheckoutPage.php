<?php 
include('../client/inc/header.php');

?>

  <div class="container mt-5">
    <span class="h1 mb-3 text-secondary">
      Checkout
</span>
    <div class="createAcc d-flex justify-content-around my-5">
      <div class="card py-3 px-3 w-50 text-start">
        <table class="table caption-top mb-4">
          <caption class="mb-2">
            Order Summary
          </caption>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Item</th>
              <th scope="col">Units</th>
              <th scope="col">Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>I Phone</td>
              <td>1</td>
              <td>200</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Samsung Phone</td>
              <td>1</td>
              <td>300</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>TV</td>
              <td>1</td>
              <td>400</td>
            </tr>
          </tbody>
        </table>

          <p class="text-md-start">Total:</p>
          <p class="text-md-start">Estimated Delivery:</p>
          <select class="form-select mb-3" aria-label="Default select example">
            <option selected>Payment Method</option>
            <option value="1">Cash</option>
            <option value="2">Card</option>
          </select>
          <select class="form-select mb-3" aria-label="Default select example">
            <option selected>Delivery Method</option>
            <option value="1">Store Pickup</option>
            <option value="2">Delivery</option>
          </select>
          <div>
            <button type="submit" class="btn btn-primary ms-auto">
              Place Order
            </button>
          </div>

      </div>
    </div>
  </div>
</body>
</html>

<?php 
  include('../client/inc/footer.php');
?>