<?php 
include('../client/inc/header.php');
?>

<body>


  <div class="createAcc d-flex justify-content-around my-5">
    <div class="card py-3 px-3 w-50">
      <h2 class="text-primary">Create Account</h2>

      <form action="" method="post" class="px-4 py-3 text-start">
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

<?php

if(isset($_POST['user_register'])){
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $user_confirm_password = $_POST['user_confirm_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_contact = $_POST['user_contact'];
    $user_address = $_POST['user_address'];
    $user_city = $_POST['user_city'];

    //select query

    $select_query = "Select * from user where User_name='$user_username'";
    $result = mysqli_query($adminconnection, $select_query);
    $row_count = mysqli_num_rows($result);
    if($row_count>0){
      echo "<script>alert('Username already exists.')</script>"; 
    }
    else if($user_password != $user_confirm_password){
      echo "<script>alert('Passwords do not match.')</script>";
    }
    else{
      //insert query
      $insert_query = "insert into user (User_Name, Password, First_Name, Last_Name, Telephone_No, Street_Address,
      City) values ('$user_username', '$hash_password', '$user_firstname', '$user_lastname', '$user_contact',
      '$user_address', '$user_city')";
      
      $sql_execute = mysqli_query($adminconnection, $insert_query);
      if($sql_execute){
        echo "<script>alert('Data inserted successfully.')</script>";
      }else{
        die(mysqli_error($adminconnection));	
      }
    }

}

?>


