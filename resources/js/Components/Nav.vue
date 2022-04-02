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
            <a class="inline-block py-2 px-4 text-white no-underline" href="#">Active</a>
          </li>
          <li class="flex-1 md:flex-none md:mr-3">
            <a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2 px-4" href="#">link</a>
          </li>
          <li class="flex-1 md:flex-none md:mr-3">
            <div class="relative inline-block">
                <button
                  @mouseleave="showDropdown = false"
                  @click="showDropdown = !showDropdown" 
                  class="drop-button text-white focus:outline-none"> 
                  Hi, User 
                  <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                  </svg>
                </button>
                <div
                  @mouseover="showDropdown = true"
                  @mouseleave="showDropdown = false"
                  class="dropdownlist absolute bg-gray-800 text-white right-0 pt-6 overflow-auto z-30 -mr-3"
                  :class="{invisible: !showDropdown}">
                  <a href="#" class="py-3 px-6 hover:bg-gray-700 text-white text-sm no-underline hover:no-underline flex gap-3"><i class="fas fa-user"></i> Profile</a>
                  <a href="#" class="py-3 px-6 hover:bg-gray-700 text-white text-sm no-underline hover:no-underline flex gap-3"><i class="fa fa-cog"></i> Settings</a>
                  <div class="mx-3 border border-gray-200"></div>
                  <a href="#" class="py-3 px-6 hover:bg-gray-700 text-white text-sm no-underline hover:no-underline flex gap-3"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      showDropdown: false,
    }
  }
}
</script>