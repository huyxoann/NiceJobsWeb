<?php
$code = '123456';
$username = 'trafa2003';
$content = 'Kính gửi, ' . $username . '<br>Tài khoản email của bạn đã được đăng kí tại NiceJob, đây là mật mã xác nhận của bạn. Vui lòng nhập để hoàn tất việc đăng kí.
        <br>Code của bạn là:
        <div class="alert alert-danger" role="alert">
        ' . $code . '    
        </div>';
echo $content;
