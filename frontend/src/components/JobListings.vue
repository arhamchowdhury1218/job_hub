<script setup>
import { ref, defineProps, onMounted } from "vue";
import { RouterLink } from "vue-router";
import axios from "axios";
import PulseLoader from "vue-spinner/src/PulseLoader.vue";

defineProps({
  limit: Number,
  showButton: {
    type: Boolean,
    default: false,
  },
});
import JobListing from "./JobListing.vue";
const jobs = ref([]);
console.log(jobs.value);

const loading = ref(true); // Initialize loading state to true

// Fetch job details on component mount
onMounted(async () => {
  try {
    const response = await axios.get(`http://localhost:8000/api/jobs`);
    console.log(response.data);
    jobs.value = response.data; // Store job data
    loading.value = false; // Set loading to false when done
  } catch (error) {
    console.error("Error fetching job details:", error);
  }
});
</script>

<template>
  <div>
    <section class="bg-blue-50 px-4 py-10 mx-3 rounded-lg">
      <div class="container-xl lg:container m-auto">
        <h2 class="text-3xl font-bold text-green-500 mb-6 text-center">
          Browse Jobs
        </h2>

        <!-- Show loading spinner while loading is true -->

        <div v-if="loading" class="text-center text-gray-500 py-6">
          <PulseLoader/>
        </div>
        <!-- Show job listing when done loading -->
        <div v-else class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <JobListing
            v-for="job in jobs.slice(0, limit || jobs.length)"
            :key="job.id"
            :jobList="job"
          >
          </JobListing>
        </div>
      </div>
    </section>

    <section v-if="showButton" class="m-auto max-w-lg my-10 px-6">
      <router-link
        to="/jobs"
        class="block bg-black text-white text-center py-4 px-6 rounded-xl hover:bg-gray-700"
        >View All Jobs</router-link
      >
    </section>
  </div>
</template>