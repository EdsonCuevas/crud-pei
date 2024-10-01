<template>
    <footer class="bg-gray-900 text-white py-12">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div>
            <h3 class="text-lg font-bold mb-4">Fundación CTI</h3>
            <p>Trabajando por un futuro mejor a través del conocimiento y la innovación.</p>
          </div>
          <div>
            <h3 class="text-lg font-bold mb-4">Enlaces Rápidos</h3>
            <ul class="space-y-2">
              <li><a href="#" class="hover:underline">Inicio</a></li>
              <li><a href="#" class="hover:underline">Proyectos</a></li>
              <li><a href="#" class="hover:underline">Noticias</a></li>
              <li><a href="#" class="hover:underline">Contacto</a></li>
            </ul>
          </div>
          <div>
            <h3 class="text-lg font-bold mb-4">Contacto</h3>
            <p>Email:</p>
            <p>Teléfono:</p>
          </div>
          <div>
            <h3 class="text-lg font-bold mb-4">Síguenos</h3>
            <div class="flex space-x-4">
              <a href="#" class="hover:text-blue-400"><Facebook /></a>
              <a href="#" class="hover:text-blue-400"><Twitter /></a>
              <a href="#" class="hover:text-blue-400"><Linkedin /></a>
              <a href="#" class="hover:text-blue-400"><Youtube /></a>
            </div>
          </div>
        </div>
        <div class="mt-8 pt-8 border-t border-gray-700 text-center">
          <p>&copy; {{ new Date().getFullYear() }} Fundación BBVA. Todos los derechos reservados.</p>
        </div>
      </div>
    </footer>
  </template>
  