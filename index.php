<?php
session_start();
$conn = new mysqli("localhost","root","","login");
$msg="";
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password =$_POST['password'];
    $password = sha1($password);
    $userType =$_POST['userType'];
    
    $sql = "SELECT * FROM users WHERE username=? AND password=? AND user_type=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss",$username,$password,$userType);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc(); 
    
    session_regenerate_id();
    $_SESSION['username'] = $row['username'];
    $_SESSION['role']= $row['user_type'];
    session_write_close();
    if($result->num_rows ==1 && $_SESSION['role']=="Employee"){
       header("location:Employee.php");
    }
    else if($result->num_rows ==1 && $_SESSION['role']=="Boss"){
    header("location:Boss.php");
    }
    else if($result->num_rows ==1 && $_SESSION['role']=="admin"){
       header("location:admin.php");
    }else{
       $msg = "username or passsword is incorrect";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body class="bg-dark">
   <div class="container">
   <div class="row justify-content-center">
   <div class="col-lg-5 bg-light mt-5 px-0">
   <h3 class="text-center text-light bg-danger p-3">user login system</h3>
   <form action="<?= $_SERVER['PHP_SELF']?>" method="post" class="p-4">
   
   <div class="form-group">
   <input type="text" name="username" class="form-control form-control-lg" placeholder="username" required>
   </div>
    
   <div class="form-group">
   <input type="password" name="password" class="form-control form-control-lg" placeholder="password" required>
   </div>
   <div class="form-group"> 
   <label for="userType">I,m a</label>
   <input type="radio" name="userType" value="Employee" 
   class="custom-radio" required>&nbsp;Employee |
      <input type="radio" name="userType" value="Boss" 
   class="custom-radio" required>&nbsp; Boss|
   <input type="radio" name="userType" value="admin" 
   class="custom-radio" required>&nbsp;admin |
   </div>
   <div class="form-group">
   <input type="submit" name="login" class="btn btn-danger btn-block">
   </div>
   <h5 class="text-danger text-center"><?= $msg;?></h5>
   </form>
   </div>
   </div>
   </div>    
</body>
</html>