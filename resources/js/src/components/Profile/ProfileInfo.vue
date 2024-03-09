<template>
  <div v-if="!getProfileData">
    Loading ...
  </div>
  <div v-else class="profile__info">
    <form enctype="multipart/form-data" class="upload" @submit.prevent="fetchUpload({'avatar': file, 'id': getProfileData.id})">
      <div class="upload__file">
        <input type="file" name="avatar"  id="avatar" @change="getFile">
        <img :src="getProfileData.avatar ? getPath() : avatarImg">
      </div>
      <input
          type="submit"
          value="Загрузить"
      >
    </form>
    <div class="name">
      {{ getProfileData.fio }}
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import photoCap from '@img/photo-cap.jpg';

export default {
  data() {
    return {
      file: null,
      avatarImg: photoCap,
    }
  },
  methods: {
    ...mapActions('Profile', [
        'fetchProfileData',
        'fetchUpload'
    ]),
    getFile(event) {
      this.file = event.target.files[0];
    },
    getPath() {
      return `${this.$store.state.url}/${this.getProfileData.avatar}`;
    }
  },
  computed: {
    ...mapGetters("Profile", ['getProfileData']),
  },
}
</script>

<style lang="scss">
  .profile__info {
    margin-bottom: auto;

    & > * {
      margin-right: auto;
      margin-left: 0;
    }

    .name {
      font-weight: 700;
    }
  }
</style>
