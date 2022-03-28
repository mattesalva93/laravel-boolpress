<template>
    <main>
        <div class="container">
            <div class="post-container">
                <div
                    v-for="elemento in posts"
                    :key="elemento.id"
                    class="post-card"
                >
                    <div>TITOLAZZO: {{ elemento.title }}</div>
                    <div>
                        {{ elemento.content }}
                    </div>
                    <div v-if="elemento.image != null">
                        <img :src="'storage/' + elemento.image" alt="" />
                    </div>
                    <div v-else>
                        <img src="../../../public/img/empty_image.jpg" alt="" />
                    </div>
                    <div v-if="elemento.category != null">
                        CATEGORIA: {{ elemento.category.name}}
                    </div>
                    <div v-else>
                        CATEGORIA: -
                    </div>
                    <div>
                        TAG: 
                        <span v-for="(tag, index) in elemento.tags" :key="index">
                            <i>{{tag.name}} </i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: "Main",
    data() {
        return {
            posts: [],
        };
    },
    created() {
        this.getPosts();
    },
    methods: {
        getPosts: function () {
            axios.get("/api/posts").then((response) => {
                this.posts = response.data;
            });
        },
    },
};
</script>

<style lang="scss" scoped>
.post-container {
    margin-top: 100px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    .post-card {
        border: 1px solid black;
        width: 30%;
        margin: 10px auto;
        display: flex;
        flex-direction: column;
        text-align: center;
        img {
            height: 100px;
            width: auto;
        }
    }
}
</style>
