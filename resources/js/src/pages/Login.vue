<template>
    <div class="login">
      <div class="row">
        <form @submit.prevent="Auth">
          <input
              type="email"
              v-model="email"
              name="email"
              placeholder="Email"
          >
          <input
              type="password"
              v-model="password"
              name="password"
              autocomplete="off"
              placeholder="Пароль"
          >
          <div class="form-text">Если у вас ещё нет аккаунта, то его можно <a href="/registration"><span>зарегистрировать</span></a></div>
          <input
              type="submit"
              value="Войти"
          >
        </form>
      </div>
    </div>
</template>

<script>
    import axios  from 'axios';
    import { mapMutations } from 'vuex'

    export default {
        data() {
            return {
                email: '',
                password: '',
            }
        },
        methods: {
          ...mapMutations('Auth', ['SET_ACCESS_TOKEN']),
            Auth() {
                axios.post(`${this.$store.state.url}/api/auth/login`, {
                  email: this.email,
                  password: this.password,
                }).then((res) => {
                  localStorage.setItem('access_token', res.data.access_token);
                  this.SET_ACCESS_TOKEN(res.data.access_token);
                  this.$router.push('profile');
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
  .login {
    height: inherit;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
</style>