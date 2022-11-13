import {defineStore} from 'pinia';
import {api} from 'boot/axios'
import {Cookies} from 'quasar'

const BACKEND_URL = process.env.BACKEND_URL
const LOGIN_ROUTE = '/api/auth/login'
const LOGOUT_ROUTE = '/api/auth/logout'
const USERS_INDEX_URL = '/api/users'

export const useAuthStore = defineStore('user', {
  state: () => ({
    userData: localStorage.getItem('userData') || null,
    token: localStorage.getItem('token') || null,
    usersData: []
  }),

  getters: {
    getUserData(state) {
      return state.userData
    },
    isLoggedIn(state) {
      return state.userData !== null
    },
    getUsers(state) {
      return state.users
    },
  },

  actions: {

    async login(data) {
      return await api.post(LOGIN_ROUTE, data)
        .then(response => {
          const token = response.data.token
          api.defaults.headers.common['Authorization'] = 'Bearer ' + token
          localStorage.setItem('token', token);

          const userData = response.data.user;
          this.userData = userData;
          localStorage.setItem('userData', userData);
        });
    },

    async logout() {
      await api.post(LOGOUT_ROUTE);

      delete api.defaults.headers.common["Authorization"];
      this.userData = null;
      localStorage.removeItem('token');
      localStorage.removeItem('userData');
    },

    async users() {
      await api.get(USERS_INDEX_URL)
        .then(response => {
          this.usersData = response.data.data;
        });
    }

  }
})
