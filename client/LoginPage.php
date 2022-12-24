<?php include('../Database/DatabaseConnection.php');?>

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
  <div class="container">
    <div class="row align-items-start g-5 align-items-start">
  
      <div class="col-md-6">
        <div class=" login my-5">
          <div class="card py-3 px-3">
            <h2 class="text-primary text-start">User Log In</h2>
            <form action="" method="post" class="px-4 py-3 text-start">
              <div class="mb-3">
                <label for="exampleDropdownFormEmail1" class="form-label"
                  >User Name</label>
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
            <form action="" method="post" class="px-4 py-3 text-start">
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
</body>
</html>

<?php

if(isset($_POST['user_login'])){
  $user_username = $_POST['user_username'];
  $user_password = $_POST['user_password'];

  $select_query = "Select * from user where User_Name = '$user_username'";
  $result = mysqli_query($adminconnection, $select_query);
  $row_count = mysqli_num_rows($result);
  $row_data = mysqli_fetch_assoc($result);
  if($row_count>0){
    if(password_verify($user_password, $row_data['Password'])){
      echo "<script>alert('Login successful.')</script>";
    }else{
      echo "<script>alert('Invalid Credentails.')</script>"; 
    }
  }else{
    echo "<script>alert('Invalid Credentails.')</script>"; 
  }
}

if(isset($_POST['guest_login'])){
  $guest_contact = $_POST['guest_contact'];
  $guest_address = $_POST['guest_address'];
  $guest_city = $_POST['guest_city'];


  //insert query
  $insert_query = "insert into guest (Telephone_No, Street_Address, City) values
   ('$guest_contact', '$guest_address', '$guest_city')";
  
  $sql_execute = mysqli_query($adminconnection, $insert_query);
  if(!$sql_execute){
    die(mysqli_error($adminconnection));	
  }
}
?>