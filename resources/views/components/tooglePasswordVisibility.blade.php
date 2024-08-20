<style>
.password-field {
    position: relative;
}

.password-field input {
    padding-right: 55px; /* Platz für das Auge-Symbol, 15px mehr als vorher */
}

.password-field .toggle-password {
    position: absolute;
    top: 50%;
    right: 25px; /* 15px weiter nach links verschoben */
    transform: translateY(-50%);
    cursor: pointer;
}

.password-field .toggle-password img {
    width: 23px;
    height: 23px;
}
</style>

<script>
function togglePasswordVisibility() {
    const passwordRegisterInput = document.getElementById('password_register');
    const passwordLoginInput = document.getElementById('password_login');
    const passwordInput = document.getElementById('new_password');
    const toggleIcons = document.querySelectorAll('.toggle-password img');

    if (passwordRegisterInput) {
        const type = passwordRegisterInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordRegisterInput.setAttribute('type', type);
        toggleIcons[0].src = type === 'password' ? "{{ asset('asset/images/eye.svg') }}" : "{{ asset('asset/images/eye-off.svg') }}";
    }

    if (passwordLoginInput) {
        const type = passwordLoginInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordLoginInput.setAttribute('type', type);
        toggleIcons[1].src = type === 'password' ? "{{ asset('asset/images/eye.svg') }}" : "{{ asset('asset/images/eye-off.svg') }}";
    }

    if (passwordInput) {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        toggleIcons[2].src = type === 'password' ? "{{ asset('asset/images/eye.svg') }}" : "{{ asset('asset/images/eye-off.svg') }}";
    }
}
</script>