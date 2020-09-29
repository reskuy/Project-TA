import Vue from 'vue'
import VueRouter from 'vue-router'
import Barang from '@/components/Barang'
import Gudang from '@/components/Gudang'
import Supplier from '@/components/Supplier'
import Pelanggan from '@/components/Customer'




Vue.use(VueRouter);

//const router = new VueRouter({
  export default new VueRouter({
    routes : [
      {path:'/Barang',name:'Barang',component: Barang},
      {path:'/Gudang',name:'Gudang',component: Gudang},
      {path:'/Supplier',name:'Supplier',component: Supplier},
      {path:'/Pelanggan',name:'Pelanggan',component: Pelanggan}
    ],
    mode: 'history'
  });

  