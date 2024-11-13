//hiển thị mật khẩu
document.querySelectorAll('.view_password').forEach(button => {
    //console.log(button);
    button.addEventListener('click', function() {
        //const passwordInput = this.previousElementSibling;
        const passwordInput=this.closest('tr').querySelector('input');
        //console.log(passwordInput);
        if (passwordInput.getAttribute('type') === 'password') {
            passwordInput.setAttribute('type', 'text');
            this.textContent = 'Ẩn';
        } else {
            passwordInput.setAttribute('type', 'password');
            this.textContent = 'Hiển thị';
        }
    });
});
//nút reset
reset_btn=document.getElementById('reset_value');
reset_btn.addEventListener('click', function() {
    document.querySelector("input[name='name']").value = '';
    document.querySelector("input[name='email']").value = '';
    document.querySelector("input[name='username']").value = '';
    document.querySelector("input[name='password']").value = '';
    document.querySelector("input[name='password_confirm']").value = '';
});

// document.addEventListener('DOMContentLoaded', function () {
//     const btn_01 = document.querySelectorAll('.view_password')[0];
//     const passwordInput = btn_01.closest('tr').querySelector('input');
//     const strengthMessage = document.getElementById('strengthMessage');

//     passwordInput.addEventListener('input', function () {
//         let strength = 0;
//         const password = passwordInput.value;

//         if (password.length >= 8) strength++;
//         if (/[A-Z]/.test(password)) strength++;
//         if (/[a-z]/.test(password)) strength++;
//         if (/[0-9]/.test(password)) strength++;
//         if (/[@$!%*?&#]/.test(password)) strength++;

//         switch (strength) {
//             case 0:
//             case 1:
//             case 2:
//                 strengthMessage.textContent = 'Mật khẩu yếu';
//                 strengthMessage.className = 'weak';
//                 break;
//             case 3:
//                 strengthMessage.textContent = 'Mật khẩu trung bình';
//                 strengthMessage.className = 'medium';
//                 break;
//             case 4:
//             case 5:
//                 strengthMessage.textContent = 'Mật khẩu mạnh';
//                 strengthMessage.className = 'strong';
//                 break;
//         }
//     });
// });
document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.querySelector("input[name='password']");
    const strengthMessage = document.getElementById('strengthMessage');
    const segments = document.querySelectorAll('.strengthSegment');

    const resetForm = () => {
        document.querySelectorAll("input[name='name'], input[name='email'], input[name='username'], input[name='password'], input[name='password_confirm']").forEach(input => {
            input.value = '';
        });

        segments.forEach(segment => {
            segment.style.backgroundColor = 'transparent';
        });
        strengthMessage.textContent = '';
    };

    const checkPasswordStrength = () => {
        let strength = 0;
        const password = passwordInput.value;

        if (password.length >= 8) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[@$!%*?&#]/.test(password)) strength++;

        segments.forEach((segment, index) => {
            segment.style.backgroundColor = index < strength ? segmentColors(index) : 'transparent';
        });

        strengthMessage.textContent = strength ? '' : '';
    };

    const segmentColors = (index) => {
        switch (index) {
            case 0: return 'red'; 
            case 1: return 'orange'; 
            case 2: return 'yellow'; 
            case 3: return 'lightgreen'; 
            case 4: return 'green'; 
        }
    };

    passwordInput.addEventListener('input', checkPasswordStrength);

    document.getElementById('reset_value').addEventListener('click', resetForm);
});

function togglePasswordVisibility(inputName) {
    const inputField = document.querySelector(`input[name='${inputName}']`);
    const eyeIcon = document.getElementById(inputName === 'password' ? 'eyeIconPassword' : 'eyeIconConfirmPassword');

    if (inputField.type === 'password') {
        inputField.type = 'text';
        eyeIcon.src = '../helpers/css/images/eye-icon.png'; // Hình ảnh con mắt mở
    } else {
        inputField.type = 'password';
        eyeIcon.src = '../helpers/css/images/eye-off-icon.png'; // Hình ảnh con mắt đóng
    }
}
