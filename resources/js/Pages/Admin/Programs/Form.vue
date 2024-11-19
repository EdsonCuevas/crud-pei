<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayoutProgram.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import DarkButton from '@/Components/DarkButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputGroup from '@/Components/InputGroup.vue';
import { ref} from 'vue';
import { onMounted } from 'vue'
import Select2 from 'vue3-select2-component';
import Swal from 'sweetalert2';
import { Type, Text, UserSearch, ImagePlus } from 'lucide-vue-next'


const props = defineProps({
    program: { type: Object },
    coordinators: { type: Object },
    users: { type: Object },
    benefsDelPrograma: { type: Object }
});

const form = useForm({
    id: '', title: '', description: '', image: '', creator_id: '', coordi_id: '', beneficiaries: [],
});

const title_form = ref(
    (props.program == null) ? 'Create Program' : 'Edit Program'
);

const srcImg = ref('../../storage/img/example.jpg');

const options = ref([]);
props.users.map((row) => (
    options.value.push({ 'id': row.id, 'text': row.name })
));

if (props.program != null) {
    form.id = props.program.id;
    form.title = props.program.title;
    form.description = props.program.description;
    form.coordi_id = props.program.coordi_id;
    form.image = props.program.image;
    srcImg.value = '../../storage/img/' + props.program.image;
    props.benefsDelPrograma.map((row) => (
        form.beneficiaries.push(row.id)
    ));
}

const save = () => {
    if (props.program == null) {
        form.post(route('admin-programs.store'), {
            onSuccess: () => {
                Swal.fire({
                    title: 'Created!',
                    text: 'Program created successfully!',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            },
            onError: () => {
                Swal.fire({
                    title: 'Error',
                    text: 'There was an error creating the program',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    } else {
        form.post(route('updateprogram', form.id), {
            onSuccess: () => {
                Swal.fire({
                    title: 'Updated!',
                    text: 'Program updated successfully!',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            },
            onError: () => {
                Swal.fire({
                    title: 'Error',
                    text: 'There was an error updating the program',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    }
};

const showImg = (e) => {
    form.image = e.target.files[0];
    srcImg.value = URL.createObjectURL(e.target.files[0]);
};

onMounted(() => {
  startTypingAnimation()
})

const startTypingAnimation = () => {
  const typingTexts = document.querySelectorAll('.typing-text')
  typingTexts.forEach((element, index) => {
    element.style.animationDelay = `${index * 3.5}s`
  })
}
</script>

<template>
    <AuthenticatedLayout>
      <Head title="Programa" />
      <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white">
        <div class="container mx-auto py-8">
            <transition
          appear
          enter-active-class="transition ease-out duration-300"
          enter-from-class="opacity-0 transform -translate-y-4"
          enter-to-class="opacity-100 transform translate-y-0"
        >
          <div class="bg-blue-600 text-white p-8 rounded-t-lg shadow-lg">
            <h2 class="text-4xl font-bold mb-2 typing-animation">
              <span class="typing-text">{{ title_form }}</span>
            </h2>
            <p class="text-blue-100 text-lg typing-animation">
              <span class="typing-text2">Education support program</span>
            </p>
          </div>
        </transition>
  
          <div class="bg-white rounded-b-lg shadow-lg">
            <div class="p-8 grid md:grid-cols-2 gap-8">
              <transition
                appear
                enter-active-class="transition ease-out duration-500 delay-300"
                enter-from-class="opacity-0 transform translate-x-4"
                enter-to-class="opacity-100 transform translate-x-0"
              >
                <div class="space-y-6">
                  <form class="space-y-6 max-w-xl" @submit.prevent="save">
                    <transition-group
                      appear
                      enter-active-class="transition ease-out duration-300"
                      enter-from-class="opacity-0 transform translate-y-4"
                      enter-to-class="opacity-100 transform translate-y-0"
                      move-class="transition duration-500"
                      :duration="{ enter: 500, leave: 0 }"
                    >
                      <InputGroup key="title" :text="'Program Title'" :required="'required'" v-model="form.title">
                        <Type />
                      </InputGroup>
                      <InputError key="title-error" :message="form.errors.title" />
  
                      <InputGroup key="description" :text="'Description'" :required="'required'" v-model="form.description">
                        <Text />
                      </InputGroup>
                      <InputError key="description-error" :message="form.errors.description" />
  
                      <div key="coordinator" class="relative text-gray-500 focus-within:text-blue-600">
                        <select
                          class="rounded-lg block w-full pl-10 py-3 text-sm text-black border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-150 ease-in-out"
                          :required="'required'"
                          v-model="form.coordi_id"
                        >
                          <option disabled value="">Coordinator in charge</option>
                          <option v-for="coordi in coordinators" :key="coordi.id" :value="coordi.id">
                            {{ coordi.name }}
                          </option>
                        </select>
                        <div class="absolute inset-y-0 left-0 flex items-center ml-3 pointer-events-none">
                          <UserSearch class="w-5 h-5" />
                        </div>
                      </div>
                      <InputError key="coordinator-error" :message="form.errors.coordi_id" />
  
                      <InputGroup
                        key="image"
                        v-if="props.program == null"
                        @change="showImg($event)"
                        :text="'Image'"
                        :required="'required'"
                        :type="'file'"
                        :accept="'image/*'"
                      >
                        <ImagePlus />
                      </InputGroup>
                      
                      <InputGroup
                        key="image-edit"
                        v-else
                        :text="'Image'"
                        @change="showImg($event)"
                        :type="'file'"
                        :accept="'image/*'"
                      >
                        <ImagePlus />
                      </InputGroup>
  
                      <InputError key="image-error" :message="form.errors.image" />
  
                      <div key="beneficiaries" class="space-y-2">
                        <span class="text-sm font-medium text-gray-700">Beneficiaries:</span>
                        <Select2
                          v-model="form.beneficiaries"
                          :options="options"
                          :settings="{ multiple: true, width: '100%' }"
                          @change="form.beneficiaries = $event.target.value"
                          class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-150 ease-in-out"
                        />
                      </div>
                      <InputError key="beneficiaries-error" :message="form.errors.beneficiaries" />
  
                      <PrimaryButton key="submit" class="w-full justify-center py-3 text-lg transition duration-150 ease-in-out transform hover:scale-105">
                        Save
                      </PrimaryButton>
                    </transition-group>
                  </form>
                </div>
              </transition>
  
              <transition
                appear
                enter-active-class="transition ease-out duration-500 delay-500"
                enter-from-class="opacity-0 transform translate-x-4"
                enter-to-class="opacity-100 transform translate-x-0"
              >
                <div class="w-full p-4 rounded-lg shadow-lg bg-gray-50">
                  <img :src="srcImg" class="w-full h-auto rounded-lg transition duration-300 ease-in-out transform hover:scale-105" />
                </div>
              </transition>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>

<style scoped>
.form-input,
.form-select {
  transition-property: all;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 150ms;
}

.form-input:focus,
.form-select:focus {
  --tw-ring-color: rgba(59, 130, 246, 0.5);
  --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
  --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
  box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
}

@keyframes typing {
  from { width: 0 }
  to { width: 100% }
}

@keyframes blink-caret {
  from, to { border-color: transparent }
  50% { border-color: white }
}

.typing-animation {
  overflow: hidden;
}
.typing-text {
  display: inline-block;
  overflow: hidden;
  white-space: nowrap;
  margin: 0 auto;
  animation: 
    typing 3.5s steps(40, end),
    blink-caret 0.75s step-end infinite;
}

.typing-text2 {
  display: inline-block;
  overflow: hidden;
  white-space: nowrap;
  margin: 0 auto;
  animation: 
    typing 3.5s steps(40, end),
    blink-caret 0.75s step-end infinite;
}
</style>