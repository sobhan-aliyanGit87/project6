<?php
include("vazyat.php");
?>
<?php
include("header.html");
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("اتصال به دیتابیس با مشکل روبه‌رو شد: " . $conn->connect_error);
}

$products = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محصولات</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { 
            background: #f8f9fa; 
            direction: rtl; 
            font-family: 'Tajawal', sans-serif; 
            margin: 0;
            padding: 20px;
        }
        .container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            max-width: 100%;
            gap: 20px;
        }
        .card {
            width: 100%;
            max-width: 420px; /* تعیین حداکثر عرض کارت‌ها */
            transition: 0.4s;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .card img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-bottom: 3px solid #007bff;
        }
        .card-body {
            padding: 20px;
            text-align: center;
        }
        .card-text {
            white-space: pre-line;
        }
        .text-danger {
            color: #e74c3c;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center w-100 my-4">🚀 محصولات</h2>

    <!-- لیست محصولات -->
    <div class="product-list">
        <?php while ($row = $products->fetch_assoc()) { ?>
            <div class="card">
                <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top img-thumbnail">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <p class="card-text"><?php echo $row['description']; ?></p>
                    <p class="card-text text-danger"><strong><?php echo number_format($row['price']); ?> تومان</strong></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>



<?php $conn->close(); ?>

<?php
include("footer.html");
?>
<?php
include("bat.html");
?>
