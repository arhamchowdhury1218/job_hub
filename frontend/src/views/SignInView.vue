<script setup>
import { reactive, ref } from "vue";
import axios from "axios";  // Use regular axios for now
import { useToast } from "vue-toastification";
import { useRouter } from 'vue-router';
import { useAuthStore } from '../stores/auth';

const form = reactive({
    username: "",
    password: "",
});

const errors = reactive({});
const toast = useToast();
const loading = ref(false);
const router = useRouter();
const authStore = useAuthStore();

// Configure axios defaults
axios.defaults.baseURL = 'http://localhost:8000';
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.headers.common['Content-Type'] = 'application/json';
axios.defaults.withCredentials = true;

const handleSubmit = async () => {
    errors.username = "";
    errors.password = "";
    loading.value = true;

    try {
        // First, get CSRF cookie
        await axios.get('/sanctum/csrf-cookie');
        console.log('Logging in with credentials:', form); // Debugging
        
        // Attempt login
        const response = await axios.post("/api/login", form);
        console.log('Login response:', response.data.access_token);  // Update to access_token
        
        if (response.data.access_token) {  // Check for access_token
            authStore.setToken(response.data.access_token);  // Set the token
            toast.success("Sign In Successful");
            router.push({ name: 'dashboard' });
        } else {
            throw new Error('No token received');
        }
    } catch (error) {
        console.error('Login error details:', error.response || error);  // Enhanced error logging
        loading.value = false;
        if (error.response?.status === 401) {
            toast.error("Invalid credentials");
        } else {
            toast.error("An error occurred during sign in.");  // Update to reflect a generic error
        }
    } finally {
        loading.value = false;
    }
};

</script>
<template>
  <section class="bg-green-50">
    <div class="container m-auto max-w-2xl py-24">
      <div class="bg-white px-6 py-8 mb-4 shadow-md rounded-md border m-4 md:m-0">
        <form @submit.prevent="handleSubmit">
          <h2 class="text-3xl text-center font-semibold mb-6">Sign In</h2>

          <!-- Username Input -->
          <div class="mb-4">
            <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
            <input
              type="text"
              v-model="form.username"
              id="username"
              name="username"
              class="border rounded w-full py-2 px-3 mb-2"
              required
              aria-describedby="usernameError"
              :class="{ 'border-red-500': errors.username }"
            />
            <p v-if="errors.username" class="text-red-500 text-sm" id="usernameError">
              {{ errors.username }}
            </p>
          </div>

          <!-- Password Input -->
          <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
            <input
              type="password"
              v-model="form.password"
              id="password"
              name="password"
              class="border rounded w-full py-2 px-3 mb-2"
              required
              aria-describedby="passwordError"
              :class="{ 'border-red-500': errors.password }"
            />
            <p v-if="errors.password" class="text-red-500 text-sm" id="passwordError">
              {{ errors.password }}
            </p>
          </div>

          <!-- Submit Button -->
          <div>
            <button
              class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full w-full focus:outline-none focus:shadow-outline"
              type="submit"
              :disabled="loading"
            >
              <span v-if="loading">Signing In...</span>
              <span v-else>Sign In</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* You can add some custom styles here if needed */
</style>
