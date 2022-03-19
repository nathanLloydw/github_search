<template>
    <div class="flex flex-auto mx-2 items-center justify-center h-max my-auto mx-auto max-w-2xl min-w-lg bg-white rounded-lg">
        <div class="w-full">
            <input
                v-model="this.search_value"
                @change="search_github_users"
                type="search" class="w-full px-4 py-1 text-gray-800 rounded-full focus:outline-none" placeholder="search">
        </div>
        <button
            @click="search_github_users"
            type="submit" class="flex items-center justify-center w-24 h-12 text-white rounded-r-lg bg-purple-500 hover:bg-blue-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>
    </div>
</template>

<script>
export default {
    name: "Search",
    data: function () {
        return {
            search_value: null
        }
    },
    methods:
        {
            search_github_users()
            {
                this.$emit("search_triggered", this.search_value)
            }
        }
}
</script>

<style scoped>

</style>
