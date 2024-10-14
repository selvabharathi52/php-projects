<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href= "style.css">
</head>
<body>
    <div class="container">
    <?php
if (isset($_POST["submit"])) {
$fullName = $_POST["fullname"];
$email = $_POST["email"];
$password = $_POST["password"];
$passwordRepeat = $_POST["repeat_password"];
$errors = array();
if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
array_push($errors, "All fields are required");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
array_push($errors, "Email is not valid");
}
if (strlen($password) <8) {
array_push($errors, "Password must be at least 8 charactes long");
}
if ($password!== $passwordRepeat) {
array_push($errors, "Password does not match");
}

if (count($errors)>0) {
    foreach ($errors as $error) {
    echo "<div class='alert alert-danger'>$error</div>";
    } 
   
}else{
    require_once "database.php";
    $sql = "INSERT INTO users (full_name, email, password) VALUES ( ?, ?, ? )";
$stmt = mysqli_stmt_init($conn);
$prepareStmt = mysqli_stmt_prepare($stmt, $sql);
if ($prepareStmt) {
mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $password);
mysqli_stmt_execute($stmt);
echo "<div class='alert alert-success'>You are registered successfully.</div>";
}else{
die("Something went wrong");
}
}
}
?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" name="fullname" class="form-control" placeholder="Full Name:">
</div>
<div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email:">
</div>
<div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password:">
</div>
<div class="form-group">
                <input type="text" name="repeat_password" class="form-control" placeholder="Repeat_Password:">
</div>
<div class="form-group">
                <input type="submit" value="Register"class="btn btn-primary" name="submit">
</div>
</form>
</body>
</html>