<style>
.password-field {
    position: relative;
}

.password-field input {
    padding-right: 10px; /* Platz für das Auge-Symbol, 15px mehr als vorher */
}

.password-field .toggle-password {
    position: absolute;
    top: 50%;
    right: 25px; /* 15px weiter nach links verschoben */
    transform: translateY(-50%);
    cursor: pointer;
}

.password-field .toggle-password img {
    width: 21px;
    height: 21px;
}
</style>

<script>
function togglePasswordVisibility() {
    const passwordFields = document.querySelectorAll('.password-field input');
    const toggleIcons = document.querySelectorAll('.toggle-password img');

    passwordFields.forEach((field, index) => {
        const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', type);
        toggleIcons[index].src = type === 'password' ? "{{ asset('asset/images/eye.svg') }}" : "{{ asset('asset/images/eye-off.svg') }}";
    });
}
</script>