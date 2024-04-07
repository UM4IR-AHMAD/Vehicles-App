<template>
  <div
    class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border">
    <div class="p-6 pb-0 mb-0 bg-transparent border-b-0 rounded-t-2xl">
      <h3 class="relative z-10 font-bold text-transparent bg-gradient-to-tl from-slate-600 to-cyan-400 bg-clip-text">
        Welcome</h3>
      <p class="mb-0">Create new account for free.</p>
    </div>
    <div class="flex-auto p-6">
      <form @submit.prevent="signup" method="POST">
        {{ }}
        <!-- name -->
        <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Name</label>
        <div class="mb-4">
          <input v-model="newUser.name" type="text"
            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
            placeholder="name" aria-label="name" aria-describedby="name-addon">
          <span class="text-red-500 text-xs" v-show="!isValiedName">Only Alphabats and should start with capital
            letter</span>
        </div>
        <!-- email -->
        <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
        <div class="mb-4">
          <input v-model="newUser.email" type="email"
            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
            placeholder="Email" aria-label="Email" aria-describedby="email-addon">
          <span class="text-red-500 text-xs" v-show="!isValiedEmail">Please enter valid email address</span>
        </div>
        <!-- password -->
        <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Password</label>
        <div class="mb-4">
          <input v-model="newUser.password" type="password"
            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
            placeholder="Password" aria-label="Password" aria-describedby="password-addon">
          <span class="text-red-500 text-xs" v-show="!isValidPassword">Password of min 8 characters(capital and small
            letter, number, special character)</span>
        </div>
        <!-- confirm password -->
        <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Confirm Password</label>
        <div class="mb-4">
          <input v-model="confirmPassword" type="password"
            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
            placeholder="Password" aria-label="Password" aria-describedby="password-addon">
          <span class="text-red-500 text-xs" v-show="!isValidPasswordConfirmation">Password doesn't match</span>
        </div>
        <!-- sumbit button -->
        <div class="text-center">
          <button type="submit"
            class="inline-block w-full px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 hover:border-slate-700 hover:bg-slate-700 hover:text-white">Sign
            up</button>
        </div>
      </form>
    </div>
    <div class="p-6 px-1 pt-0 text-center bg-transparent border-t-0 border-t-solid rounded-b-2xl lg:px-2">
      <p class="mx-auto mb-6 leading-normal text-sm">
        Do you have an account?
        <router-link :to="{ name: 'signin' }"
          class="relative z-10 font-semibold text-transparent bg-gradient-to-tl from-blue-600 to-cyan-400 bg-clip-text">Sign
          in</router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useSignup } from '@/composables/authentication.js';

const router = useRouter();

// use to hold form data
const newUser = reactive({
  name: '',
  email: '',
  password: ''
});

// use to hold password
const confirmPassword = ref('');

// submit form
const signup = async () => {
  startValidation.value = true;
  if (isValiedName.value && isValiedEmail.value && isValidPassword.value && isValidPasswordConfirmation.value) {
    const response = await useSignup(newUser);
    if (response) {
      router.push({ name: 'dashboard' });
    }
  }
}



// below is signup form validaion

const startValidation = ref(false);

// name validation
const isValiedName = computed(() => startValidation.value ? /^[A-Z][a-zA-Z ]+$/.test(newUser.name) : true);

// email validation
const isValiedEmail = computed(() => startValidation.value ? /^(?![\w\.@]*\.\.)(?![\w\.@]*\.@)(?![\w\.]*@\.)\w+[\w\.]*@[\w\.]+\.\w{2,}$/.test(newUser.email) : true);


// password validation
const isValidPassword = computed(() => startValidation.value ? /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$/.test(newUser.password) : true);

// password match validation
const isValidPasswordConfirmation = computed(() => startValidation.value ? newUser.password === confirmPassword.value : true);

</script>