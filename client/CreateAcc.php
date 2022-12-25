<?php 
include('../client/inc/header.php');
?>

<body>


  <div class="createAcc d-flex justify-content-around my-5">
    <div class="card py-3 px-3 w-50">
      <h2 class="text-primary">Create Account</h2>

      <form action="LoginPage.php" method="post" class="px-4 py-3 text-start">
        <div class="mb-3">
          <label for="exampleDropdownFormEmail1" class="form-label"
            >User Name</label
          >
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

        <div class="mb-3">
          <label for="exampleDropdownFormPassword1" class="form-label"
            >Confirm Password</label
          >
          <input
            type="password"
            class="form-control"
            id="exampleDropdownFormPassword1"
            placeholder="Password"
            name="user_confirm_password"
            required
          />
        </div>

        <div class="mb-3">
          <label for="exampleDropdownFormEmail1" class="form-label"
            >First Name</label
          >
          <input
            type="text"
            class="form-control"
            id="exampleDropdownFormEmail1"
            placeholder="First Name"
            name="user_firstname"
            required
          />
        </div>

        <div class="mb-3">
          <label for="exampleDropdownFormEmail1" class="form-label"
            >Last Name</label
          >
          <input
            type="text"
            class="form-control"
            id="exampleDropdownFormEmail1"
            placeholder="Last Name"
            name="user_lastname"
            required
          />
        </div>
 
        <div class="mb-3">
          <label for="exampleDropdownFormEmail1" class="form-label"
            >Telephone No.</label
          >
          <input
            type="text"
            class="form-control"
            id="exampleDropdownFormEmail1"
            placeholder="Telephone"
            name="user_contact"
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
            name="user_address"
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
            name="user_city"
            required
          />
        </div>


        <input type = "submit" value="Create Account" class="btn btn-primary" name="user_register">
        
      </form>
      <p class="dropdown-item"
      >Already have an account ? <a href="LoginPage.php">Log in</a></p
    >
    </div>
  </div>
<?php 
  include('../client/inc/footer.php');
?>




