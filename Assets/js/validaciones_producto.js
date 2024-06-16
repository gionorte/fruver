   // Validar Nombre del Producto
   const nomProduct = document.getElementById('nom_product');
   const nomProductError = document.getElementById('nom_product_error');
   if (nomProduct.value.trim() === '') {
       nomProductError.textContent = 'Ingrese el nombre del producto.';
       isValid = false;
   } else {
       nomProductError.textContent = '';
   }

   // Validar Cantidad
   const cantidad = document.getElementById('cantidad');
   const cantidadError = document.getElementById('cantidad_error');
   if (cantidad.value.trim() === '') {
       cantidadError.textContent = 'Ingrese la cantidad del producto.';
       isValid = false;
   } else {
       cantidadError.textContent = '';
   }

   // Validar Fecha de Vencimiento
   const fechaVenc = document.getElementById('fecha_venc');
   const fechaVencError = document.getElementById('fecha_venc_error');
   if (fechaVenc.value.trim() === '') {
       fechaVencError.textContent = 'Ingrese la fecha de vencimiento del producto.';
       isValid = false;
   } else {
       fechaVencError.textContent = '';
   }

   // Validar Descripción
   const descripcion = document.getElementById('descripcion');
   const descripcionError = document.getElementById('descripcion_error');
   if (descripcion.value.trim() === '') {
       descripcionError.textContent = 'Ingrese la descripción del producto.';
       isValid = false;
   } else {
       descripcionError.textContent = '';
   }

   // Validar Estado
   const idEstado = document.getElementById('id_estado');
   const idEstadoError = document.getElementById('id_estado_error');
   if (idEstado.value === '') {
       idEstadoError.textContent = 'Seleccione el estado del producto.';
       isValid = false;
   } else {
       idEstadoError.textContent = '';
   }

   // Validar Precio
   const precio = document.getElementById('precio');
   const precioError = document.getElementById('precio_error');
   if (precio.value.trim() === '') {
       precioError.textContent = 'Ingrese el precio del producto.';
       isValid = false;
   } else {
       precioError.textContent = '';
   }

   // Validar Imagen
   const imagen = document.getElementById('imagen');
   const imagenError = document.getElementById('imagen_error');
   if (imagen.value.trim() === '') {
       imagenError.textContent = 'Seleccione una imagen para el producto.';
       isValid = false;
   } else {
       imagenError.textContent = '';
   }

   if (!isValid) {
       event.preventDefault();
   }

