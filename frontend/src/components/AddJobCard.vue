<script setup>
  import Card from "./Card.vue";
  import { RouterLink } from "vue-router";
  </script>

<template>
    <Card bg="bg-blue-100">
      <h2 class="text-2xl font-bold">Add Job</h2>
      <p class="mt-2 mb-4">
        List your job opportunity and find the perfect candidate in no time!
      </p>
      <RouterLink
        class="inline-block bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700"
        to="/jobs/add"
      >
        Add Job
      </RouterLink>
    </Card>
  </template>
  
  
  