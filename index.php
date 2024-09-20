<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>المصطفى</title>
</head>
<body>
    <h1>إدخال بيانات المستخدم</h1>

    <form method="POST" action="">
        <input type="text" name="name" placeholder="الاسم" required>
        <input type="email" name="email" placeholder="البريد الإلكتروني" required>
        <button type="submit">إضافة مستخدم</button>
    </form>

    <?php
    // الاتصال بقاعدة البيانات
    $conn = new mysqli('localhost', 'root', '', 'mydatabase');
    if ($conn->connect_error) {
        die("فشل الاتصال: " . $conn->connect_error);
    }

    // معالجة نموذج الإدخال
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);

        $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
        if ($conn->query($sql) === TRUE) {
            echo "تم إضافة المستخدم بنجاح.";
        } else {
            echo "خطأ: " . $sql . "<br>" . $conn->error;
        }
    }

    // استعلام لعرض المستخدمين
    $sql = "SELECT name, email FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>" . $row["name"] . " - " . $row["email"] . "</p>";
        }
    } else {
        echo "لا توجد نتائج.";
    }
    $conn->close();
    ?>
</body>
</html>
