<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import Card from "../components/Card.vue";

const jobs = ref([]);
const loading = ref(true);
const errorMessage = ref("");

const getToken = () => {
  const token = localStorage.getItem("token");
  console.log(token);
  if (token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
  }
};

onMounted(async () => {
  getToken();
  try {
    
    const response = await axios.get("http://localhost:8000/api/admin/jobs");
    jobs.value = response.data;
  } catch (error) {
    console.error("Error fetching jobs:", error);
    errorMessage.value = "Failed to load jobs.";
  } finally {
    loading.value = false;
  }
});
</script>

<template>
  <section class="py-4">
    <div class="container-xl lg:container m-auto">
      <h1 class="text-2xl font-bold mb-4">Jobs Posted</h1>

      <div v-if="loading">
        <p>Loading...</p>
      </div>

      <div v-if="errorMessage" class="text-red-500">
        {{ errorMessage }}
      </div>

      <div v-else>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <Card v-for="job in jobs" :key="job.id" bg="bg-gray-100">
            <h2 class="text-xl font-bold">{{ job.title }}</h2>
            <p>{{ job.description }}</p>
            <p class="mt-2"><strong>Salary:</strong> {{ job.salary }}</p>
            <p><strong>Location:</strong> {{ job.location }}</p>
            <RouterLink :to="`/jobs/${job.id}/applicants`" class="text-blue-600"
              >View Applicants</RouterLink
            >
          </Card>
        </div>

        <div v-if="jobs.length === 0" class="text-gray-500">
          No jobs posted by you.
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Add any custom styles for the jobs page */
</style>
