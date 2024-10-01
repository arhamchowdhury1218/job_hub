<script setup>
import Hero from "../components/Hero.vue";
import HomeCards from "../components/HomeCards.vue";
import JobListings from "../components/JobListings.vue";
</script>

<template>
  <div>
    <Hero title="Welcome" subTitle="To JobHub"></Hero>
    <HomeCards></HomeCards>
    <JobListings :limit="3" :showButton="true"></JobListings>
  </div>
</template>