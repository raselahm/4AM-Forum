<?php session_start();

if (isset($_POST['email'], $_POST['pass'])) {

    // get values passed in from loginpage.php
    $email = $_POST['email'];
    $password = $_POST['pass'];

    //checks if valid buffalo.edu email, display message if not
    require_once 'validate.php';
    $validate_email = new validate_email();
    if (!($validate_email->validate_by_domain($email))) {
        $_SESSION['message']="Email must be of the domain @buffalo.edu";
        header('location:loginpage.php');
        exit();
    }

    //query database for email and login
    include('conn.php');
    $query = mysqli_query($conn,"select * from `users` where email = '$email'");
    $numrows = mysqli_num_rows($query);
    $data = mysqli_fetch_array($query);

    //check we got data, display message if not
    if ($numrows==0){
        $_SESSION['message']="Email or password incorrect";
        header('location:loginpage.php');
        exit();

    }else{
        if (password_verify($password, $data['password']) == 1) {
            //create session variable based on user id
            $_SESSION['id'] = $data['id'];
            header('location:homepage.php');
            exit();
        }else {
            $_SESSION['message'] = "Email or password incorrect";
            header('location:loginpage.php');
            exit();
        }

    }

}
else{
    $_SESSION['message'] = "Error processing submitted form";
    header('location:loginpage.php');
}