import Vue from 'vue'
import VueRouter from 'vue-router'
import Barang from "@/components/Barang"
import User from "@/components/User";
import HakAkses from "@/components/HakAkses";
import Gudang from "@/components/Gudang";
import Supplier from "@/components/Supplier";
import Customer from "@/components/Customer";
import PurchaseOrder from "@/components/PurchaseOrder";



Vue.use(VueRouter);

//const router = new VueRouter({
export default new VueRouter({
  routes : [
    {path:'/Barang',name:'Barang',component: Barang},
    {path:'/user',name:'User',component: User},
    {path:'/Gudang',name:'Gudang',component: Gudang},
    {path:'/Supplier',name:'Supplier',component: Supplier},
    {path:'/Pelanggan',name:'Pelanggan',component: Customer},
    {path:'/PurchaseOrder',name:'PurchaseOrder',component: PurchaseOrder},
    {path:'/hakAkses',name:'HakAkses',component: HakAkses}
  ],
  mode: 'history'
});

