<template>
  <div class="w-full px-6 py-6 mx-auto">
    <!-- table 1 -->
    <div class="flex flex-wrap -mx-3">
      <div class="flex-none w-full max-w-full px-3">
        <div
          class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
          <div
            class="flex justify-between p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <h6>Categories table</h6>
            <router-link :to="{ name: 'add-category' }"
              class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
              <i class="fas fa-plus" aria-hidden="true"> </i>&nbsp;&nbsp;Add New
            </router-link>
          </div>
          <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto ps">
              <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                <thead class="align-bottom">
                  <tr class="">
                    <th
                      class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                      <div class="flex items-center">
                        <span>
                          Category
                        </span>
                        <span class="ml-2 font-bold flex flex-col">
                          <a @click="check" id="name-asc" href="#">
                            <i @click="" class="fas fa-angle-up"></i>
                          </a>
                          <a @click="check" id="name-desc" href="#">
                            <i class="fas fa-angle-down"></i>
                          </a>
                        </span>
                      </div>
                    </th>
                    <th
                      class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                      <div class="flex items-center">
                        <span>
                          Created At
                        </span>
                        <span class="ml-2 font-bold flex flex-col">
                          <a @click="check" id="created_at-asc" href="#">
                            <i @click="" class="fas fa-angle-up"></i>
                          </a>
                          <a @click="check" id="created_at-desc" href="#">
                            <i class="fas fa-angle-down"></i>
                          </a>
                        </span>
                      </div>
                    </th>
                    <th
                      class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <template v-for="category of categories.data" :key="category.id">
                    <tr>
                      <td class="p-2 align-middle bg-transparent border-b-0 whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                          <div class="flex flex-col justify-center">
                            <h6 class="mb-0 text-sm leading-normal">{{ category.name }}</h6>
                            <p class="mb-0 text-xs leading-tight text-slate-400">miriam@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b-0 whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                          <div class="flex flex-col justify-center">
                            <h6 class="mb-0 text-sm leading-normal">{{ category.created_at }}</h6>
                          </div>
                        </div>
                      </td>
                      <td
                        class="text-center p-2 align-middle bg-transparent border-b-0 whitespace-nowrap shadow-transparent">
                        <div class="ml-auto text-right">
                          <router-link :to="`/category/${category.id}/edit`" class="inline-block px-4 py-3 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 bg-x-25 text-slate-700"
                            href="javascript:;"><i class="mr-2 fas fa-pencil-alt text-slate-700"
                              aria-hidden="true"></i>Edit
                          </router-link>

                          <a @click="remove(category.id)" class="relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text"
                            href="javascript:;">
                            <i class="mr-2 far fa-trash-alt bg-150 bg-gradient-to-tl from-red-600 to-rose-400 bg-x-25 bg-clip-text"
                              aria-hidden="true"></i>Delete
                          </a>
                        </div>
                      </td>
                    </tr>
                  </template>
                  <tr v-show="categories.length < 1" class="text-center text-red-600">
                    <td colspan="2">No data found!</td>
                  </tr>
                </tbody>
              </table>
              <div class="ps__rail-x" style="left: 0px; top: 0px;">
                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
              </div>
              <div class="ps__rail-y" style="top: 0px; left: 0px;">
                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- pagination start -->
    <div v-show="categories.last_page > 1">
      <pagination :data="categories" @byPageNo="getByPageNo"/>
    </div>
    <!-- pagination end -->
  </div>




</template>


<script setup>
import { onMounted, ref } from 'vue';
import { useGetRequest, useDeleteRequest } from '@/axiosClient';
import { useRouter } from 'vue-router';
import pagination from '@/components/pagination.vue';

  
const router = useRouter();


// use to hold categories data from backend
const categories = ref([]);
// use to hold current page number
const pageNumber = ref('1');
// use to type of sort type
const sortBy = ref('created_at-asc');

// fetch data on component mounting 
onMounted(() => {
  getCategories();
});

// use for get data by pagination
const getByPageNo = async (pageNo) => {
  pageNumber.value = pageNo;
  getCategories();
};


// use for get data by sort type
const getBySort = async (sort) => {
  sortBy.value = sort;
  getCategories();
};

// use to send reqest data to backend to get dat
const getCategories = async () => {
  const response = await useGetRequest(`/categories?sort=${sortBy.value}&page=${pageNumber.value}`);
  if (response.data.hasOwnProperty('categories')) {
    categories.value = response.data.categories;
  }
};

// use to save last clicked sort btn
let sortBtn = null;
// use to give active effect
const check = (event) => {
  if (sortBtn) {
    sortBtn.classList.toggle('text-black');
  }
  // get the selected sort btn
  sortBtn = event.currentTarget;
  // call function accroding to sort type
  getBySort(sortBtn.id);
  // give class to show selected btn
  sortBtn.classList.toggle('text-black');
}


// delete category
const remove = async (category_id) => {
  const response = await useDeleteRequest('category/'+category_id);
  console.log(response);
  if (response.data.success) {
    router.go(0);
  }
};


</script>
