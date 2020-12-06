<template>
<v-container>
<Appbar @NavTerbuka="expandOnHover = !expandOnHover, permanent = !permanent "/>
  <v-navigation-drawer
    color="blue darken-4"
    class="elevation-5"
    absolute clipped
    v-model="drawer"
    :expandOnHover="expandOnHover"
    height="100%"
    width='300'
    :permanent="permanent"
    fixed
    dark
    app
  >
    <v-list
      nav
      dense
      rounded
    >
      <v-list-item  to="Home">
        <v-list-item-icon>
          <v-icon>mdi-home</v-icon>
        </v-list-item-icon>

        <v-list-item-title>Home</v-list-item-title>
      </v-list-item>
      
      <v-list-group
        v-for="item in items"
        v-model="item.active"
        :key="item.title"
        :prepend-icon="item.action"
        color="dark"
        no-action
      >
        <template v-slot:activator>
          <v-list-item-content>
            <v-list-item-title
              v-text="item.title"
            >
            </v-list-item-title>
          </v-list-item-content>
        </template>

        <v-list-item
          color="white"
          v-for="subitem in item.items"
          :key="subitem.title"
          :to="subitem.link"
          link
        >
        
        <v-icon v-text="subitem.icon"></v-icon>
          <v-list-item-content>
            <v-list-item-title class="px-4" v-text="subitem.title"></v-list-item-title>
          </v-list-item-content>   
        </v-list-item>

        <v-divider></v-divider>

      </v-list-group>
      <v-divider></v-divider>
    </v-list>
  </v-navigation-drawer>
  </v-container>
</template>

<script>
import Appbar from '@/views/Appbar'
  export default {
    components: {
    Appbar
    },
    data: () => ({
      expandOnHover : true,
      drawer: true,
      permanent: false,
      items: [
        {
          action: 'mdi-folder',
          items: [
            { title: 'User', link: '/User', icon: 'mdi-account' },
            { title: 'Barang', link: '/Barang', icon: 'mdi-package-variant-closed' },
            { title: 'Pelanggan', link: '/CustomerSync', icon: 'mdi-account-group' },
            { title: 'Supplier', link: '/Supplier', icon: 'mdi-truck-fast' },
            { title: 'Gudang', link: '/Gudang', icon: 'mdi-warehouse' },
          ],
          title: 'MASTER',
        },

        {
          action: 'mdi-folder',
          items: [
            { title: 'Daftar Harga Beli Jual', link: '/DaftarHargaBeliJual', icon: 'mdi-file-document' },
            { title: 'Jenis Pekerjaan', link: '/JenisPekerjaan', icon: 'mdi-briefcase' },
            { title: 'Invoice', link: '/Invoice', icon: 'mdi-receipt' },
            { title: 'Chart of Account (COA)', link: '/ChartOfAccount', icon: 'mdi-file-account' },
            { title: 'Periode', link: '/Periode', icon: 'mdi-calendar-range' },
            { title: 'Purchase Order (PO)', link: '/PurchaseOrder', icon: 'mdi-cart-arrow-down' },
            { title: 'Internal Part Order', link: '/InternalPartOrder', icon: 'mdi-cart-arrow-down' },
            { title: 'Pembelian', link: '/Pembelian', icon: 'mdi-cart-plus' },
            { title: 'Retur Pembelian', link: '/ReturPembelian', icon: 'mdi-cart-arrow-up' },
            { title: 'Work Order (WO)', link: '/WorkOrder', icon: 'mdi-cart' },
            { title: 'Estimasi', link: '/Estimasi', icon: 'mdi-cart' },
          ],
          title: 'DATA',
        },

        {
          action: 'mdi-folder',
          items: [
            { title: 'Nota Gudang', link: '/NotaGudang', icon: 'mdi-note-text' },
            { title: 'Pembelian2', link: '/Pembelian2', icon: 'mdi-note-text' },
          ],
          title: 'LAINNYA',
        },
        

      ],
    }),
  }
</script>