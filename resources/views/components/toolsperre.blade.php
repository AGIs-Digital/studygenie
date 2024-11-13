
<style>
    .swal2-elegant-popup {
        border-radius: 12px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .swal2-actions {
        justify-content: center !important;
    }

    .swal2-confirm {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 120px !important;
    }
</style>
<script>
    function showDialog() {
        Swal.fire({
            title: '<h2>Noch nicht freigeschaltet</h2>',
            imageUrl: '{{ asset('asset/images/lock2.svg') }}',
            imageWidth: 167,
            imageHeight: 243,
            html: 'Upgrade deinen <b>{{ auth()->user()->subscription_name }} - Status</b> zum Freischalten',
            showCloseButton: true,
            focusConfirm: false,
            confirmButtonText: 'Upgrade',
            confirmButtonColor: '#e09e50',
            customClass: {
                popup: 'swal2-elegant-popup',
                confirmButton: 'plancardButton'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ route('profile') }}';
            }
        });
    }

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>