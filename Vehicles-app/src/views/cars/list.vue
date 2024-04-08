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
            <router-link :to="{ name: 'add-car' }"
              class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
              <i class="fas fa-plus" aria-hidden="true"> </i>&nbsp;&nbsp;Add New
            </router-link>
          </div>
          <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto ps">
              <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                <thead class="align-bottom">
                  <tr class="">
                    <!-- registration_no -->
                    <th
                      class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"> Register #
                    </th>
                    <!-- category  -->
                    <th
                      class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                      <div class="flex items-center">
                        <span>
                          Category
                        </span>
                        <span class="ml-2 font-bold flex flex-col">
                          <a @click="check" id="category-asc" href="#">
                            <i @click="" class="fas fa-angle-up"></i>
                          </a>
                          <a @click="check" id="category-desc" href="#">
                            <i class="fas fa-angle-down"></i>
                          </a>
                        </span>
                      </div>
                    </th>
                    <!-- make -->
                    <th
                      class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                      <div class="flex items-center">
                        <span>
                          Make
                        </span>
                        <span class="ml-2 font-bold flex flex-col">
                          <a @click="check" id="make-asc" href="#">
                            <i @click="" class="fas fa-angle-up"></i>
                          </a>
                          <a @click="check" id="make-desc" href="#">
                            <i class="fas fa-angle-down"></i>
                          </a>
                        </span>
                      </div>
                    </th>
                    <!-- model -->
                    <th
                      class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"> Model
                    </th>
                    <!-- color -->
                    <th
                      class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"> Color
                    </th>
                    <!-- create at -->
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
                   <!-- actions -->
                    <th
                      class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- start table row -->
                  <template v-for="car of cars.data" :key="car.id">
                    <tr>
                      <!-- registration_no -->
                      <td class="p-2 align-middle bg-transparent border-b-0 whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                          <div class="flex flex-col justify-center">
                            <h6 class="mb-0 text-sm leading-normal">{{ car.registration_no }}</h6>
                          </div>
                        </div>
                      </td>
                      <!-- category -->
                      <td class="p-2 align-middle bg-transparent border-b-0 whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                          <div class="flex flex-col justify-center">
                            <h6 class="mb-0 text-sm leading-normal">{{ car.category.name }}</h6>
                          </div>
                        </div>
                      </td>
                      <!-- make -->
                      <td class="p-2 align-middle bg-transparent border-b-0 whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                          <div class="flex flex-col justify-center">
                            <h6 class="mb-0 text-sm leading-normal">{{ car.make }}</h6>
                          </div>
                        </div>
                      </td>
                      <!-- model -->
                      <td class="p-2 align-middle bg-transparent border-b-0 whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                          <div class="flex flex-col justify-center">
                            <h6 class="mb-0 text-sm leading-normal">{{ car.model }}</h6>
                          </div>
                        </div>
                      </td>
                      <!-- color -->
                      <td class="p-2 align-middle bg-transparent border-b-0 whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                          <div class="flex flex-col justify-center">
                            <h6 class="mb-0 text-sm leading-normal">{{ car.color }}</h6>
                          </div>
                        </div>
                      </td>
                      <!-- created_at -->
                      <td class="p-2 align-middle bg-transparent border-b-0 whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                          <div class="flex flex-col justify-center">
                            <h6 class="mb-0 text-sm leading-normal">{{ car.created_at }}</h6>
                          </div>
                        </div>
                      </td>
                      <!-- actions -->
                      <td
                        class="text-center p-2 align-middle bg-transparent border-b-0 whitespace-nowrap shadow-transparent">
                        <div class="ml-auto text-right">
                          <router-link :to="`/car/${car.id}/edit`"
                            class="inline-block px-4 py-3 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 bg-x-25 text-slate-700"
                            href="javascript:;"><i class="mr-2 fas fa-pencil-alt text-slate-700"
                              aria-hidden="true"></i>Edit
                          </router-link>

                          <a @click="remove(car.id)"
                            class="relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text"
                            href="javascript:;">
                            <i class="mr-2 far fa-trash-alt bg-150 bg-gradient-to-tl from-red-600 to-rose-400 bg-x-25 bg-clip-text"
                              aria-hidden="true"></i>Delete
                          </a>
                        </div>
                      </td>
                    </tr>
                  </template>
                  <!-- end table row -->
                  <tr v-show="cars.length < 1" class="text-center text-red-600">
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
    <div v-show="cars.last_page > 1">
      <pagination :data="cars" @byPageNo="getByPageNo"/>
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
const cars = ref([]);
// use to hold current page number
const pageNumber = ref('1');
// use to type of sort type
const sortBy = ref('created_at-asc');

// fetch data on component mounting 
onMounted(() => {
  getCars();
});

// use for get data by pagination
const getByPageNo = async (pageNo) => {
  pageNumber.value = pageNo;
  getCars();
};


// use for get data by sort type
const getBySort = async (sort) => {
  sortBy.value = sort;
  getCars();
};

// use to send reqest data to backend to get dat
const getCars = async () => {
  const response = await useGetRequest(`/cars?sort=${sortBy.value}&page=${pageNumber.value}`);
  if (response.data.hasOwnProperty('cars')) {
    cars.value = response.data.cars;
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
  const response = await useDeleteRequest('car/' + category_id);
  console.log(response);
  if (response.data.success) {
    router.go(0);
  }
};


</script>
