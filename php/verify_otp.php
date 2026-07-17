<?php
// verify_otp.php -- Step 3: User yahan OTP enter karega
session_start();

// Agar email session me nahi hai to seedha forgot_email.php par bhej do
if (!isset($_SESSION['reset_email'])) {
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
    font-family:Arial, Helvetica, sans-serif;
}
 

@media (max-width:480px){

    .container{
        padding:20px;
    }

    h2{
        font-size:24px;
    }

    .info{
        font-size:14px;
    }

    input,
    button{
        font-size:15px;
    }
}

</style>


    <title>Verify OTP</title>
</head>
<body>

    <h2>Enter OTP</h2>
    <p>OTP aapke email <b><?php echo htmlspecialchars($_SESSION['reset_email']); ?></b> par bheja gaya hai.</p>

    <?php
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>

    <form action="check_otp.php" method="POST">
        <label>Enter OTP:</label><br>
        <input type="text" name="otp" maxlength="6" required><br><br>
        <button type="submit">Verify OTP</button>
    </form>

</body>
</html>