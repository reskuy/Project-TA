<template>
  <v-data-table
    :headers="headers"
    :items="supplier"
    sort-by="kode"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>Supplier</v-toolbar-title>
        <v-divider
          class="mx-6"
          inset
          vertical
        ></v-divider>    
        <v-toolbar-title>Daftar Supplier</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, additem }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="additem"
              v-on="on"
            >Tambahkan Supplier</v-btn>
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
                    <v-text-field v-model="editedItem.badanhukum" label="Badan Hukum"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.alamat" label="Alamat"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.kota" label="Kota"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.negara" label="Negara"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.contactperson" label="Contact Person"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                   <v-switch v-model="SupplierSwitchAktif" color="primary" label=" Aktif "></v-switch>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.kreditlimit" label="Kredit Limit"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.lamakredit" label="Lama Kredit"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.npwp" label="NPWP"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.nppkp" label="NPPKP"></v-text-field>
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
      <v-btn color="primary" @click="initialize">Reset</v-btn>
    </template>
  </v-data-table>
</template>
<script>
import api from '@/axios/http'
  export default {
    data: () => ({
      dialog: false,
      SupplierSwitchAktif: ['✓'],
      headers: [
        {
          text: 'Kode',
          align: 'start',
          value: 'kode',
        },
        { text: 'Nama', value: 'nama' },
        { text: 'Badan Hukum', value: 'badanhukum' },
        { text: 'Alamat', value: 'alamat' },
        { text: 'Kota', value: 'kota' },
        { text: 'Negara', value: 'negara' },
        { text: 'Contact Person', value: 'contactperson' },
        { text: 'Aktif', value: 'aktif' },
        { text: 'Kredit Limit', value: 'kreditlimit' },
        { text: 'Lama Kredit', value: 'lamakredit' },
        { text: 'NPWP', value: 'npwp' },
        { text: 'nppkp', value: 'nppkp' },
        { text: 'Aksi', value: 'aksi', sortable: false },
      ],
      supplier: [],
      editedIndex: -1,
      editedItem: {
        kode: '',
        nama: '',
        badanhukum: '',
        alamat: '',
        kota: '',
        negara: '',
        contactperson: 0,
        aktif: '',
        kreditlimit: 0,
        lamakredit: 0,
        npwp: 0,
        nppkp: 0,
      },
      defaultItem: {
        kode: '',
        nama: '',
        badanhukum: '',
        alamat: '',
        kota: '',
        negara: '',
        contactperson: 0,
        aktif: '',
        kreditlimit: 0,
        lamakredit: 0,
        npwp: 0,
        nppkp: 0,
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Tambahkan Supplier' : 'Edit Supplier'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    mounted () {
      this.getSupplier()
    },

    methods: {
      getSupplier() {
        api.get('/supplier').then(
          result => {
            console.log(result.data)
            this.supplier = result.data
          },
          error => {
            console.error(error)
          }
        )
      },
      TambahkanSupplier() {
        api.post('/supplier',
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
      HapusSupplier(supplier, index) {
        api.delete('/supplier/'+ supplier.id
        ).then((res) => {
          this.supplier.splice(index, 1)
          console.log(res)
        }).catch((err) => {
          console.log(err)
        })
      },
      UpdateSupplier(barang) {
        api.put('/api/supplier/' + barang.id,
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
        this.editedIndex = this.supplier.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.supplier.indexOf(item)
        var hapus = confirm('Anda Yakin Menghapus Barang ini?')
        if (hapus) {
        this.HapusSupplier(item, index)
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
          Object.assign(this.supplier[this.editedIndex], this.editedItem)
        } else {
          this.supplier.push(this.editedItem)
          this.TambahkanSupplier(this.editedItem)
        }
        this.close()
      },
    },
  }
</script>