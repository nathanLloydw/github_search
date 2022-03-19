<template>
    <div class="max-w-4xl mx-auto">
        <div class="py-2 px-4" v-for="user in users.items" v-if="users">
            <div class="w-full rounded bg-white px-4 py-6 shadow-xl flex flex-wrap">
                <div class="w-full sm:w-max mx-4">
                    <img class="w-full sm:w-24 sm:h-24 rounded-full" :src="user.avatar_url">
                    <h3 class="text-center font-semibold tracking-wider text-[#242d3c]">{{ user.login }}</h3>
                    <h4 class="text-center hover:text-purple-500 cursor-pointer" @click="redirect(user.html_url)">view profile</h4>
                </div>

                <div class="flex flex-col flex-auto">
                    <h4 class="text-[#242d3c] font-semibold tracking-wider text-lg">
                        Top 5 Repos :
                    </h4>
                    <div class="flex justify-between w-full" v-for="repo in user.repos">
                        <div class="w-[40%] whitespace-nowrap overflow-hidden px-2">{{repo.name}}</div>
                        <div class="w-[15%] whitespace-nowrap px-2 font-semibold flex">
                            <i class="fas fa-star my-auto pr-2"></i>
                            <span>{{repo.stargazers_count}}</span>
                        </div>
                        <div class="w-[20%] whitespace-nowrap px-2">{{repo.updated_at.split('T')[0]}}</div>
                        <h4  class="w-[25%] whitespace-nowrap px-2 hover:text-purple-500 cursor-pointer font-semibold tracking-wider text-[#242d3c]" @click="redirect(repo.url)">view repo</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "GithubUsers",
    props:['users'],
    methods:
        {
            redirect(url)
            {
                window.location.href = url;
            }
        }
}
</script>

<style scoped>

</style>
