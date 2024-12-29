// main.js
async function obtenerListaTotal(page = 1, limit = 5) {
    try {
        const response = await fetch(`src/controladores/posts.php?action=listaPosts&page=${page}&limit=${limit}`);
        if (!response.ok) throw new Error('Error en la solicitud');
        const data = await response.json();
        console.log(data);
        return data;
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
}

async function mostrarPosts(page = 1, limit = 5) {
    const postsData = await obtenerListaTotal(page, limit);
    console.log(postsData);
    const postsContainer = document.getElementById('postsContainer');
    const paginationContainer = document.getElementById('paginationContainer'); // Contenedor de paginación

    postsContainer.innerHTML = ''; // Limpiar los posts
    paginationContainer.innerHTML = ''; // Limpiar la paginación

        // Obtener el usuario logueado (si existe) de forma segura
        let loggedUser = null;
        const loggedUserRaw = localStorage.getItem("loggedUser");
        if (loggedUserRaw) {
            try {
                loggedUser = loggedUserRaw;
            } catch (error) {
                console.error("Error al parsear loggedUser:", error);
            }
        }

        postsData.posts.forEach(async (post) => {
            const contentHtml = post.content ? `<p class="card-text">${post.content}</p>` : '';
    
            // Determinar si es una imagen o un video
            let mediaHtml = '';
            if (post.media_path) {
                const extension = post.media_path.split('.').pop().toLowerCase();
                if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
                    mediaHtml = `<img src="uploads/${post.media_path}" alt="Media del post" class="img-fluid mt-2" style="width: 100%; max-width: 400px; height: auto;">`;
                } else if (['mp4', 'webm', 'ogg'].includes(extension)) {
                    mediaHtml = `
                        <video controls class="mt-2" style="width: 100%; max-width: 400px; height: auto;">
                            <source src="uploads/${post.media_path}" type="video/${extension}">
                            Tu navegador no soporta la reproducción de video.
                        </video>`;
                }
            }
    
            const hashtags = JSON.parse(post.hashtags || "[]");
            const hashtagsHtml = hashtags.length > 0 ? `
                <div class="hashtags mt-2">
                    ${hashtags.map(hashtag => `<div class="hashtag-item">${hashtag}</div>`).join('')}
                </div>
            ` : '';
    
            // Botón de like
            const likeStatusResponse = await fetch(`src/controladores/likes.php?postId=${post.id}`);
            const likeStatus = await likeStatusResponse.json();
            const likeButtonHtml = loggedUser ? `
                <button id="likeBtn_${post.id}" class="btn btn-outline-none like-btn" onclick="toggleLike(${post.id})" style="background: none; border: none; display: flex; align-items: center; gap: 5px;">
                    <i id="icon_${post.id}" class="fa${likeStatus.liked ? 's' : 'r'} fa-heart" style="font-size: 24px; color: ${likeStatus.liked ? 'red' : 'gray'};"></i>
                    <span id="likeCount_${post.id}" class="likes-count">${post.likes}</span>
                </button>
            ` : `
                <div style="display: flex; align-items: center; gap: 5px;">
                    <i class="far fa-heart" style="font-size: 24px; color: gray;"></i>
                    <span class="likes-count">${post.likes}</span>
                </div>`;
    
            const postCard = `
                <div class="card rounded mt-3 post-card" id="post_${post.id}">
                    <div class="card-body">
                        <h5 class="card-title">
                        <img src="avatar/${post.avatar}" alt="${post.username}'s avatar" class="profile-pic" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc; margin-right: 10px;">
                            <a href="templates/perfil.php?id=${post.user_id}" class="username-link">
                                ${post.username}
                            </a> 
                            - <small class="text-muted">${new Date(post.fecha).toLocaleDateString()}</small>
                        </h5>
                        <div class="post-content">
                            ${contentHtml}
                            ${mediaHtml}
                        </div>
    
                        <!-- Botón de Like -->
                        ${likeButtonHtml}
    
                        <!-- Botón para respuestas y formulario si el usuario está logueado -->
                        ${loggedUser ? `<div class="respuesta-form mt-3">
                            <textarea id="respuesta_${post.id}" class="form-control" rows="2" placeholder="Escribe una respuesta..."></textarea>
                            <button onclick="agregarRespuesta(${post.id}, ${post.user_id}, document.getElementById('respuesta_${post.id}').value)" class="btn btn-primary btn-sm mt-2">Responder</button>
                        </div>` : ''}
    
                        <button class="btn btn-secondary btn-sm mt-2 btnVerRespuestas" onclick="mostrarRespuestas(${post.id})">Ver respuestas</button>
                        <div id="respuestas_${post.id}" class="respuestas-container mt-3" style="display: none;"></div>
    
                        <!-- Hashtags -->
                        <div class="hashtags-container">
                            ${hashtagsHtml}
                        </div>
                    </div>
                </div>
            `;
            postsContainer.innerHTML += postCard;
        });
    

    // Mostrar los botones de paginación
    for (let i = 1; i <= postsData.totalPages; i++) {
        const button = document.createElement('button');
        button.textContent = i;
        button.className = `btn btn-sm ${i === page ? 'btn-primary' : 'btn-secondary'}`;
        button.onclick = () => mostrarPosts(i, limit);
        paginationContainer.appendChild(button);
    }
}


async function toggleLike(postId) {
    const response = await fetch('src/controladores/likes.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ postId }),
    });

    const result = await response.json();

    if (result.success) {
        const icon = document.getElementById(`icon_${postId}`);
        const likesCount = document.getElementById(`likeCount_${postId}`);

        // Cambiar el estado del corazón
        if (result.liked) {
            icon.classList.remove('far'); // Cambiar a corazón relleno
            icon.classList.add('fas');
            icon.style.color = 'red';
        } else {
            icon.classList.remove('fas'); // Cambiar a corazón vacío
            icon.classList.add('far');
            icon.style.color = 'gray';
        }

        // Actualizar el conteo de likes
        if (likesCount) {
            likesCount.innerText = result.likes; // Actualizar con el nuevo total
        }
    }
}





async function obtenerRespuestas(postId) {
    try {
        const response = await fetch(`src/controladores/posts.php?action=obtenerRespuestas&post_id=${postId}`);
        if (!response.ok) throw new Error('Error al obtener las respuestas');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error al obtener respuestas:', error);
        return [];
    }
}



async function mostrarRespuestas(postId) {
    const respuestasContainer = document.getElementById(`respuestas_${postId}`);
    if (!respuestasContainer) {
        console.error(`No se encontró el contenedor de respuestas para el post con ID: ${postId}`);
        return;
    }

    if (respuestasContainer.style.display === "none" || respuestasContainer.innerHTML.trim() === "") {
        const respuestas = await obtenerRespuestas(postId);
        if (!respuestas.success) {
            respuestasContainer.innerHTML = `<p>No hay respuestas para este post.</p>`;
        } else {
            const respuestasHtml = respuestas.respuestas.map(respuesta => `
                <div class="respuesta p-2 border rounded mt-2 respuesta-card">
                    <p><strong>${respuesta.username}</strong>:</p>
                    <p>${respuesta.content}</p>
                    <small class="text-muted">${new Date(respuesta.fecha).toLocaleString()}</small>
                </div>
            `).join("");
            respuestasContainer.innerHTML = respuestasHtml;
        }
        respuestasContainer.style.display = "block";
    } else {
        respuestasContainer.style.display = "none";
    }
}



document.addEventListener('DOMContentLoaded', mostrarPosts);





// Función para añadir una respuesta a un post
async function agregarRespuesta(postId, userId, content) {
    try {
        const response = await fetch('src/controladores/posts.php?action=addReply', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                post_id: postId,
                user_id: userId,
                content: content
            })
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
                title: "Respuesta añadida"
              });
            // Recargar o actualizar las respuestas del post
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
                title: "Error al añadir la respuesta"
              });
        }
    } catch (error) {
        console.error('Error al añadir la respuesta:', error);
    }
}


// Función para realizar un post en el index.php
$('#postForm').on('submit', function (e) {
    e.preventDefault();

    const postContent = $('#post').val();
    const mediaFile = $('input[name="media"]')[0].files[0]; // Obtener el archivo seleccionado (imagen o video)

    // Crear un objeto FormData para enviar el texto y el archivo
    const formData = new FormData();
    formData.append('post', postContent);
    if (mediaFile) {
        formData.append('media', mediaFile); // Cambiado a 'media' para coincidir con PHP
    }

    $.ajax({
        url: 'src/controladores/createPost.php',
        method: 'POST',
        data: formData,
        contentType: false, // Necesario para enviar datos de FormData
        processData: false, // Necesario para enviar datos de FormData
        success: function (response) {
            const postResponse = JSON.parse(response);
            if (postResponse.success) {
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
                    title: "Post creado"
                  });
                $('#post').val(''); // Limpiar el campo de texto del post
                $('input[name="media"]').val(''); // Limpiar el campo de archivo
                mostrarPosts(); // Recargar los posts
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
                    title: "Error al crear el post"
                  });
            }
        },
        error: function () {
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
                title: "Error en la solicitud"
              });
        }
    });
});



function toggleDropdown() {
    const dropdownMenu = document.getElementById('dropdownMenu');
    if (dropdownMenu.style.display === "none" || dropdownMenu.style.display === "") {
        dropdownMenu.style.display = "block";
    } else {
        dropdownMenu.style.display = "none";
    }
}

// Cerrar el dropdown si el usuario hace clic fuera de él
window.onclick = function(event) {
    const dropdownMenu = document.getElementById('dropdownMenu');
    if(dropdownMenu){
        if (!event.target.matches('.dropdown-toggle')) {
            dropdownMenu.style.display = "none";
        }
    }
}

    const postInput = document.getElementById("post");
    const autocompleteContainer = document.getElementById("autocompleteContainer");

    // Verificar si el input existe antes de intentar agregar el eventListener
    if (postInput && autocompleteContainer) {
        postInput.addEventListener("input", async (e) => {
            const content = e.target.value;
            const cursorPosition = e.target.selectionStart;

            // Detectar el último hashtag antes del cursor
            const hashIndex = content.lastIndexOf("#", cursorPosition - 1);
            if (hashIndex >= 0) {
                const query = content.substring(hashIndex + 1, cursorPosition).trim();
                if (query.length > 0) {
                    const hashtags = await fetchHashtags(query);
                    showAutocomplete(hashtags, hashIndex, content);
                } else {
                    autocompleteContainer.style.display = "none";
                }
            } else {
                autocompleteContainer.style.display = "none";
            }
        });
    } else {
        console.warn("El elemento con id 'post' o 'autocompleteContainer' no existe en el DOM.");
    }

  
  async function fetchHashtags(query) {
      try {
          const response = await fetch(`src/controladores/vulnerabilities.php?query=${encodeURIComponent(query)}`);
          if (!response.ok) throw new Error("Error al obtener hashtags");
          return await response.json();
      } catch (error) {
          console.error("Error:", error);
          return [];
      }
  }
  
  function showAutocomplete(hashtags, hashIndex, content) {
      autocompleteContainer.innerHTML = "";
      if (hashtags.length === 0) {
          autocompleteContainer.style.display = "none";
          return;
      }
  
      hashtags.forEach(({ hashtag }) => {
          const item = document.createElement("div");
          item.classList.add("autocomplete-item");
          item.textContent = hashtag;
          item.onclick = () => insertHashtag(hashtag, hashIndex, content);
          autocompleteContainer.appendChild(item);
      });
  
      autocompleteContainer.style.display = "block";
  }
  
  function insertHashtag(hashtag, hashIndex, content) {
    const beforeHash = content.substring(0, hashIndex);
    const afterHash = content.substring(postInput.selectionStart);
    
    // Verificar si el hashtag ya tiene el símbolo '#'
    const formattedHashtag = hashtag.startsWith('#') ? hashtag : `#${hashtag}`;

    postInput.value = `${beforeHash}${formattedHashtag} ${afterHash}`;
    postInput.focus();
    postInput.selectionStart = postInput.selectionEnd = beforeHash.length + formattedHashtag.length + 2;
    autocompleteContainer.style.display = "none";
}

