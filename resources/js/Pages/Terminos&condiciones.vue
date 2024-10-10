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
        Privacy Policy
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
        Terms of Service
        </button>
      </div>

    <!-- Section 2: Política de Privacidad -->
      <div class="bg-white text-black max-w-5xl mx-auto rounded-lg shadow-md">
  <div class="p-6">
    <div v-if="activeTab === 'privacy'">
      <h2 class="text-2xl font-bold mb-4">Privacy Policy</h2>
      <p class="mb-4">
        Fundación CTI, Asociación Civil, with address at Av. Universidad No. 333, Colonia Las Víboras, Colima, Colima, C.P. 28040; building in front of Rectoría, second floor,is committed to protecting the privacy and personal data of the people who interact with us, whether they are donors, beneficiaries or any related third party.The purpose of this policy is to provide information on how the CTI Foundation collects, uses, protects and, where appropriate, shares the personal data it collects from users.
      </p>
      
      <p class="mb-4">
        <strong>1. Data to be collected</strong><br>
        The CTI Foundation may collect various types of personal data, including, but not limited to:
      </p>
      <ul class="mb-4 list-disc list-inside">
        <li><strong>Identification data:</strong> Full name, address, e-mail, phone number.</li>
        <li><strong>Financial information:</strong>Bank account or credit card information for the management of donations.</li>
        <li><strong>Fiscal data:</strong> Federal Taxpayers Registry (RFC) and other data necessary for the issuance of Digital Tax Receipts via Internet (CFDI).</li>
        <li><strong>Navigation data:</strong> Information obtained from your interaction with our websites through cookies or other technologies.</li>
      </ul>

      <p class="mb-4">
        <strong>2. Purpose of data processing</strong><br>
        The personal data collected will be used exclusively for the following purposes:
      </p>
      <ul class="mb-4 list-disc list-inside">
        <li><strong>Management and administration of donations:</strong> Includes processing of donations, issuance of CFDIs and tracking of recurring donations.</li>
        <li><strong>Compliance with legal and tax obligations:</strong> Issue and report information to the corresponding tax authorities.</li>
        <li><strong>Communication:</strong> Keep donors informed about activities, programs, calls for proposals, annual reports and other relevant actions of the CTI Foundation.</li>
        <li><strong>Improvement of services:</strong> Analyze and evaluate the use of our services to improve the user experience on our platforms.</li>
      </ul>

      <p class="mb-4">
        <strong>3. Protection of personal data</strong><br>
        CTI Foundation adopts all physical, technical and administrative security measures necessary to protect personal data against loss, misuse, alteration, unauthorized access and theft. 
        Also, only authorized personnel will have access to personal data, who have been trained to handle this information confidentially.
      </p>
      <p class="mb-4">
        <strong>4. Data Sharing</strong><br>
        The CTI Foundation will not share or transfer personal data to third parties, except in the following cases:
      </p>
      <ul class="mb-4 list-disc list-inside">
        <li><strong>Fiscal authorities:</strong> When necessary to comply with legal obligations related to donations.</li>
        <li><strong>Service providers:</strong> When we work with third parties to facilitate the management of donations or the sending of communications, provided that such suppliers assume a commitment to confidentiality and comply with current legislation on data protection.</li>
      </ul>

      <p class="mb-4">
        <strong>5. Rights of the owner of the data</strong><br>
        The holders of personal data have the right to:
      </p>
      <ul class="mb-4 list-disc list-inside">
        <li>Access to your personal data in possession of the CTI Foundation.</li>
        <li>Rectify your data in case they are incorrect or outdated.</li>
        <li>Cancel your data when they consider that they are not necessary for the above mentioned purposes.</li>
        <li>Oppose the processing of your data for specific purposes.</li>
      </ul>
      <p class="mb-4">
        To exercise any of these rights, holders may send a request to cti@support.com, including their full name, the relationship they have with Fundación CTI and the right they wish to exercise.
         The Foundation will respond to such request within 20 working days, in accordance with the provisions of the Federal Law for the Protection of Personal Data in Possession of Individuals.
      </p>

      <p class="mb-4">
        <strong>6. Use of cookies and similar technologies</strong><br>
        The CTI Foundation uses cookies and other similar technologies on its website to enhance the user experience and analyze traffic. Users can adjust their browser settings to limit or disable the use of cookies, although this may affect some functionality of the site.
      </p>

      <p class="mb-4">
        <strong>7. Modifications to the Privacy Policy</strong><br>
        CTI Foundation reserves the right to update this Privacy Policy at any time. Any changes will be notified through our website. We encourage users to periodically review this policy to stay informed about how we protect your information.
      </p>

      <p class="mb-4">
        <strong>8. Contact</strong><br>
        If you have any questions or comments regarding this Privacy Policy, you may contact us by e-mail at cti@support.com or by telephone at 3131410000.
      </p>

      <p class="mb-4">
        <strong>Validity of the Privacy Policy</strong><br>
        This Privacy Policy is effective as of its publication and will be applicable to data collected as of that date.
      </p>
    </div>

    <!-- Terminos de servicio -->
<div v-if="activeTab === 'terms'">
  <h2 class="text-2xl font-bold mb-4">Terms of Service</h2>

<p class="mb-4">
  <strong>1. Acceptance of the Terms</strong><br />
  By participating as a volunteer, scholar, donor, coordinator, or in any other program of the CTI Foundation, the User agrees to these Terms, which may be modified at any time. Any changes will be notified through the Foundation's official website at 
  <a href="#">http://crud-pei.test/terms-conditions.</a>, and the continued use of the services implies acceptance of such changes.
</p>

<p class="mb-4">
  <strong>2. Definitions</strong><br />
  - <strong>User:</strong> Any person participating in the programs of the CTI Foundation, whether as a volunteer, scholar, donor, or coordinator.<br />
  - <strong>Donee:</strong> The CTI Foundation, legally constituted under Mexican law and authorized by the Ministry of Finance and Public Credit (SHCP) to receive tax-deductible donations.<br />
  - <strong>Donation:</strong> A contribution in money or kind made by the User as a donor to support the social goals of the CTI Foundation.<br />
  - <strong>Volunteer:</strong> A person who voluntarily offers their time and skills to collaborate in the Foundation's activities and projects.<br />
  - <strong>Scholar:</strong> A person who receives financial or academic support through scholarships granted by the CTI Foundation.<br />
  - <strong>Coordinator:</strong> A person responsible for the management and organization of the Foundation's programs, projects, and activities.
</p>

<p class="mb-4">
  <strong>3. Services and Programs Offered</strong><br />
  The CTI Foundation offers a variety of programs aimed at different beneficiaries, including but not limited to:
</p>

<ul class="mb-4 list-disc list-inside">
  <li><strong>Volunteering:</strong> Volunteers support social, educational, and cultural activities according to the Foundation's objectives.</li>
  <li><strong>Scholarships:</strong> The Foundation grants scholarships to students or professionals who meet the established criteria, aiming to promote academic and personal development.</li>
  <li><strong>Donations:</strong> Donors contribute economic resources or in-kind donations to support the Foundation's projects.</li>
  <li><strong>Coordinators:</strong> Coordinators are responsible for overseeing and managing the programs and teams of volunteers, scholars, and donors.</li>
</ul>

<p class="mb-4">
  <strong>4. User Rights and Obligations</strong><br />
  <strong>Volunteers:</strong>
</p>

<ul class="mb-4 list-disc list-inside">
  <li><strong>Participation:</strong> The volunteer agrees to participate in assigned activities, adhering to the Foundation's rules and policies.</li>
  <li><strong>Commitment:</strong> The volunteer is expected to fulfill their time and work commitments responsibly and ethically and to notify in advance if they are unable to complete an assigned activity.</li>
  <li><strong>Safety and Respect:</strong> The Foundation guarantees a safe environment for volunteers and expects mutual respect to prevail in all interactions.</li>
</ul>

<p class="mb-4">
  <strong>Scholars:</strong>
</p>

<ul class="mb-4 list-disc list-inside">
  <li><strong>Requirement Compliance:</strong> Scholars must meet the academic and personal requirements established in the scholarship call.</li>
  <li><strong>Periodic Reports:</strong> Scholars are required to submit progress reports in accordance with the Foundation's guidelines.</li>
  <li><strong>Scholarship Use:</strong> The scholarship must be used for the agreed-upon purposes, and any misuse of funds may result in suspension of the scholarship.</li>
</ul>

<p class="mb-4">
  <strong>Donors:</strong>
</p>

<ul class="mb-4 list-disc list-inside">
  <li><strong>Making Donations:</strong> Donors can make their contributions through the Foundation's portal or via bank transfers.</li>
  <li><strong>CFDI:</strong> Donors will receive an Internet Digital Fiscal Receipt (CFDI) upon providing their tax information, as stipulated in section 5.</li>
  <li><strong>Right to Information:</strong> Donors have the right to receive periodic information about the use of donated funds and the impact of their contributions.</li>
</ul>

<p class="mb-4">
  <strong>Coordinators:</strong>
</p>

<ul class="mb-4 list-disc list-inside">
  <li><strong>Supervision:</strong> Coordinators are responsible for managing and supervising the teams of volunteers and scholars, ensuring the achievement of project objectives.</li>
  <li><strong>Reports:</strong> Coordinators must submit reports on the progress and results of the projects and programs under their charge.</li>
</ul>

<p class="mb-4">
  <strong>5. Donations and Tax Receipts</strong><br />
  Donations made to the CTI Foundation are subject to the following guidelines:
</p>

<ul class="mb-4 list-disc list-inside">
  <li><strong>Donation through the portal:</strong> By making an online donation, the User agrees to these Terms and Conditions by confirming the transaction.</li>
  <li><strong>Donation via SPEI transfer:</strong> By making a bank transfer, the User agrees to these Terms.</li>
  <li><strong>CFDI:</strong> The Foundation will issue an Internet Digital Fiscal Receipt (CFDI) for each donation, which will be available in the "Deductible Receipts" section of the portal within 24 to 48 hours after the donation.</li>
</ul>

<p class="mb-4">
  <strong>6. Personal Data Protection</strong><br />
  The CTI Foundation is committed to protecting the personal data of all its users (volunteers, scholars, donors, and coordinators) in accordance with the Privacy Policy and the Federal Law on Protection of Personal Data Held by Private Parties. For more details, please refer to the Privacy Policy at 
  <a href="#">http://crud-pei.test/terms-conditions.</a>
</p>

<p class="mb-4">
  <strong>7. Modification of Services</strong><br />
  The CTI Foundation reserves the right to modify, suspend, or discontinue any service or program, either temporarily or permanently, without prior notice.
</p>

<p class="mb-4">
  <strong>8. Limitation of Liability</strong><br />
  The CTI Foundation will not be responsible for:
</p>

<ul class="mb-4 list-disc list-inside">
  <li>Losses or damages resulting from service interruptions, website operation errors, or technical issues.</li>
  <li>Losses or damages resulting from misuse of services or information by the User or third parties.</li>
</ul>

<p class="mb-4">
  The User agrees that the use of CTI Foundation services is at their own risk.
</p>

<p class="mb-4">
  <strong>9. Termination of Relationship</strong><br />
  The CTI Foundation reserves the right to suspend or terminate the relationship with any volunteer, scholar, donor, or coordinator who violates these Terms, without prior notice.
</p>

<p class="mb-4">
  <strong>10. Governing Law and Jurisdiction</strong><br />
  These Terms are governed by the applicable laws of Mexico. In case of dispute, the User agrees to submit to the jurisdiction of the competent courts of the City of Colima.
</p>

<p class="mb-4">
  <strong>11. Contact</strong><br />
  For any questions or clarifications related to these Terms of Service, the User may contact the CTI Foundation via email at cti@support.com or at the number 3131410000.
</p>

<p class="mb-4">
  <strong>Validity of the Terms of Service</strong><br />
  These Terms of Service come into effect from the date of their publication and will apply to all interactions, donations, and participation in CTI Foundation programs from that date onward.
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