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
            <ResponsiveNavLink :href="route('volunt-myinfo.index')" :active="route().current('volunt-myinfo.index')">
              <template #icon>
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                  </path>
                </svg>
              </template>
              My Info
            </ResponsiveNavLink>
          </li>

          <li class="relative px-6 py-3">
            <ResponsiveNavLink :href="route('volunt-expenses.index')" :active="route().current('volunt-expenses.index')">
              <template #icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>
              </template>
              Expenses
            </ResponsiveNavLink>
          </li>

          <li class="relative px-6 py-3">
            <ResponsiveNavLink :href="route('volunt-contactos.index')" :active="route().current('volunt-contactos.index')">
              <template #icon>
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path
                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                  </path>
                </svg>
              </template>
              Contacts
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
