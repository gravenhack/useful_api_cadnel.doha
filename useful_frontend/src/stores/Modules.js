import api from '../api/utils.js'

import {defineStore} from "pinia";


export const useModulesStore = defineStore("modules", {

    state: () => ({

        modulesList: [],

        loading: false,
        
        error: null,
    }),

    actions: {

        async deactivateModule(id) {

            this.loading = true

            this.error = null

            try {
                const response = await api.post(`/modules/${id}/deactivate`)

            } catch (e) {

                this.error = e.message;

            } finally {

                this.loading = false
            }

        },

        async activateModule(id) {

            this.loading = true

            this.error = null

            try {
                const response = await api.post(`/modules/${id}/activate`)

            } catch (e) {

                this.error = e.message;
               
            } finally {

                this.loading = false
            }

        },

        
        async fetchAllModules() {

            this.loading = true;

            try {
                const res = await api.get(`/modules`);

                return res.data

            } catch (err) {

                this.error = err.message;

            } finally {

                this.loading = false;
            }
        },
    },

    persist: true,
})