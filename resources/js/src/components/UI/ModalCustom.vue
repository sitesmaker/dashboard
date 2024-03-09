<template>
    <div class="modal" v-if="showModal" @click="hideModal">
        <div class="modal__content" @click.stop>
            <div class="button-close" @click.prevent="hideModal"></div>
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ModalCustom',
    props: {
        showModal:{
            type: Boolean,
            required: true,
            default: false,
        }
    },
    methods: {
        hideModal() {
            this.$emit('hideModal', false);
        }
    }
}
</script>

<style lang="scss">
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba($black, .7);
    z-index: 100;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal__content {
    position: relative;
    background-color: $white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    max-width: 600px;
    min-height: 100px;
    padding: 40px;
    border-radius: 10px;

    .button-close {
        position: absolute;
        top: 0;
        right: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 25px;
        height: 25px;
        cursor: pointer;


        &::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
            background-image: url(@img/icons/close-black.svg);
            background-repeat: no-repeat;
            background-size: contain;
        }
    }
}
</style>
