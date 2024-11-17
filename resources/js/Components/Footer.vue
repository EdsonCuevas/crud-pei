<template>
  <footer class="bg-gradient-to-r from-blue-900 via-blue-900 to-black text-white py-12">
    <div class="container mx-auto px-6 lg:px-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Logo and Call to Action -->
        <div class="flex flex-col items-start space-y-4 text-right">
          <img 
            src="/images/LOGOCTI2.png" 
            alt="Logo Fundación CTI" 
            class="max-h-13 w-auto cursor-pointer" 
            onclick="window.location.href='/home';"
          >
          <p class="text-sm text-left">Innovating for a brighter future through research and development. Join our mission to make a difference.</p>
          <br>
        </div>

        <!-- Quick Links Section -->
        <div>
          <h3 class="text-xl text-right font-bold">Quick Links</h3>
          <br>
          <ul class="space-y-2 text-right">
            <li><a href="/home" class="hover:text-gray-200 hover:underline">Home</a></li>
            <li><a href="/programs" class="hover:text-gray-200 hover:underline">Programs</a></li>
            <li><a href="/contact" class="hover:text-gray-200 hover:underline">Contact Us</a></li>
          </ul>
        </div>

        <!-- Contact Section (moved to the left) -->
        <div>
          <h3 class="text-xl font-bold text-left">Contact</h3>
          <br>

          <ul class="space-y-2 text-left">
            <li>Email: <a href="mailto:cti@support.com" class="hover:text-gray-200 hover:underline">cti@support.com</a></li>
            <li>Phone: <a href="tel:3131410000" class="hover:text-gray-200 hover:underline">313-141-0000</a></li>
          </ul>
        </div>

        <!-- Google Translate (moved up) -->
        <div class="space-y-4">
          <div id="google_translate_element"></div>
        </div>
      </div>

      <!-- Footer Bottom -->
      <div class="mt-8 pt-8 border-t border-gray-700 text-center text-sm">
        <p>&copy; {{ new Date().getFullYear() }} Fundación CTI. All rights reserved.</p>
        <!-- Added Privacy Policy and Terms & Conditions -->
        <div class="mt-2">
          <a href="/terms-conditions" class="hover:underline text-gray-200">Terms and Conditions</a> | 
          <a href="/terms-conditions" class="hover:underline text-gray-200">Privacy Policy</a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  mounted() {
    // Inicializar Google Translate cuando el componente esté montado
    const googleTranslateScript = document.createElement('script');
    googleTranslateScript.type = 'text/javascript';
    googleTranslateScript.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
    document.body.appendChild(googleTranslateScript);

    window.googleTranslateElementInit = function () {
      new window.google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
    };
  }
};
</script>

<style>
footer {
  background-size: cover;
  position: relative;
}

footer a {
  transition: color 0.3s;
}

button span {
  transform: translateY(-2px);
}

#google_translate_element {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
