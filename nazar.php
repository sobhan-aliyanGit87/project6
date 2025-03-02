<?php
include("vazyat.php");
?>
<?php


// تنظیمات پایگاه داده
$host = 'localhost';
$dbname = 'feedback_db';
$username = 'root'; // نام کاربری پایگاه داده
$password = ''; // رمز عبور پایگاه داده

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // حذف نظر
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
        $deleteId = $_POST['delete_id'];
        $stmt = $pdo->prepare("DELETE FROM feedbacks WHERE id = :id");
        $stmt->execute(['id' => $deleteId]);
    }

    // ثبت نظر
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_feedback'])) {
        $name = trim($_POST['name']);
        $comment = trim($_POST['comment']);

        // فیلتر کلمات غیرمجاز
        $bannedWords = ['کیر', 'مادرجنده', 'کسکش']; // کلمات غیرمجاز
        foreach ($bannedWords as $word) {
            if (strpos($comment, $word) !== false) {
                echo '<script>alert("نظر شما شامل کلمات غیرمجاز است.");</script>';
                exit;
            }
        }

        if (!empty($name) && !empty($comment)) {
            $stmt = $pdo->prepare("INSERT INTO feedbacks (name, comment) VALUES (:name, :comment)");
            $stmt->execute(['name' => $name, 'comment' => $comment]);
            echo '<script>alert("نظر شما با موفقیت ثبت شد.");</script>';
        } else {
            echo '<script>alert("لطفاً همه فیلدها را پر کنید.");</script>';
        }
    }

    // دریافت نظرات
    $stmt = $pdo->query("SELECT * FROM feedbacks ORDER BY created_at DESC");
    $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo '<script>alert("خطا: ' . $e->getMessage() . '");</script>';
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه نظرسنجی</title>
    <!-- لینک Font Awesome برای استیکرها -->
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
            background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fbc2eb);
            color: #000; /* رنگ متن سیاه */
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 800px;
            width: 100%;
            background: rgba(255, 255, 255, 0.9); /* پس‌زمینه سفید شفاف */
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            position: relative;
            animation: fadeInContainer 1s ease-in-out;
        }

        @keyframes fadeInContainer {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        h1 {
            font-size: 2.5rem;
            color: #fff; /* رنگ متن سفید */
            margin-bottom: 20px;
            text-align: center;
            padding: 20px;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fbc2eb);
            position: relative;
            border-radius: 20px 20px 0 0;
        }

        h1 i {
            margin-left: 10px;
            animation: spinIcon 5s linear infinite;
        }

        @keyframes spinIcon {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .feedback-box {
            padding: 20px;
            text-align: center;
        }

        .toggle-btn {
            background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fbc2eb);
            color: #000; /* رنگ متن سیاه */
            border: none;
            padding: 15px 40px;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 50px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .toggle-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .toggle-btn i {
            font-size: 1.5rem;
        }

        .feedback-form {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease, padding 0.5s ease;
            padding: 0;
            background: rgba(255, 255, 255, 0.9); /* پس‌زمینه سفید شفاف */
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .feedback-form.active {
            max-height: 500px;
            padding: 20px;
        }

        .feedback-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #000; /* رنگ متن سیاه */
        }

        .feedback-form input,
        .feedback-form textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
            color: #000; /* رنگ متن سیاه */
            background: rgba(255, 255, 255, 0.9); /* پس‌زمینه سفید شفاف */
            transition: border-color 0.3s ease, transform 0.3s ease;
        }

        .feedback-form input:focus,
        .feedback-form textarea:focus {
            border-color: #ff9a9e;
            transform: scale(1.02);
            box-shadow: 0 0 10px rgba(255, 154, 158, 0.5);
        }

        .submit-btn {
            background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fbc2eb);
            color: #000; /* رنگ متن سیاه */
            border: none;
            padding: 15px 40px;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .submit-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .comments-section {
            padding: 20px;
        }

        .comment-item {
            background: rgba(255, 255, 255, 0.9); /* پس‌زمینه سفید شفاف */
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: flex-start;
            gap: 20px;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .comment-item i {
            color: #FFC107;
            font-size: 2rem;
            animation: pulseIcon 2s infinite;
        }

        @keyframes pulseIcon {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2);
            }
        }

        .comment-content {
            flex-grow: 1;
        }

        .comment-name {
            font-weight: bold;
            margin-bottom: 10px;
            color: #ff9a9e;
        }

        .action-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .delete-btn {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            color: #fff; /* رنگ متن سفید */
        }

        .delete-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(255, 69, 0, 0.5);
        }

        .admin-login {
            margin-top: 20px;
            text-align: center;
        }

        .admin-login input {
            padding: 15px;
            margin: 10px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
            color: #000; /* رنگ متن سیاه */
            background: rgba(255, 255, 255, 0.9); /* پس‌زمینه سفید شفاف */
            transition: border-color 0.3s ease;
        }

        .admin-login input:focus {
            border-color: #ff9a9e;
            transform: scale(1.02);
            box-shadow: 0 0 10px rgba(255, 154, 158, 0.5);
        }

        .admin-login button {
            padding: 15px 30px;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fbc2eb);
            color: #000; /* رنگ متن سیاه */
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .admin-login button:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .logout-btn {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            color: #fff; /* رنگ متن سفید */
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .logout-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-comments"></i> نظرسنجی کاربران</h1>

        <!-- فرم ثبت نظر -->
        <div class="feedback-box">
            <button id="toggleFeedback" class="toggle-btn"><i class="fas fa-plus"></i> ثبت نظر شما</button>
            <div id="feedbackForm" class="feedback-form">
                <h2><i class="fas fa-edit"></i> ثبت نظر</h2>
                <form method="POST">
                    <label for="name">نام شما:</label>
                    <input type="text" id="name" name="name" placeholder="نام خود را وارد کنید" required>

                    <label for="comment">نظر شما:</label>
                    <textarea id="comment" name="comment" placeholder="نظر خود را بنویسید" required></textarea>

                    <button type="submit" name="submit_feedback" class="submit-btn"><i class="fas fa-paper-plane"></i> ارسال نظر</button>
                </form>
            </div>
        </div>

        <!-- نمایش نظرات -->
        <div id="commentsSection" class="comments-section">
            <h2><i class="fas fa-users"></i> نظرات کاربران</h2>
            <?php foreach ($feedbacks as $feedback): ?>
                <div class="comment-item" id="comment-<?= $feedback['id'] ?>">
                    <i class="fas fa-user-circle"></i>
                    <div class="comment-content">
                        <div class="comment-name"><?= htmlspecialchars($feedback['name']) ?></div>
                        <div><?= htmlspecialchars($feedback['comment']) ?></div>
                    </div>
                    <?php if (isset($_SESSION['admin'])): ?>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="delete_id" value="<?= $feedback['id'] ?>">
                            <button type="submit" class="action-btn delete-btn"><i class="fas fa-trash-alt"></i> حذف</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- فرم ورود ادمین -->
        <div class="admin-login">
            <?php if (!isset($_SESSION['admin'])): ?>
                <form method="POST">
                    <input type="password" name="admin_password" placeholder="رمز عبور ادمین" required>
                    <button type="submit"><i class="fas fa-sign-in-alt"></i> ورود به پنل ادمین</button>
                </form>
            <?php else: ?>
                <button class="logout-btn" onclick="location.href='index.php?logout=true'"><i class="fas fa-sign-out-alt"></i> خروج</button>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // باز و بسته کردن فرم ثبت نظر
        const toggleFeedback = document.getElementById('toggleFeedback');
        const feedbackForm = document.getElementById('feedbackForm');
        toggleFeedback.addEventListener('click', () => {
            feedbackForm.classList.toggle('active');
        });

        // صدای کلیک (اختیاری)
        const buttons = document.querySelectorAll('button');
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const audio = new Audio('https://www.soundjay.com/button/beep-07.mp3'); // لینک صدای کلیک
                audio.play();
            });
        });
    </script>

    <?php
    // خروج از حساب ادمین
    if (isset($_GET['logout'])) {
        unset($_SESSION['admin']);
        header("Location: index.php");
        exit;
    }

    // ورود ادمین
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_password'])) {
        if ($_POST['admin_password'] === 'Sobhan_87') { // رمز عبور ادمین
            $_SESSION['admin'] = true;
        } else {
            echo '<script>alert("رمز عبور اشتباه است!");</script>';
        }
    }
    ?>
</body>
</html>