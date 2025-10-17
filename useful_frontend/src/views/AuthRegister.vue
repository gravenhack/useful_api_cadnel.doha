<script setup>

import { ref } from 'vue'

import { useUsersStore } from '../stores/User.js'

import { useRouter } from 'vue-router'


const store = useUsersStore()

const name = ref('')

const email = ref('')

const password = ref('')

const router = useRouter()


const register = async () => {

  if (!name.value || !email.value || !password.value) {

    console.log('Vous devez remplir tous les champs')

    return
  }

  const success = await store.doRegister({

    name: name.value,

    email: email.value,

    password: password.value,

  })

  if (success) {

    alert('Inscription réussie ! Vous pouvez vous connecter.')

    router.push('/auth/login');
  }
}
</script>

<template>

  <div class="min-h-screen flex flex-col lg:flex-row">

    <div class="w-full lg:w-full bg-gray-50 flex items-center justify-center px-6 sm:px-10 md:px-16 lg:px-20 py-12 lg:py-0">

      <div class="w-full max-w-md">

        <form @submit.prevent="register" class="space-y-4 lg:space-y-6">

          <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">

              Nom 

            </label>

            <input
                v-model="name"
                type="text"
                placeholder="Ex: John51"
                class="w-full px-4 py-3 bg-[#E8F0FE] text-black placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-purple-500"
            >
          </div>

          <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">

              Email

            </label>

            <input
                v-model="email"
                type="email"
                placeholder="Ex: johdoe@gmail.com"
                class="w-full px-4 py-3 bg-[#E8F0FE] text-black  placeholder-gray-400"
            >
          </div>

          

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Votre mot passe
            </label>
            <input
                v-model="password"
                type="password"
                placeholder="*****"
                class="w-full px-4 py-3 bg-[#E8F0FE] text-black  placeholder-black"
            >
          </div>


          <button
              type="submit"
              class="m-2 w-full bg-black text-white font-semibold py-2.5 lg:py-3  transition duration-200 text-sm lg:text-base"
          >
            Inscription
          </button>

          <p class="text-center text-sm text-gray-700">
            Vous avez déjà un compte alors connectez vous c'est par
            <router-link to="/auth/login">
            <a  class="text-purple-600 hover:underline font-medium">ici</a>
            </router-link>
          </p>
        </form>
      </div>
    </div>
  </div>
</template>
