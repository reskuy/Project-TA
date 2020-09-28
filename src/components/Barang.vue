<template>
  <v-data-table
    :headers="headers"
    :items="barang"
    sort-by="kode"
    class="elevation-1"
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
        <v-dialog v-model="dialog" max-width="500px">
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
                    <v-text-field v-model="editedItem.kode" label="Kode"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.nama" label="Nama"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.merk" label="Merk"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.kategori" label="Kategori"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.partnumber1" label="PartNumber 1"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.partnumber2" label="PartNumber 2"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.kendaraan" label="Kendaraan"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.kd_suplier" label="Kode Suplier"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.dimensi" label="Dimensi"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                   <v-switch v-model="editedItem.aktif" color="primary" true-value="Aktif" false-value="tidak" label=" Aktif "></v-switch>
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
    <template v-slot:[`item.aksi`]="{ item }">
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
      <p>Tidak ada Data barang</p>
    </template>
  </v-data-table>
</template>
<script>
import api from "@/axios/http";
  export default {
    data: () => ({
      dialog: false,
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
      barang: [],
      editedIndex: -1,
      editedItem: {
        kode: '',
        nama: 0,
        merk: 0,
        kategori: 0,
        partnumber1: 0,
        partnumber2: 0,
        kendaraan: '0',
        kd_suplier: '0',
        dimensi: '0',
        aktif: '',
      },
      defaultItem: {
        kode: '',
        nama: 0,
        merk: 0,
        kategori: 0,
        partnumber1: 0,
        partnumber2: 0,
        kendaraan: '0',
        kd_suplier: '0',
        dimensi: '0',
        aktif: 'tidak',
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