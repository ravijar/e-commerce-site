<?php 
include('../client/inc/header.php');
?>


<body>
  <div class="container">
    <div class="row align-items-start g-5 align-items-start">
  
      <div class="col-md-6">
        <div class=" login my-5">
          <div class="card py-3 px-3">
            <h2 class="text-primary text-start">User Log In</h2>
            <form action="CheckoutPage.php" method="post" class="px-4 py-3 text-start">
              <div class="mb-3">
                <label for="exampleDropdownFormEmail1" class="form-label"
                  >User Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleDropdownFormEmail1"
                  placeholder="Username"
                  name="user_username"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="exampleDropdownFormPassword1" class="form-label"
                  >Password</label
                >
                <input
                  type="password"
                  class="form-control"
                  id="exampleDropdownFormPassword1"
                  placeholder="Password"
                  name="user_password"
                  required
                />
              </div>
              <div class="mb-3"></div>
              <input type = "submit" value="Sign in" class="btn btn-primary" name="user_login">
            </form>
            <p class="dropdown-item"
              >Don't have an account ? <a href="CreateAcc.php">Create Account</a></p
            >
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class=" login my-5">
          <div class="card py-3 px-3">
            <h2 class="text-primary text-start">Guest Log In</h2>
            <form action="CheckoutPage.php" method="post" class="px-4 py-3 text-start">
              <div class="mb-3">
                <label for="exampleDropdownFormEmail1" class="form-label"
                  >Telephone No.</label
                >
                <input
                  type="text"
                  class="form-control"
                  id="exampleDropdownFormEmail1"
                  placeholder="Telephone"
                  name="guest_contact"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="exampleDropdownFormEmail1" class="form-label"
                  >Street Address</label
                >
                <input
                  type="text"
                  class="form-control"
                  id="exampleDropdownFormEmail1"
                  placeholder="Street Address"
                  name="guest_address"
                  required
                />
              </div>

              <div class="mb-3">
                <label for="exampleDropdownFormEmail1" class="form-label">City</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleDropdownFormEmail1"
                  placeholder="City"
                  name="guest_city"
                  required
                />
              </div>

              <div class="mb-3"></div>
              <input type = "submit" value="Sign in" class="btn btn-primary" name="guest_login">
            </form>
  
          </div>
        </div>
      </div>  
    </div>
    </div>
<?php 
  include('../client/inc/footer.php');
?>

