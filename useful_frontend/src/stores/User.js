import { defineStore } from 'pinia'

import api, { setToken } from '../api/utils';

import auth from '../api/auth';

import { useRouter } from 'vue-router';


const router = useRouter()



export const useUsersStore = defineStore('board', {
    state: () => ({
        users: [],
        currentUser: null,
    }),
    actions: {


        async doRegister(data) {

            const response = await auth.register(data);

            if (response) {

                console.log(response.message);

                console.log(`Bienvenue! Votre compte a été créé.`)

                return true;
            }
            return false;
        },


        async doLogin(data) {

            const response = await auth.login(data);

            if (response) {

                this.currentUser = response.user;

                setToken(response.token);

                console.log(` Vous êtes connecté.`)

            } else {

                const toast = useToast();

                console.log('Oups, Informations incorrectes')
            }
        },

    },
    persist: true,
})
