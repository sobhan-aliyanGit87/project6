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

// اضافه کردن محصول جدید
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // آپلود تصویر
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);
    $imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));

    // بررسی اینکه تصویر تکراری نباشه
    $stmt = $conn->prepare("SELECT * FROM products WHERE image = ?");
    $stmt->bind_param("s", $image);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('❌ تصویری با این نام وجود دارد! لطفا یک تصویر متفاوت انتخاب کنید.');</script>";
    } else {
        // بررسی فرمت‌های مجاز
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowedExtensions)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);

            // درج محصول در دیتابیس
            $stmt = $conn->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $name, $description, $price, $image);
            if ($stmt->execute()) {
                echo "<script>alert('✅ محصول با موفقیت اضافه شد!');</script>";
            } else {
                echo "<script>alert('❌ خطا در اضافه کردن محصول!');</script>";
            }
        } else {
            echo "<script>alert('❌ فرمت تصویر مجاز نیست!');</script>";
        }
    }
}

// ویرایش محصول
if (isset($_POST['edit_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // آپلود تصویر جدید (در صورتی که تصویر جدید آپلود شده باشد)
    $image = $_POST['current_image']; // تصویر قبلی را نگه می‌داریم
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        $imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));

        // بررسی اینکه تصویر تکراری نباشه
        $stmt = $conn->prepare("SELECT * FROM products WHERE image = ? AND id != ?");
        $stmt->bind_param("si", $image, $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "<script>alert('❌ تصویری با این نام وجود دارد! لطفا یک تصویر متفاوت انتخاب کنید.');</script>";
        } else {
            // بررسی فرمت‌های مجاز
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($imageFileType, $allowedExtensions)) {
                // حذف تصویر قبلی
                if (file_exists("uploads/" . $_POST['current_image'])) {
                    unlink("uploads/" . $_POST['current_image']);
                }
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
            }
        }
    }

    // به روز رسانی اطلاعات محصول در دیتابیس
    $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssisi", $name, $description, $price, $image, $id);
    if ($stmt->execute()) {
        echo "<script>alert('✅ محصول با موفقیت ویرایش شد!');</script>";
    } else {
        echo "<script>alert('❌ خطا در ویرایش محصول!');</script>";
    }
}

// حذف محصول
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $result = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $result->bind_param("i", $id);
    $result->execute();
    $row = $result->get_result()->fetch_assoc();

    if (file_exists("uploads/" . $row['image'])) {
        unlink("uploads/" . $row['image']);
    }

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "<script>alert('🗑️ محصول حذف شد!'); window.location='index.php';</script>";
}

$products = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت محصولات</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { background: #f8f9fa; direction: rtl; font-family: 'Roboto', sans-serif; }
        .container { max-width: 1000px; margin: 20px auto; }
        .card { transition: 0.4s; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
        .card img { height: 200px; object-fit: cover; border-bottom: 3px solid #007bff; }
        .btn-danger, .btn-warning, .btn-primary { transition: 0.3s; border-radius: 50px; padding: 10px 20px; }
        .btn-danger:hover { background: #c0392b; }
        .btn-warning:hover { background: #f39c12; }
        .btn-primary:hover { background: #007bff; }
        #searchBox { margin-bottom: 20px; }
        .form-container { display: none; padding: 20px; background-color: #f1f1f1; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1); margin-bottom: 30px; }
        .toggle-form-btn { cursor: pointer; font-weight: bold; color: #007bff; background-color: transparent; border: none; }
        .product-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
        .form-container input[type="file"] { border: none; padding: 5px; }
        .form-container textarea, .form-container input[type="text"], .form-container input[type="number"] { border-radius: 10px; }
        .img-thumbnail { object-fit: cover; height: 150px; width: 100%; border-radius: 10px; }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center my-4">🚀 مدیریت محصولات</h2>

    <!-- دکمه برای باز و بسته کردن فرم اضافه کردن محصول -->
    <button class="toggle-form-btn" onclick="toggleForm('addProductForm')">➕ اضافه کردن محصول جدید</button>

    <!-- فرم اضافه کردن محصول -->
    <div class="form-container" id="addProductForm">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">📌 نام محصول</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">📝 توضیحات</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">💰 قیمت</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">🖼️ تصویر محصول</label>
                <input type="file" name="image" class="form-control" required>
            </div>
            <button type="submit" name="add_product" class="btn btn-primary">💾 اضافه کردن محصول</button>
        </form>
    </div>

    <!-- لیست محصولات -->
    <input type="text" id="searchBox" class="form-control" placeholder="🔍 جستجو در محصولات...">

    <div class="product-list">
        <?php while ($row = $products->fetch_assoc()) { ?>
            <div class="card">
                <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top img-thumbnail">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <p class="card-text"><?php echo $row['description']; ?></p>
                    <p class="card-text text-danger"><strong><?php echo number_format($row['price']); ?> تومان</strong></p>
                    <!-- دکمه ویرایش -->
                    <button class="btn btn-warning edit-btn" onclick="toggleEditForm(<?php echo $row['id']; ?>)">✏️ ویرایش</button>
                    <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger">🗑️ حذف</a>
                </div>
                <!-- فرم ویرایش هر محصول -->
                <div class="form-container" id="editForm<?php echo $row['id']; ?>">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $row['image']; ?>">
                        <div class="mb-3">
                            <label class="form-label">📌 نام محصول</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">📝 توضیحات</label>
                            <textarea name="description" class="form-control" required><?php echo $row['description']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">💰 قیمت</label>
                            <input type="number" name="price" class="form-control" value="<?php echo $row['price']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">🖼️ تصویر محصول</label>
                            <input type="file" name="image" class="form-control">
                            <img src="uploads/<?php echo $row['image']; ?>" alt="Image" class="img-thumbnail mt-2">
                        </div>
                        <button type="submit" name="edit_product" class="btn btn-primary">💾 ذخیره تغییرات</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script>
// تابع برای باز و بسته کردن فرم ویرایش برای هر محصول
function toggleEditForm(productId) {
    const form = document.getElementById('editForm' + productId);
    form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
}

// تابع برای باز و بسته کردن فرم اضافه کردن محصول
function toggleForm(formId) {
    const form = document.getElementById(formId);
    form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
}
</script>

</body>
</html>


<?php $conn->close(); ?>

<?php
include("footer.html");
?>
<?php
include("bat.html");
?>
