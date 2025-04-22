document.addEventListener("DOMContentLoaded", () => {
    const selectedNumbers = new Set();

    document.querySelectorAll(".number").forEach((button) => {
        button.addEventListener("click", () => {
            const id = button.dataset.id;

            if (selectedNumbers.has(id)) {
                selectedNumbers.delete(id);
                button.classList.remove("selected");
            } else {
                selectedNumbers.add(id);
                button.classList.add("selected");
            }
        });
    });

    const form = document.querySelector("form[action*='carrito/add-selected']");
    form.addEventListener("submit", (event) => {
        const selectedArray = Array.from(selectedNumbers);
        document.getElementById("selected-numbers").value = JSON.stringify(selectedArray);

        if (selectedArray.length === 0) {
            event.preventDefault();
            alert("Por favor, selecciona al menos un número.");
        }
    });
});
