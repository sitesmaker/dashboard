<template>
  <ul class="nav nav-tabs profile__navigation">
    <li class="nav-item nav-item_active">
      <a
          href="#ProfileInfo"
          class="link nav-link"
          @click.prevent="setActiveTab"
      >
        <span>Профиль</span>
      </a>
    </li>
    <li class="nav-item">
      <a
          href="#Dashboard"
          class="link nav-link"
          @click.prevent="setActiveTab"
      >
        <span>Доска</span>
      </a>
    </li>
  </ul>
</template>

<script>
  export default {
    data() {
      return {
        activeTab: 'profile',
      }
    },
    methods: {
      setActiveTab(event) {
        let self = event.currentTarget,
            list = self.closest('.nav'),
            listElement = self.closest('.nav-item'),
            href = self.getAttribute("href");

        list.querySelectorAll('.nav-item').forEach(el => {
          el.classList.remove('nav-item_active');
        })

        listElement.classList.add('nav-item_active');

        this.$emit('changeTab', href);
      }
    }
  }
</script>

<style lang="scss" scoped>

.nav-item {
  position: relative;

  &::before {
    content: '';
    width: 0;
    height: 100%;
    position: absolute;
    top:0;
    left: 0;
    background-color: $black;
    z-index: -1;
    transition: all ease-in-out .4s;
  }

  .link {
    display: block;
    width: 100%;
    padding: 10px;
  }

  &_active {
    width: 100%;

    &::before {
      width: 100%;
      transition: all ease-in-out .4s;
    }

    .link {
      color: $gold;
    }
  }
}

.profile__navigation {
  max-width: 220px;
  min-width: 220px;
  width: 100%;
  height: 100%;
  border: 1px solid $black;
}
</style>