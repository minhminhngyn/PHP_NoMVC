function checkRoleChange(selectElement, id) {
            const oldRole = selectElement.getAttribute('data-old-role');
            const newRole = selectElement.value;
            const saveButton = document.getElementById('save-' + id);
            const newRoleInput = document.getElementById('new-role-' + id);
            newRoleInput.value = newRole;
            saveButton.style.display = oldRole !== newRole ? 'inline-block' : 'none';
        }

function confirmLogout() {
            if (confirm("Bạn có chắc chắn muốn đăng xuất không?")) {
                window.location.href = '../dangnhap/dangnhap.php';
            }
        }