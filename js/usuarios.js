document.addEventListener('DOMContentLoaded', function() {
    // Comprobar si el usuario es admin
    const isAdmin = localStorage.getItem('isAdmin');

    if (isAdmin !== '1') {
        // Redirigir al usuario a la página 404 si no es admin
        window.location.href = '../templates/404.html';
        return;
    }

    // Función para cargar usuarios


    // Llamar a la función para cargar los usuarios al cargar la página
    cargarUsuarios();
});



    async function cargarUsuarios() {
        try {
            // Realizar la petición con fetch y await
            const response = await fetch('../src/controladores/usuarios.php?action=listaUsuarios');
            
            // Verificar si la respuesta es correcta
            if (!response.ok) {
                throw new Error(`Error: ${response.status}`);
            }

            // Convertir la respuesta a JSON
            const data = await response.json();
            console.log(data);

            // Obtener el tbody de la tabla
            const tbody = document.querySelector('#usuariosTable tbody');
            tbody.innerHTML = ''; // Limpiar el contenido del tbody

            // Verificar si no hay usuarios
            if (data.length === 0) {
                const fila = document.createElement('tr');
                fila.innerHTML = `<td colspan="6">No hay usuarios disponibles.</td>`;
                tbody.appendChild(fila);
                return;
            }
            // Recorrer los usuarios y agregarlos a la tabla
            data.forEach(usuario => {
                const fila = document.createElement('tr');
                fila.innerHTML = `
                    <td>${usuario.id}</td>
                    <td>${usuario.username}</td>
                    <td>${usuario.email}</td>
                    <td>${usuario.password}</td>
                    <td>${usuario.admin == 1 ? 'Sí' : 'No'}</td> <!-- Verifica si es admin -->
                    <td><button class='btn btn-danger' onclick='eliminarUsuario(${usuario.id})'>Eliminar</button></td>
                    <td><button class='btn btn-primary' onclick='editarUsuario(${usuario.id})'>Editar</button></td>
                `;
                tbody.appendChild(fila);
            });
        } catch (error) {
            console.error('Error al cargar los usuarios:', error);

            // Mostrar mensaje de error en la tabla
            const tbody = document.querySelector('#usuariosTable tbody');
            tbody.innerHTML = '';
            const fila = document.createElement('tr');
            fila.innerHTML = `<td colspan="6">Error al cargar los usuarios.</td>`;
            tbody.appendChild(fila);
        }
    }

//Funciona pero tengo que ver el metodo para llamar al mostrar usuarios
async function eliminarUsuario(usuarioId) {
    // Mostrar el diálogo de confirmación
    const result = await Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás recuperar este post después de eliminarlo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });

    // Si el usuario confirma, procede a eliminar el usuario
    if (result.isConfirmed) {
        try {
            const response = await fetch('../src/controladores/deleteUsuario.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: usuarioId })
            });

            const result = await response.json();
            console.log(result);
            if (result.success) {
                // Mostrar mensaje de éxito
                const Toast = Swal.mixin({
                    toast: true,
                    position: "bottom-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.onmouseenter = Swal.stopTimer;
                      toast.onmouseleave = Swal.resumeTimer;
                    }
                  });
                  Toast.fire({
                    icon: "success",
                    title: "El usuario ha sido eliminado"
                  });
                // Actualiza la lista de posts
                cargarUsuarios(); // Asume que tienes una función para recargar los posts
            } else {
                // Mostrar mensaje de error
                const Toast = Swal.mixin({
                    toast: true,
                    position: "bottom-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.onmouseenter = Swal.stopTimer;
                      toast.onmouseleave = Swal.resumeTimer;
                    }
                  });
                  Toast.fire({
                    icon: "error",
                    title: "Error"
                  });
            }
        } catch (error) {
            console.error('Error:', error);
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.onmouseenter = Swal.stopTimer;
                  toast.onmouseleave = Swal.resumeTimer;
                }
              });
              Toast.fire({
                icon: "error",
                title: "'Ocurrió un error al intentar eliminar el post",
              });
        }
    }
}

async function editarUsuario(id) {
    try {
        // Obtener los datos del usuario seleccionado
        const response = await fetch(`../src/controladores/usuarios.php?action=obtenerUsuario&id=${id}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos del usuario');
        }
        const usuario = await response.json();
        console.log(usuario);

        // Rellenar los campos del formulario en el modal con los datos del usuario
        document.getElementById('editId').value = usuario.id;
        console.log(usuario.id);
        document.getElementById('editUsername').value = usuario.username;
        document.getElementById('editEmail').value = usuario.email;
        document.getElementById("editPassword").value = usuario.password;
        document.getElementById('editAdmin').value = usuario.admin;

        // Mostrar el modal
        const editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
        console.log(editUserModal);
        editUserModal.show();
    } catch (error) {
        console.error('Error al cargar los datos del usuario:', error);
        alert('Error al cargar los datos del usuario.');
    }
}

const myModal = new bootstrap.Modal(document.getElementById('editUserModal'));

// Evento para guardar cambios al hacer clic en el botón "Guardar Cambios"
document.getElementById('saveChanges').addEventListener('click', async function () {
    const id = document.getElementById('editId').value;
    const username = document.getElementById('editUsername').value;
    const email = document.getElementById('editEmail').value;
    const password = document.getElementById("editPassword").value;
    const admin = document.getElementById('editAdmin').value;

    // Preparar datos a enviar
    const datos = {
        id,
        username,
        email,
        password,
        admin
    };

    try {
        // Enviar los datos actualizados al servidor
        const response = await fetch('../src/controladores/usuarios.php?action=actualizarUsuario', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datos)
        });

        const result = await response.json();
        if (result.success) {
            //Cierra el modal 
            document.querySelector('button#cerrar').click();            
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.onmouseenter = Swal.stopTimer;
                  toast.onmouseleave = Swal.resumeTimer;
                }
              });
              Toast.fire({
                icon: "success",
                title: "El usuario ha sido editado"
              });
            myModal.hide()
            cargarUsuarios();
        } else {
            alert('Error al actualizar el usuario');
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.onmouseenter = Swal.stopTimer;
                  toast.onmouseleave = Swal.resumeTimer;
                }
              });
              Toast.fire({
                icon: "error",
                title: "Error al editar el usuario"
              });
        }
    } catch (error) {
        console.error('Error al actualizar el usuario:', error);
    }
});


