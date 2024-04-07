<template>
  <sideBar />
  <main
    class="flex flex-col justify-between min-h-screen ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
    <section>
      <main-header />
      <Router-view />
    </section>
    <main-footer />
  </main>

</template>


<script setup>
import { RouterView } from 'vue-router';
import sideBar from '@/components/layout/side-bar.vue';
import mainHeader from '@/components/layout/header.vue';
import mainFooter from '@/components/layout/footer.vue';
</script>