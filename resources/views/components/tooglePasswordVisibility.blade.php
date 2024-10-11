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