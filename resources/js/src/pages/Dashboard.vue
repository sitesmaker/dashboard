<template>
    <div class="dashboard">
        <div class="dashboard__header">
        <button @click.prevent="showModal = !showModal">Создать статус</button>
        </div>
        <div class="dashboard__main">
            <DashboardStatus
                v-for="item in getStatusList"
                :key="item.id"
                :statusName="item.title"
                :id="item.id"
                @StatusUpdate="update"
            />
        </div>
    </div>
    <!-- Модалка для создания Статуса -->
    <ModalCustom
        :showModal="showModal"
        @hideModal="closeModal"
    >
        <input v-model="statusName">
        <button @click.prevent="addStatus">Создать</button>
    </ModalCustom>
    <!-- Модалка для редактирования Статуса -->
    <ModalCustom
        :showModal="modalUpdate"
        @hideModal="closeModalUpdate"
    >
        <input :value="updateStatusName" @input="updateStatusName = $event.target.value">
        <button @click.prevent="updateStatus">Обновить</button>
    </ModalCustom>
</template>

<script>
import DashboardStatus from '@/components/Dashboard/DashboardStatus.vue';
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
  data() {
    return {
      statusName: '',
      showModal: false,
      modalUpdate: false,
      updateStatusName: '',
      objectUpdateStatus: null,
    }
  },
  components: {
    DashboardStatus
  },
  methods: {
    ...mapMutations('Dashboard', ['PUSH_STATUS']),
    ...mapActions('Dashboard', ['fetchCreateMainTask', 'fetchUpdateMainTask']),
    addStatus() {
        let doubleName = false;

        if(!this.getStatusList.length) {

            if(this.statusName.length) {
                this.fetchCreateMainTask(this.statusName);
            }
        } else {
            this.getStatusList.forEach((el) => {
                if(el.title === this.statusName) {
                    doubleName = true;
                }
            })

            if(!doubleName && this.statusName.length) {
                this.fetchCreateMainTask(this.statusName);
            }
        }

        this.showModal = false;
    },
    updateStatus() {
        this.fetchUpdateMainTask({
            'id': this.objectUpdateStatus.id,
            'title': this.updateStatusName,
        });

        this.modalUpdate = false;
    },
    update(event) {
        const status = this.getStatusList.filter(el => el.id === event.id)[0];
        this.objectUpdateStatus = status;
        this.updateStatusName = this.objectUpdateStatus.title;
        this.modalUpdate = event.modal;
    },
    closeModal(event) {
        this.showModal = event;
    },
    closeModalUpdate(event) {
        this.modalUpdate = event;
    }
  },
  computed: {
    ...mapGetters('Dashboard', ['getStatusList']),
    ...mapActions('Dashboard', ['fetchMainTaskList']),
  },
  mounted() {
    this.fetchMainTaskList;
  }
}
</script>

<style lang="scss" scoped>
.dashboard {
    margin-bottom: auto;
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow-x: auto;
    overflow-y: hidden;

    &__header {
        margin-bottom: 20px;
    }

    &__main {
        display: flex;
        align-items: flex-start;
        overflow-x: auto;
        overflow-y: hidden;
        width: 100%;
        height: 100%;
    }
}
</style>
