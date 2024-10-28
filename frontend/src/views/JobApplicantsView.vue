<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';

const applicants = ref([]);
const loading = ref(true);
const errorMessage = ref('');
const route = useRoute();
const jobId = route.params.id;

onMounted(async () => {
    try {
        const response = await axios.get(`http://localhost:8000/api/jobs/${jobId}/applicants`);
        applicants.value = response.data; 
    } catch (error) {
        console.error('Error fetching applicants:', error);
        errorMessage.value = 'Failed to load applicants.';
    } finally {
        loading.value = false;
    }
});
</script>

<template>
  <section class="py-4">
    <div class="container-xl lg:container m-auto">
      <!-- <h1 class="text-2xl font-bold mb-4">Applicants for Job ID: {{ jobId }}</h1> -->

      <div v-if="loading">
        <p>Loading...</p>
      </div>

      <div v-if="errorMessage" class="text-red-500">
        {{ errorMessage }}
      </div>

      <div v-else>
        <ul>
          <li v-for="applicant in applicants" :key="applicant.id" class="border p-4 mb-2">
            <h2 class="font-bold">{{ applicant.name }}</h2>
            <p><strong>Email:</strong> {{ applicant.email }}</p>
            <p><strong>Phone:</strong> {{ applicant.phone }}</p>
            
          </li>
          <li v-if="applicants.length === 0" class="text-gray-500">
            No applicants for this job.
          </li>
        </ul>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Add any custom styles for the applicants page */
</style>
