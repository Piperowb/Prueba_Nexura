function validateForm() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var area = document.getElementById("area").value;
            var descripcion = document.getElementById("description").value;
            var checkboxes = document.querySelectorAll('input[name="rol[]"]:checked');

            // Validar campos requeridos
            if (name.trim() === "") {
                alert("Por favor, ingresa el nombre completo.");
                return false;
            }

            if (email.trim() === "") {
                alert("Por favor, ingresa el correo electrónico.");
                return false;
            }

            // Validar formato de correo electrónico
            var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (!emailRegex.test(email)) {
                alert("Por favor, ingresa un correo electrónico válido.");
                return false;
            }

            if (area === "") {
                alert("Por favor, selecciona el área.");
                return false;
            }

            if (descripcion === "") {
                alert("Por favor, selecciona la descripción.");
                return false;
            }

            if (checkboxes.length === 0) {
                alert("Por favor, selecciona al menos un rol.");
                return false;
            }

            // Validación exitosa en el lado del cliente
            return true;
        }

function closeConfirmationMessage(button) {
        var confirmationMessage = button.parentNode;
        confirmationMessage.style.display = 'none';
}