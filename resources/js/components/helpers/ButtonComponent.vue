<template>
    <div class="flex gap-2 h-full bg-white items-center px-5">
        <button 
        @click="prevPage" :disabled="page === 1" 
        class="flex items-center justify-center gap-1 disabled:text-gray-300 desktop:text-base laptop:text-sm">
        <i class="fa-solid fa-angle-left"></i>Prev
        </button>
        <div>
            <!-- <button 
            class="px-2 border"
            v-for="index in totalPages" :key="index" 
            @click="prevPage(index)"
            > 
            {{ index }}
            </button> -->
            <span class="desktop:text-base laptop:text-sm">{{ page }} of {{ totalPages }}</span>
        </div>
        <button 
        @click="nextPage" 
        :disabled="page === totalPages"
        class="flex items-center justify-center gap-1 disabled:text-gray-300 desktop:text-base laptop:text-sm"
            >Next 
            <i class="fa-solid fa-angle-right"></i>
        </button>
    </div>
</template>

<script>
export default {
    props: ['page', 'totalPages'],
    components: {},
    data() {
        return {
            value: 7
        }
    },
    methods:{
        // prevPage(index) {
        //     this.$emit('prev-page', index)
        // },
        prevPage() {
             this.$emit('prev-page', this.page - 1)
        },
        nextPage() {
            this.$emit('next-page',  this.page + 1)
        },
        lastPage() {
            this.$emit('last-page',  this.totalPages)
        },
    },
    created(){},
    computed:{}
}
</script>

<style scoped></style>