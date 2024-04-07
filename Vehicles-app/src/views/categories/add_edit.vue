<template>
  <div class="w-full px-6 py-6 mx-auto">
    <!-- row 1 -->
    <div class="flex flex-wrap -mx-3">
      <div class="px-3 mx-auto mt-0 md:flex-0 shrink-0 w-7/12">
        <div
          class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
          <div class="p-6 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
            <h5>{{ route.name === 'add-category' ? 'Add new ' : 'Edit ' }}category</h5>
          </div>
          <div class="flex-auto p-6">
            <form role="form text-left">
              <input type="text" v-modal="category.id" hidden />
              <div class="mb-4">
                <label class="font-semibold">Category</label>
                <input v-model="category.name" type="text"
                  class="mt-2 text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                  placeholder="Category Name" aria-label="Name" aria-describedby="categry-name-addon">
                <span class="text-red-500 text-xs" v-show="!isValidName">Only Alphabats,should start with capital letter and no space</span>
              </div>
              <div class="text-center">
                <button @click="submitForm" type="button"
                  class="inline-block w-full px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 hover:border-slate-700 hover:bg-slate-700 hover:text-white">{{
                    route.name === 'add-category' ? 'Add new ' : 'Update' }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { reactive, onMounted, ref, computed } from 'vue';
import { usePostRequest, useGetRequest, usePutRequest } from '@/axiosClient';
import { useToastr } from '@/composables/toastr';
import { useRouter, useRoute } from 'vue-router';

const router = useRouter();
const route = useRoute();

// use to hold category data of form/request
const category = reactive({
  id: 0,
  name: ''
});


// this function runs when submit the form and add/update request to server
const submitForm = async () => {
  startValidation.value = true;
  if (isValidName.value) {
    const response = route.params.id
      ? await usePutRequest('category/update', category)
      : await usePostRequest('category/add', category);
    if (response.data.success) {
      router.push({ name: 'categories' });
    }else if(!response.success && response.data.message){
      useToastr(response.data.message, false);
    }
  }

};



// on component check if route has category id then fetch data
onMounted(async () => {
  if (route.params.id) {
    const response = await useGetRequest(`/category/${route.params.id}/edit`);
    if (response.data.success) {
      category.id = response.data.category.id;
      category.name = response.data.category.name;
    }
  }
});



// below is category validation

const startValidation = ref(false);

// name validation
const isValidName = computed(() => startValidation.value ? /^[A-Z][a-zA-Z]+$/.test(category.name) : true);



</script>