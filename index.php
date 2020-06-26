<?php

// Get a key from https://www.google.com/recaptcha/admin/create
$publicKey = '';
$secretKey = '';

if(!empty($_POST['g-recaptcha-response']) && !empty($_POST['username']) && !empty($_POST['password'])){
    $RetornaCaptcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $_POST['g-recaptcha-response']));
    if($RetornaCaptcha->success){
        if($_POST['username'] == "test" && $_POST['password'] == "test123"){
        
            // Go to the restricted area
            include('success.php');
            exit();
    
        } else {

            // Error message to display above the form
            $msg = 'Username and/or password incorrect. Try again!';
        
        }
    } else {
        $msg = 'The reCAPTCHA is incorrect. Try again!';

    }
} else if(!empty($_POST)) {
    if(empty($_POST['g-recaptcha-response'])){
        $msg .= 'Please solve the reCAPTCHA<br />';
    }
    if(empty($_POST['password']) || empty($_POST['password'])){
        $msg .= 'Username and password required';
    }

}

include('form.php');

?>