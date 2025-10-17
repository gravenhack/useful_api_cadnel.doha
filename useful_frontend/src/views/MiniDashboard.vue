<script setup>
import { onMounted, ref } from 'vue';

import { useModulesStore } from '../stores/Modules';



const store = useModulesStore();

const modules = ref([]);



onMounted(() => {

  store.fetchAllModules();

  modules.value = store.modulesList;

  console.log(store.modulesList)

  
});
</script>

<template>

  {{ modules }}
  
</template>