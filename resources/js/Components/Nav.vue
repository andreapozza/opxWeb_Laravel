<template>
  <!--Nav-->
  <nav class="bg-gray-800 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">
  
    <div class="flex flex-wrap items-center">
      <div class="flex flex-shrink md:py-5 md:pl-3 p-0 h-12 md:h-20 w-full md:w-1/3 justify-center md:justify-start text-white">
        <img src="../../images/logo-opx.png" alt="">
      </div>
  
      <div class="flex flex-1 justify-center w-full md:w-1/3 text-white px-2">
        <span class="text-3xl pt-2 flex flex-nowrap justify-center w-full text-ellipsis">
          <a href="/" class="text-gray-400 hover:text-white overflow-hidden whitespace-nowrap text-ellipsis">
            {{ $page.props.host }}
          </a>
          <a href="/" target="_blank" class="ml-3 text-gray-400 hover:text-white">
            <font-awesome-icon :icon="['fas','external-link-alt']" size="xs" fixed-width/>
          </a>
        </span>
      </div>
  
      <div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
        <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
          <li class="flex-1 md:flex-none md:mr-3">
            <!-- Settings Dropdown -->
            <div class="ml-3 relative">
              <jet-dropdown align="right" width="48">
                <template #trigger>
                  <div class="flex">
                    <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                      <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                    </button>
                    
                    <span class="inline-flex rounded-md">
                      <button type="button" class="inline-flex items-center px-3 border border-transparent leading-4 font-medium rounded-md text-gray-400  hover:text-gray-200 focus:text-gray-200 focus:outline-none transition">
                        {{ $page.props.user.name }}
                    
                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                      </button>
                    </span>
                  </div>
                </template>

                <template #content>
                  <!-- Account Management -->
                  <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Account') }}
                  </div>

                  <jet-dropdown-link :href="route('profile.show')">
                    {{ __('Profile') }}
                  </jet-dropdown-link>

                  <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                    {{ __('API Tokens') }}
                  </jet-dropdown-link>

                  <div class="border-t border-gray-100"></div>

                  <!-- Authentication -->
                  <jet-dropdown-link as="button" @click="$inertia.post(route('logout'), {onProgress: () => console.log(1) })">
                    {{ __('Log Out') }}
                  </jet-dropdown-link>
                </template>
              </jet-dropdown>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
import JetDropdown from '@/Jetstream/Dropdown.vue'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/inertia-vue3'
export default {
  data() {
    return {
      showDropdown: false,
    }
  },
  components: { JetDropdownLink, JetResponsiveNavLink, JetDropdown, Link }
}
</script>