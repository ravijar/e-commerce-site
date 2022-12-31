<?php
// including database connection file
include('../Database/DatabaseConnection.php');

//getting products and displaying products in home page
function get_products(){
    global $adminconnection;

    // checking whether the category is set or not
    if(!isset($_GET['category'])){
      echo"<div class='mt-5 container'>
      <div class='row g-4'>";
    $select_products = "Select * from product order by rand() limit 0,9";
    $result_products = mysqli_query($adminconnection, $select_products);
    while($row_data = mysqli_fetch_assoc($result_products)){
      $Product_ID = $row_data['Product_ID'];
      $SKU = $row_data['SKU'];
      $Title = $row_data['Title'];
      $Weight = $row_data['Weight'];
      $Category_ID = $row_data['Category_ID'];
      $Subcategory_ID = $row_data['Subcategory_ID'];
      $Image = $row_data['Image'];
      
      echo "<div class='col-lg-3 col-md-6'>
      <div class='card py-2 bg-dark text-light text-center'>
      <div class='card-title h3'>$Title</div>
    <img
      src='../Admin/Product_Images/$Image'
      class='card-img-top img-fluid'
    />
    <div class='card-body'>
      <div class='card-title h4 mb-3'>500 LKR</div>
      <a
        href='../client/ProductPage.php?product_id=$Product_ID'
        class='btn btn-secondary'
        >View More</a
      >
    </div>
    </div>
    </div>";

    
  }
  echo"</div>
  </div>";    
}
}

// getting unique category
function get_unique_category(){
    global $adminconnection;

    // checking whether the category is set or not
    if(isset($_GET['category'])){
      echo"<div class='mt-5 container'>
      <div class='row g-4'>";
        $category_id = $_GET['category'];
    $select_category_name = "Select Category_Name from category where Category_ID = $category_id"; 
    $result_category_name = mysqli_query($adminconnection, $select_category_name); 
    while($row_data = mysqli_fetch_assoc($result_category_name)){
      $category_name = $row_data['Category_Name'];
    }  
    
    $select_products = "Select * from product where Category_ID = $category_id";
    $result_products = mysqli_query($adminconnection, $select_products);
    $row_count = mysqli_num_rows($result_products);
    echo "<div class='text-primary h5 fw-bold text-start py-1'>$category_name</div>";
    if($row_count==0){
        echo "<h2 class='text-danger'>Stocks are unavailable.</h2>";
    }
    else{
      
      while($row_data = mysqli_fetch_assoc($result_products)){
        $Product_ID = $row_data['Product_ID'];
        $SKU = $row_data['SKU'];
        $Title = $row_data['Title'];
        $Weight = $row_data['Weight'];
        $Category_ID = $row_data['Category_ID'];
        $Subcategory_ID = $row_data['Subcategory_ID'];
        $Image = $row_data['Image'];
        
        echo "<div class='col-lg-3 col-md-6'>
        <div class='card py-2 bg-dark text-light text-center'>
        <div class='card-title h3'>$Title</div>
      <img
        src='../Admin/Product_Images/$Image'
        class='card-img-top img-fluid'
      />
      <div class='card-body'>
        <div class='card-title h4 mb-3'>500 LKR</div>
        <a
          href='../client/ProductPage.php?product_id=$Product_ID'
          class='btn btn-secondary'
          >View More</a
        >
      </div>
      </div>
      </div>";
  
      }  
      
    }
    echo"</div>
    </div>";  
     
}
}
// getting categories from database and display categories in drop down menu in home page
function get_categories(){
    global $adminconnection;
    $select_categories = "Select * from category";
    $result_categories = mysqli_query($adminconnection, $select_categories);
    while($row_data = mysqli_fetch_assoc($result_categories)){
      $category_name = $row_data['Category_Name'];
      $category_id = $row_data['Category_ID'];
      echo "<li><a href='ProductsPage.php?category=$category_id' class='dropdown-item'>$category_name</a></li>";
    }
}


function    view_product_details(){
  global $adminconnection;

  // checking whether the category is set or not
  if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $select_products = "Select * from product where Product_ID=$product_id";
    $result_products = mysqli_query($adminconnection, $select_products);
    while($row_data = mysqli_fetch_assoc($result_products)){
      $Product_ID = $row_data['Product_ID'];
      $SKU = $row_data['SKU'];
      $Title = $row_data['Title'];
      $Weight = $row_data['Weight'];
      $Category_ID = $row_data['Category_ID'];
      $Subcategory_ID = $row_data['Subcategory_ID'];
      $Image = $row_data['Image'];

    echo " <div class='container mt-5'>
    <section class='py-5 mb-5 bg-light text-dark' id='info'>
      <div class='container'>
        <div class='row justify-content-around align-items-start'>
          <div class='col-d col-4'>
            <img
              src='../Admin/Product_Images/$Image'
              alt=''
              class='w-75'
            />
          </div>
          <div class='col-d col-6 text-start d-flex flex-column'>
            <h2 class='mb-4'>$Title</h2>
            <div class='lead'>Product Description:</div>
            <p class='mb-4'>
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque
              maxime labore deserunt quasi at autem natus veritatis quia
              voluptas nam!
            </p>
    
            <div class='mb-3 row'>
              <div class='lead col'>Select Variant:</div>
              <div class='list-group p-4 pt-2'>

            ";
          }
          $iteration = 0;
          $select_varients = "Select * from product_variant, variant where product_variant.Variant_ID = variant.Varient_ID AND Product_ID=$product_id";
          $result_varients = mysqli_query($adminconnection, $select_varients);
          
          while($row_data = mysqli_fetch_assoc($result_varients)){
            $Varient_ID = $row_data['Variant_ID'];
            $Attribute = $row_data['Attribute'];
            $Value = $row_data['Value'];
            if($iteration==0){
              echo "<a
              href='#'
              class='list-group-item list-group-item-action'
              data-bs-toggle='list'
              id='variant1'
            >
              <div class='d-flex w-100 justify-content-between'>
                <div>
                <div class='mb-1'>$Attribute: $Value</div>";
                $iteration+=1;
            }
            elseif($iteration==1){
              echo "<div class='mb-1'>$Attribute: $Value</div>";
              $iteration+=1;
            }
            elseif($Attribute=='ZPrice'){
                echo "</div>
                <span class='lead'>$Value LKR</span>
              </div>
            </a>";
            $iteration=0;
            }

          }
  echo "          </div>
  </div>
  <div class='ms-auto me-4'>
    <a href='CartPage.php' class='btn btn-primary'>Add to Cart</a>
  </div>
</div>
</div>
</div>
</section>
</div> ";

  

  
}  
}

/*<!-- <div class="container mt-5">
<section class="py-5 mb-5 bg-light text-dark" id="info">
  <div class="container">
    <div class="row justify-content-around align-items-start">
      <div class="col-d col-4">
        <img
          src="../Admin/Product_Images/$Image"
          alt=""
          class="w-75"
        />
      </div>
      <div class="col-d col-6 text-start d-flex flex-column">
        <h2 class="mb-4">$Title</h2>
        <div class="lead">Product Description:</div>
        <p class="mb-4">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque
          maxime labore deserunt quasi at autem natus veritatis quia
          voluptas nam!
        </p>

        <div class="mb-3 row">
          <div class="lead col">Select Variant:</div>
          <div class="list-group p-4 pt-2">
            <a
              href="#"
              class="list-group-item list-group-item-action"
              data-bs-toggle="list"
              id="variant1"
            >
              <div class="d-flex w-100 justify-content-between">
                <div>
                if()
                  <div class="mb-1">Storage:</div>
                  <div class="mb-1">Color:</div>
                </div>
                <span class="lead">500 LKR</span>
              </div>
            </a>
            <a
              href="#"
              class="list-group-item list-group-item-action"
              data-bs-toggle="list"
              id="variant2"
            >
              <div class="d-flex w-100 justify-content-between">
                <div>
                  <div class="mb-1">Storage:</div>
                  <div class="mb-1">Color:</div>
                </div>
                <span class="lead">1000 LKR</span>
              </div>
            </a>
            <a
              href="#"
              class="list-group-item list-group-item-action"
              data-bs-toggle="list"
              id="variant2"
            >
              <div class="d-flex w-100 justify-content-between">
                <div>
                  <div class="mb-1">Storage:</div>
                  <div class="mb-1">Color:</div>
                </div>
                <span class="lead">1000 LKR</span>
              </div>
            </a>
          </div>
        </div>
        <div class="ms-auto me-4">
          <a href="#" class="btn btn-primary">Add to Cart</a>
        </div>
      </div>
    </div>
  </div>
</section>
</div> -->*/
/*
function    view_product_details(){
  global $adminconnection;

  // checking whether the category is set or not
  if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $select_products = "Select * from product where Product_ID=$product_id";
    $result_products = mysqli_query($adminconnection, $select_products);
    while($row_data = mysqli_fetch_assoc($result_products)){
      $Product_ID = $row_data['Product_ID'];
      $SKU = $row_data['SKU'];
      $Title = $row_data['Title'];
      $Weight = $row_data['Weight'];
      $Category_ID = $row_data['Category_ID'];
      $Subcategory_ID = $row_data['Subcategory_ID'];
      $Image = $row_data['Image'];

    echo " <div class='container mt-5'>
    <section class='p-5 bg-light text-dark' id='info'>
      <div class='container'>
        <div class='row justify-content-between align-items-start'>
          <div class='col-md'>
          <img src='../Admin/Product_Images/$Image'
              alt=''
              class='w-75'
            />
          </div>
          <div class='col-md text-start'>
            <h2 class='mb-5'>$Title</h2>
            
            <p class='lead mb-1'>Product Description:</p>
            <p class=''>
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque
              maxime labore deserunt quasi at autem natus veritatis quia
              voluptas nam!
            </p>

            ";
          }
          $select_varients = "Select * from product_variant, variant where product_variant.Variant_ID = variant.Varient_ID AND Product_ID=$product_id";
          $result_varients = mysqli_query($adminconnection, $select_varients);
          $prev_Attribute = '';
          while($row_data = mysqli_fetch_assoc($result_varients)){
            $Varient_ID = $row_data['Variant_ID'];
            $Attribute = $row_data['Attribute'];
            $Value = $row_data['Value'];
            if($prev_Attribute==''){
              echo"<p class='lead mb-1'>$Attribute</p>
              <select required
              class='form-select mb-3'
              aria-label='Default select example'
              >
              <option value=''>Select $Attribute</option>
              <option value=$Varient_ID>$Value</option>
              }";
              $prev_Attribute = $Attribute;
            }
            elseif($Attribute != $prev_Attribute){
              echo"</select><p class='lead mb-1'>$Attribute</p>
                <select required
                class='form-select mb-3'
                aria-label='Default select example'
                >
                <option value=''>Select $Attribute</option>
                <option value=$Varient_ID>$Value</option>
                }";
                $prev_Attribute = $Attribute;
              }
              else{
                echo"<option value=$Varient_ID>$Value</option>";
              }

          }
  echo "</select><a href='CartPage.php' class='btn btn-secondary mt-3'>Add to Cart</a>
  </div>
</div>
</div>
</section>
</div> ";

  

  
}  
}
*/
