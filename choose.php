<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه انتخاب</title>
    <style>
        /* استایل‌ها */
        body {
            font-family: 'Roboto', sans-serif;
            background: url('bak.webp') no-repeat center center fixed;
            background-size: cover;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 15px;
            padding: 40px;
            width: 400px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            text-align: center;
        }
        .container h2 {
            font-size: 26px;
            margin-bottom: 20px;
            color: #4caf50;
        }
        .btn {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            background-color: #4caf50;
            color: #fff;
            font-size: 16px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .btn-container {
            display: flex;
            flex-direction: column;
        }
        .btn-container button {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>لطفاً انتخاب کنید</h2>
        <div class="btn-container">
            <button class="btn" onclick="window.location.href='register.php'">ثبت‌نام</button>
            <button class="btn" onclick="window.location.href='login.php'">ورود</button>
            <button class="btn" onclick="window.location.href='index.php'">صفحه اصلی</button>
        </div>
    </div>
</body>
</html>
