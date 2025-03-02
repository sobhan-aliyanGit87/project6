<?php
session_start();

// اطلاعات دیتابیس
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management"; // نام دیتابیس 

// اتصال به دیتابیس
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("خطا در اتصال به دیتابیس: " . $conn->connect_error);
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $user_username = trim($_POST['username']);
    $user_password = trim($_POST['password']);
    if ($action == 'signup') {
        $user_email = trim($_POST['email']);
        $confirm_password = trim($_POST['confirm_password']);
        
        if ($user_password !== $confirm_password) {
            $message = "رمز عبور و تایید رمز عبور باید یکسان باشند.";
        } else {
            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT);
            $sql = "SELECT * FROM users WHERE username = '$user_username' OR email = '$user_email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $message = "این نام کاربری یا ایمیل قبلاً ثبت شده است.";
            } else {
                $sql = "INSERT INTO users (username, email, password) VALUES ('$user_username', '$user_email', '$hashed_password')";
                if ($conn->query($sql) === TRUE) {
                    $message = "ثبت‌نام موفقیت‌آمیز بود. لطفاً وارد شوید.";
                } else {
                    $message = "خطا در ثبت‌نام: " . $conn->error;
                }
            }
        }
    } elseif ($action == 'login') {
        $sql = "SELECT * FROM users WHERE username = '$user_username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($user_password, $user['password'])) {
                $_SESSION['username'] = $user_username;
                header("Location: index.php");
                exit;
            } else {
                $message = "رمز عبور اشتباه است.";
            }
        } else {
            $message = "کاربری با این مشخصات یافت نشد.";
        }
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود و ثبت‌نام</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- CDN FontAwesome -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: url('22.webp') no-repeat center center fixed;
            background-size: cover;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 50px 60px;
            border-radius: 20px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.5);
            width: 400px;
            text-align: center;
            transform: scale(1);
            animation: scaleIn 0.5s ease-out;
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        }

        .header {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #ffffff;
            letter-spacing: 1px;
        }

        .message {
            color: #ff4d4d;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .form-input {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            border-radius: 12px;
            border: 2px solid #ddd;
            font-size: 16px;
            outline: none;
            background: #fff;
            color: #333;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #007bff;
            box-shadow: 0 0 12px rgba(0, 123, 255, 0.6);
        }

        .form-button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            font-weight: 600;
            font-size: 18px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .form-button:hover {
            transform: translateY(-5px);
            background: linear-gradient(45deg, #2575fc 0%, #6a11cb 100%);
        }

        .form-link {
            margin-top: 15px;
            font-size: 16px;
        }

        .form-link a {
            color: #007bff;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .form-link a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        #signup-form {
            display: none;
        }

        .eye-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
            cursor: pointer;
            font-size: 22px;
        }

        .eye-icon-slash {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
            cursor: pointer;
            font-size: 22px;
        }

        .password-container {
            position: relative;
        }

        @media (max-width: 600px) {
            .container {
                width: 90%;
                padding: 40px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">ورود / ثبت‌نام</div>

        <div class="message"><?php echo $message; ?></div>

        <?php if (!isset($_SESSION['username'])): ?>
            <form method="POST">
                <input type="hidden" name="action" value="login">
                <input type="text" name="username" class="form-input" placeholder="نام کاربری" required>
                <div class="password-container">
                    <input type="password" name="password" id="login-password" class="form-input" placeholder="رمز عبور" required>
                    <i class="fas fa-eye eye-icon" id="toggle-login-password"></i>
                </div>
                <button type="submit" class="form-button">ورود</button>
            </form>
            
            <div class="form-link">
                <a href="#" id="show-signup">ثبت‌نام</a>
            </div>

            <div class="form-link">
                <a href="#">فراموشی رمز عبور</a>
            </div>

        <?php else: ?>
            <div class="form-link">
                <p>خوش آمدید, <?php echo $_SESSION['username']; ?>!</p>
                <a href="?logout=true">خروج</a>
            </div>
        <?php endif; ?>

        <!-- فرم ثبت‌نام -->
        <div id="signup-form">
            <form method="POST">
                <input type="hidden" name="action" value="signup">
                <input type="text" name="username" class="form-input" placeholder="نام کاربری" required>
                <input type="email" name="email" class="form-input" placeholder="ایمیل" required>
                <div class="password-container">
                    <input type="password" name="password" id="signup-password" class="form-input" placeholder="رمز عبور" required>
                    <i class="fas fa-eye eye-icon" id="toggle-signup-password"></i>
                </div>
                <div class="password-container">
                    <input type="password" name="confirm_password" id="confirm-password" class="form-input" placeholder="تایید رمز عبور" required>
                    <i class="fas fa-eye eye-icon" id="toggle-confirm-password"></i>
                </div>
                <button type="submit" class="form-button">ثبت‌نام</button>
            </form>

            <div class="form-link">
                <a href="#" id="show-login">ورود</a>
            </div>
        </div>
    </div>

    <script>
        // Toggle Password Visibility for Login
        const toggleLoginPassword = document.getElementById('toggle-login-password');
        const loginPassword = document.getElementById('login-password');
        toggleLoginPassword.addEventListener('click', function () {
            const type = loginPassword.type === 'password' ? 'text' : 'password';
            loginPassword.type = type;
            toggleLoginPassword.classList.toggle('fa-eye-slash');
        });

        // Toggle Password Visibility for Signup
        const toggleSignupPassword = document.getElementById('toggle-signup-password');
        const signupPassword = document.getElementById('signup-password');
        toggleSignupPassword.addEventListener('click', function () {
            const type = signupPassword.type === 'password' ? 'text' : 'password';
            signupPassword.type = type;
            toggleSignupPassword.classList.toggle('fa-eye-slash');
        });

        // Toggle Password Visibility for Confirm Password
        const toggleConfirmPassword = document.getElementById('toggle-confirm-password');
        const confirmPassword = document.getElementById('confirm-password');
        toggleConfirmPassword.addEventListener('click', function () {
            const type = confirmPassword.type === 'password' ? 'text' : 'password';
            confirmPassword.type = type;
            toggleConfirmPassword.classList.toggle('fa-eye-slash');
        });

        document.getElementById("show-signup").addEventListener("click", function () {
            document.getElementById("signup-form").style.display = "block";
            document.querySelector("form").style.display = "none";
        });

        document.getElementById("show-login").addEventListener("click", function () {
            document.getElementById("signup-form").style.display = "none";
            document.querySelector("form").style.display = "block";
        });
    </script>

</body>
</html>
