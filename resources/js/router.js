
import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from "./pages/Home";
import PostSingolo from "./pages/PostSingolo";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },        
        {
            path: "/post/:slug",
            name: "post-single",
            component: PostSingolo
        },
    ]
});

export default router