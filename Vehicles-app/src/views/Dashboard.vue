<template>

  <!-- cards -->
  <div class="w-full px-6 py-6 mx-auto">
    <!-- row 1 -->
    <div class="flex flex-wrap -mx-3">
      <!-- card -->
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <div>
                <p class="mb-0 font-sans font-semibold leading-normal text-sm">Registered car</p>
                <h5 class="mb-0 font-bold">
                  {{ registeredCars }}
                </h5>
              </div>
            </div>
            <div class="px-3 text-right basis-1/3">
              <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                <i class="fa-solid fa-car-tunnel text-lg relative top-3 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { onMounted, ref } from 'vue';
import { useGetRequest } from "@/axiosClient";

const registeredCars = ref(0);

onMounted(async() => {

  // get regoistered cars count
  const response = await useGetRequest('dashboard');
  if (response.data.registeredCars) {
    registeredCars.value = response.data.registeredCars
  }
});
</script>
