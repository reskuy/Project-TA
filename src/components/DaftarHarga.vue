<template>
  <v-col cols="12" md="12">
    <v-card class="elevation-3">
      <v-toolbar
        flat
        dark
        dense
        color='blue darken-4'
        class="elevation-1"
      >
        <v-toolbar-title dark>
         <template v-if="posisi === true">
             Daftar Harga Beli
              </template> 
              <template v-if="posisi === false">
             Daftar Harga Jual
              </template> 
        </v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>

        <v-spacer></v-spacer>
         <template v-if="posisi === false">
            <v-btn  @click="posisi = !posisi">Harga beli</v-btn>
              </template>
        <template v-if="posisi === true">
            <v-btn  @click="posisi = !posisi">Harga Jual</v-btn>
              </template>
      </v-toolbar>

      <div id="app">
          <template v-if="posisi === true">
            <HargaBeli/>
              </template>
          <template v-if="posisi === false">
            <HargaJual/>
          </template>
    </div>

    </v-card>
  </v-col>
</template>

<script>

import api from '@/axios/http'
import HargaBeli from '@/views/DaftarHarga/HargaBeli'
import HargaJual from '@/views/DaftarHarga/HargaJual'

export default {
components:{
    HargaBeli,HargaJual
},
    data() {
        return {
        posisi : true,
        token : localStorage.getItem('token'),
        data: [],
        
            
    };
  },
    mounted(){
        this.getData()
    },

    watch: {
      dialogSupplier(val) {
         val || this.closeSupplier();
      },
      
    },

    computed: {
        formTitleSupplier(){
            return this.editedIndex === -1 ? "Tambah Supplier" : "Edit Supplier";
        },
        
    },
    
    methods: {
        getData(){
            api.get('/supplier?token='+this.token).then(
        res=>{
            console.log(res)
            this.data = res.data
        },
        err => {
            console.log(err)
            // this.$router.push('/')
            // localStorage.removeItem('token')
        })},
    }
}
</script>

<style>
    .centered-input input {
    text-align: right
  }

    .e-grid .e-groupdroparea.e-grouped { 
        background-color: rgb(25, 118, 210) ; 
    } 
    .e-grid .e-groupheadercell { 
        background-color: rgb(29, 79, 129) ; 
    } 
</style>