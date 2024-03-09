<template>
  <div class="row">
    <div class="profile">
      <ProfileNav @change-tab="getActiveTab" />
      <component :is="currentTabComponent" class="profile__content"></component>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import ProfileNav   from '@/components/Profile/ProfileNav.vue';
import ProfileInfo from '@/components/Profile/ProfileInfo.vue';
import Dashboard   from '@/pages/Dashboard.vue';

export default {
  data() {
    return {
      currentTabComponent: 'ProfileInfo',
    }
  },
  components: {
    ProfileNav,
    ProfileInfo,
    Dashboard,
  },
  methods: {
    ...mapActions("Profile", ['fetchUserData', 'fetchUpload']),
    getActiveTab(tab) {
      tab = tab.replace('#', '');
      this.currentTabComponent = tab;
    }
  },
  mounted() {
    this.fetchUserData();
  },
}
</script>

<style lang="scss" scoped>

.profile {
  display: flex;
  align-items: center;
  height: calc(100vh - $header-h);
  padding-top: 50px;
  padding-bottom: 50px;

  &__content {
    padding-left: 50px;
    width: 100%;
  }
}
</style>