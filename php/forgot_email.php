<?php
// forgot_email.php -- Step 1: User apna registered email daalega
session_start();
?>
<!DOCTYPE html>
<html>
<head>

<style>
    *{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    background:#f5f5f5;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

.container{
    width:100%;
    max-width:400px;
    background:#fff;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 15px rgba(0,0,0,.15);
}

h2{
    text-align:center;
    margin-bottom:20px;
    color:#333;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:bold;
    color:#555;
}

input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:16px;
    outline:none;
    margin-bottom:20px;
}

input:focus{
    border-color:#007bff;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:6px;
    background:#007bff;
    color:#fff;
    font-size:16px;
    cursor:pointer;
    transition:.3s;
}

button:hover{
    background:#0056b3;
}

.error{
    color:red;
    margin-bottom:15px;
    text-align:center;
}

@media (max-width:480px){

    .container{
        width:90%;
        padding:20px;
    }

    h2{
        font-size:24px;
    }

    input,
    button{
        font-size:15px;
    }
}
</style>




    <title>Forget Password</title>
</head>
<body>

<div class="container">

<h2>Forget Password</h2>

<?php
if (isset($_SESSION['error'])) {
    echo "<p class='error'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
?>

<form action="send_otp.php" method="POST">

<label>Registered Email:</label>

<input type="email" name="email" placeholder="Enter your email" required>

<button type="submit">Send OTP</button>

</form>

</div>

</body>
</html>