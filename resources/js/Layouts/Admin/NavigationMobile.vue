<template>
  <transition enter-active-class="transition ease-in-out duration-150" enter-from-class="opacity-0"
    enter-to-class="opacity-100" leave-active-class="transition ease-in-out duration-150" leave-from-class="opacity-100"
    leave-to-class="opacity-0">
    <div v-show="$page.props.showingMobileMenu"
      class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
  </transition>
  <transition enter-active-class="transition ease-in-out duration-150"
    enter-from-class="opacity-0 transform -translate-x-20" enter-to-class="opacity-100"
    leave-active-class="transition ease-in-out duration-150" leave-from-class="opacity-100"
    leave-to-class="opacity-0 transform -translate-x-20">
    <aside v-show="$page.props.showingMobileMenu"
      class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-blue-500 md:hidden">
      <div class="py-4 text-white">
        <Link class="ml-6 text-lg font-bold" :href="route('home')">
        Fundación CTI
        </Link>
        <ul class="mt-6">
          <li class="relative px-6 py-3">
            <ResponsiveNavLink :href="route('admin-myinfo.index')" :active="route().current('admin-myinfo.index')">
              <template #icon>
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                  </path>
                </svg>
              </template>
              My Data
            </ResponsiveNavLink>
          </li>

          <li class="relative px-6 py-3">
            <ResponsiveNavLink :href="route('admin-dashboard.index')"
              :active="route().current('admin-dashboard.index')">
              <template #icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
                </svg>
              </template>
              Dashboard
            </ResponsiveNavLink>
          </li>

          <li class="relative px-6 py-3">
            <button @click="showingTwoLevelMenu = !showingTwoLevelMenu"
              class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800"
              aria-haspopup="true">
              <span class="inline-flex items-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                  </path>
                </svg>
                <span class="ml-4">Users</span>
              </span>
              <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
            </button>
            <ul
              v-show="showingTwoLevelMenu || route().current('admin-coordinators.index') || route().current('admin-volunteers.index') || route().current('admin-donors.index') || route().current('admin-beneficiaries.index')"
              class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50"
              aria-label="submenu">
              <li :class="{ 'text-gray-900': route().current('admin-coordinators.index') }"
                class="px-2 py-1 transition-colors duration-150 hover:text-gray-900">
                <ResponsiveNavLink :href="route('admin-coordinators.index')"
                  :active="route().current('admin-coordinators.index')">
                  Coordinators
                </ResponsiveNavLink>
              </li>
              <li :class="{ 'text-gray-900': route().current('admin-volunteers.index') }"
                class="px-2 py-1 transition-colors duration-150 hover:text-gray-900">
                <ResponsiveNavLink :href="route('admin-volunteers.index')"
                  :active="route().current('admin-volunteers.index')">
                  Volunteers
                </ResponsiveNavLink>
              </li>
              <li :class="{ 'text-gray-900': route().current('admin-donors.index') }"
                class="px-2 py-1 transition-colors duration-150 hover:text-gray-900">
                <ResponsiveNavLink :href="route('admin-donors.index')" :active="route().current('admin-donors.index')">
                  Donors
                </ResponsiveNavLink>
              </li>
              <li :class="{ 'text-gray-900': route().current('admin-beneficiaries.index') }"
                class="px-2 py-1 transition-colors duration-150 hover:text-gray-900">
                <ResponsiveNavLink :href="route('admin-beneficiaries.index')"
                  :active="route().current('admin-beneficiaries.index')">
                  Beneficiaries
                </ResponsiveNavLink>
              </li>
            </ul>
          </li>

          <li class="relative px-6 py-3">
            <ResponsiveNavLink :href="route('admin-programs.index')" :active="route().current('admin-programs.index')">
              <template #icon>
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path
                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                  </path>
                </svg>
              </template>
              Programs
            </ResponsiveNavLink>
          </li>



        </ul>
      </div>
    </aside>
  </transition>
</template>

<script setup>
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'

let showingTwoLevelMenu = ref(false)
</script>
