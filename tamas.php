<?php
include("vazyat.php");
?>
<?php
include("header.html");
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تماس با ما</title>
    <link href="https://fonts.googleapis.com/css2?family=Vazir:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Vazir', sans-serif;
            background: linear-gradient(135deg, #2c3e50, #34495e);
            margin: 0;
            padding: 0;
            direction: rtl;
            overflow-x: hidden;
            color: #fff;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0); }
        }

        .contact-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
            gap: 40px;
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 42px;
            font-weight: bold;
            margin-bottom: 20px;
            animation: fadeIn 1s ease-in-out;
            color:rgb(0, 0, 0);
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
            animation: fadeIn 1.5s ease-in-out;
              color:rgb(0, 0, 0);
        }

        .contact-info {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(255, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 700px;
            backdrop-filter: blur(10px);
            animation: fadeIn 2s ease-in-out;
        }

        .contact-info p {
            font-size: 16px;
            color: #d3d3d3;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .social-links a {
            margin: 10px;
            display: inline-block;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .social-links a:hover {
            transform: scale(1.1);
            color: #ff6f61;
        }

        .social-links i {
            font-size: 35px;
            color: #fff;
        }

        .contact-button {
            display: inline-block;
            padding: 15px 30px;
            background: linear-gradient(135deg, #ff6f61, #ff9a8b);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: float 3s infinite ease-in-out;
        }

        .contact-button:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(255, 111, 97, 0.3);
        }

        .map-container {
            margin-top: 40px;
            width: 100%;
            height: 400px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            animation: fadeIn 2.5s ease-in-out;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 32px;
            }

            p {
                font-size: 16px;
            }

            .contact-info {
                padding: 30px;
            }

            .contact-info p {
                font-size: 14px;
            }

            .contact-button {
                font-size: 16px;
                padding: 12px 25px;
            }

            .social-links i {
                font-size: 30px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 28px;
            }

            p {
                font-size: 14px;
            }

            .contact-button {
                font-size: 14px;
                padding: 10px 20px;
            }

            .social-links i {
                font-size: 25px;
            }
        }
    </style>
</head>
<body>

<div class="contact-container">
    <h1>با ما در تماس باشید!</h1>
    <p>ما همیشه آماده‌ایم تا به سوالات شما پاسخ دهیم. از طریق اطلاعات زیر یا شبکه‌های اجتماعی ما را دنبال کنید.</p>

    <!-- Contact Info Section -->
    <div class="contact-info">
        <p><strong>آدرس:</strong> نجف آباد، شهرک صنعتی شماره دو</p>
        <p><strong>ساعات کاری:</strong> شنبه تا پنج شنبه - ۸ صبح تا ۴ عصر</p>
        <p><strong>شماره تماس:</strong> <a href="tel:09134300158" style="color: #ff6f61;">09134300158</a></p>
        <p><strong>ایمیل:</strong> <a href="mailto:kiafarayandnutrikaco@gmail.com" style="color: #ff6f61;">kiafarayandnutrikaco@gmail.com</a></p>
        <p><strong> نام و نام خانوادگی و اطلاعات:</strong> <a href="tel:09134300158" style="color: #ff6f61;">سبحان علیان یازدهم شبکه 2 </a></p>
        <div class="social-links">
            <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://t.me" target="_blank"><i class="fab fa-telegram"></i></a>
            <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://wa.me" target="_blank"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>

    <!-- Contact Button -->
    <button class="contact-button" onclick="window.location.href='nezer.php'">ارسال پیام</button>
</div>

<!-- Google Map Section -->
<div class="map-container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3200.674278212585!2d51.283465515741745!3d32.789443679736054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fabb441a4585999%3A0x2035f639ab9a849!2z2YbYryDYp9mF2KfYp9mI2LTZiiDZh9ix2r3YjA!5e0!3m2!1sen!2s!4v1675208481042!5m2!1sen!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>

</body>
</html>

<?php
include("footer.html");
?>
<?php
include("bat.html");
?>