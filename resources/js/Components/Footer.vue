<template>
    <footer class="bg-gray-900 text-white py-12">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div>
            <h3 class="text-lg font-bold mb-4">Fundación CTI</h3>
            <p>Working for a better future through knowledge and innovation.</p>
            <br>
            <a href="/terms-conditions" class="hover:underline"><p>Privacy Policy</p></a>
          </div>
          <div>
            <h3 class="text-lg font-bold mb-4">Quick Links</h3>
            <ul class="space-y-2">
              <li><a href="home" class="hover:underline">Home</a></li>
              <li><a href="programs" class="hover:underline">Programs</a></li>
              <li><a href="contact" class="hover:underline">Contact us</a></li>
            </ul>
          </div>
          <div>
            <h3 class="text-lg font-bold mb-4">Contact</h3>
            <p>E-mail: cti@support.com</p>
            <br>
            <p>Phone: 3131410000</p>
          </div>
        </div>
        <div class="mt-8 pt-8 border-t border-gray-700 text-center">
          <p>&copy; {{ new Date().getFullYear() }} Fundación CTI. All rights reserved.</p>
        </div>
        
      </div>
    </footer>
  </template>
  