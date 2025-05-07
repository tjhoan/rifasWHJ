document.addEventListener("DOMContentLoaded", function () {
    const successMessage = "{{ session('success') }}";
    const errorMessage = "{{ session('error') }}";

    if (successMessage) {
        Swal.fire({
            icon: "success",
            title: "¡Éxito!",
            text: successMessage,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Aceptar",
        });
    }

    if (errorMessage) {
        Swal.fire({
            icon: "error",
            title: "¡Error!",
            text: errorMessage,
            confirmButtonColor: "#d33",
            confirmButtonText: "Aceptar",
        });
    }
});
