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
        <div>
            <h4>Commenti</h4>
            <div v-for="(elemento, index) in post.comments" :key="index" class="box_commento">
                <p><b>Nome Utente:</b> {{elemento.name}}</p>
                <p>{{elemento.testo}}</p>
            </div>
            <form @submit.prevent="aggiungiCommento()">
                <input
                    type="text"
                    id="name"
                    placeholder="Inserisci il nome"
                    v-model="inputUtente.name"
                />
                <textarea
                    id="testo"
                    cols="30"
                    rows="5"
                    placeholder="Commenta qui"
                    v-model="inputUtente.testo"
                ></textarea>
                <button type="submit">Invia</button>
            </form>
        </div>
        <div v-show="commentCheck">In approvazione!</div>
    </div>
</template>

<script>
export default {
    name: "Post-Singolo",
    data() {
        return {
            post: {},
            inputUtente: {
                name: "",
                testo: "",
                post_id: null,
            },
            commentCheck: false,
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
                    this.inputUtente.post_id = this.post.id;
                    console.log(this.post);
                });
        },
        aggiungiCommento: function () {
            axios.post(`/api/comments/`, this.inputUtente).then((response) => {
                this.inputUtente.name = "";
                this.inputUtente.testo = "";
                this.commentCheck = true;
                console.log(response);
            });
        },
    },
};
</script>

<style lang="scss" scoped>
    .box_commento{
        border: 1px solid black;
        padding: 10px;
        margin: 10px 0;
    }
</style>>


