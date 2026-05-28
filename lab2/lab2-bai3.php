<?php

class SinhVien
{
    private $hoTen;
    private $gioiTinh;
    private $ngaySinh;
    private $diemTB;

    public function __construct($hoTen, $gioiTinh, $ngaySinh, $diemTB)
    {
        $this->hoTen = $hoTen;
        $this->gioiTinh = $gioiTinh;
        $this->ngaySinh = $ngaySinh;
        $this->diemTB = $diemTB;
    }

    // Getter & Setter

    public function getHoTen()
    {
        return $this->hoTen;
    }

    public function setHoTen($hoTen)
    {
        $this->hoTen = $hoTen;
    }

    public function getGioiTinh()
    {
        return $this->gioiTinh;
    }

    public function setGioiTinh($gioiTinh)
    {
        $this->gioiTinh = $gioiTinh;
    }

    public function getNgaySinh()
    {
        return $this->ngaySinh;
    }

    public function setNgaySinh($ngaySinh)
    {
        $this->ngaySinh = $ngaySinh;
    }

    public function getDiemTB()
    {
        return $this->diemTB;
    }

    public function setDiemTB($diemTB)
    {
        $this->diemTB = $diemTB;
    }

    // Hiển thị thông tin
    public function hienThiThongTin()
    {
        echo "Họ Tên: " . $this->getHoTen() . "<br>";
        echo "Giới Tính: " . $this->getGioiTinh() . "<br>";
        echo "Ngày sinh: " . $this->getNgaySinh() . "<br>";
        echo "Điểm TB: " . $this->getDiemTB() . "<br>";
    }
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Nhập thông tin sinh viên</title>
</head>

<body>

    <h1>Nhập thông tin sinh viên</h1>

    <form method="post">
        <label>Họ tên:</label>
        <input type="text" name="hoTen" required><br><br>

        <label>Giới tính:</label>
        <select name="gioiTinh" required>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select><br><br>

        <label>Ngày sinh:</label>
        <input type="date" name="ngaySinh" required><br><br>

        <label>Điểm TB:</label>
        <input type="number" step="0.01" name="diemTB" required><br><br>

        <button type="submit">Lưu</button>
    </form>

    <hr>

    <?php
 
    // Mảng lưu trữ sinh viên
    $mangSinhVien = [];

    // Kiểm tra form 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Lấy dữ liệu từ form
        $hoTen = $_POST['hoTen'] ?? '';
        $gioiTinh = $_POST['gioiTinh'] ?? '';
        $ngaySinh = $_POST['ngaySinh'] ?? '';
        $diemTB = $_POST['diemTB'] ?? 0;

        // Tạo đối tượng sinh viên
        $sinhVien = new SinhVien($hoTen, $gioiTinh, $ngaySinh, $diemTB);

        // Thêm vào mảng
        $mangSinhVien[] = $sinhVien;

        // Hiển thị
        echo "<h2>Thông tin sinh viên đã lưu:</h2>";

        foreach ($mangSinhVien as $sv) {
            $sv->hienThiThongTin();
            echo "<hr>";
        }
    } else {
        echo "Vui lòng nhập dữ liệu từ form!";
    }
    ?>

</body>

</html>