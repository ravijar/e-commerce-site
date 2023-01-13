<?php include('../Database/DatabaseConnection.php'); ?>
<?php
$months = [
  1 => 'January',
  2 => 'February',
  3 => 'March',
  4 => 'April',
  5 => 'May',
  6 => 'June',
  7 => 'July',
  8 => 'August',
  9 => 'September',
  10 => 'October',
  11 => 'November',
  12 => 'December',
];
?>

<?php
// customer order report
$sql = 'SELECT Order_ID,Date_Of_Order,First_Name,Last_Name,Total_Value FROM `order`,`user`,`cart` WHERE `order`.User_ID = `user`.User_ID AND `order`.Cart_ID = `cart`.Cart_ID AND `order`.Guest_ID IS NULL;';
$result = mysqli_query($adminconnection, $sql);
$customer_order_report = mysqli_fetch_all($result, MYSQLI_ASSOC);

// year for dropdowns
$sql = 'SELECT min(Date_Of_Order) FROM `order`;';
$result = mysqli_query($adminconnection, $sql);
$min_date = strtotime(mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['min(Date_Of_Order)']);
$min_year = date('Y', $min_date);
$max_year = date('Y');

// products for dropdowns
$sql = 'SELECT Product_ID,Title FROM `product`;';
$result = mysqli_query($adminconnection, $sql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
$products_dict = [];
foreach ($products as $product) {
  $products_dict[$product['Product_ID']] = $product['Title'];
}

// quarterly sales report
$year = $quarter = '';
$show_set = false;
if (isset($_POST['show'])) {
  if (count($_POST) == 3) {
    $year = $_POST['year'];
    $quarter = $_POST['quarter'];
    $show_set = true;
  }
}
$sql = $adminconnection->prepare("select Title,sum(Quantity) as Quantity,sum(Item_Total_Price) as Total
  from `order`,`cart_item`,`product_variant`,`product` 
  where `order`.Cart_ID = `cart_item`.Cart_ID
  and `cart_item`.Variant_ID = `product_variant`.Variant_ID
  and `product_variant`.Product_ID = `product`.Product_ID
  and year(Date_Of_Order) = ? and ceil(month(Date_Of_Order)/3) = ?
  group by `product`.Product_ID");
$sql->bind_param("ss", $year, $quarter);
$sql->execute();
$result = $sql->get_result();
$sales_report  = array();
$sum_Quantity = $sum_Total = 0;
while ($row = $result->fetch_assoc()) {
  $sales_report[] = $row;
  $sum_Quantity += $row['Quantity'];
  $sum_Total += $row['Total'];
}
if (empty($sales_report)) {
  $show_set = false;
}

// product with most number of sales
$year1 = $month1 = '';
$search1_set = false;
if (isset($_POST['search1'])) {
  if (count($_POST) == 3) {
    $year1 = $_POST['year1'];
    $month1 = $_POST['month1'];
    $search1_set = true;
  }
}
$sql = $adminconnection->prepare("select Title from product where Product_ID in(
    select Product_ID from product_variant as pv inner join(
    select Variant_ID,sum(Quantity) as q from `cart_item` where Cart_ID in(
    select Cart_ID from `order` where year(Date_Of_Order) = ? and month(Date_Of_Order) = ?
    ) group by Variant_ID order by q desc limit 1)
    as v on pv.Variant_ID = v.Variant_ID);");
$sql->bind_param("ss", $year1, $month1);
$sql->execute();
$result = $sql->get_result();
$product  = $result->fetch_assoc();
if (empty($product)) {
  $search1_set = false;
}

// product category with most orders
$year2 = $month2 = '';
$search2_set = false;
if (isset($_POST['search2'])) {
  if (count($_POST) == 3) {
    $year2 = $_POST['year2'];
    $month2 = $_POST['month2'];
    $search2_set = true;
  }
}
$sql = $adminconnection->prepare("select Category_Name from `category` as c inner join(
    select Category_ID,sum(Quantity) as q from `cart_item`,`product_variant`,`product` 
    where `cart_item`.Variant_ID = `product_variant`.Variant_ID
    and `product_variant`.Product_ID = `product`.Product_ID 
    and Cart_ID in(
      select Cart_ID from `order`
        where year(Date_Of_Order) = ? and month(Date_Of_Order) = ?
    ) group by Category_ID order by q desc limit 1)
    as cid on cid.Category_ID = c.Category_ID;");
$sql->bind_param("ss", $year2, $month2);
$sql->execute();
$result = $sql->get_result();
$category  = $result->fetch_assoc();
if (empty($category)) {
  $search2_set = false;
}

// Time period with most interest to a product
$selected_product = '';
$search3_set = false;
if (isset($_POST['search3'])) {
  if (count($_POST) == 2) {
    $selected_product = $_POST['Product_ID'];
    $search3_set = true;
  }
}
$sql = $adminconnection->prepare("select count(Date_Of_Order) as count,
  year(Date_Of_Order) as year,
  month(Date_Of_Order) as month,
  extract(year_month from Date_Of_Order) as period
  from `order` where Cart_ID in(
    select Cart_ID from `cart_item` where Variant_ID in(
      select Variant_ID from `product_variant` where Product_ID = ?)
  ) group by period order by count desc limit 1;");
$sql->bind_param("s", $selected_product);
$sql->execute();
$result = $sql->get_result();
$time  = $result->fetch_assoc();
if (empty($time)) {
  $search3_set = false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecommerce</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-5">
    <div class="h1 text-start pb-5">Overview</div>

    <div class="row align-items-start gap-5 justify-content-between mb-5">


      <div class="col card text-black bg-light py-3">
        <div class="h4 caption-top text-start mb-4">Customer Order Report</div>
        <table class="table caption-top table-secondary table-bordered">
          <thead>
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Customer</th>
              <th scope="col">Order ID</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($customer_order_report as $report) : ?>
              <tr>
                <th><?php echo $report['Date_Of_Order']; ?></th>
                <td><?php echo $report['First_Name'] . ' ' . $report['Last_Name']; ?></td>
                <td><?php echo $report['Order_ID']; ?></td>
                <td><?php echo $report['Total_Value']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <div class="col">
        <div class="d-flex flex-column bd-highlight  text-start lead gap-2">
          <div class="p-3 bd-highlight card bg-light text-black d-flex flex-column gap-2">
            <div class="h4 mb-3">Product with most number of sales</div>
            <form class="form-inline" method="POST">
              <div class="d-flex flex-row gap-2">
                <div class="form-group">
                  <select class="form-select form-control" aria-label="Default select example" name="year1">
                    <option selected disabled>Select Year</option>
                    <?php for ($i = $min_year; $i <= $max_year; $i++) : ?>
                      <option value=<?php echo $i; ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-select form-control" aria-label="Default select example" name="month1">
                    <option selected disabled>Select Month</option>
                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                      <option value=<?php echo $i; ?>><?php echo $months[$i]; ?></option>
                    <?php endfor; ?>
                  </select>
                </div>
                <div class="form-group">
                  <button class="btn btn-warning" name="search1">Search</button>
                </div>
              </div>
            </form>
            <div>
              <?php if ($search1_set) : ?>
                <span><?php echo "$year1 $months[$month1] :" ?></span>
                <span class="text-warning fw-bold"><?php echo $product['Title']; ?></span>
              <?php else : ?>
                <span class="text-warning fw-bold"><?php echo 'No sales in the selected period!'; ?><span>
                  <?php endif; ?>
            </div>
          </div>

          <div class="d-flex flex-column bd-highlight mb-3 text-start lead gap-2">
            <div class="p-3 bd-highlight card bg-light text-black d-flex flex-column gap-2">
              <div class="h4 mb-3">Product category with most orders</div>
              <form class="form-inline" method="POST">
                <div class="d-flex flex-row gap-2">
                  <div class="form-group">
                    <select class="form-select form-control" aria-label="Default select example" name="year2">
                      <option selected disabled>Select Year</option>
                      <?php for ($i = $min_year; $i <= $max_year; $i++) : ?>
                        <option value=<?php echo $i; ?>><?php echo $i; ?></option>
                      <?php endfor; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="form-select form-control" aria-label="Default select example" name="month2">
                      <option selected disabled>Select Month</option>
                      <?php for ($i = 1; $i <= 12; $i++) : ?>
                        <option value=<?php echo $i; ?>><?php echo $months[$i]; ?></option>
                      <?php endfor; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-warning" name="search2">Search</button>
                  </div>
                </div>
              </form>
              <div>
                <?php if ($search2_set) : ?>
                  <span><?php echo "$year2 $months[$month2] :" ?></span>
                  <span class="text-warning fw-bold"><?php echo $category['Category_Name']; ?></span>
                <?php else : ?>
                  <span class="text-warning fw-bold"><?php echo 'No orders in the selected period!'; ?><span>
                    <?php endif; ?>
              </div>
            </div>

            <div class="p-3 bd-highlight card bg-light text-black d-flex flex-column gap-2">
              <div class="h4 mb-3">Time period with most interest to a product</div>
              <form class="form-inline" method="POST">
                <div class="d-flex flex-row gap-2">
                  <div class="form-group">
                    <select class="form-select" aria-label="Default select example" name="Product_ID">
                      <option selected disabled>Select Product</option>
                      <?php foreach ($products_dict as $key => $value) : ?>
                        <option value=<?php echo $key ?>><?php echo $value ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-warning" name="search3">Search</button>
                  </div>
                </div>
              </form>
              <div>
                <?php if ($search3_set) : ?>
                  <span><?php echo "{$products_dict[$selected_product]} :" ?></span>
                  <span class="text-warning fw-bold"><?php echo "{$time['year']} {$months[$time['month']]}"; ?></span>
                <?php else : ?>
                  <span class="text-warning fw-bold"><?php echo 'No interest for the selected product!'; ?><span>
                    <?php endif; ?>
              </div>
            </div>
          </div>
        </div>

        <div class="card text-black p-3 bg-light">
          <div class="h4 caption-top text-start mb-4">Quarterly Sales Report</div>
          <table class="table caption-top table-secondary table-bordered">
            <div class="d-flex flex-row">
              <form class="form-inline" method="POST">
                <div class="d-flex gap-3">
                  <div class="form-group">
                    <select class="form-select mb-3" aria-label="Default select example" name="year">
                      <option selected disabled>Select Year</option>
                      <?php for ($i = $min_year; $i <= $max_year; $i++) : ?>
                        <option value=<?php echo $i; ?>><?php echo $i; ?></option>
                      <?php endfor; ?>
                    </select>
                  </div>
                  <div class="form-group">

                    <select class="form-select mb-3" aria-label="Default select example" name="quarter">
                      <option selected disabled>Select Quarter</option>
                      <option value="1">First Quater</option>
                      <option value="2">Second Quater</option>
                      <option value="3">Third Quater</option>
                      <option value="4">Fourth Quater</option>
                    </select>
                  </div>
                </div>
                <div class="ms-3" class="form-group">
                  <button class="btn btn-warning" name="show">Show</button>
                </div>
              </form>
            </div>
            <?php if ($show_set) : ?>
              <thead>
                <tr>
                  <th scope="col">Product</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($sales_report as $record) : ?>
                  <tr>
                    <td><?php echo $record['Title']; ?></td>
                    <td><?php echo $record['Quantity']; ?></td>
                    <td><?php echo $record['Total']; ?></td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  <th>Total</th>
                  <th><?php echo $sum_Quantity; ?></th>
                  <th><?php echo number_format((float)$sum_Total, 2, '.', ''); ?></th>
                </tr>
              </tbody>
            <?php else : ?>
              <span class="text-warning fw-bold"><?php echo 'No available data for the selected period!'; ?><span>
                <?php endif; ?>
          </table>
        </div>
      </div>
    </div>




</body>

</html>