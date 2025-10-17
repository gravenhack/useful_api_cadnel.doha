
<template>
  <div class="product-list">
    <div class="header">
      <h1>Liste des Produits</h1>
      <button @click="goToCreate" class="btn-create">
        Créer un produit
      </button>
    </div>

    <div v-if="loading" class="loading">
      Chargement...
    </div>

    <div v-if="error" class="error">
      Erreur: {{ error }}
    </div>

    <div v-if="!loading && products.length" class="products-grid">
      <div
        v-for="product in products"
        :key="product.id"
        class="product-card"
      >
        <img :src="product.image" :alt="product.title" />
        <h3>{{ product.title }}</h3>
        <p class="price">{{ product.price }} €</p>
        <p class="category">{{ product.category }}</p>
       
        <div class="actions">
          <button @click="editProduct(product.id)" class="btn-edit">
            Modifier
          </button>
          <button @click="deleteItem(product.id)" class="btn-delete">
            Supprimer
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useProductStore } from '@/stores/productStore';

const router = useRouter();
const store = useProductStore();

const products = computed(() => store.products);
const loading = computed(() => store.loading);
const error = computed(() => store.error);

onMounted(() => {
  store.fetchProducts();
});

const goToCreate = () => {
  router.push({ name: 'ProductCreate' });
};

const editProduct = (id) => {
  router.push({ name: 'ProductEdit', params: { id } });
};

const deleteItem = async (id) => {
  if (confirm('Voulez-vous vraiment supprimer ce produit?')) {
    try {
      await store.deleteProduct(id);
    } catch (error) {
      alert('Erreur lors de la suppression');
    }
  }
};
</script>

<style scoped>
.product-list {
  padding: 20px;
  max-width: 1200px;
  margin: 0 auto;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
}

.btn-create {
  background-color: #42b983;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.loading, .error {
  text-align: center;
  padding: 20px;
  font-size: 18px;
}

.error {
  color: red;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 20px;
}

.product-card {
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 15px;
  background: white;
}

.product-card img {
  width: 100%;
  height: 200px;
  object-fit: contain;
  margin-bottom: 10px;
}

.product-card h3 {
  font-size: 16px;
  margin: 10px 0;
  height: 40px;
  overflow: hidden;
}

.price {
  font-size: 20px;
  font-weight: bold;
  color: #42b983;
  margin: 10px 0;
}

.category {
  color: #666;
  font-size: 14px;
  margin-bottom: 15px;
}

.actions {
  display: flex;
  gap: 10px;
}

.btn-edit, .btn-delete {
  flex: 1;
  padding: 8px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn-edit {
  background-color: #4CAF50;
  color: white;
}

.btn-delete {
  background-color: #f44336;
  color: white;
}
</style>
