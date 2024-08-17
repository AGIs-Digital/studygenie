<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css" rel="stylesheet">
<style>
    .swal2-elegant-popup {
        border-radius: 12px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .swal2-elegant-title {
        font-size: 26px;
        color: #333;
        font-weight: 600;
        font-family: Milonga;
    }

    .swal2-elegant-content {
        font-size: 18px;
        color: #555;
    }

    .swal2-elegant-confirm-button {
        background-color: #1a73e8;
        color: #fff;
        border-radius: 8px;
        padding: 12px 24px;
        font-size: 16px;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .swal2-elegant-confirm-button:hover {
        background-color: #155ab6;
    }
</style>
<script>
    function showDialog() {
        Swal.fire({
            title: '<strong>Tool noch gesperrt</strong>',
            icon: 'info',
            html: 'Upgrade dein ' +
                '<a href="/profile" style="color: #e09e50; text-decoration: underline;">Abo</a> ' +
                'um dieses Tool zu benutzen.',
            showCloseButton: true,
            focusConfirm: false,
            confirmButtonText: 'Verstanden',
            confirmButtonColor: '#e09e50',
            customClass: {
                popup: 'swal2-elegant-popup',
                title: 'swal2-elegant-title',
                content: 'swal2-elegant-content',
                confirmButton: 'swal2-elegant-confirm-button'
            }
        });
    }

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>