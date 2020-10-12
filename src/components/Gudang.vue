<template>
  <v-data-table
    :headers="headers"
    :items="gudang"
    sort-by="kode"
    class="elevation-1"
    >

    <template v-slot:top>
      <v-toolbar flat color="white">

        <v-toolbar-title>Gudang</v-toolbar-title>

          <v-divider
            class="mx-6"
            inset
            vertical
          ></v-divider>

        <v-toolbar-title>Daftar Gudang</v-toolbar-title>

          <v-spacer></v-spacer>
            <v-dialog
              v-model="dialog"
              max-width="700px">
                
                <template v-slot:activator="{ on, additem }">
                  <v-btn
                    color="primary"
                    dark
                    class="mb-2"
                    v-bind="additem"
                    v-on="on">
                    Tambahkan Gudang
                  </v-btn>
                </template>

          <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="18" sm="10" md="6">
                      <v-text-field
                        v-model="editedItem.kode" 
                        label="Kode">
                      </v-text-field>
                    </v-col>

                  <v-col cols="18" sm="10" md="6">
                    <v-text-field 
                      v-model="editedItem.nama" 
                      label="Nama">
                    </v-text-field>
                  </v-col>

                  <v-col cols="18" sm="10" md="6">
                    <v-text-field 
                      v-model="editedItem.alamat" 
                      label="Alamat">
                    </v-text-field>
                  </v-col>

                  <v-col cols="18" sm="10" md="6">
                    <v-text-field 
                      v-model="editedItem.kota" 
                      label="Kota" required>
                    </v-text-field>
                  </v-col>

                  <v-col cols="18" sm="10" md="6">
                    <v-text-field 
                      v-model="editedItem.memo" 
                      label="Memo">
                    </v-text-field>
                  </v-col>

                  <v-col cols="18" sm="10" md="6">
                    <v-switch 
                      v-model="GudangSwitchAktif" 
                      color="primary" 
                      label=" Aktif">
                    </v-switch>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="error" text @click="close">Batal</v-btn>
              <v-btn color="success" text @click="save">Simpan</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>

    <template v-slot:[`item.action`]= "{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)">
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)">
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
      GudangSwitchAktif: ['✓'],
      headers: [
        {
          text: 'Kode',
          align: 'start',
          value: 'kode',
        },
        { text: 'Nama', value: 'nama' },
        { text: 'Alamat', value: 'alamat' },
        { text: 'Kota', value: 'kota' },
        { text: 'Memo', value: 'memo' },
        { text: 'Aksi', value: 'aksi', sortable: false },
      ],
      gudang: [],
      editedIndex: -1,
      editedItem: {
        kode: '',
        nama: '',
        alamat: '',
        kota: '',
        memo: '',
      },
      defaultItem: {
        kode: '',
        nama: '',
        alamat: '',
        kota: '',
        memo: '',
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Tambahkan Gudang' : 'Edit Gudang'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    mounted() {
      this.getGudang()
    },

    methods: {
      getGudang() {
        api.get('/gudang').then(
          result => {
            console.log(result.data)
            this.gudang = result.data
          },
          error => {
            console.error(error)
          }
        )
      },
      TambahkanGudang() {
        api.post('/gudang',
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
      HapusGudang(gudang, index) {
        api.delete('/gudang/'+ gudang.id
        ).then((res) => {
          this.gudang.splice(index, 1)
          console.log(res)
        }).catch((err) => {
          console.log(err)
        })
      },
      UpdateGudang(barang) {
        api.put('/api/gudang/' + barang.id,
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
        this.editedIndex = this.gudang.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.gudang.indexOf(item)
        var hapus = confirm('Anda Yakin Menghapus Barang ini?')
        if (hapus) {
        this.HapusGudang(item, index)
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
          Object.assign(this.gudang[this.editedIndex], this.editedItem)
        } else {
          this.gudang.push(this.editedItem)
          this.TambahkanGudang(this.editedItem)
        }
        this.close()
      },
    },
  }
</script>