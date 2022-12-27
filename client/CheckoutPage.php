<?php 
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
          <div class="row text-secondary lead justify-content-end">
            <div class="col-2 text-end ">Total:</div>
            <div class="col-3">Answer</div>
          </div>
          <div class="row text-secondary lead justify-content-end">
            <div class="col-4 text-end">Estimated Delivery:</div>
            <div class="col-3">Answer</div>
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