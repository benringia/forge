<?php require_once 'init.php'?>

<?php 


    redirect('index.php') ?: $session -> is_signed_in();


    if(isset($_POST['submit'])) {

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

    }

    //method to chech db user

    $user_found = User::verify_user($username, $password);

    if($user_found) {
        
        $session -> login($user_found);
        redirect('index.php');

    } else {

        $message = "Invalid Password or Username";

    } else {

        $username = '';
        $password = '';
    }


?>