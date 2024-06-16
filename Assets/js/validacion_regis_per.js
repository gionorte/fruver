document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('form').addEventListener('submit', function(event) {
        let isValid = true;
        const fields = [
            { id: 'num_doc', message: 'Ingrese su número de documento.' },
            { id: 'tipo_doc', message: 'Seleccione el tipo de documento.' },
            { id: 'prim_nombre', message: 'Ingrese su primer nombre.' },
            { id: 'prim_apellido', message: 'Ingrese su primer apellido.' },
            { id: 'telefono', message: 'Ingrese su número de teléfono.' },
            { id: 'correo', message: 'Ingrese su correo electrónico.' },
            { id: 'contrasena', message: 'Ingrese su contraseña.' },
            { id: 'salario', message: 'Ingrese su salario.' },
            { id: 'id_cargo', message: 'Seleccione un cargo.' }
        ];

        fields.forEach(field => {
            const element = document.getElementById(field.id);
            const errorElement = document.getElementById(`${field.id}_error`);
            if (element.value.trim() === '' || (element.tagName === 'SELECT' && element.value === '')) {
                errorElement.textContent = field.message;
                isValid = false;
            } else {
                errorElement.textContent = '';
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });
});