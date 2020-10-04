import Vue from 'vue'
import VueRouter from 'vue-router'
import Barang from "@/components/Barang"
import User from "@/components/User";
import HakAkses from "@/components/HakAkses";



Vue.use(VueRouter);

//const router = new VueRouter({
export default new VueRouter({
  routes : [
    {path:'/Barang',name:'Barang',component: Barang},
    {path:'/user',name:'User',component: User},
    {path:'/hakAkses',name:'HakAkses',component: HakAkses}
  ],
  mode: 'history'
});

