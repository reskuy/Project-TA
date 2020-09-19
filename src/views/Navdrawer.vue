<template>
<v-navigation-drawer
      app
        v-model="drawer"
        color="primary"
        expandOnHover
        miniVariant
        permanent
        absolute
        dark
      >
        <v-list
          dense
          nav
          class="py-0"
        >
          <v-list-item two-line :class="miniVariant && 'px-0'">
            <v-list-item-avatar>
              <img src="https://i.ibb.co/tJrtCtK/585e4bf3cb11b227491c339a.png">
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title>User Role</v-list-item-title>
              <v-list-item-subtitle>Setting</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>

          <v-divider></v-divider>
         
         <v-list-group
        v-for="item in items"
        :key="item.title"
        v-model="item.active"
        :prepend-icon="item.icon"
      >
        <template v-slot:activator>
          <v-list-item-content>
            <v-list-item-title v-text="item.title"></v-list-item-title>
          </v-list-item-content>
        </template>

        <v-list-item
          v-for="subItem in item.items"
          :key="subItem.title"
        >
          <v-list-item-content>
            <v-list-item-title v-text="subItem.title"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-group>

        </v-list>
      </v-navigation-drawer>
</template>
<script>
  export default {
    data () {
      return {
        drawer: true,
        items: [
          {
            icon: 'mdi-view-dashboard',
            title: 'Dashboard',
          },
          {
            icon: 'mdi-package-variant-closed',
            title: 'Barang',
            active: true,
            items: [
              { title: 'Daftar Barang' },
              { title: 'Input Barang' },
            ],
          },
          {
            icon: 'mdi-account-group',
            title: 'Pelanggan',
            items: [
              { title: 'Daftar Pelanggan' },
              { title: 'Pelanggan' },
            ],
          },
          {
            icon: 'mdi-truck-fast',
            title: 'Suplier',
            items: [
              { title: 'Daftar Suplier' },
              { title: 'Suplier' },
            ],
          },
          {
            icon: 'mdi-warehouse',
            title: 'Gudang',
            items: [
              { title: 'Daftar Gudang' },
              { title: 'Gudang' },
            ],
          },
        ],
        permanent: true,
        miniVariant: true,
        expandOnHover: true,
      }
    },
  }
</script>