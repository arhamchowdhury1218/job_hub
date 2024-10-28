<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import axios from "axios";

const route = useRoute();
const jobId = route.params.id;
const form = ref({
  name: "",
  email: "",
  phone: "",
  
});
const jobTitle = ref("");

onMounted(async () => {
  try {
    const response = await axios.get(`http://localhost:8000/api/jobs/${jobId}`);
    jobTitle.value = response.data.title;
  } catch (error) {
    console.error("Error fetching job details:", error);
  }
});

const submitApplication = async () => {
  try {
    await axios.post(
      `http://localhost:8000/api/jobs/apply/${jobId}`,
      form.value
    );
    alert("Application submitted successfully!");
    form.value = {
      name: "",
      email: "",
      phone: "",
      
    };
  } catch (error) {
    console.error("Error submitting application:", error);
    alert("There was an error submitting your application.");
  }
};
</script>



<template>
  <div class="apply-job-container">
    <h1 class="text-2xl font-bold mb-6">Apply for {{ jobTitle }}</h1>
    <form
      @submit.prevent="submitApplication"
      class="bg-white p-6 rounded-lg shadow-md"
    >
      <div class="mb-4">
        <label for="name" class="block text-sm font-bold mb-2">Name:</label>
        <input
          type="text"
          id="name"
          v-model="form.name"
          required
          class="border rounded w-full py-2 px-3"
        />
      </div>
      <div class="mb-4">
        <label for="email" class="block text-sm font-bold mb-2">Email:</label>
        <input
          type="email"
          id="email"
          v-model="form.email"
          required
          class="border rounded w-full py-2 px-3"
        />
      </div>
      <div class="mb-4">
        <label for="phone" class="block text-sm font-bold mb-2">Phone:</label>
        <input
          type="tel"
          id="phone"
          v-model="form.phone"
          required
          class="border rounded w-full py-2 px-3"
        />
      </div>
     
      <button
        type="submit"
        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
      >
        Submit Application
      </button>
    </form>
  </div>
</template>


<style scoped>
.apply-job-container {
  max-width: 600px;
  margin: auto;
  padding: 20px;
}
</style>
