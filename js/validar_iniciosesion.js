function validarFormulario() {
    var correo = document.getElementById("correo").value;
    var contrasena = document.getElementById("contrasena").value;
  
    // Comprobar si los campos están vacíos
    if (correo.trim() === "" || contrasena.trim() === "") {
      alert("Por favor, complete todos los campos.");
      return false; // Evitar el envío del formulario
    }
  
    // Validación básica del formato del correo electrónico
    var correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!correoRegex.test(correo)) {
      alert("Por favor, ingrese un correo electrónico válido.");
      return false;
    }
  
    // Validación de la contraseña (mínimo 8 caracteres)
    if (contrasena.length < 8) {
      alert("La contraseña debe tener al menos 8 caracteres.");
      return false;
    }
  
    // Validación de caracteres no deseados en la contraseña
    var contrasenaRegex = /^[A-Za-z0-9!@#$%^&*()_+=\-`~\[\]{}|\\:;"'<>,.?/]+$/;
    if (!contrasenaRegex.test(contrasena)) {
      alert("La contraseña contiene caracteres no permitidos.");
      return false;
    }
  
    // Verificar si el correo está registrado
    fetch('/api/verificarCorreo', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ correo: correo })
    })
    .then(response => response.json())
    .then(data => {
      if (!data.existe) {
        alert("El correo no está registrado.");
        return false;
      } else {
        return true; // Permitir el envío del formulario
      }
    })
    .catch(error => {
      console.error('Error:', error);
      return false;
    });
  }