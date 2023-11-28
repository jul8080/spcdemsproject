<template>
    <transition name="modal-animation" >
        <div v-show="modalActive" class="modal">
            <transition name="moda-animation-inner"> 
                <div v-show="modalActive" class="modal-inner" >
                    <!-- Modal content -->
                    <slot />
                    <!-- <button @click="closeModal">Close</button> -->
                </div>
            </transition>
        </div>
    </transition>
</template>

<script>
    import { onClickOutside } from '@vueuse/core'
    import { ref, onMounted, onUnmounted } from 'vue'
    export default {
        props: ['modalActive', 'target'],
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
.moda-animation-inner-enter-active {
    transition: all .3s cubic-bezier(0.52, 0.02, 0.19, 1.02) 0.15s;
}
.moda-animation-inner-leave-active {
    transition: all .3s cubic-bezier(0.52, 0.02, 0.19, 1.02);
}
.moda-animation-inner-enter-from {
    opacity: 0;
    transform: scale(0.8);
}
.moda-animation-inner-leave-to {
    transform: scale(0.8);
}
.modal{
    background-color: rgba(0, 0, 0, 0.5);
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
.modal-inner {
    background-color: white;
    width: 700px;
    height: 100%;
}
</style>