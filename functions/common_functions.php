<?php
// including database connection file
include('../Database/DatabaseConnection.php');

//getting products and displaying products in home page
function get_products(){
    global $adminconnection;

    // checking whether the category is set or not
    if(!isset($_GET['category'])){

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

      echo "
      <div class='card card-main'>
      
          <img src='../Admin/Product_Images/$Image' class='card-img-top' alt='$Title'>
         
        <div class='card-body'>
          
          <!-- <p class='card-text text-start'>
            Some quick example text to build on the card title and make up
            the bulk of the card's content.
          </p> -->
          

      </div>
      <div class='col-md-12 text-center'>
      <div class='card-footer'>
      <h5 class='card-title'>$Title</h5>
      <button class='btn btn-secondary'>View More</button>
</div>
</div>
      
    </div>";

    }    
}
}

// getting unique category
function get_unique_category(){
    global $adminconnection;

    // checking whether the category is set or not
    if(isset($_GET['category'])){
        $category_id = $_GET['category'];
    $select_products = "Select * from product where Category_ID = $category_id";
    $result_products = mysqli_query($adminconnection, $select_products);
    $row_count = mysqli_num_rows($result_products);
    if($row_count==0){
        echo "<h2 class='text-danger'>Stocks are unavailable.</h2>";
    }
    while($row_data = mysqli_fetch_assoc($result_products)){
      $Product_ID = $row_data['Product_ID'];
      $SKU = $row_data['SKU'];
      $Title = $row_data['Title'];
      $Weight = $row_data['Weight'];
      $Category_ID = $row_data['Category_ID'];
      $Subcategory_ID = $row_data['Subcategory_ID'];
      $Image = $row_data['Image'];

      echo "
      <div class='card card-main'>
      
          <img src='../Admin/Product_Images/$Image' class='card-img-top' alt='$Title'>
         
        <div class='card-body'>
          
          <!-- <p class='card-text text-start'>
            Some quick example text to build on the card title and make up
            the bulk of the card's content.
          </p> -->
          

      </div>
      <div class='col-md-12 text-center'>
      <div class='card-footer'>
      <h5 class='card-title'>$Title</h5>
      <button class='btn btn-secondary'>View More</button>
</div>
</div>
      
    </div>";

    }    
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
      echo "<li><a href='index.php?category=$category_id' class='dropdown-item'>$category_name</a></li>";
    }
}
?>