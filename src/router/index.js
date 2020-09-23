import Vue from 'vue'
import VueRouter from 'vue-router'
import Barang from "@/components/Barang"



Vue.use(VueRouter);

//const router = new VueRouter({
  export default new VueRouter({
    routes : [
      {path:'/Barang',name:'Barang',component: Barang}
    ],
    mode: 'history'
  });

  