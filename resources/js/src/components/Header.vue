<template>
    <header>
        <div class="row">
            <nav>
                <router-link v-if="getAccessToken" to="/profile" class="link"><span>Профиль</span></router-link>
                <a href="#" v-if="getAccessToken" @click.prevent="logout" class="link">Выйти</a>
                <router-link v-if="!getAccessToken" to="login" class="link">Войти</router-link>
            </nav>
        </div>
    </header>
</template>

<script>
import axios           from 'axios';
import store           from '@/store/index.js';
import { mapGetters, mapMutations }  from 'vuex';

export default {
  methods: {
    ...mapMutations('Auth', ['DELETE_ACCESS_TOKEN']),
    logout() {
        localStorage.removeItem('access_token');
        this.DELETE_ACCESS_TOKEN();
        this.$router.push('/login');
    },
  },
  computed: {
    ...mapGetters('Auth', ['getAccessToken']),
  },
  mounted() {
    axios.post(`${store.state.url}/api/auth/me`, null, {
      headers: { Authorization: `Bearer ${localStorage.getItem('access_token')}`}
    }).catch((err) => {
      localStorage.removeItem('access_token');
    })
  }
}
</script>

<style lang="scss">

header {
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  z-index: 10;
  background-color: $yellow;
  height: $header-h;
  display: flex;
  align-items: center;

  nav {
    display: flex;
    justify-content: flex-end;
  }

  .link {
    font-weight: 700;
    padding: 10px;
  }
}
</style>
