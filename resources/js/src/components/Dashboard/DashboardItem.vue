<template>
    <div class="dashboard__list-item">
        <div class="title">{{ title }}</div>
        <div class="description">{{ text }}</div>

        <div class="dashboard__buttons">
            <button @click.prevent="showModal = true">
                <i class="fa fa-pencil" aria-hidden="true"></i>
            </button>

            <button
                class="button_delete"
                @click.prevent="deleteTask"
            >
                <i class="fa fa-trash-o" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <!-- Модалка для именения Задачи -->
    <ModalCustom
        :showModal="showModal"
        @hideModal="closeModal"
    >
        <input type="text" name="title" placeholder="Название задачи" :value="title" @input="updateTitle = $event.target.value">
        <textarea name="text" placeholder="Описание задачи" :value="text" @input="updateText = $event.target.value"></textarea>
        <button @click.prevent="updateTask">Обновить</button>
    </ModalCustom>
</template>

<script>
import { mapActions } from 'vuex'
export default {
    data(){
        return {
            showModal: false,
            updateTitle: this.title,
            updateText: this.text,
        }
    },
    props: {
        id: {
            type: Number,
        },
        status_id: {
            type: Number,
        },
        title: {
            type: String,
        },
        text: {
            type: String,
        }
    },
    methods: {
        ...mapActions('Dashboard', ['fetchDeleteTask', 'fetchUpdateTask', 'fetchTaskList']),
        deleteTask() {
            this.fetchDeleteTask(this.id).then((res) => {
                this.$emit('updateTaskList');
            })
        },
        updateTask(){
            this.fetchUpdateTask({
                id: this.id,
                title: this.updateTitle,
                text: this.updateText
            }).then((res) => {
                this.$emit('updateTaskList');
            })
        },
        closeModal() {
            this.showModal = false;
        }
    }
}
</script>

<style lang="scss">
.dashboard__list-item {
    margin-bottom: 20px;
    background-color: $white;
    padding: 20px;

    .title {
        font-size: 24px;
        line-height: 28px;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .description {
        font-size: 20px;
        line-height: 24px;
        margin-bottom: 10px;
    }

    .dashboard__buttons {
        display: flex;
        justify-content: flex-end;

        & > * {
            width: 50px;

            &:not(:last-child) {
                margin-right: 10px;
            }
        }
    }
}
</style>
