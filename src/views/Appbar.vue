<template> 
  <v-div>
  <v-app-bar
    color="blue darken-4"
    clipped-left
    fixed
    dark
    app
  >
    <v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>
    <v-toolbar-title>TRINITY AUTO</v-toolbar-title>
      <!-- <v-btn
      dark
      fab text small
      @click="$emit('NavTerbuka')"
      >
      <v-icon>mdi-menu</v-icon>
      </v-btn> -->

      <v-spacer></v-spacer>
      
      <!-- ------------------------------------------------- -->
      <v-menu>
      <template v-slot:activator="{ on: menu, attrs }">
        <v-tooltip bottom>
          <template v-slot:activator="{ on: tooltip }">
            <v-btn
              small
              depressed
              color="blue darken-4"
              dark
              v-bind="attrs"
              v-on="{ ...tooltip, ...menu }"
            >
             Master
             <v-icon>mdi-chevron-down</v-icon>
            </v-btn>
          </template>
          <span>Master</span>
        </v-tooltip>
      </template>
      <v-list>
        <v-list-item
          v-for="(item, index) in master"
          :prepend-icon="item.icon"
          :key="index"
          :to="item.link"
          dense
          link
        >
          <v-list-item-title>{{ item.title }}</v-list-item-title>

          <v-list-item-icon>
            <v-icon class="mr-1" v-text="item.icon"></v-icon>
          </v-list-item-icon>

        </v-list-item>
      </v-list>
    </v-menu>
    <!-- ------------------------------------------------------------- -->
    <v-menu>
      <template v-slot:activator="{ on: menu, attrs }">
        <v-tooltip bottom>
          <template v-slot:activator="{ on: tooltip }">
            <v-btn
              small
              depressed
              color="blue darken-4"
              dark
              v-bind="attrs"
              v-on="{ ...tooltip, ...menu }"
            >
             Data
             <v-icon>mdi-chevron-down</v-icon>
            </v-btn>
          </template>
          <span>Data</span>
        </v-tooltip>
      </template>
      <v-list>
        <v-list-item
          v-for="(item, index) in data"
          :prepend-icon="item.icon"
          :key="index"
          :to="item.link"
          dense
          link
        >
          <v-list-item-title>{{ item.title }}</v-list-item-title>

          <v-list-item-icon>
            <v-icon class="mr-1" v-text="item.icon"></v-icon>
          </v-list-item-icon>

        </v-list-item>
      </v-list>
    </v-menu>
    <!-- ------------------------------------------------------------- -->
    <v-menu>
      <template v-slot:activator="{ on: menu, attrs }">
        <v-tooltip bottom>
          <template v-slot:activator="{ on: tooltip }">
            <v-btn
              small
              depressed
              color="blue darken-4"
              dark
              v-bind="attrs"
              v-on="{ ...tooltip, ...menu }"
            >
             Data
             <v-icon>mdi-chevron-down</v-icon>
            </v-btn>
          </template>
          <span>Data</span>
        </v-tooltip>
      </template>
      <v-list>
        <v-list-item
          v-for="(item, index) in data1"
          :prepend-icon="item.icon"
          :key="index"
          :to="item.link"
          dense
          link
        >
          <v-list-item-title>{{ item.title }}</v-list-item-title>

          <v-list-item-icon>
            <v-icon class="mr-1" v-text="item.icon"></v-icon>
          </v-list-item-icon>

        </v-list-item>
      </v-list>
    </v-menu>

      <v-btn
        class="mx-2"
        text
        dark
        fab
        small
        to="login"
        >
        <v-icon>mdi-login-variant</v-icon>
      </v-btn>
      
      <v-btn
        class="mx-2"
        text
        dark
        fab
        small
        href="#"
      >
        <v-icon>mdi-bell-outline</v-icon>
      </v-btn>

      <v-btn
        class="mx-2"
        text
        dark
        fab
        small
        href="#"
      >
      <v-icon>mdi-alert-circle-outline</v-icon>
    </v-btn>
  </v-app-bar>

  <!-- ----------------------navigation-drawer-start-------------------------- -->
  <v-navigation-drawer
      v-model="drawer"
      color="white"
      absolute
      temporary
      
    >
      <v-list
        dense
        rounded
      >
        <v-list-item class="px-2">
          <v-list-item-avatar>
            <v-avatar class="mx-n1" color="blue darken-4">
              <span class="white--text headline">TA</span>
            </v-avatar>
          </v-list-item-avatar>
          
          <v-list-item-content>
            <v-list-title>TRINITY AUTO</v-list-title>
          </v-list-item-content>
        </v-list-item>
        
      <v-divider class="my-2"></v-divider>

      <v-list-item
        link
        to="Dashboard"
        color="blue darken-4"
      >
        <v-list-item-icon>
            <v-icon>mdi-home</v-icon>
        </v-list-item-icon>
        <v-list-item-title>Dashboard</v-list-item-title>
      </v-list-item>

      <v-divider class="my-2"></v-divider>

      <v-list-item
        link
        to="Setting"
        color="blue darken-4"
      >
        <v-list-item-icon>
            <v-icon>mdi-cog</v-icon>
        </v-list-item-icon>
        <v-list-item-title>Setting</v-list-item-title>
      </v-list-item>

      <v-divider class="my-2"></v-divider>
      
      <!-- <v-subheader>Master</v-subheader> -->
      <!-- ----------------------------master-data-start--------------------------- -->
      <!-- <v-list-item-group
        v-model="selectedItem"
        color="blue darken-4"
        dense
      >
        <v-list-item
          v-for="(item, i) in masterdata"
          :key="i"
          :to="item.link"
          link
        >
          <v-list-item-icon>
            <v-icon v-text="item.icon"></v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title v-text="item.text"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group> -->
    </v-list>
    <!-- ------------------------------master-data-end--------------------------- -->
    <v-divider></v-divider>
    <!-- ------------------------------------data---------------------------- -->
    <v-list dense rounded>
      <v-list-group
        class="my-1"
        color="blue darken-4"
        v-for="item in items"
        :key="item.title"
        v-model="item.active"
        :prepend-icon="item.action"
        no-action
      >
        <template v-slot:activator>
          <v-list-item-content>
            <v-list-item-title v-text="item.title"></v-list-item-title>
          </v-list-item-content>
        </template>

        <v-list-item
          color="blue darken-4"
          v-for="child in item.items"
          :key="child.title"
          :to="child.link"
          link
        >
          <v-list-item-content>
            <v-list-item-title v-text="child.title"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-group>
    </v-list>
    <!-- ------------------------------data-end------------------------------ -->
    </v-navigation-drawer>
    <!-- ------------------------navigation-drawer-end----------------------- -->
  </v-div>

  
</template>

<script>
    export default {
    data: () => ({
      drawer: false,
      group: null,
      
      // --------------------------navigation-drawer-start-----------------------
      // selectedItem: 1,
      // masterdata: [
      //   { text: 'User', link: '/User', icon: 'mdi-account' },
      //   { text: 'Barang', link: '/Barang', icon: 'mdi-package-variant-closed' },
      //   { text: 'Pelanggan', link: '/CustomerSync', icon: 'mdi-account-group' },
      //   { text: 'Supplier', link: '/Supplier', icon: 'mdi-truck-fast' },
      //   { text: 'Gudang', link: '/Gudang', icon: 'mdi-warehouse' },
      // ],

      items: [
        {
          action: 'mdi-folder',
          items: [
            { title: 'User', link: '/User' },
            { title: 'Barang', link: '/Barang' },
            { title: 'Pelanggan', link: '/CustomerSync' },
            { title: 'Supplier', link: '/Supplier' },
            { title: 'Gudang', link: '/Gudang' },
          ],
          title: 'MASTER',
        },

        {
          action: 'mdi-folder',
          items: [
            { title: 'Daftar Harga Jual Beli', link: '/DaftarHargaBeliJual' },
            { title: 'Jenis Pekerjaan', link: 'JenisPekerjaan' },
            { title: 'Invoice', link: 'Invoice' },
            { title: 'Chart of Account', link: 'ChartOfAccount' },
            { title: 'Periode', link: 'Periode' },
            { title: 'Purchase Order (PO)', link: 'PurchaseOrder' },
            { title: 'Internal Part Order', link: '/InternalPartOrder', icon: 'mdi-account'},
            { title: 'Pembelian', link: 'Pembelian2' },
            { title: 'Retur Pembelian', link: 'ReturPembelian' },
            { title: 'Work Order', link: 'WorkOrder' },
            { title: 'Estimasi', link: 'Estimasi' },
          ],
          title: 'DATA (1)',
        },

        {
          action: 'mdi-folder',
          items: [
            { title: 'Nota Gudang', link: '/NotaGudang' },
            { title: 'test2', link: '/test2' },
          ],
          title: 'DATA (2)',
        },

        {
          action: 'mdi-folder',
          items: [
            { title: 'Pembelian Yg Lama', link: '/Pembelian' },
          ],
          title: 'DATA (3)',
        },
      ],
      // --------------------------navigation-drawer-end-----------------------


      // ------------------------- ---app-bar-start----------------------------
      master: [
        { title: 'User', link: '/User', icon: 'mdi-account' },
        { title: 'Barang', link: '/Barang', icon: 'mdi-package-variant-closed' },
        { title: 'Pelanggan', link: '/CustomerSync', icon: 'mdi-account-group' },
        { title: 'Supplier', link: '/Supplier', icon: 'mdi-truck-fast' },
        { title: 'Gudang', link: '/Gudang', icon: 'mdi-warehouse' },
      ],
      
      data: [
        { title: 'Daftar Harga Beli Jual', link: '/DaftarHargaBeliJual', icon: 'mdi-account'},
        { title: 'Jenis Pekerjaan', link: '/JenisPekerjaan', icon: 'mdi-account'},
        { title: 'Invoice', link: '/Invoice', icon: 'mdi-account'},
        { title: 'Chart of Account (COA)', link: '/ChartOfAccount', icon: 'mdi-account'},
        { title: 'Periode', link: '/Periode', icon: 'mdi-account'},
        { title: 'Purchase Order (PO)', link: '/PurchaseOrder', icon: 'mdi-account'},
        { title: 'Internal Part Order', link: '/InternalPartOrder', icon: 'mdi-account'},
        { title: 'Pembelian', link: '/Pembelian2', icon: 'mdi-account'},
        { title: 'Retur Pembelian', link: '/ReturPembelian', icon: 'mdi-account'},
        { title: 'Work Order (WO)', link: '/WorkOrder', icon: 'mdi-account'},
        { title: 'Estimasi', link: '/Estimasi', icon: 'mdi-account'},
      ],

      data1: [
        { title: 'Nota Gudang', link: '/NotaGudang', icon: 'mdi-account' },
        { title: 'Nota Gudang2', link: '/NotaGudang2', icon: 'mdi-account' },
      ],
      offset: true,
      // ------------------------- ---app-bar-end----------------------------

      
    }),
  }
</script>