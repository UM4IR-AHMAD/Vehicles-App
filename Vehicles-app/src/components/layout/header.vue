<template>
    <!-- Navbar -->
    <nav class=" relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="true">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit  ">
                <nav class="">
                    <!-- breadcrumb -->
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="leading-normal text-sm">
                            <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']" aria-current="page">{{ route.name }}</li>
                    </ol>
                    <h6 class="mb-0 font-bold capitalize">{{ route.name.replace('-', ' ') }}</h6>
                </nav>

                <div class="flex items-center mt-2 sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">

                    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                        <li class="flex items-center">
                            <a href="javascript:;" class="block px-0 py-2 font-semibold transition-all ease-nav-brand text-sm text-slate-500">
                                <i class="fa fa-user sm:mr-1"></i>
                                <span class="hidden sm:inline ml-1`">Hi, {{userFullname}}</span>
                            </a>
                           
                        </li>
                        <li class="flex items-center px-4">
                            <a @click="signout" href="javascript:;" class="p-0 transition-all text-sm ease-nav-brand text-slate-500">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> 
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
</template>


<script setup>
import { ref, computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useSignout } from '@/composables/authentication.js';

// use to get current route name
const route = useRoute();
const router =useRouter();

// use to keep user name update
const userFullname = computed(() => localStorage.getItem('user_name') ?? '');

// logout user
const signout =  () => {
    const respone = useSignout();
    router.push({name:'signin'});
};

</script>