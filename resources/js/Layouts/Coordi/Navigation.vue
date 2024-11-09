<template>
  <aside class="z-20 hidden w-64 overflow-y-auto bg-blue-500 md:block flex-shrink-0">
    <div class="py-4 text-white">
      <Link class="ml-6 text-lg font-bold text-gray-100" :href="route('home')">
        Fundación CTI      
      </Link>

      <ul class="mt-6">
        <li class="relative px-6 py-3">
          <NavLink :href="route('coord-myinfo.index')" :active="route().current('coord-myinfo.index')">
            <template #icon>
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
              </svg>
            </template>
            <span class="ml-4">My data</span>
          </NavLink>
        </li>

        <li class="relative px-6 py-3">
          <NavLink :href="route('coord-programs.index')" :active="route().current('coord-programs.index')">
          <template #icon>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
              stroke-width="2" 
              stroke="currentColor" 
              class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 6.75A1.5 1.5 0 014.5 5h15a1.5 1.5 0 011.5 1.5v12A1.5 1.5 0 0119.5 
              20h-15A1.5 1.5 0 013 
              18.5v-12zM3 8.25v10.5m18-10.5v10.5M8.25 5.25H5.75a.75.75 0 00-.75.75v.75h4.5v-.75a.75.75 0 
              00-.75-.75zm10.5 0h-2.5a.75.75 0 00-.75.75v.75h4.5v-.75a.75.75 0 00-.75-.75z" />
              </svg>
          </template>
            <span class="ml-3">Programs</span>
          </NavLink>
        </li>

        

        <li class="relative px-6 py-3">
          <NavLink :href="route('coord-reports.index')" ::active="route().current('coord-reports.index')">
            <template #icon>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" 
                d="M4 12h2v8H4v-8zm4-2h2v10H8V10zm4-4h2v14h-2V6zm4-6h2v20h-2V0z" />
              </svg>
            </template>
            <span class="ml-3">Reports</span>
          </NavLink>
        </li>
        <li class="relative px-6 py-3">
          <NavLink :href="route('coord-peticiones.index')" ::active="route().current('coord-peticiones.index')">
            <template #icon>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-symlink"><path d="m10 18 3-3-3-3"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M4 11V4a2 2 0 0 1 2-2h9l5 5v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h7"/></svg>
            </template>
            <span class="ml-3">Peticiones</span>
          </NavLink>
        </li>

      </ul>
    </div>
  </aside>
</template>

<script>
import NavLink from '@/Components/NavLink.vue'
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'

export default {
  components: {
    NavLink,
    Link,
  },

  setup() {
    let showingTwoLevelMenu = ref(false)

    return {
      showingTwoLevelMenu
    }
  },
}
</script>
