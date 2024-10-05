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
            ? 'border-b-2 border-black text-black'
            : 'text-gray-600 hover:text-[#004481] transition-colors'
        ]"
        >
          Política de Privacidad
        </button>
        <button
          @click="activeTab = 'terms'"
          :class="[
          'text-lg font-semibold pb-2',
          activeTab === 'terms'
            ? 'border-b-2 border-black text-black'
            : 'text-gray-600 hover:text-[#004481] transition-colors'
        ]"
        >
          Términos de Servicio
        </button>
      </div>

    <!-- Section 2: Política de Privacidad -->
      <div class="bg-white text-black max-w-5xl mx-auto rounded-lg shadow-md">
  <div class="p-6">
    <div v-if="activeTab === 'privacy'">
      <h2 class="text-2xl font-bold mb-4">Política de Privacidad</h2>
      <p class="mb-4">
        La Fundación CTI, Asociación Civil, con domicilio en Av. Universidad No. 333, Colonia Las Víboras, Colima, Colima, C.P. 28040; edificio frente a Rectoría, segunda planta,
        está comprometida con la protección de la privacidad y los datos personales de las personas que interactúan con nosotros, ya sean donantes, beneficiarios o cualquier tercero relacionado.
        Esta política tiene como objetivo informar sobre cómo la Fundación CTI recopila, utiliza, protege y, en su caso, comparte los datos personales que recaba de los usuarios.
      </p>
      
      <p class="mb-4">
        <strong>1. Datos que se recopilan</strong><br>
        La Fundación CTI podrá recopilar diversos tipos de datos personales, entre los que se incluyen, pero no se limitan a:
      </p>
      <ul class="mb-4 list-disc list-inside">
        <li><strong>Datos de identificación:</strong> Nombre completo, dirección, correo electrónico, número de teléfono.</li>
        <li><strong>Datos financieros:</strong> Información de cuentas bancarias o tarjetas de crédito para la gestión de donativos.</li>
        <li><strong>Datos fiscales:</strong> Registro Federal de Contribuyentes (RFC) y otros datos necesarios para la emisión de Comprobantes Fiscales Digitales por Internet (CFDI).</li>
        <li><strong>Datos de navegación:</strong> Información obtenida de su interacción con nuestros sitios web a través de cookies u otras tecnologías.</li>
      </ul>

      <p class="mb-4">
        <strong>2. Finalidad del tratamiento de datos</strong><br>
        Los datos personales recabados serán utilizados exclusivamente para los siguientes fines:
      </p>
      <ul class="mb-4 list-disc list-inside">
        <li><strong>Gestión y administración de donativos:</strong> Incluye el procesamiento de donaciones, la emisión de CFDIs y el seguimiento de donativos recurrentes.</li>
        <li><strong>Cumplimiento de obligaciones legales y fiscales:</strong> Emitir y reportar información ante las autoridades fiscales correspondientes.</li>
        <li><strong>Comunicación:</strong> Mantener informados a los donantes sobre actividades, programas, convocatorias, reportes anuales y otras acciones relevantes de la Fundación CTI.</li>
        <li><strong>Mejora de servicios:</strong> Analizar y evaluar el uso de nuestros servicios para mejorar la experiencia de los usuarios en nuestras plataformas.</li>
      </ul>

      <p class="mb-4">
        <strong>3. Protección de datos personales</strong><br>
        La Fundación CTI adopta todas las medidas de seguridad físicas, técnicas y administrativas necesarias para proteger los datos personales contra pérdida, mal uso, alteración, acceso no autorizado y robo. Asimismo, solo el personal autorizado tendrá acceso a los datos personales, quienes han sido capacitados para manejar esta información de manera confidencial.
      </p>

      <p class="mb-4">
        <strong>4. Compartición de datos</strong><br>
        La Fundación CTI no compartirá ni transferirá los datos personales a terceros, salvo en los siguientes casos:
      </p>
      <ul class="mb-4 list-disc list-inside">
        <li><strong>Autoridades fiscales:</strong> Cuando sea necesario para cumplir con las obligaciones legales relacionadas con los donativos.</li>
        <li><strong>Proveedores de servicios:</strong> Cuando trabajemos con terceros para facilitar la gestión de donaciones o el envío de comunicaciones, siempre que dichos proveedores asuman un compromiso de confidencialidad y cumplan con la legislación vigente en materia de protección de datos.</li>
      </ul>

      <p class="mb-4">
        <strong>5. Derechos del titular de los datos</strong><br>
        Los titulares de los datos personales tienen derecho a:
      </p>
      <ul class="mb-4 list-disc list-inside">
        <li>Acceder a sus datos personales en posesión de la Fundación CTI.</li>
        <li>Rectificar sus datos en caso de ser incorrectos o desactualizados.</li>
        <li>Cancelar sus datos cuando consideren que no son necesarios para los fines mencionados.</li>
        <li>Oponerse al tratamiento de sus datos para finalidades específicas.</li>
      </ul>
      <p class="mb-4">
        Para ejercer cualquiera de estos derechos, los titulares podrán enviar una solicitud al correo electrónico cti@support.com, incluyendo su nombre completo, la relación que mantiene con la Fundación CTI y el derecho que desean ejercer. La Fundación responderá a dicha solicitud en un plazo de 20 días hábiles, conforme a lo establecido por la Ley Federal de Protección de Datos Personales en Posesión de los Particulares.
      </p>

      <p class="mb-4">
        <strong>6. Uso de cookies y tecnologías similares</strong><br>
        La Fundación CTI utiliza cookies y otras tecnologías similares en su sitio web para mejorar la experiencia de los usuarios y analizar el tráfico. Los usuarios pueden ajustar la configuración de su navegador para limitar o desactivar el uso de cookies, aunque esto podría afectar algunas funcionalidades del sitio.
      </p>

      <p class="mb-4">
        <strong>7. Modificaciones a la Política de Privacidad</strong><br>
        La Fundación CTI se reserva el derecho de actualizar esta Política de Privacidad en cualquier momento. Cualquier cambio será notificado a través de nuestra página web . Recomendamos a los usuarios revisar periódicamente esta política para estar informados sobre cómo protegemos su información.
      </p>

      <p class="mb-4">
        <strong>8. Contacto</strong><br>
        Si tiene alguna duda o comentario respecto a esta Política de Privacidad, puede ponerse en contacto con nosotros a través del correo electrónico cti@support.com o al número de teléfono 3131410000.
      </p>

      <p class="mb-4">
        <strong>Vigencia de la Política de Privacidad</strong><br>
        Esta Política de Privacidad está vigente desde su publicación y será aplicable a los datos recabados desde esa fecha.
      </p>
    </div>

    <!-- Terminos de servicio -->
<div v-if="activeTab === 'terms'">
  <h2 class="text-2xl font-bold mb-4">Términos de Servicio</h2>
 
  <p class="mb-4">
    <strong>1. Aceptación de los Términos</strong><br />
    Al participar como voluntario, becario, donador, coordinador o en cualquier otro programa de la Fundación CTI, el Usuario acepta estos Términos, los cuales pueden ser modificados en cualquier momento. Cualquier cambio será notificado a través de la página web oficial de la Fundación  <a href="#">http://crud-pei.test/terminos-condiciones.</a>
    , y el uso continuo de los servicios implica la aceptación de dichos cambios.
  </p>

  <p class="mb-4">
    <strong>2. Definiciones</strong><br />
    - <strong>Usuario:</strong> Toda persona que participa en los programas de la Fundación CTI, ya sea como voluntario, becario, donador o coordinador.<br />
    - <strong>Donataria:</strong> La Fundación CTI, legalmente constituida conforme a las leyes mexicanas y autorizada por la Secretaría de Hacienda y Crédito Público (SHCP) para recibir donativos deducibles de impuestos.<br />
    - <strong>Donativo:</strong> Aportación en dinero o especie realizada por el Usuario en calidad de donador, destinada a apoyar los fines sociales de la Fundación CTI.<br />
    - <strong>Voluntario:</strong> Persona que ofrece su tiempo y habilidades de manera voluntaria para colaborar en actividades y proyectos de la Fundación.<br />
    - <strong>Becario:</strong> Persona que recibe apoyo económico o académico a través de becas otorgadas por la Fundación CTI.<br />
    - <strong>Coordinador:</strong> Persona encargada de la gestión y organización de los programas, proyectos y actividades de la Fundación CTI.
  </p>

  <p class="mb-4">
    <strong>3. Servicios y Programas Ofrecidos</strong><br />
    La Fundación CTI ofrece una variedad de programas dirigidos a diferentes beneficiarios, incluyendo pero no limitándose a:
  </p>

  <ul class="mb-4 list-disc list-inside">
    <li><strong>Voluntariado:</strong> Los voluntarios apoyan en actividades sociales, educativas y culturales, conforme a los objetivos de la Fundación.</li>
    <li><strong>Becas:</strong> La Fundación otorga becas a estudiantes o profesionales que cumplan con los criterios establecidos, con el objetivo de fomentar el desarrollo académico y personal.</li>
    <li><strong>Donaciones:</strong> Los donadores contribuyen con recursos económicos o en especie para apoyar los proyectos de la Fundación.</li>
    <li><strong>Coordinadores:</strong> Los coordinadores son responsables de la supervisión y gestión de los programas y el equipo de voluntarios, becarios y donadores.</li>
  </ul>

  <p class="mb-4">
    <strong>4. Derechos y Obligaciones del Usuario</strong><br />
    <strong>Voluntarios:</strong>
  </p>

  <ul class="mb-4 list-disc list-inside">
    <li><strong>Participación:</strong> El voluntario acepta participar en las actividades asignadas, respetando las reglas y políticas de la Fundación.</li>
    <li><strong>Compromiso:</strong> Se espera que el voluntario asuma su compromiso de tiempo y trabajo con responsabilidad y ética, y que notifique con antelación si no puede cumplir con alguna actividad asignada.</li>
    <li><strong>Seguridad y respeto:</strong> La Fundación garantiza un ambiente seguro para los voluntarios y espera que el respeto mutuo prevalezca en todas las interacciones.</li>
  </ul>

  <p class="mb-4">
    <strong>Becarios:</strong>
  </p>
  <ul class="mb-4 list-disc list-inside">
    <li><strong>Cumplimiento de requisitos:</strong> Los becarios deben cumplir con los requisitos académicos y personales establecidos en la convocatoria de becas.</li>
    <li><strong>Informes periódicos:</strong> Los becarios están obligados a presentar informes de avance, de acuerdo con las directrices de la Fundación.</li>
    <li><strong>Uso de la beca:</strong> La beca debe ser utilizada para los fines acordados, y cualquier mal uso de los fondos puede resultar en la suspensión de la misma.</li>
  </ul>

  <p class="mb-4">
    <strong>Donadores:</strong>
  </p>
  <ul class="mb-4 list-disc list-inside">
    <li><strong>Realización de donativos:</strong> Los donadores pueden realizar sus aportaciones a través del portal de la Fundación o mediante transferencias bancarias.</li>
    <li><strong>CFDI:</strong> Los donadores recibirán un Comprobante Fiscal Digital por Internet (CFDI) al proporcionar su información fiscal, según lo estipulado en la sección 5.</li>
    <li><strong>Derecho a información:</strong> Los donadores tienen derecho a recibir información periódica sobre el uso de los fondos donados y el impacto de sus contribuciones.</li>
  </ul>

  <p class="mb-4">
    <strong>Coordinadores:</strong>
  </p>
  <ul class="mb-4 list-disc list-inside">
    <li><strong>Supervisión:</strong> Los coordinadores tienen la responsabilidad de gestionar y supervisar a los equipos de voluntarios y becarios, asegurando el cumplimiento de los objetivos de cada proyecto.</li>
    <li><strong>Reportes:</strong> Los coordinadores deberán entregar informes sobre el avance y resultados de los proyectos y programas bajo su cargo.</li>
  </ul>

  <p class="mb-4">
    <strong>5. Donaciones y Comprobantes Fiscales</strong><br />
    Los donativos realizados a la Fundación CTI estarán sujetos a los siguientes lineamientos:
  </p>

  <ul class="mb-4 list-disc list-inside">
    <li><strong>Donación a través del portal:</strong> Al realizar un donativo en línea, el Usuario acepta estos Términos y condiciones al confirmar la transacción.</li>
    <li><strong>Donación mediante transferencia SPEI:</strong> Al realizar una transferencia bancaria, el Usuario acepta estos Términos.</li>
    <li><strong>CFDI:</strong> La Fundación emitirá un Comprobante Fiscal Digital por Internet (CFDI) por cada donativo, el cual estará disponible en la sección de "Recibos Deducibles" del portal dentro de las 24 a 48 horas posteriores a la donación.</li>
  </ul>

  <p class="mb-4">
    <strong>6. Protección de Datos Personales</strong><br />
    La Fundación CTI se compromete a proteger los datos personales de todos sus usuarios (voluntarios, becarios, donadores y coordinadores) conforme a la Política de Privacidad y la Ley Federal de Protección de Datos Personales en Posesión de los Particulares. Para más detalles, consulte la Política de Privacidad en 
    <a href="#">http://crud-pei.test/terminos-condiciones.</a>
  </p>

  <p class="mb-4">
    <strong>7. Modificación de los Servicios</strong><br />
    La Fundación CTI se reserva el derecho de modificar, suspender o descontinuar cualquier servicio o programa, ya sea de manera temporal o permanente, sin previo aviso.
  </p>

  <p class="mb-4">
    <strong>8. Limitaciones de Responsabilidad</strong><br />
    La Fundación CTI no será responsable por:
  </p>

  <ul class="mb-4 list-disc list-inside">
    <li>Pérdidas o daños derivados de interrupciones en el servicio, errores en la operación del sitio web o problemas técnicos.</li>
    <li>Pérdidas o daños derivados del uso indebido de los servicios o información por parte del Usuario o terceros.</li>
  </ul>

  <p class="mb-4">
    El Usuario acepta que el uso de los servicios de la Fundación CTI es bajo su propio riesgo.
  </p>

  <p class="mb-4">
    <strong>9. Terminación de la Relación</strong><br />
    La Fundación CTI se reserva el derecho de suspender o terminar la relación con cualquier voluntario, becario, donador o coordinador que incumpla estos Términos, sin necesidad de previo aviso.
  </p>

  <p class="mb-4">
    <strong>10. Ley Aplicable y Jurisdicción</strong><br />
    Estos Términos se rigen por las leyes aplicables en México. En caso de controversia, el Usuario acepta someterse a la jurisdicción de los tribunales competentes de la Ciudad de Colima.
  </p>

  <p class="mb-4">
    <strong>11. Contacto</strong><br />
    Para cualquier duda o aclaración relacionada con estos Términos de Servicio, el Usuario puede ponerse en contacto con la Fundación CTI a través del correo electrónico cti@support.com o al número 3131410000.
  </p>

  <p class="mb-4">
    <strong>Vigencia de los Términos de Servicio</strong><br />
    Estos Términos de Servicio entran en vigor desde la fecha de su publicación y serán aplicables a todas las interacciones, donativos y participaciones en los programas de la Fundación CTI a partir de esa fecha.
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