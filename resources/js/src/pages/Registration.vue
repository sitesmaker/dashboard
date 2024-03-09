<template>
    <div class="registration">
      <div class="row">
        <form @submit.prevent="Registration">
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
          <div class="form-text">Если у вас уже есть аккаунт - <a href="/login"><span>войти</span></a></div>
          <input
              type="submit"
              value="Зарегистрироваться"
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
            async Registration() {
                await axios.post(`${this.$store.state.url}/api/registration`, {
                  email: this.email,
                  password: this.password,
                });
            }
        }
    }
</script>

<style lang="scss" scoped>
  .registration {
    height: inherit;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
</style>
