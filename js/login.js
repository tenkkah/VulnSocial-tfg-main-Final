document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault(); // Prevenir el comportamiento por defecto del formulario

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    console.log(email);
    console.log(password);


    try {
        const response = await fetch('../src/controladores/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                email: email,
                password: password,
            }),
        });

        const data = await response.json(); // Procesar la respuesta como JSON
        console.log(data);
        console.log(data.idUsuario);
        console.log(data.username);
        console.log(data.isAdmin);
        if (data.success) {
            // Guardar la sesión en localStorage
            localStorage.setItem('idUsuario', data.idUsuario);
            localStorage.setItem('isAdmin', data.isAdmin);
            localStorage.setItem('loggedUser',data.email);

            // Redirigir al index.php si el login es exitoso
            window.location.href = '../index.php';
        } else {
            // Mostrar mensaje de error si el login falla
            document.getElementById('loginError').style.display = 'block';
            document.getElementById('loginError').textContent = data.message;
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
});
