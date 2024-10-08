<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import PulseLoader from "vue-spinner/src/PulseLoader.vue";
import JobListing from "@/components/JobListing.vue";
const jobs = ref([]);
const loading = ref(true);
const errorMessage = ref(""); // Initialize error message state

onMounted(async () => {
  console.log("refresh");
  try {
    console.log("2");
    const response = await axios.get(`http://localhost:8000/api/jobsbyuser`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
      },
    });
    console.log(response.data);
    jobs.value = response.data.jobs; // Store job data
    loading.value = false; // Set loading to false when done
  } catch (error) {
    console.error("Error fetching job details:", error);
    errorMessage.value = "Failed to fetch job details. Please try again later."; // Set error message
    loading.value = false;
  }
});
</script>

<template>
  <div>
    <section class="bg-blue-50 px-4 py-10 mx-3 rounded-lg">
      <div class="container-xl lg:container m-auto">
        <h2 class="text-3xl font-bold text-green-500 mb-6 text-center">
          Your Job Listings
        </h2>

        <div v-if="loading" class="text-center text-gray-500 py-6">
          <PulseLoader></PulseLoader>
        </div>

        <div v-else-if="errorMessage" class="text-center text-red-500 py-6">
          {{ errorMessage }}
        </div>

        <div
          v-else-if="jobs.length === 0"
          class="text-center text-gray-500 py-6"
        >
          No job postings available.
        </div>

        <!-- <div v-else class="grid grid-cols-1 md:grid-cols-3 gap-6">
           <JobListing
             v-for="job in jobs"
             :key="job.id"
             :jobList="job"
           />
        </div> -->

        <div v-else class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div
            v-for="job in jobs"
            :key="job.id"
            class="bg-white p-4 rounded shadow"
          >
            <h3 class="text-xl font-bold">{{ job.title }}</h3>
            <p><strong>Type:</strong> {{ job.type }}</p>
            <p><strong>Description:</strong> {{ job.description }}</p>
            <p><strong>Salary:</strong> {{ job.salary }}</p>
            <p><strong>Location:</strong> {{ job.location }}</p>
            <p><strong>Company:</strong> {{ job.company_name }}</p>
            <p><strong>Contact Email:</strong> {{ job.contact_email }}</p>
            <p><strong>Contact Phone:</strong> {{ job.contact_phone }}</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
