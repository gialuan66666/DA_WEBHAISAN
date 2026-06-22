<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once './vendor/autoload.php';

class ContactController
{
    public function send()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /contact');
            exit;
        }

        $fullname = trim($_POST['fullname'] ?? '');
        $phone    = trim($_POST['phone'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $message  = trim($_POST['message'] ?? '');

        if ($fullname === '' || $phone === '' || $email === '' || $message === '') {
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Vui lòng nhập đầy đủ thông tin liên hệ.'
            ];

            header('Location: /contact');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Email không hợp lệ.'
            ];

            header('Location: /contact');
            exit;
        }

        $safeFullname = htmlspecialchars($fullname, ENT_QUOTES, 'UTF-8');
        $safePhone    = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
        $safeEmail    = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $safeMessage  = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));

        try {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;

            $mail->Username   = 'vanquythaicute@gmail.com';
            $mail->Password   = 'uhjycqpjltqckuxd';

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('vanquythaicute@gmail.com', 'SeaFresh Contact');
            $mail->addAddress('vanquythaicute@gmail.com', 'SeaFresh Admin');

            $mail->addReplyTo($email, $fullname);

            $mail->isHTML(true);
            $mail->Subject = 'Khách hàng liên hệ từ website SeaFresh';

            $mail->Body = "
                <!DOCTYPE html>
                <html lang='vi'>
                <head>
                    <meta charset='UTF-8'>
                    <title>Liên hệ SeaFresh</title>
                </head>
                <body style='margin:0; padding:0; background:#f4f8fb; font-family:Arial, sans-serif; color:#333;'>
                    <div style='max-width:650px; margin:30px auto; background:#ffffff; border-radius:18px; overflow:hidden; box-shadow:0 8px 30px rgba(0,0,0,0.08);'>

                        <div style='background:linear-gradient(135deg,#0077b6,#00b4d8); padding:28px 30px; color:#ffffff;'>
                            <h1 style='margin:0; font-size:26px;'>SeaFresh</h1>
                            <p style='margin:8px 0 0; font-size:15px;'>Bạn có một liên hệ mới từ website</p>
                        </div>

                        <div style='padding:30px;'>

                            <h2 style='margin:0 0 20px; color:#0077b6; font-size:22px;'>
                                Thông tin khách hàng
                            </h2>

                            <table style='width:100%; border-collapse:collapse; margin-bottom:25px;'>
                                <tr>
                                    <td style='padding:12px 0; font-weight:bold; width:150px; color:#555;'>Họ tên:</td>
                                    <td style='padding:12px 0; color:#222;'>{$safeFullname}</td>
                                </tr>
                                <tr>
                                    <td style='padding:12px 0; font-weight:bold; color:#555;'>Số điện thoại:</td>
                                    <td style='padding:12px 0; color:#222;'>{$safePhone}</td>
                                </tr>
                                <tr>
                                    <td style='padding:12px 0; font-weight:bold; color:#555;'>Email:</td>
                                    <td style='padding:12px 0; color:#222;'>{$safeEmail}</td>
                                </tr>
                            </table>

                            <div style='background:#f1f9ff; border-left:5px solid #00b4d8; padding:18px 20px; border-radius:12px;'>
                                <h3 style='margin:0 0 12px; color:#0077b6; font-size:18px;'>Nội dung cần tư vấn</h3>
                                <p style='margin:0; line-height:1.7; font-size:15px; color:#333;'>{$safeMessage}</p>
                            </div>

                            <div style='margin-top:28px; padding:18px; background:#fff8e6; border-radius:12px; color:#7a5200; font-size:14px;'>
                                Email này được gửi tự động từ form liên hệ trên website SeaFresh.
                                Bạn có thể bấm trả lời trực tiếp email này để phản hồi khách hàng.
                            </div>

                        </div>

                        <div style='background:#eef6fb; padding:18px 30px; text-align:center; color:#666; font-size:13px;'>
                            © SeaFresh - Hải sản tươi sống mỗi ngày
                        </div>

                    </div>
                </body>
                </html>
            ";

            $mail->AltBody = "
                SeaFresh - Liên hệ mới

                Họ tên: {$fullname}
                Số điện thoại: {$phone}
                Email: {$email}

                Nội dung:
                {$message}
            ";

            $mail->send();

            $_SESSION['toast'] = [
                'type' => 'success',
                'message' => 'Gửi liên hệ thành công. SeaFresh sẽ phản hồi sớm nhất!'
            ];

        } catch (Exception $e) {
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Không thể gửi liên hệ. Vui lòng thử lại sau.'
            ];
        }

        header('Location: /contact');
        exit;
    }
}