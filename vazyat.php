<?php
session_start();

// مدیریت خروج کاربر
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// بررسی وجود $username در $_SESSION
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کیا فرایند نوتریکا</title>
    <link href="https://fonts.googleapis.com/css2?family=Vazir:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* تنظیمات عمومی */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fa;
            overflow-x: hidden;
        }

        /* هدر */
        .hero2 {
            position: relative;
            top: 0;
            left: 0;
            width: 100%;
            height: 500px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ddd;
            z-index: 1;
        }

        .image-slider {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
        }

        .image-slider img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            transition: transform 1s ease-in-out;
        }

        .image-slider img.active {
            transform: translateX(0);
        }

        .image-slider img.prev {
            transform: translateX(-100%);
        }

        .image-slider img.next {
            transform: translateX(100%);
        }

        /* استایل جدید برای نام شرکت */
        .text-overlay {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            text-align: center;
            z-index: 2;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
        }

        .text-content {
            font-size: 3rem;
            font-weight: bold;
            color: #fff;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        /* نوار آیکون‌ها */
        #top-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            z-index: 1000;
            display: flex;
            justify-content: center;
        }

        #top-bar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        #top-bar a:hover {
            color: #27ae60;
        }

        /* نوار منو */
        #navbar {
            position: fixed;
            top: 60px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.6));
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 15px 25px rgba(0, 4, 255, 0.1);
            z-index: 1000;
            font-size: 16px;
            border-radius: 25px;
            
        }

        /* لوگو و متن */
        #navbar .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color:rgb(173, 130, 130);
            letter-spacing: 1px;
        }

        #navbar .logo-text {
            font-size: 18px;
            font-weight: normal;
            color: #34495e;
        }

        /* منو */
        #navbar .menu {
            display: flex;
            align-items: center;
            gap: 20px;
            background-color: #34495e;
            padding: 10px 15px;
            border-radius: 20px;
            transition: transform 0.3s ease;
        }

        #navbar .menu a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 20px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            font-weight: 500;
        }

        #navbar .menu a:hover {
            background-color: #27ae60;
            transform: scale(1.05);
        }

        #navbar .user-status {
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: #f39c12;
        }

        #navbar .user-status .username {
            font-weight: bold;
            font-size: 16px;
            text-transform: capitalize;
        }

        #navbar .user-status .logout-btn,
        #navbar .user-status .login-btn {
            padding: 10px 18px;
            font-size: 14px;
            border-radius: 25px;
            color: white;
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        #navbar .user-status .logout-btn {
            background-color: #e74c3c;
        }

        #navbar .user-status .login-btn {
            background-color: #27ae60;
        }

        #navbar .user-status .btn:hover {
            opacity: 0.8;
            transform: scale(1.05);
        }

        #navbar .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        #navbar .hamburger .bar {
            width: 30px;
            height: 4px;
            background: black;
            margin: 6px 0;
            transition: 0.4s;
        }

        /* تنظیمات برای موبایل */
        @media (max-width: 768px) {
            #navbar {
                width: 100%;
                left: 0;
                transform: none;
            }

            #navbar .menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                right: 0;
                width: 100%;
                background: #34495e;
                padding: 15px 0;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            }

            #navbar .menu.active {
                display: flex;
            }

            #navbar .hamburger {
                display: flex;
            }
        }

        /* موبایل کوچک */
        @media (max-width: 480px) {
            #navbar {
                padding: 10px 20px;
            }

            #navbar .logo {
                font-size: 22px;
            }

            #navbar .logo-text {
                font-size: 16px;
            }

            #navbar .menu a {
                padding: 10px 15px;
                font-size: 13px;
            }

            #navbar .user-status {
                font-size: 13px;
                gap: 12px;
            }
        }
    </style>
</head>
<body>

    <!-- نوار آیکون‌ها -->
    <div id="top-bar">
        <a href="https://wa.me/989134300158" target="_blank">
            <i class="fab fa-whatsapp"></i> واتساپ
        </a>
        <a href="https://eitaa.com/989134300158" target="_blank">
            <i class="fab fa-telegram-plane"></i> اِیتا
        </a>
        <a href="https://instagram.com/yourprofile" target="_blank">
            <i class="fab fa-instagram"></i> اینستاگرام
        </a>
    </div>

    <!-- نوار منو -->
    <div id="navbar">
        <div class="logo-container">
            <div class="logo">
                <img src="logog.webp" alt="لوگو" style="width: 40px; height: 40px; border-radius: 50%;"> 
            </div>
            <div class="logo-text"><h2>کیا فرایند نوتریکا</h2></div>
        </div>

        <!-- دکمه همبرگر برای موبایل -->
        <div class="hamburger" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>

        <!-- منو -->
        <div class="menu" id="menu">
            <a href="index.php">🏠 خانه</a>
            <a href="about.php">ℹ️ درباره ما</a>
            <a href="products.php"> 🧴  محصولات</a>
            <a href="nezer.php">💭نظرات</a>
            <a href="tamas.php">📞 تماس با ما</a>
            <div class="user-status">
            <?php if ($username): ?>
                    <span class="username">👤 <?php echo htmlspecialchars($username); ?></span>
                    <?php if ($username === 'admin'): ?>
                        <a href="admin.php" class="admin-btn">⚙️ مدیریت</a>
                    <?php endif; ?>
                    <a href="logout.php" class="logout-btn">🔴 خروج</a>
                <?php else: ?>
                    <a href="register.php" class="login-btn">🟢 ورود</a>
                    <a href="register.php" class="login-btn">✏️ ثبت‌نام</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            menu.classList.toggle("active");
        }
    </script>

</body>
</html>
