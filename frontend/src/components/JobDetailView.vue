
<template>
    <div v-if="job">
        <h1>{{ job.title }}</h1>
        <p>{{ job.description }}</p>
        <p>Salary: {{ job.salary }} / Year</p>
        <p>Location: {{ job.location }}</p>
    </div>
    <div v-else>
        <p>Loading...</p>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

const job = ref(null);
const route = useRoute();

onMounted(async () => {
    try {
        const response = await axios.get(`http://localhost:8000/api/jobs/${route.params.id}`);
        job.value = response.data;
    } catch (error) {
        console.error('Error fetching job details:', error);
    }
});
</script>
