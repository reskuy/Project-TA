<template>
  <v-data-table
    :headers="headers"
    :items="barang"
    sort-by="kode"
    class="elevation-1"
    loading="loadingtrue"
    loading-text="Mohon Tunggu"
  >
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>Barang</v-toolbar-title>
        <v-divider
          class="mx-6"
          inset
          vertical
        ></v-divider>    
        <v-toolbar-title>Daftar Barang</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="600px">
          <template v-slot:activator="{ on, additem }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="additem"
              v-on="on"
            >Tambahkan Barang</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>

            </v-card-title>

            <v-card-text>
              <v-container>               
            <v-row>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.kode" label="Kode" :rules="rules"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.nama" label="Nama" :rules="rules"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.merk" label="Merk" :rules="rules"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.kategori" label="Kategori" :rules="rules"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.partnumber1" label="PartNumber 1" :rules="rules"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.partnumber2" label="PartNumber 2" :rules="rules"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.kendaraan" label="Kendaraan" :rules="rules"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.kd_suplier" label="Kode Suplier" :rules="rules"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.dimensi" label="Dimensi" :rules="rules"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                   <v-switch v-model="editedItem.aktif" color="primary" true-value="Aktif" false-value="tidak" label=" Aktif "></v-switch>
                  </v-col>
                </v-row>


              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-col>
  <div class="my-1">
 <v-btn color="primary"
 @click.stop="dialog1=true"
>Harga</v-btn>
  </div>
  <v-dialog v-model="dialog1" >
     <v-card>
    <v-card-title>
      <v-col cols="12" sm="9">
      Harga 
      </v-col>
      <v-col cols="12" sm="3">
        
      <v-text-field 
        v-model="search1"
        append-icon="mdi-magnify"
        label="Search"
        hide-details
        clearable
      ></v-text-field>     

      </v-col>
    </v-card-title>
        <v-col>
    <v-data-table
    :headers="headers1"
    :items="rasio"
    sort-by="rasio"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title><v-btn>satuan</v-btn></v-toolbar-title>
        <v-divider
          class="mx-6"
          inset
          vertical
        ></v-divider> 
        <v-toolbar-title><v-btn>harga jual</v-btn></v-toolbar-title> 
         <v-divider
          class="mx-6"
          inset
          vertical
        ></v-divider>   
        <v-toolbar-title><v-btn>harga beli</v-btn></v-toolbar-title> 
        
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog3" max-width="500px">
          <template v-slot:activator="{ on, additem }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="additem"
              v-on="on"
            >Tambahkan Barang</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6">
                    <v-text-field v-model="editedItem.rasiokode" label="Rasio"></v-text-field>
                  </v-col>
                   <v-col cols="12" sm="6">
                    <v-text-field v-model="editedItem.namaharga" label="Nama"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6">
                    <v-text-field v-model="editedItem.hargajual" label="Harga Jual"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6">
                    <v-text-field v-model="editedItem.hargabeli" label="Harga Beli"></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Batal</v-btn>
              <v-btn color="blue darken-1" text @click="save">Simpan</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:[`item.action`]= "{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="primary">Reset</v-btn>
    </template>
  </v-data-table>
        </v-col>
    <v-col>

    <v-data-table class="elevation-1"
      
      
    ></v-data-table>
    </v-col>
    <v-col>
    <v-data-table class="elevation-1"
      
    ></v-data-table>
    </v-col>
     </v-card>
</v-dialog>
  
</v-col >
 
<v-col >
  <div class="my-1">
 <v-btn color="primary"
 @click.stop="dialog2=true"
 >Stock</v-btn>
  </div>
  <v-dialog v-model="dialog2">
  <v-data-table
    
  >
    
  </v-data-table>
  </v-dialog>
</v-col >

              <v-btn color="error"  @click="close">Batal</v-btn>
              <v-btn color="primary"  @click="save">Simpan</v-btn>
              
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:[`item.aksi`]= "{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize">Reset</v-btn>
    </template>
  </v-data-table>
</template>
<script>
import api from "@/axios/http";

  export default {
    data: () => ({
      loadingtrue:false,
      dialog: false,
      dialog1 : false,
      dialog2 : false,
      dialog3 : false,
      headers: [
        {
          text: 'Kode',
          align: 'start',
          value: 'kode',
        },
        { text: 'Nama', value: 'nama' },
        { text: 'Merk', value: 'merk' },
        { text: 'PartNumber 1', value: 'partnumber1' },
        { text: 'PartNumber 2', value: 'partnumber2' },
        { text: 'Kategori', value: 'kategori' },
        { text: 'Kendaraan', value: 'kendaraan' },
        { text: 'Kode Suplier', value: 'kd_suplier' },
        { text: 'Dimensi', value: 'dimensi' },
        { text: 'Aktif', value: 'aktif' },
        { text: 'Aksi', value: 'aksi', sortable: false },
      ],
      headers1: [
        {
          text: 'Rasio',
          align: 'start',
          value: 'rasiokode',
        },
        { text: 'Nama', value: 'nama' },
     
        { text: 'Action', value: 'action', sortable: false },
      ],
      rules: [
        value => !!value || 'Required.',
        value => (value && value.length >= 1) || '',
      ],

      barang: [],
      editedIndex: -1,
      editedItem: {
        kode: null,
        nama: null,
        merk: null,
        kategori: null,
        partnumber1: null,
        partnumber2: null,
        kendaraan: null,
        kd_suplier: null,
        dimensi: null,
        aktif: null,
      },
      defaultItem: {
        kode: null,
        nama: null,
        merk: null,
        kategori: null,
        partnumber1: null,
        partnumber2: null,
        kendaraan: null,
        kd_suplier: null,
        dimensi: null,
        aktif: 'Tidak',
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Tambahkan Barang' : 'Edit Barang'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },
     mounted() {
      this.getBarang()
    },

    methods: {
      getBarang() {
        api.get('/barang').then(
          result => {
            console.log(result.data)
            this.barang = result.data
          },
          error => {
            console.error(error)
          }
        )
      },
      TambahkanBarang() {
        api.post('/barang',
          { kode: this.editedItem.kode,
            nama: this.editedItem.nama,
            merk: this.editedItem.merk,
            kategori: this.editedItem.kategori,
            partnumber1: this.editedItem.partnumber1,
            partnumber2: this.editedItem.partnumber2,
            kendaraan: this.editedItem.kendaraan,
            kd_suplier: this.editedItem.kd_suplier,
            dimensi: this.editedItem.dimensi,
            aktif: this.editedItem.aktif
          }
        ).then((res) => {
          this.kode = ''
          this.nama = ''
          this.merk = ''
          this.kategori = ''
          this.partnumber1 = ''
          this.partnumber2 = ''
          this.kendaraan = ''
          this.kd_suplier = ''
          this.dimensi = ''
          this.aktif = ''
          console.log(res)
        }).catch((err) => {
          console.log(err)
        })
      },
      HapusBarang(barang, index) {
        api.delete('/barang/'+ barang.id
        ).then((res) => {
          this.barang.splice(index, 1)
          console.log(res)
        }).catch((err) => {
          console.log(err)
        })
      },
      UpdateBarang(barang) {
        api.put('/api/task/' + barang.id,
          { kode: this.editedItem.kode,
            nama: this.editedItem.nama,
            merk: this.editedItem.merk,
            kategori: this.editedItem.kategori,
            partnumber1: this.editedItem.partnumber1,
            partnumber2: this.editedItem.partnumber2,
            kendaraan: this.editedItem.kendaraan,
            kd_suplier: this.editedItem.kd_suplier,
            dimensi: this.editedItem.dimensi,
            aktif: this.editedItem.aktif
          }
        ).then((res) => {
          this.kode = ''
          console.log(res)
        }).catch((err) => {
          console.log(err)
        })
      },

      editItem (item) {
        this.editedIndex = this.barang.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.barang.indexOf(item)
        var hapus = confirm('Anda Yakin Menghapus Barang ini?')
        if (hapus) {
        this.HapusBarang(item, index)
      }
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.barang[this.editedIndex], this.editedItem)
        } else {
          this.barang.push(this.editedItem)
          this.TambahkanBarang(this.editedItem)
        }
        this.close()
      },
    },
  }
</script>