import celebrityRoutes from './celebrity';
import representativeRoutes from './representative';
import territoryRoutes from './territory';
import VueRouter from "vue-router";
import Vue from 'vue';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        celebrityRoutes,
        representativeRoutes,
        territoryRoutes,
    ]
});
