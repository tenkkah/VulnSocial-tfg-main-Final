document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault(); 

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;



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

        const data = await response.json(); 
        if (data.success) {
            localStorage.setItem('idUsuario', data.idUsuario);
            localStorage.setItem('isAdmin', data.isAdmin);
            localStorage.setItem('loggedUser',data.email);

            window.location.href = '../index.php';
        } else {
            document.getElementById('loginError').style.display = 'block';
            document.getElementById('loginError').textContent = data.message;
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
});
