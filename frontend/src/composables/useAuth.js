import { ref } from 'vue';

const isAuthenticated = ref(false);

const login = () => {
  isAuthenticated.value = true;
};

const logout = () => {
  isAuthenticated.value = false;
};

export const useAuth = () => {
  return {
    isAuthenticated,
    login,
    logout,
  };
};
