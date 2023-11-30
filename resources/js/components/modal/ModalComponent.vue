<template>
    <transition name="modal-animation" >
        <div v-show="modalActive" :class="{
            'bg-white bg-opacity-0 fixed inset-y-0 inset-x-0 m-auto flex items-center justify-center' : type == 'secondary',
            'bg-[#000000] bg-opacity-50 fixed inset-y-0 inset-x-0 m-auto flex items-center justify-center' : type == 'primary'
        }">
            <slot />
            <!-- <transition name="moda-animation-inner"> 
                <div v-show="modalActive" class="modal-inner" >
                </div>
            </transition> -->
        </div>
    </transition>
</template>

<script>
    import { onClickOutside } from '@vueuse/core'
    import { ref, onMounted, onUnmounted } from 'vue'
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
        // methods: {
        //     closeModal() {
        //         this.$emit('closeModal')
        //     }
        // }
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
// .moda-animation-inner-enter-active {
//     transition: all .3s cubic-bezier(0.52, 0.02, 0.19, 1.02) 0.15s;
// }
// .moda-animation-inner-leave-active {
//     transition: all .3s cubic-bezier(0.52, 0.02, 0.19, 1.02);
// }
// .moda-animation-inner-enter-from {
//     opacity: 0;
//     transform: scale(0.8);
// }
// .moda-animation-inner-leave-to {
//     transform: scale(0.8);
// }
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