<?php 
include('../client/inc/header.php');
include('../functions/common_functions.php');
?>

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
                  get_categories();
                ?>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <div class="card-group">
        <?php
          get_products();
          get_unique_category();
        ?>
        
        

        
    </div>
  </div>
</body>
</html>