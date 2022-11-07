function passwordChanged() {
    var strength = document.getElementById('strength');
    var strongRegex = new RegExp("^(?=.{14,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
    var mediumRegex = new RegExp("^(?=.{10,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
    var enoughRegex = new RegExp("(?=.{8,}).*", "g");
    var pwd = document.getElementById("password");
    if (pwd.value.length == 0) {
        strength.innerHTML = 'Type Password';
    } else if (false == enoughRegex.test(pwd.value)) {
        strength.innerHTML = 'Mật khẩu phải từ 8 kí tự trở lên';
    } else if (strongRegex.test(pwd.value)) {
        strength.innerHTML = '<span style="color:green">Mật khẩu mạnh</span>';
    } else if (mediumRegex.test(pwd.value)) {
        strength.innerHTML = '<span style="color:orange">Mật khẩu trung bình</span>';
    } else {
        strength.innerHTML = '<span style="color:red">Mật khẩu yếu</span>';
    }
}

function match_pass() {
    var button = document.getElementById('btnDN')
    var re_pass_mess = document.getElementById('re_pass_mess');
    var first_password = document.form.password.value;
    var second_password = document.form.re_password.value;

    if (!(first_password === second_password)) {
        re_pass_mess.innerHTML = '<span style="color:red">Nhập lại mật khẩu phải giống với mật khẩu</span>'
    } else {
        re_pass_mess.innerHTML = ''
    }
}

// function check_form() {
//     var button = document.getElementById('btnDN')
//     var username = document.getElementById('username').value
//     var password = document.getElementById('password').value
//     var re_password = document.getElementById('re_password').value
//     var email = document.getElementById('email').value

//     if (username == '') {
//         username.innerHTML = '<span style="color:red">Vui lòng nhập Username</span>';
//     } else if (password == '') {
//         password.innerHTML = '<span style="color:red">Vui lòng nhập Password</span>';
//     }
//     else if (re_password == '') {
//         re_password.innerHTML = '<span style="color:red">Vui lòng nhập Re-Password</span>';
//     }
//     else if (email == '') {
//         email.innerHTML = '<span style="color:red">Vui lòng nhập Email</span>';
//     }
//     else {
//         button.innerHTML = '<button onclick="return check_form()" name="register" class="btn btn-success btn-lg" type="submit" style="background-color: #2A5DDE;" id="btnDN">Đăng ký ngay</button>'
//     }
// }
