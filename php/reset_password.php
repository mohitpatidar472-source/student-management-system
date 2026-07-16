<?php
// reset_password.php -- Step 5: OTP verify hone ke baad new password set karne ka form
session_start();

// Direct access rokne ke liye - agar OTP verify nahi hua to allow mat karo
if (!isset($_SESSION['otp_verified']) || !isset($_SESSION['reset_email'])) {
    header("Location: forgot_email.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:linear-gradient(135deg,#4f46e5,#0ea5e9);
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

.container{
    width:400px;
    background:#fff;
    padding:35px;
    border-radius:15px;
    box-shadow:0 15px 30px rgba(0,0,0,.2);
}

h2{
    text-align:center;
    margin-bottom:30px;
    color:#222;
}

.input-box{
    margin-bottom:20px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
}

input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:15px;
}

input:focus{
    border-color:#4f46e5;
    outline:none;
}

button{
    width:100%;
    padding:13px;
    background:#4f46e5;
    color:#fff;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
    font-weight:600;
}

button:hover{
    background:#3730a3;
}

.error{
    background:#ffe8e8;
    color:red;
    padding:10px;
    margin-bottom:20px;
    border-radius:6px;
}
    
</style>

    <title>Reset Password</title>
</head>
<body>

<div class="container">

    <h2>Set New Password</h2>

    <?php
    if (isset($_SESSION['error'])) {
        echo "<div class='error'>".$_SESSION['error']."</div>";
        unset($_SESSION['error']);
    }
    ?>

    <form action="update_password.php" method="POST">

        <div class="input-box">
            <label>New Password</label>
            <input type="password" name="new_password" placeholder="Enter New Password" required>
        </div>

        <div class="input-box">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        </div>

        <button type="submit">Update Password</button>

    </form>

</div>

</body>
</html>