<template>
    <div class="bg-[#242d3c] w-full sticky top-0 shadow-2xl">
        <div class="py-2 flex flex-wrap max-w-4xl mx-auto">

            <div class="flex mx-auto sm:mx-2">
                <img class="w-16 h-16 m-2 rounded-full" :src="'../storage/github_logo.png'">
                <h2 class="text-white my-auto">Github Search</h2>
            </div>

            <search @search_triggered="search_github_users"></search>

        </div>
    </div>

    <div class='min-h-screen from-cyan-100 via-pink-200 to-yellow-200 bg-gradient-to-br'>
        <github_users :users="this.github_users"></github_users>
    </div>
</template>

<script>
import search from "../Components/Search"
import github_users from "../Components/GithubUsers"
import axios from "axios";

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

export default {
    name: "Home",
    props:['name'],
    components:{ search,github_users },
    data: function () {
        return {
            github_users: null
        }
    },
    methods:
    {
        search_github_users(search_value)
        {
            console.log(search_value);

            axios.post("/api/search_github_users", { search_value: search_value })
            .then((res) =>
            {
                this.github_users = res.data;
            });
        }
    }
}
</script>

<style scoped>

</style>
