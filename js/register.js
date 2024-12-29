document.getElementById('registerForm').addEventListener('submit', async function (e) {
    e.preventDefault(); // Prevenir el comportamiento por defecto del formulario

    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const avatar = document.getElementById('avatar').files[0]; // Obtener el archivo seleccionado
    console.log(avatar);

    // Validaciones del lado del cliente
    const usernameRegex = /^[a-zA-Z0-9_]{3,20}$/; // Al menos 3 caracteres, alfanuméricos o guiones bajos
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Formato de email válido
    const passwordRegex = /^.{8,}$/; // Mínimo 8 caracteres

    let valid = true;
    let errorMessage = '';

    if (!usernameRegex.test(username)) {
        valid = false;
        errorMessage += 'El nombre de usuario debe tener entre 3 y 20 caracteres alfanuméricos o guiones bajos.\n';
    }
    if (!emailRegex.test(email)) {
        valid = false;
        errorMessage += 'El email no es válido.\n';
    }
    if (!passwordRegex.test(password)) {
        valid = false;
        errorMessage += 'La contraseña debe tener al menos 8 caracteres.\n';
    }
    if (!avatar) {
        valid = false;
        errorMessage += 'Debe subir un avatar.\n';
    } else {
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        const fileExtension = avatar.name.split('.').pop().toLowerCase();
        if (!allowedExtensions.includes(fileExtension)) {
            valid = false;
            errorMessage += 'El avatar debe ser una imagen (jpg, jpeg, png o gif).\n';
        }
        if (avatar.size > 2 * 1024 * 1024) { // Máximo 2 MB
            valid = false;
            errorMessage += 'El avatar no debe superar los 2 MB.\n';
        }
    }

    if (!valid) {
        document.getElementById('registerError').style.display = 'block';
        document.getElementById('registerError').textContent = errorMessage;
        return; // Salir si hay errores de validación
    }

    // Si las validaciones son exitosas, proceder con el registro
    try {
        const formData = new FormData();
        formData.append('username', username);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('avatar', avatar); // Añadir el archivo al FormData

        const response = await fetch('../src/controladores/register.php', {
            method: 'POST',
            body: formData, // Enviar FormData directamente
        });

        const data = await response.json();
        console.log(data);
        if (data.success) {
            // Redirigir al login.html si el registro es exitoso
            window.location.href = 'login.html';
        } else {
            // Mostrar mensaje de error si el registro falla
            document.getElementById('registerError').style.display = 'block';
            document.getElementById('registerError').textContent = data.message;
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
});
