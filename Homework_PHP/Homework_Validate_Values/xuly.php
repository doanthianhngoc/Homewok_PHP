
<?php

// Khởi tạo biến
$year = $_POST["year"] ?? "";
$diem1 = $_POST["diem1"] ?? "";
$diem2 = $_POST["diem2"] ?? "";
$email = trim($_POST["email"] ?? "");

// Khởi tạo thông báo lỗi
$errYear = "";
$errDiem1 = "";
$errDiem2 = "";
$errEmail = "";

// Khởi tạo kết quả
$diemTB = 0;
$hocLuc = "";
$valid = true;

// 1. Kiểm tra năm học
if ($year == "") {
    $errYear = "Vui lòng chọn năm học!";
    $valid = false;
} elseif (!in_array($year, ["1", "2"], true)) {
    $errYear = "Năm học không hợp lệ!";
    $valid = false;
}

// 2. Kiểm tra điểm học kỳ 1
if ($diem1 === "") {
    $errDiem1 = "Không được để trống điểm học kỳ 1!";
    $valid = false;
} elseif (!is_numeric($diem1)) {
    $errDiem1 = "Điểm phải là số!";
    $valid = false;
} elseif ($diem1 < 0 || $diem1 > 10) {
    $errDiem1 = "Điểm phải từ 0 đến 10!";
    $valid = false;
}

// 3. Kiểm tra điểm học kỳ 2
if ($diem2 === "") {
    $errDiem2 = "Không được để trống điểm học kỳ 2!";
    $valid = false;
} elseif (!is_numeric($diem2)) {
    $errDiem2 = "Điểm phải là số!";
    $valid = false;
} elseif ($diem2 < 0 || $diem2 > 10) {
    $errDiem2 = "Điểm phải từ 0 đến 10!";
    $valid = false;
}

// 4. Kiểm tra Email
if ($email === "") {
    $errEmail = "Email không được để trống!";
    $valid = false;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errEmail = "Email không đúng định dạng!";
    $valid = false;
}

// Nếu tất cả dữ liệu hợp lệ
if ($valid == true) {

    // Chuyển điểm thành số
    $diem1 = (float)$diem1;
    $diem2 = (float)$diem2;

    // Tính điểm trung bình theo năm học
    switch ($year) {
        case "1":
            $diemTB = ($diem1 + $diem2) / 2;
            break;

        case "2":
            $diemTB = ($diem1 + $diem2) / 2;
            break;
    }

    // Xét học lực bằng Switch Case
    switch (true) {
        case ($diemTB >= 9):
            $hocLuc = "Xuất sắc";
            break;

        case ($diemTB >= 8):
            $hocLuc = "Giỏi";
            break;

        case ($diemTB >= 6.5):
            $hocLuc = "Khá";
            break;

        case ($diemTB >= 5):
            $hocLuc = "Trung bình";
            break;

        default:
            $hocLuc = "Yếu";
            break;
    }
}

?>

<!-- Hiển thị lỗi bên dưới từng ô nhập -->

<div id="errYear"><?= $errYear ?></div>

<div id="errDiem1"><?= $errDiem1 ?></div>

<div id="errDiem2"><?= $errDiem2 ?></div>

<div id="errEmail"><?= $errEmail ?></div>

<?php if ($valid == true) { ?>

    <div id="result">

        <h2>KẾT QUẢ HỌC TẬP</h2>

        <p>Năm học: <?= $year ?></p>

        <p>Điểm học kỳ 1: <?= $diem1 ?></p>

        <p>Điểm học kỳ 2: <?= $diem2 ?></p>

        <p>Email: <?= htmlspecialchars($email) ?></p>

        <p>Điểm bình: <?= $diemTB ?></p>

        <p>Học lực: <?= $hocLuc ?></p>

    </div>

<?php } ?>
