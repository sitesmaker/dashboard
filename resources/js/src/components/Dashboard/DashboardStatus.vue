<template>
    <div class="dashboard__status">
        <div class="dashboard__status-header">
            <div class="dashboard__status-name">
                {{ statusName }}
            </div>
            <div class="dashboard__status-buttons">
                <button @click.prevent="updateStatus">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </button>

                <button
                    class="button_delete"
                    @click.prevent="fetchDeleteMainTask(id)"
                >
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <button class="button" @click.prevent="showModal = !showModal">
            <span>Создать задачу</span>
            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
        </button>
        <div class="dashboard__list">
            <DashboardItem
                v-for="item in taskList"
                :key="item"
                :id="item.id"
                :status_id="item.status_id"
                :title="item.title"
                :text="item.text"
                @updateTaskList="updateResponseTask"
            />
        </div>
    </div>
    <!-- Модалка для создания Задачи -->
    <ModalCustom
        :showModal="showModal"
        @hideModal="closeModal"
    >
        <input type="text" name="title" placeholder="Название задачи" v-model="title">
        <textarea name="text" placeholder="Описание задачи" v-model="text"></textarea>
        <button @click.prevent="createTask">Создать</button>
    </ModalCustom>
</template>

<script>
import DashboardItem from '@/components/Dashboard/DashboardItem.vue';
import { mapActions } from 'vuex';

export default {
  data() {
    return {
      title: '',
      text: '',
      showModal: false,
      taskList: [],
    }
  },
  components: {
    DashboardItem,
  },
  props: {
    id: {
      type: Number,
    },
    statusName: {
      type: String,
    },
  },
  methods: {
    ...mapActions('Dashboard', ['fetchDeleteMainTask', 'fetchTaskList', 'fetchCreateTask']),
    createTask() {
        this.fetchCreateTask({
            title: this.title,
            text: this.text,
            status_id: this.id,
        }).then((res) => {
            this.updateResponseTask();
            this.title = '';
            this.text = '';
            this.showModal = false;
        })
    },
    async updateResponseTask() {
        this.taskList = await this.fetchTaskList(this.id);
    },
    updateStatus() {
        this.$emit('StatusUpdate', {
            modal: true,
            id: this.id,
        })
    },
    closeModal(event) {
        this.showModal = event;
    },
  },
  created() {
    this.fetchTaskList(this.id);
    this.updateResponseTask();
  }
}
</script>

<style lang="scss">
.dashboard {
    &__status {
        display: flex;
        flex-direction: column;
        width: 400px;
        min-width: 400px;
        margin-right: 20px;
        height: 100%;

        & > button {
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 100%;

            i {
                padding: 3px 0 0 5px;
            }
        }

        input,
        textarea {
            text-align: left;
            padding: 10px;
        }

        &-header {
            display: flex;
            justify-content: space-between;
            background-color: $gold;
        }

        &-buttons {
            padding: 4px;

            button {
                margin-bottom: 4px;

                &:last-child {
                    margin-bottom: 0;
                }
            }
        }

        &-name {
            padding: 20px;
            font-size: 30px;
            line-height: 34px;
            text-transform: uppercase;
            background-color: $gold;
        }
    }

    &__list {
        padding: 20px;
        height: 100%;
        overflow-y: auto;
    }
}
</style>
