<template>
  <q-page class="flex flex-center">
    <q-field
      :error="v$.form.email.$error"
      helper="Enter your registered email address to Log in"
      icon="mail"
      label="Email"
      label-width="3"
      @blur="v$.form.email.$touch"
      class="q-mr-sm"
    >
      <q-input v-model="form.email" type="email"/>
      <template v-slot:error>
        Please type a valid email address
      </template>
    </q-field>

    <q-field
      :error="v$.form.password.$error"
      helper="Enter your password"
      icon="vpn_key"
      label="Password"
      label-width="3"
      class="q-mr-sm"
    >
      <q-input v-model="form.password" type="password"/>
      <template v-slot:error>
        Please type a valid password
      </template>
    </q-field>

    <div>
      <q-btn :loading="loading" color="primary" label="Login" @click="submit"/>
    </div>
  </q-page>

  <q-dialog v-model="dialog">
    <q-card style="width: 300px">
      <q-card-section>
        <p v-html="dialog_info"></p>
      </q-card-section>

      <q-card-actions align="right" class="bg-white text-teal">
        <q-btn v-close-popup flat label="OK"/>
      </q-card-actions>
    </q-card>
  </q-dialog>

</template>

<script>
import {useAuthStore} from "src/stores/user";
import {useVuelidate} from "@vuelidate/core";
import {email, required} from "@vuelidate/validators";

export default {
  setup() {
    return {
      v$: useVuelidate(),
    };
  },

  data() {
    return {
      form: {
        email: "l.przezdziek@gmail.com",
        password: "password",
      },
      loading: false,
      dialog: false,
      dialog_info: '',
    };
  },

  validations: {
    form: {
      email: {required, email},
      password: {required},
    },
  },

  methods: {
    async submit() {
      this.v$.form.$touch();
      this.loading = true;

      const isValidData = await this.v$.$validate()

      if (!isValidData) {
        this.$q.notify("Please review fields again.");
      } else {
        const store = useAuthStore();
        store.login(this.form).then(() => {
          this.$router.push("/");
        }).catch(error => {
          this.dialog = true;
          this.dialog_info = error.toString();
        });
      }

      this.loading = false;
    },
  }
};
</script>
