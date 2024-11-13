const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('MatKhau');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.src = type === 'password' ? '../helpers/css/images/eye-off-icon.png' : '../helpers/css/images/eye-icon.png';
    });

function confirmLogout() {
        if (confirm("Bạn có chắc chắn muốn đăng xuất không?")) {
            window.location.href = '../dangnhap/dangnhap.php';
        }
    }