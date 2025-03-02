<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اعلان ویژه</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        /* لایه مات */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(128, 128, 128, 0.6); /* رنگ طوسی با شفافیت */
            backdrop-filter: blur(5px); /* حالت مات */
            z-index: 9998;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        /* زمانی که لایه مات نمایش داده می‌شود */
        .overlay.show {
            opacity: 1;
            visibility: visible;
        }

        /* استایل کادر اعلان */
        #notification {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.9);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05)); /* گرادیان مات */
            backdrop-filter: blur(10px); /* حالت مات */
            border: 1px solid rgba(255, 255, 255, 0.2); /* خط دور کادر */
            color: white;
            padding: 50px 60px;
            border-radius: 30px;
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.6);
            width: 75%;
            max-width: 800px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.8s ease, transform 0.8s ease, box-shadow 0.5s ease;
            z-index: 9999;
            overflow: hidden; /* برای افکت براق */
        }

        /* افکت براق */
        #notification::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.4) 10%, transparent 70%);
            transform: rotate(45deg);
            animation: shine 3s infinite;
            pointer-events: none;
        }

        /* انیمیشن براق */
        @keyframes shine {
            0% {
                transform: rotate(45deg) translateX(-50%) translateY(-50%);
            }
            100% {
                transform: rotate(45deg) translateX(50%) translateY(50%);
            }
        }

        /* زمانی که اعلان نمایش داده می‌شود */
        #notification.show {
            opacity: 1;
            visibility: visible;
            transform: translate(-50%, -50%) scale(1);
            box-shadow: 0 25px 75px rgba(0, 0, 0, 0.8);
        }

        /* دکمه بستن اعلان */
        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 36px;
            cursor: pointer;
            position: absolute;
            top: 20px;
            right: 20px;
            transition: transform 0.3s ease, background 0.3s ease;
            z-index: 10000;
        }

        /* زمانی که موس روی دکمه بستن می‌رود */
        .close-btn:hover {
            transform: scale(1.3) rotate(15deg);
            background: rgba(255, 255, 255, 0.2);
        }

        /* استایل برای آیکن */
        #notification .icon {
            font-size: 60px;
            margin-bottom: 30px;
            animation: bounce 1.5s infinite;
        }

        /* استایل متن مهم */
        #notification strong {
            color: #ffeb3b; /* رنگ زرد برای تاکید */
        }

        /* انیمیشن پرش آیکن */
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-15px);
            }
            60% {
                transform: translateY(-7px);
            }
        }

        /* استایل برای متن */
        #notification p {
            line-height: 1.8;
            font-size: 20px;
            letter-spacing: 1px; /* فاصله بیشتر بین حروف */
        }
    </style>
</head>
<body>

<!-- لایه مات -->
<div class="overlay" id="overlay"></div>

<!-- اعلان -->
<div id="notification">
    <button class="close-btn" onclick="closeNotification()">×</button>
    <div class="icon">📞</div>
    <p>برای اطلاع از قیمت دقیق محصولات، با ما تماس بگیرید! <strong>ما منتظرتون هستیم!</strong></p>
</div>

<script>
    // نمایش اعلان و لایه مات بعد از بارگذاری صفحه
    window.onload = function() {
        setTimeout(function() {
            document.getElementById('notification').classList.add('show');
            document.getElementById('overlay').classList.add('show');
        }, 1000); // نمایش بعد از 1 ثانیه
    }

    // بستن اعلان و لایه مات
    function closeNotification() {
        document.getElementById('notification').classList.remove('show');
        document.getElementById('overlay').classList.remove('show');
        setTimeout(function() {
            document.getElementById('notification').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }, 500); // مدت زمان انیمیشن
    }
</script>

</body>
</html>