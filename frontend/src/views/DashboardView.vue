<script setup>
import AddJobCard from "@/components/AddJobCard.vue";
import JobsAddedCard from "@/components/JobsAddedCard.vue";
</script>

<template>
  <section class="py-4">
    <div class="container-xl lg:container m-auto">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 rounded-lg">
        <AddJobCard />
        <JobsAddedCard />
      </div>
    </div>
  </section>
</template>
  
 
  
  <style scoped>
/* Add any custom styles for the dashboard */
</style>
  