function submitForm(event) {
  event.preventDefault();

  const username = document.getElementById("username").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const profilePicture = document.getElementById("profile_picture").files[0]; 

  // Crear un objeto FormData con los valores del formulario
  const formData = new FormData();
  formData.append("username", username);
  formData.append("email", email);
  formData.append("password", password);
  if (profilePicture) {
      formData.append("profile_picture", profilePicture); // Agregar la imagen si existe
  }

  fetch("../src/controladores/procesarEdicionPerfil.php", {
      method: "POST",
      body: formData
  })
  .then(response => response.text())
  .then(data => {
      // Verificar la respuesta y mostrar una alerta
      if (data.includes("success=1")) {
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
              title: "Perfil actualizado correctamente"
            });

          // Si la imagen se actualizó, actualizar también la imagen de previsualización
          if (profilePicture) {
              const reader = new FileReader();
              reader.onload = function (e) {
                  document.getElementById("profile-preview").src = e.target.result;
              };
              reader.readAsDataURL(profilePicture); // Actualizar la previsualización
          }
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
              icon: "info",
              title: "Hubo un error al actualizar el perfil"
            });
      }
  })
  .catch(error => {
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
          title: "Error en la solicitud."
        });
  });
}


function togglePassword() {
    const passwordInput = document.getElementById("password");
    const toggleButton = passwordInput.nextElementSibling;

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleButton.textContent = "Ocultar";
    } else {
        passwordInput.type = "password";
        toggleButton.textContent = "Mostrar";
    }
}

function previewImage(event) {
  const file = event.target.files[0];
  const reader = new FileReader();
  
  reader.onload = function(e) {
      const image = document.getElementById('profile-preview');
      image.src = e.target.result; // Establece la nueva imagen seleccionada
  };
  
  if (file) {
      reader.readAsDataURL(file); // Lee la imagen como una URL de datos
  }
}

