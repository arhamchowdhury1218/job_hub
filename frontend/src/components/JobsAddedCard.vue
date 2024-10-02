<script setup>
import Card from "./Card.vue";
import { RouterLink } from "vue-router";
</script>

<template>
  <Card bg="bg-yellow-100">
    <h2 class="text-2xl font-bold">Jobs Added</h2>
    <p class="mt-2 mb-4">
      View the list of jobs you've added and manage them easily.
    </p>
    <RouterLink
      class="inline-block bg-yellow-600 text-white rounded-lg px-4 py-2 hover:bg-yellow-700"
      to="/jobs/added"
    >
      Jobs Added
    </RouterLink>
  </Card>
</template>
  
 
  