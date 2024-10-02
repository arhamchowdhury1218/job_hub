<script setup>
import { reactive, ref } from "vue";
import axios from "axios";
import { useToast } from "vue-toastification";

const form = reactive({
  username: "",
  email: "",
  password: "",
});

const errors = reactive({});
const toast = useToast();
const loading = ref(false);

const handleSubmit = async () => {
  errors.username = "";
  errors.email = "";
  errors.password = "";
  loading.value = true;

  try {
    const response = await axios.post("http://localhost:8000/api/signup", form);
    console.log(response.data);
    toast.success("Sign Up Successful");
    resetForm();
  } catch (error) {
    loading.value = false;
    if (error.response && error.response.status === 422) {
      // Assuming your server returns validation errors
      Object.assign(errors, error.response.data);
    } else {
      toast.error("Sign Up Failed");
    }
  } finally {
    loading.value = false;
  }
};

const resetForm = () => {
  form.username = "";
  form.email = "";
  form.password = "";
};
</script>


<template>
  <section class="bg-green-50">
    <div class="container m-auto max-w-2xl py-24">
      <div
        class="bg-white px-6 py-8 mb-4 shadow-md rounded-md border m-4 md:m-0"
      >
        <form @submit.prevent="handleSubmit">
          <h2 class="text-3xl text-center font-semibold mb-6">Sign Up</h2>

          <!-- Username Input -->
          <div class="mb-4">
            <label for="username" class="block text-gray-700 font-bold mb-2"
              >Username</label
            >
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
            <p
              v-if="errors.username"
              class="text-red-500 text-sm"
              id="usernameError"
            >
              {{ errors.username }}
            </p>
          </div>

          <!-- Email Input -->
          <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2"
              >Email</label
            >
            <input
              type="email"
              v-model="form.email"
              id="email"
              name="email"
              class="border rounded w-full py-2 px-3 mb-2"
              required
              aria-describedby="emailError"
              :class="{ 'border-red-500': errors.email }"
            />
            <p v-if="errors.email" class="text-red-500 text-sm" id="emailError">
              {{ errors.email }}
            </p>
          </div>

          <!-- Password Input -->
          <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2"
              >Password</label
            >
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
            <p
              v-if="errors.password"
              class="text-red-500 text-sm"
              id="passwordError"
            >
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
              <span v-if="loading">Signing Up...</span>
              <span v-else>Sign Up</span>
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
