<template>
    <transition name="modal-animation" >
        <div v-show="modalActive" :class="{
            'bg-white bg-opacity-0 fixed inset-y-0 inset-x-0 m-auto flex items-center justify-center' : type == 'secondary',
            'bg-[#000000] bg-opacity-10 fixed inset-y-0 inset-x-0 m-auto flex items-center justify-center' : type == 'primary'
        }">
            <slot />

        </div>
    </transition>
</template>

<script>
    import { onClickOutside } from '@vueuse/core'
    import { ref } from 'vue'
    export default {

        props: ['modalActive', 'target', 'class', 'type'],

        setup(props, {emit}) {
            const target = ref(null)
            const closeModal = () => {
                emit('closeModal')
            }
            onClickOutside(target, closeModal)
            return {closeModal, target}
        }
    }
</script>

<style lang="scss" scoped>
.modal-animation-enter-active, 
.modal-animation-leave-active{
    transition: opacity .3s cubic-bezier(0.52, 0.02, 0.19, 1.02);
}
.modal-animation-enter-from,
.modal-animation-leave-to{
    opacity: 0;
}
.modal{
    background-color: rgba(255, 255, 255, 0.2);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 0px 20px 0px;
}

</style>