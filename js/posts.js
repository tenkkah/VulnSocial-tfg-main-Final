document.addEventListener('DOMContentLoaded', async () => {
    // Comprobar si el usuario es admin
    const isAdmin = localStorage.getItem('isAdmin');

    if (isAdmin !== '1') {
        // Redirigir al usuario a la página 404 si no es admin
        window.location.href = '../templates/404.html';
        return;
    }

    try {
        const response = await fetch('../src/controladores/postsAdmin.php?action=listaPosts');
        if (!response.ok) {
            throw new Error('Error al cargar los posts');
        }

        const posts = await response.json();

        const tbody = document.getElementById("postsBody");
        
        if (!tbody) {
            throw new Error('No se pudo encontrar el tbody');
        }

        tbody.innerHTML = '';

        posts.forEach(post => {
            const fila = document.createElement('tr');
            fila.innerHTML = `
                <td>${post.id}</td>
                <td>${post.content}</td>
                <td>${post.user_id || 'Desconocido'}</td> <!-- Cambiado para manejar un posible undefined -->
                <td>${new Date(post.fecha).toLocaleDateString()}</td> <!-- Formato de fecha -->
                <td><button class='btn btn-danger' onclick='eliminarPost(${post.id})'>Eliminar</button></td>
                <td><button class='btn btn-primary' onclick='editarPost(${post.id})'>Editar</button></td>
                
            `;
            tbody.appendChild(fila);
        });
    } catch (error) {
        console.error('Error:', error);
    }
});

async function mostrarPosts() {
    try {
        const response = await fetch('../src/controladores/postsAdmin.php?action=listaPosts');
        if (!response.ok) {
            throw new Error('Error al cargar los posts');
        }
        const posts = await response.json();
        const tbody = document.getElementById("postsBody");
        if (!tbody) {
            throw new Error('No se pudo encontrar el tbody');
        }
        tbody.innerHTML = '';

        posts.forEach(post => {
            const fila = document.createElement('tr');
            fila.innerHTML = `
                <td>${post.id}</td>
                <td>${post.content}</td>
                <td>${post.user_id || 'Desconocido'}</td>
                <td>${new Date(post.fecha).toLocaleDateString()}</td>
                <td><button class='btn btn-danger' onclick='eliminarPost(${post.id})'>Eliminar</button></td>
                <td><button class='btn btn-primary' onclick='editarPost(${post.id})'>Editar</button></td>
            `;
            tbody.appendChild(fila);
        });
    } catch (error) {
        console.error('Error al mostrar los posts:', error);
    }
}



async function eliminarPost(postId) {
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

    // Si el usuario confirma, procede a eliminar el post
    if (result.isConfirmed) {
        try {
            const response = await fetch('../src/controladores/deletePost.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: postId })
            });

            const result = await response.json();
            if (result.success) {
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
                    title: "El post ha sido eliminado"
                  });
                // Actualiza la lista de posts
                mostrarPosts();
            } else {
                Swal.fire(
                    'Error!',
                    result.message,
                    'error'
                );
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire(
                'Error!',
                'Ocurrió un error al intentar eliminar el post.',
                'error'
            );
        }
    }
}

async function editarPost(id) {
    try {
        const response = await fetch(`../src/controladores/posts.php?action=obtenerPost&id=${id}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos del post');
        }
        const post = await response.json();
        // Rellenar los campos del formulario en el modal con los datos del post
        document.getElementById('editPostId').value = post.id;
        document.getElementById('editPostContent').value = post.content;
        document.getElementById('editPostUserId').value = post.user_id;
        
        
        // Formatear la fecha correctamente
        const fecha = new Date(post.fecha);
        const formattedDate = `${fecha.getFullYear()}-${(fecha.getMonth() + 1).toString().padStart(2, '0')}-${fecha.getDate().toString().padStart(2, '0')}`;
        document.getElementById('editFecha').value = formattedDate;

        // Mostrar el modal
        const editPostModal = new bootstrap.Modal(document.getElementById('editPostModal'));
        editPostModal.show();
    } catch (error) {
        console.error('Error al editar el post:', error);
    }
}


const postModal = new bootstrap.Modal(document.getElementById('editPostModal'));

// Evento para guardar cambios al hacer clic en el botón "Guardar Cambios"
document.getElementById('savePostChanges').addEventListener('click', async function () {
    const id = document.getElementById('editPostId').value;
    const content = document.getElementById('editPostContent').value;
    const user_id = document.getElementById('editPostUserId').value;
    const fecha = document.getElementById('editFecha').value;  

    // Preparar datos a enviar
    const datos = {
        id,
        content,
        user_id,
        fecha  
    };

    try {
        const response = await fetch('../src/controladores/posts.php?action=actualizarPost', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datos)
        });

        const result = await response.json();
        if (result.success) {
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
            title: "El post ha sido editado"
          });
            postModal.hide();
            mostrarPosts(); 
        } else {
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
                title: "Error al editar el post"
              });
        }
    } catch (error) {
        console.error('Error al actualizar el post:', error);
    }
});






