document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("factura-form");
    const separarCheckbox = document.getElementById("separar");
    const comprarCheckbox = document.getElementById("comprar");
    const ticket = document.querySelector(".ticket");
    const metodosPago = document.getElementById("metodos-pago");

    separarCheckbox.addEventListener("change", () => {
        if (separarCheckbox.checked) {
            ticket.style.display = "block";
            comprarCheckbox.checked = false;
            metodosPago.disabled = true;
        } else {
            ticket.style.display = "none";
            metodosPago.disabled = false;
        }
    });

    comprarCheckbox.addEventListener("change", () => {
        if (comprarCheckbox.checked) {
            separarCheckbox.checked = false;
            ticket.style.display = "none";
            metodosPago.disabled = false;
        }
    });

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        alert("Formulario enviado");
    });
});
