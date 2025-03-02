<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منوی حرفه‌ای</title>
    <!-- لینک Font Awesome برای آیکون‌ها -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* تنظیمات عمومی */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #a8c0ff, #3f2b96);
            color: #000;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 800px;
            width: 100%;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            position: relative;
        }

        /* منوی حرفه‌ای */
        .menu {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background: linear-gradient(135deg, #3f2b96, #a8c0ff);
            padding: 15px;
            border-radius: 20px 20px 0 0;
        }

        .menu a {
            text-decoration: none;
            color: #fff;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .menu a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.3);
            transform: skewX(-45deg);
            transition: left 0.5s ease;
        }

        .menu a:hover::before {
            left: 100%;
        }

        .menu a.active {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* محتوای صفحه */
        h2 {
            color: #3f2b96;
            margin-bottom: 20px;
        }

        p {
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- منوی حرفه‌ای -->
        <div class="menu">
            <a href="nazar.php" class="menu-item">نظرات</a>
            <a href="pro.php" class="menu-item">محصولات</a>
        </div>

    </div>
</body>
</html>