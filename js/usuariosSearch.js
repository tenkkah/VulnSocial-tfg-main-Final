const searchBar = document.querySelector(".search input");
const searchIcon = document.querySelector(".search button");
const usersList = document.querySelector(".users-list");

// Mostrar y ocultar la barra de búsqueda
searchIcon.onclick = () => {
  searchBar.classList.toggle("show");
  searchIcon.classList.toggle("active");
  searchBar.focus();
  if (searchBar.classList.contains("active")) {
    searchBar.value = "";
    searchBar.classList.remove("active");
  }
};

// Función para obtener usuarios desde el servidor
async function fetchUsuarios(searchTerm = "") {
  try {
    let url = "../src/controladores/usuarios.php?action=usuariosParaChat";
    if (searchTerm) {
      url += `&search=${encodeURIComponent(searchTerm)}`;
    }

    const response = await fetch(url);
    if (!response.ok) throw new Error("Error al obtener usuarios");

    const usuarios = await response.json();
    usersList.innerHTML = "";

    if (usuarios.length === 0) {
      usersList.innerHTML = "<p>No se encontraron usuarios.</p>";
    } else {
      usuarios.forEach(usuario => {
        // Preparar datos
        const lastMessage = usuario.last_message || "No hay mensajes disponibles";
        const truncatedMessage = lastMessage.length > 28 ? lastMessage.substring(0, 28) + "..." : lastMessage;
        
        // Generar el HTML para cada usuario
        const userElement = `
          <a href="chat.php?id=${encodeURIComponent(usuario.id)}">
            <div class="content">
              <div class="details">
                <img src="../avatar/${usuario.avatar}" class="profile-pic" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc; margin-bottom: 10px;">
                <span>${usuario.username}</span>
                <p>${truncatedMessage}</p>
              </div>
            </div>
            <div class="status-dot ${usuario.status === "Desconectado" ? "offline" : ""}">
              <i class="fas fa-circle"></i>
            </div>
          </a>
        `;

        // Añadir al contenedor
        usersList.innerHTML += userElement;
      });
    }
  } catch (error) {
    console.error("Error:", error);
    usersList.innerHTML = "<p>Error al cargar usuarios.</p>";
  }
}


// Manejo de la búsqueda
searchBar.onkeyup = () => {
  const searchTerm = searchBar.value.trim();
  console.log(searchTerm);
  if (searchTerm !== "") {
    searchBar.classList.add("active");
    fetchUsuarios(searchTerm); // Buscar usuarios
  } else {
    searchBar.classList.remove("active");
    fetchUsuarios(); // Recargar lista completa si no hay término de búsqueda
  }
};

// Actualización periódica de la lista de usuarios
setInterval(() => {
  if (!searchBar.classList.contains("active")) {
    fetchUsuarios();
  }
}, 3000); // Intervalo de 5 segundos
