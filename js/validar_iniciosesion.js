async function validarFormulario(event) {
  event.preventDefault(); // Evitar el envío del formulario de forma predeterminada

  var correo = document.getElementById("correo").value;
  var contrasena = document.getElementById("contrasena").value;

  // Comprobar si los campos están vacíos
  if (correo.trim() === "" || contrasena.trim() === "") {
      alert("Por favor, complete todos los campos.");
      return false;
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

  try {
      const response = await fetch('/api/verificarCorreo', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json'
          },
          body: JSON.stringify({ correo: correo })
      });
      const data = await response.json();
      if (!data.existe) {
          alert("Correo no válido o usuario no encontrado. Por favor, verifique sus datos.");
          return false;
      } else {
          document.getElementById("miFormulario").submit(); // Permitir el envío del formulario
      }
  } catch (error) {
      console.error('Error:', error);
      alert("Hubo un problema con la verificación del correo. Por favor, intente nuevamente.");
      return false;
  }
}
