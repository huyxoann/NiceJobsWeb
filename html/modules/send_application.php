<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../modules/PHPMailer/src/Exception.php';
require '../modules/PHPMailer/src/PHPMailer.php';
require '../modules/PHPMailer/src/SMTP.php';
require_once('connection.php');
if (isset($_POST['apply'])) {
    $pre_href = isset($_COOKIE['pre_href']) ? $_COOKIE['pre_href'] : '';
    $employee_id = isset($_COOKIE['id_user']) ? $_COOKIE['id_user'] : '';
    $cv_selected = mysqli_real_escape_string($conn, $_POST['cv_selected']);

    $introduce = mysqli_real_escape_string($conn, $_POST['introduce']);
    $job_id = mysqli_real_escape_string($conn, $_POST['job_id']);
    if ($cv_selected == '') {
        $address_job_current = "../job_detail.php?job_id=" . $job_id;
        header("Location: " . $address_job_current);
    }
    $query_add_new_application = "INSERT INTO `application` (employee_id, cv_id, introduce, job_id) VALUES ('$employee_id', '$cv_selected', '$introduce', '$job_id')";

    $query_get_id_corp = "SELECT employer_id, job_name, job_id FROM jobs WHERE job_id = '$job_id'";
    $employer_data = mysqli_fetch_assoc(mysqli_query($conn, $query_get_id_corp));
    $employer_id = $employer_data['employer_id'];

    $query_user_get_email = "SELECT email, fullname FROM users INNER JOIN employer ON users.id_user = employer.id_user WHERE users.id_user = '$employer_id'";
    $email_employer = mysqli_fetch_assoc(mysqli_query($conn, $query_user_get_email));

    if ($conn->query($query_add_new_application)) {
        $mail1 = new PHPMailer(true);
        // Send to corp
        try {
            $mail1->SMTPDebug = 0;                      //Enable verbose debug output
            $mail1->isSMTP();                                            //Send using SMTP
            $mail1->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail1->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail1->Username   = 'hirashihiro@gmail.com';                     //SMTP username
            $mail1->Password   = 'eecnlnutkfnqvrpj';                               //SMTP password
            $mail1->SMTPSecure = 'tsl';            //Enable implicit TLS encryption
            $mail1->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail1->charSet = "UTF-8";
            //Recipients
            $mail1->setFrom('hirashihiro@gmail.com', "Nice Job");
            $mail1->addAddress($email_employer['email']);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            $mail1->addReplyTo('hirashihiro@gmail.com', "Nice Job");
            //Content
            $content = '
                Xin chào, ' . $email_employer['fullname'] . '! <br>
                Công việc "' . $employer_data['job_name'] . '" của bạn vừa có một ứng viên nộp đơn. Vui lòng kiểm tra ngay trên website NiceJob. <br>
            ';
            $mail1->isHTML(true);
            $mail1->Subject = "New Application for your job! Check now! | NiceJob";
            $mail1->Body    = $content;

            $mail1->send();
            ob_start();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail1->ErrorInfo}";
        }
        $mail2 = new PHPMailer(true);
        $employee_mail = $_COOKIE['email'];
        try {
            $mail2->SMTPDebug = 0;                      //Enable verbose debug output
            $mail2->isSMTP();                                            //Send using SMTP
            $mail2->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail2->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail2->Username   = 'hirashihiro@gmail.com';                     //SMTP username
            $mail2->Password   = 'eecnlnutkfnqvrpj';                               //SMTP password
            $mail2->SMTPSecure = 'tsl';            //Enable implicit TLS encryption
            $mail2->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail2->charSet = "UTF-8";
            //Recipients
            $mail2->setFrom('hirashihiro@gmail.com', "Nice Job");
            $mail2->addAddress($employee_mail);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            $mail2->addReplyTo('hirashihiro@gmail.com', "Nice Job");
            //Content
            $content = '
                Xin chào, ' . $_COOKIE['username'] . '! <br>
                Bạn đã nộp đơn xin việc cho công việc "' . $employer_data['job_name'] . '". Người tuyển dụng có thể sẽ liên hệ qua số điện thoại hoặc email của bạn. Vui lòng kiểm tra sau để không mai đánh mất cơ hội!<br>
            ';
            $mail2->isHTML(true);
            $mail2->Subject = "You had been apply for a job on NiceJob! | NiceJob";
            $mail2->Body    = $content;

            $mail2->send();
            ob_start();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail2->ErrorInfo}";
        }
        $address_job_current = "../job_detail.php?job_id=" . $job_id;
        header("Location: " . $address_job_current);
    } else {
        echo $conn->error;
    }
}
