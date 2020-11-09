<template>
<v-navigation-drawer
      app
        v-model="drawer"
        color="primary"
        expandOnHover
        miniVariant
        permanent
        fixed
        dark
        height="100%"
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
           <v-list-item link to="/Home">
        <v-list-item-icon>
          <v-icon>mdi-home</v-icon>
        </v-list-item-icon>

        <v-list-item-title>Dashboard</v-list-item-title>
      </v-list-item>
         <v-list-group
        v-for="item in items"
        :key="item.title"
        v-model="item.active"
        :prepend-icon="item.icon"
        :color="active ? 'primary' : ''"
      >
        <template v-slot:activator>
          <v-list-item-content>
            <v-list-item-title v-text="item.title"></v-list-item-title>
          </v-list-item-content>
        </template>
        <v-list-item
          v-for="subItem in item.items"
          :key="subItem.title"
          link
          :to="subItem.link"
        >
          <v-list-item-content >
          <v-list-item-icon>
          <v-icon>{{subItem.icon}}</v-icon>
          </v-list-item-icon>
            
          </v-list-item-content>
           <v-list-item-title v-text="subItem.title"></v-list-item-title>
           <v-list-item-icon >
          <v-icon dense>{{subItem.icon}}</v-icon>
            </v-list-item-icon>
         
        </v-list-item>
      </v-list-group>

        </v-list>
      </v-navigation-drawer>
</template>
<script>

  export default {
    data () {
      return {
        active: false,
        drawer: true,
        items: [
          {
            icon: 'mdi-webpack',
            title: 'Master Data',
            items: [
              { icon: 'mdi-package-variant-closed',title: 'Barang', link: '/Barang' },
              { icon: 'mdi-account-group', title: 'Pelanggan', link: '/Pelanggan' },
              { icon: 'mdi-truck-fast', title: 'Supplier', link: '/Supplier' },
              { icon: 'mdi-warehouse', title: 'Gudang', link: '/Gudang' },
              { icon: 'mdi-account-box', title: 'User', link: '/User' },
              { icon: 'mdi-account-key', title: 'Hak Akses User', link: '/HakAkses' },
            
            ],
          },
          {
            icon: 'mdi-cart-check',
            title: 'Purchase Order',
            items: [
              { icon: 'mdi-view-list', title: 'Purchase Order', link: '/PurchaseOrder' },
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
<style>
/* width */
::-webkit-scrollbar {
  width: 1px;
}

/* Track */
::-webkit-scrollbar-track {
  background:none; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>