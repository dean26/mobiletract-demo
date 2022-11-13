<template>
  <q-page padding>
    <!-- content -->
  </q-page>
</template>

<script>
import { useAuthStore } from "src/stores/user";

export default {
  mounted() {
    const store = useAuthStore();
    store.logout();
    this.$router.push("/");
  },
};
</script>
