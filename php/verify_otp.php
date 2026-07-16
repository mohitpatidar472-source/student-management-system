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

body{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    background:#f4f6f9;
    padding:20px;
}

.container{
    width:100%;
    max-width:420px;
    background:#fff;
    padding:30px;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,.1);
}

h2{
    text-align:center;
    color:#333;
    margin-bottom:15px;
}

.info{
    text-align:center;
    color:#555;
    margin-bottom:20px;
    line-height:1.5;
    word-break:break-word;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#555;
}

input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:16px;
    margin-bottom:20px;
    outline:none;
    transition:.3s;
}

input:focus{
    border-color:#0d6efd;
    box-shadow:0 0 5px rgba(13,110,253,.25);
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:6px;
    background:#0d6efd;
    color:#fff;
    font-size:16px;
    cursor:pointer;
    transition:.3s;
}

button:hover{
    background:#0b5ed7;
}

.error{
    background:#ffe5e5;
    color:#d10000;
    padding:10px;
    border-radius:5px;
    margin-bottom:20px;
    text-align:center;
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