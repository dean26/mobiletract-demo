<template>
  <div class="q-pa-md">

    <p>{{ store.$state.userData?.fullName }}</p>

    <router-link to="/">
      <q-btn
        class="full-width q-mb-sm"
        :class="{ active: $route.fullPath === '/' }"
        label="Home"
      />
    </router-link>

    <div v-if="store.isLoggedIn">
      <router-link to="/users" v-if="store.isLoggedIn">
        <q-btn
          class="full-width q-mb-sm"
          :class="{ active: $route.fullPath === '/users' }"
          label="Menage users"/>
      </router-link>
      <router-link to="/logout" v-if="store.isLoggedIn">
        <q-btn class="full-width q-mb-sm" label="Logout"/>
      </router-link>
    </div>

    <div v-if="!store.isLoggedIn">
      <router-link to="/login">
        <q-btn
          class="full-width q-mb-sm"
          :class="{ active: $route.fullPath === '/login' }"
          label="Login"
        />
      </router-link>
    </div>

  </div>
</template>

<script>
import {defineComponent} from "vue";
import {useAuthStore} from "src/stores/user";

export default defineComponent({
  name: "SidebarMenu",

  setup() {
    const store = useAuthStore();

    return {
      store,
      user: store.getUser,
    };
  },
});
</script>

<style>
.active {
  color: red;
}
</style>
