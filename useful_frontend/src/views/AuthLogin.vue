<script setup>

import { ref } from 'vue'

import { useUsersStore } from '../stores/User.js'

import { useRouter } from 'vue-router'


const store = useUsersStore()

const email = ref('')

const password = ref('')

const router = useRouter()


const login = async () => {

  if (!email.value || !password.value) {

    console.log('Veuillez remplir tous les champs')

    return

  }

  const success = await store.doLogin({

    email: email.value,

    password: password.value

  })

  if (success) {

    router.push('/');
  }

}



</script>

<template>

  <div class="min-h-screen flex flex-col lg:flex-row">


    <div
      class="w-full lg:w-full bg-gray-50 flex items-center justify-center px-6 sm:px-10 md:px-16 lg:px-20 py-12 lg:py-0">
      <div class="w-full max-w-md">

        <div class="w-full max-w-md">

          <form @submit.prevent="login" class="space-y-4 lg:space-y-6">


            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">
                Email
              </label>
              <input v-model="email" type="email" placeholder="Ex: johdoe@gmail.com"
                class="w-full px-4 py-3 bg-[#E8F0FE] text-black placeholder-black  focus:outline-none focus:ring-1 focus:ring-purple-500">
            </div>



            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">
                Votre mot passe
              </label>
              <input v-model="password" type="password" placeholder="*****"
                class="w-full px-4 py-3 bg-[#E8F0FE] text-black  placeholder-black  focus:outline-none focus:ring-1 focus:ring-purple-500">
            </div>



            <button type="submit"
              class="m-2 w-full bg-black text-white font-semibold py-2.5 lg:py-3  transition duration-200 text-sm lg:text-base"
              >
              Connexion
            </button>

            <p class="text-center text-sm text-gray-700">
              Vous n'avez pas de compte alors inscrivez vous
              <router-link to="/auth/register">
                <a class="text-purple-600 hover:underline font-medium">ici</a>
              </router-link>
            </p>

          </form>
        </div>

      </div>
    </div>
  </div>
</template>
