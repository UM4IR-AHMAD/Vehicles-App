<template>
  <div
    class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border"  style="margin-bottom: 6.2rem; margin-top: 1rem;">
    <div class="p-6 pb-0 mb-0 bg-transparent border-b-0 rounded-t-2xl">
      <h3 class="relative z-10 font-bold text-transparent bg-gradient-to-tl from-blue-600 to-cyan-400 bg-clip-text">
        Welcome back</h3>
      <p class="mb-0">Enter your email and password to sign in</p>
    </div>
    <div class="flex-auto p-6">
      <!-- <div class="relative w-full p-4 text-white bg-red-500 rounded-lg">Alert red</div> -->
      <form @submit.prevent="signin" method="POST" role="form">
        <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
        <div class="mb-4">
          <input v-model="user.email" type="email"
            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
            placeholder="Email" aria-label="Email" aria-describedby="email-addon">
            <span class="text-red-500 text-xs" v-show="!isValiedEmail">Please enter valid email address</span>
        </div>
        <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Password</label>
        <div class="mb-4">
          <input v-model="user.password" type="password"
            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
            placeholder="Password" aria-label="Password" aria-describedby="password-addon">
        </div>
        <div class="text-center">
          <button type="submit"
            class="inline-block w-full px-6 py-3 mt-6 mb-0 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-blue-600 to-cyan-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85">
            Signin
          </button>
        </div>
      </form>
    </div>
    <div class="p-6 px-1 pt-0 text-center bg-transparent border-t-0 border-t-solid rounded-b-2xl lg:px-2">
      <p class="mx-auto mb-6 leading-normal text-sm">
        Don't have an account?
        <router-link :to="{ name: 'signup' }"
          class="relative z-10 font-semibold text-transparent bg-gradient-to-tl from-blue-600 to-cyan-400 bg-clip-text">Sign
          up</router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import {useSignin} from '@/composables/authentication.js';

const router = useRouter();

// use to hold form data
const user = reactive({
  email:'',
  password:''
});


// submit form
const signin = async () => {
  startValidation.value = true;
  if (isValiedEmail.value) {
    const response = await useSignin(user);
    console.log(response);
    if (response) {
      router.push({name:'dashboard'});
    }
  }
}



// below is signin form validaion

const startValidation = ref(false);
// email validation
const isValiedEmail = computed(() => startValidation.value ? /^(?![\w\.@]*\.\.)(?![\w\.@]*\.@)(?![\w\.]*@\.)\w+[\w\.]*@[\w\.]+\.\w{2,}$/.test(user.email) : true );


</script>