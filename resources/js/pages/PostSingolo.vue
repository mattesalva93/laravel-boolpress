<template>
    <div class="container">
        <div>
            <router-link :to="{ name: 'home' }">Ritorna alla home</router-link>
        </div>
        <h1>
            {{ post.title }}
        </h1>
        <div v-if="post.category != null">
            CATEGORIA: {{ post.category.name }}
        </div>
        <div v-else>CATEGORIA: -</div>
        <div>
            TAG:
            <span v-for="(post, index) in post.tags" :key="index">
                <i>{{ post.name }} </i>
            </span>
        </div>
        <div>
            <p>
                {{ post.content }}
            </p>
        </div>
        <div v-if="post.image != null">
            <img :src="'../storage/' + post.image" alt="" />
        </div>
        <div v-else>
            <img src="../../../public/img/empty_image.jpg" alt="" />
        </div>
    </div>
</template>

<script>
export default {
    name: "Post-Singolo",
    data() {
        return {
            post: {},
        };
    },
    created() {
        this.getPost();
    },
    methods: {
        getPost: function () {
            axios
                .get(`/api/posts/${this.$route.params.slug}`)
                .then((response) => {
                    this.post = response.data;
                    console.log(this.post);
                });
        },
    },
};
</script>

<style></style>
