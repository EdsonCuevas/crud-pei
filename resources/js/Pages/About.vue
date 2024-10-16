<template>
    <Header/>
    <div class="min-h-screen  bg-gray-200 text-white p-6">
      <h1 class="text-3xl font-bold text-center mb-8">
      </h1>
      <div class="flex justify-center space-x-8 mb-6">
        <button
          @click="activeTab = 'privacy'"
          :class="[
          'text-lg font-semibold pb-2',
          activeTab === 'privacy'
            ? 'border-b-2 border-blue-900 text-blue-900'
            : 'text-gray-600 hover:text-[#000000] transition-colors'
        ]"
        >
        About us
        </button>
        <button
          @click="activeTab = 'terms'"
          :class="[
          'text-lg font-semibold pb-2',
          activeTab === 'terms'
            ? 'border-b-2 border-blue-900 text-blue-900'
            : 'text-gray-600 hover:text-[#000000] transition-colors'
        ]"
        >
        Our Objective
        </button>
      </div>

    <!-- Section 2: Política de Privacidad -->
      <div class="bg-white text-black max-w-5xl mx-auto rounded-lg shadow-md">
  <div class="p-6">
    <div v-if="activeTab === 'privacy'">
      <h2 class="text-2xl font-bold mb-4">About Us</h2> <p class="mb-4"> Fundación CTI, Asociación Civil, is a non-profit organization located at Av. Universidad No. 333, Colonia Las Víboras, Colima, Colima, C.P. 28040; in the building in front of the Rectoría, second floor. Our mission is to support and improve education for vulnerable communities by reducing inequality and providing opportunities for personal and academic development. </p>
      
      <p class="mb-4">
    At CTI Foundation, we believe that education is the cornerstone of development and progress. We work to provide educational resources, tools, and support to children, young people, and adults from disadvantaged backgrounds, ensuring that they have access to quality education and the means to succeed.
  </p>

  <p class="mb-4">
    <strong>Our Vision</strong><br>
    Our vision is a world where every person, regardless of their socio-economic background, has equal access to education and opportunities. We envision a future where inequality is minimized, and individuals can reach their full potential through the power of knowledge and learning.
  </p>

  <p class="mb-4">
    <strong>Our Mission</strong><br>
    Our mission is to promote inclusive and quality education for all by providing programs that support the academic growth of students and foster community involvement in educational development. We focus on offering resources, mentorship, and financial assistance to ensure that no one is left behind in their educational journey.
  </p>

  <p class="mb-4">
    <strong>What We Do</strong><br>
    The CTI Foundation offers a variety of programs designed to improve access to education:
  </p>
  <ul class="mb-4 list-disc list-inside">
    <li><strong>Scholarships and Grants:</strong> We provide financial support to students from underprivileged communities, ensuring they can continue their studies without financial burdens.</li>
    <li><strong>Mentorship Programs:</strong> Our volunteers and mentors guide students in their academic and professional development, offering advice and support to help them reach their goals.</li>
  </ul>

  <p class="mb-4">
    <strong>Get Involved</strong><br>
    There are several ways you can get involved with the CTI Foundation:
  </p>
  <ul class="mb-4 list-disc list-inside">
    <li><strong>Donate:</strong> Your contributions help us fund scholarships, purchase supplies, and run our educational programs.</li>
    <li><strong>Volunteer:</strong> Join our team of volunteers to mentor students, assist in workshops, or help with administrative tasks.</li>
    <li><strong>Partner with Us:</strong> If you represent an organization, you can collaborate with us to expand our reach and make a greater impact in the communities we serve.</li>
  </ul>

  <p class="mb-4">
    <strong>Contact Us</strong><br>
    If you would like to learn more about our programs, how to get involved, or if you have any questions, feel free to contact us at cti@support.com or call us at 3131410000.
  </p>

  <p class="mb-4">
    Together, we can make a difference by ensuring that education is accessible to all and that future generations have the opportunity to succeed.
  </p>
</div>


    <!-- Terminos de servicio -->
<div v-if="activeTab === 'terms'">
  <h2 class="text-2xl font-bold mb-4">Our Objectives</h2> <p class="mb-4"> At Fundación CTI, our primary goal is to promote equality through access to education and personal development opportunities. We are committed to breaking down barriers and ensuring that every individual, regardless of their background, has the tools and support needed to succeed academically and professionally. </p>

  <p class="mb-4">
    <strong>1. Provide Equal Access to Education</strong><br>
    Our first objective is to ensure that students from disadvantaged backgrounds have the same opportunities for education as their peers. We aim to provide the financial support and resources necessary for them to attend school, perform well academically, and pursue higher education.
  </p>

  <p class="mb-4">
    <strong>2. Foster Academic and Professional Growth</strong><br>
    We are dedicated to helping students not only complete their education but also excel in their studies. Our mentorship programs, academic workshops, and career counseling services are designed to foster personal and professional growth, helping students prepare for successful careers.
  </p>

  <p class="mb-4">
    <strong>3. Support Vulnerable Communities</strong><br>
    We focus on supporting vulnerable communities by providing educational workshops, parenting support, and community-building activities. Our aim is to create a supportive environment where families can thrive and contribute to the education of their children.
  </p>

  <p class="mb-4">
    <strong>4. Promote Lifelong Learning</strong><br>
    We believe that education doesn't stop after school. One of our objectives is to promote lifelong learning through community programs and resources that encourage individuals of all ages to continue learning and developing new skills.
  </p>

 

  <p class="mb-4">
    <strong>5. Improve Educational Resources</strong><br>
    We are constantly working to improve the educational resources available to students and educators. From providing access to learning materials to creating new opportunities for digital learning, our goal is to enhance the educational experience for all.
  </p>

  <p class="mb-4">
    <strong>6. Reduce Inequality</strong><br>
    A key objective of Fundación CTI is to combat inequality by ensuring that education is a tool for empowerment. By addressing financial, social, and educational disparities, we seek to create a more equitable society where everyone has the chance to succeed.
  </p>

  <p class="mb-4">
    <strong>Contact Us</strong><br>
    If you would like to learn more about our objectives or how to support our initiatives, please contact us at cti@support.com or call us at 3131410000.
  </p>
</div>

    </div>
    </div>
    </div>
    <Footer/>
  </template>
  <script setup>
  import { ref, computed } from 'vue'
  import Footer from '@/Components/Footer.vue';
  import Header from '@/Components/Header.vue';
  const activeTab = ref('privacy')
  
  const currentDate = computed(() => {
    return new Date().toLocaleDateString()
  })
  
  </script>