<?php
// config.php (أو ملف الاتصال بقاعدة البيانات الخاص بك)
$host = "localhost";
$dbname = "my_database";  // اسم قاعدة البيانات
$username = "my_user";  // اسم المستخدم الخاص بقاعدة البيانات
$password = "my_password";  // كلمة المرور الخاصة بقاعدة البيانات

try {
    // الاتصال بقاعدة البيانات باستخدام PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // استعلام لحساب عدد المستخدمين
    $query = "SELECT COUNT(*) AS user_count FROM users";  // users هو اسم جدول المستخدمين
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // الحصول على النتيجة
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_count = $result['user_count'];

    echo "عدد المستخدمين المسجلين هو: " . $user_count;

} catch (PDOException $e) {
    echo "فشل الاتصال بقاعدة البيانات: " . $e->getMessage();
}
?>
