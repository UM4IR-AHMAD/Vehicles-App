<template>
  <div class="w-full px-6 py-6 mx-auto">
    <!-- row 1 -->
    <div class="flex flex-wrap -mx-3">
      <div class="px-3 mx-auto mt-0 md:flex-0 shrink-0 w-7/12">
        <div
          class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
          <div class="p-6 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
            <h5>{{ route.name === 'add-car' ? 'Add new ' : 'Edit ' }}car</h5>
          </div>
          <div class="flex-auto p-6">
            <form role="form text-left">
              <!-- car id -->
              <input type="text" v-modal="car.id" hidden />

              <!-- car category -->
              <div class="mb-4">
                <label class="my-2 font-semibold">Categories</label>
                <select
                  class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                  id="cars" name="cars" v-model="car.category_id">
                  <option selected disabled value="">Select category</option>
                  <template v-for="category of categories" :key="category.id">
                    <option @selected="category.id" :value="category.id">{{ category.name }}
                    </option>
                  </template>
                </select>
                <span class="text-red-500 text-xs" v-show="!isValidCategory">Please select category</span>
              </div>
              <!-- end car category -->

              <!-- car registration_no -->
              <div class="mb-4">
                <label class="my-2 font-semibold">Registration No.</label>
                <input v-model="car.registration_no" type="text"
                  class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                  placeholder="BI-GH-1245">
                  <span class="text-red-500 text-xs" v-show="!isValiedRegNo">Please enter valid registration number pattren L(IP)-P(F)-2(014)</span>
              </div>
             
              <!-- end car maker -->

              <!-- car maker -->
              <div class="mb-4">
                <label class="my-2 font-semibold">Make by</label>
                <input v-model="car.make" type="text"
                  class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                  placeholder="Car Maker">
                  <span class="text-red-500 text-xs" v-show="!isValidMake">Only Alphabats,should start with capital letter and no space</span>              </div>
              <!-- end car maker -->

              <!-- car model -->
              <div class="mb-4">
                <label class="my-2 font-semibold">Model</label>
                <input v-model="car.model" type="text"
                  class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                  placeholder="Car model">
                  <span class="text-red-500 text-xs" v-show="!isValidModel">Car model number is required</span>
              </div>
              <!-- end car maker -->

              <!-- car Color -->
              <div class="mb-4">
                <label class="my-2 font-semibold">Color</label>
                <input v-model="car.color" type="text"
                  class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                  placeholder="Car Color">
                  <span class="text-red-500 text-xs" v-show="!isValidColor">Only Alphabats,should start with capital letter and no space</span>
              </div>
              <!-- end car color -->

              <div class="text-center">
                <button @click="submitForm" type="button"
                  class="inline-block w-full px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 hover:border-slate-700 hover:bg-slate-700 hover:text-white">{{
                    route.name === 'add-car' ? 'Add new ' : 'Update' }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { ref, reactive, onMounted, computed } from 'vue';
import { usePostRequest, useGetRequest, usePutRequest } from '@/axiosClient';
import { useToastr } from '@/composables/toastr';
import { useRouter, useRoute } from 'vue-router';

const router = useRouter();
const route = useRoute();

// categories
const categories = ref([]);

// use to hold category data of form/request
const car = reactive({
  id: 0,
  category_id: '',
  registration_no: '',
  make: '',
  model: '',
  color: '',
});


// this function runs when submit the form and add/update request to server
const submitForm = async () => {
  startValidation.value = true;
  if (isValidCategory.value && isValiedRegNo.value && isValidMake.value && isValidModel.value && isValidColor.value) {
    const response = route.params.id
      ? await usePutRequest('car/update', car)
      : await usePostRequest('car/add', car);
    if (response.data.success) {
      router.push({ name: 'cars' });
    } else if (!response.success && response.data.message) {
      useToastr(response.data.message, false);
    }
  }
};



// on component check if route has category id then fetch data
onMounted(async () => {
  // get categories
  const response = await useGetRequest('categories/all');
  if (response.data.hasOwnProperty('categories')) {
    categories.value = response.data.categories;
  }

  // check if car editing then get car data from backend
  if (route.params.id) {
    const response = await useGetRequest(`/car/${route.params.id}/edit`);
    if (response.data.hasOwnProperty('car')) {
      car.id = response.data.car.id;
      car.category_id = response.data.car.category_id;
      car.registration_no = response.data.car.registration_no;
      car.make = response.data.car.make;
      car.model = response.data.car.model;
      car.color = response.data.car.color;
    }
  }
});


// below is cars validation

const startValidation = ref(false);

// category selection
const isValidCategory = computed(() => startValidation.value ? /^[1-9][0-9]*$/.test(car.category_id) : true);

// name validation
const isValiedRegNo = computed(() => startValidation.value ? /^[A-Z]{1,3}-[A-Z]{1,2}-[0-9]{1,4}$/.test(car.registration_no) : true);

// make validation
const isValidMake = computed(() => startValidation.value ? /^[A-Z][a-zA-Z]+$/.test(car.make) : true);

// model validation
const isValidModel = computed(() => startValidation.value ? /^(?!\s*$).+/.test(car.model) : true);

// color validation
const isValidColor = computed(() => startValidation.value ? /^[A-Z][a-zA-Z]+$/.test(car.color) : true);

</script>
