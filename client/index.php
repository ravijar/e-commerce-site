<?php include('../Database/DatabaseConnection.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>
<body>
  <div>
    <nav class="navbar navbar-dark navbar-expand bg-dark p-2">
      <div class="container-fluid px-3">
        <a href="" class="navbar-brand" 
          ><span class="mb-0 h1">My Shop</span></a
        >
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto me-5">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdownMenuLink"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Categories
              </a>
              <ul
                class="dropdown-menu"
                aria-labelledby="navbarDropdownMenuLink"
              >
              
                <?php

                $select_categories = "Select * from category";
                $result_categories = mysqli_query($adminconnection, $select_categories);
                while($row_data = mysqli_fetch_assoc($result_categories)){
                  $category_name = $row_data['Category_Name'];
                  $category_id = $row_data['Category_ID'];
                  echo "<li><a href='index.php?category=$category_id' class='dropdown-item'>$category_name</a></li>";
                }
                ?>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <div class="card-group">
        <!-- fetching products -->
        <?php
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

            // echo $Image;
          }
        ?>
        
        

        
    </div>
  </div>
</body>
</html>