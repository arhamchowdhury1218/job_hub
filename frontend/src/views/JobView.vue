<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import axios from "axios";
import BackButton from "@/components/BackButton.vue";

const job = ref(null);
const route = useRoute();
const router = useRouter();
const jobId = route.params.id;

onMounted(async () => {
  try {
    const response = await axios.get(
      `http://localhost:8000/api/jobs/${route.params.id}`
    );
    // console.log(response.data);
    job.value = response.data;
    console.log("Job Value:", job.value);
  } catch (error) {
    console.error("Error fetching job details:", error);
  }
});

// Delete function
const deleteJob = async () => {
  const confirmDelete = confirm("Are you sure you want to delete this job?");

  if (confirmDelete) {
    try {
      await axios.delete(`http://localhost:8000/api/jobs/${route.params.id}`);
      alert("Job deleted successfully!");
      // Redirect to the Jobs page
      router.push("/jobs"); // Redirect after deletion
    } catch (error) {
      console.error("Error deleting job:", error);
      alert("There was an error deleting the job.");
    }
  }
};
</script>
<template>
  <div>
    <BackButton></BackButton>
    <section class="bg-green-50">
      <div class="container m-auto py-10 px-6">
        <div class="grid grid-cols-1 md:grid-cols-70/30 w-full gap-6">
          <main>
            <div
              class="bg-white p-6 rounded-lg shadow-md text-center md:text-left"
            >
              <div class="text-gray-500 mb-4">{{ job?.type }}</div>
              <h1 class="text-3xl font-bold mb-4">{{ job?.title }}</h1>
              <div
                class="text-gray-500 mb-4 flex align-middle justify-center md:justify-start"
              >
                <div class="flex items-center">
                  <i class="pi pi-map-marker mr-3 text-blue-500"></i>
                  <!-- Changed to location icon -->
                  <p class="text-orange-700">{{ job?.location }}</p>
                </div>
              </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md mt-6">
              <h3 class="text-green-800 text-lg font-bold mb-6">
                Job Description
              </h3>
              <p class="mb-4">{{ job?.description }}</p>
              <h3 class="text-green-800 text-lg font-bold mb-2">Salary</h3>
              <p class="mb-4">{{ job?.salary }}</p>
            </div>
          </main>

          <aside>
            <!-- Company Info -->
            <div class="bg-white p-6 rounded-lg shadow-md">
              <h3 class="text-xl font-bold mb-6">Company Info</h3>
              <h2 class="text-2xl">{{ job?.companyName }}</h2>
              <p class="my-2">{{ job?.companyDescription }}</p>
              <hr class="my-4" />
              <h3 class="text-xl">Contact Email:</h3>
              <p class="my-2 bg-green-100 p-2 font-bold">
                {{ job?.contactEmail }}
              </p>
              <h3 class="text-xl">Contact Phone:</h3>
              <p class="my-2 bg-green-100 p-2 font-bold">
                {{ job?.contactPhone }}
              </p>
            </div>

            <!-- Manage -->
            <div class="bg-white p-6 rounded-lg shadow-md mt-6">
              <h3 class="text-xl font-bold mb-6">Manage Job</h3>

              <RouterLink
                v-if="job"
                :to="`/jobs/edit/${jobId}`"
                class="bg-green-500 hover:bg-green-600 text-white text-center font-bold py-2 px-4 rounded-full w-full focus:outline-none focus:shadow-outline mt-4 block"
              >
                Edit Job
              </RouterLink>

              <button
                @click="deleteJob"
                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full w-full focus:outline-none focus:shadow-outline mt-4 block"
              >
                Delete Job
              </button>
            </div>
          </aside>
        </div>
      </div>
    </section>
  </div>
</template>
<style scoped>
/* Add any styles here */
</style>
