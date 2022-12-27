<?php
include('../client/inc/header.php');

?>
<div class="container mt-5">
  <div>

    <table class="table caption-top mb-5">
      <caption class="h1 mb-5">
        Cart
      </caption>
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">#</th>
          <th scope="col">Item</th>
          <th scope="col">Unit Price(LKR)</th>
          <th scope="col">Units</th>
          <th scope="col">Subtotal(LKR)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><button class="btn btn-danger">Remove</button></td>
          <th scope="row">1</th>
          <td>I Phone</td>
          <td>100</td>
          <td>2</td>
          <td>200</td>
        </tr>

        <tr>
          <td><button class="btn btn-danger">Remove</button></td>
          <th scope="row">1</th>
          <td>I Phone</td>
          <td>100</td>
          <td>2</td>
          <td>200</td>
        </tr>

        <tr>
          <td><button class="btn btn-danger">Remove</button></td>
          <th scope="row">1</th>
          <td>I Phone</td>
          <td>100</td>
          <td>2</td>
          <td>200</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="d-flex me-5 align-items-end flex-column bd-highlight mb-3">
    <div class="py-3 fw-bold lead">
      <span class="bd-highlight ">Total: </span>
      <span class="bd-highlight pb-3 ">5000</span>
      <span class="bd-highlight pb-3 "> LKR</span>
    </div>
    <div class="d-flex flex-row w-100 justify-content-between">
      <div class="align-self-center ms-5">
        <a href="index.php#productSection" class="lead text-decoration-none fw-light">Continue Shopping</a>
      </div>
      <div>
        <a href='LoginPage.php' class='btn btn-primary'>Checkout</a>
      </div>
    </div>

  </div>
</div>
</body>

</html>
<?php
include('../client/inc/footer.php');
?>