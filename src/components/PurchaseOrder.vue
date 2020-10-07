<template>
  <v-data-table
    :headers="headers"
    :items="gudang"
    sort-by="kode"
    class="elevation-1"
    >

    <template v-slot:top>
      <v-toolbar flat color="white">

        <v-toolbar-title>Purchase Order</v-toolbar-title>

          <v-divider
            class="mx-6"
            inset
            vertical
          ></v-divider>

        <v-toolbar-title>List Purchase Order</v-toolbar-title>

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
  export default {
    data: () => ({
      dialog: false,
      GudangSwitchAktif: ['✓'],
      headers: [
        {
          text: 'Kode Nota',
          align: 'start',
          value: 'kd_nota',
        },
        { text: 'Tanggal', value: 'tanggal' },
        { text: 'Nama Supplier', value: 'nm_supplier' },
        { text: 'Tanggal Kirim', value: 'tgl_kirim' },
        { text: 'Status', value: 'status' },
        { text: 'Total', value: 'total' },
        { text: 'Diskon', value: 'diskon' },
        { text: 'DPP', value: 'dpp' },
        { text: 'PPn', value: 'ppn' },
        { text: 'Total Bayar', value: 'total_bayar' },
        { text: 'Keterangan', value: 'keterangan' },
        { text: 'Referensi', value: 'referensi' },
        { text: 'Nomor Rangka', value: 'nomor_rangka' },
        { text: 'Nomor Polisi', value: 'nomor_polisi' },
        { text: 'Nomor WO', value: 'nomor_wo' },
        { text: 'Apply', value: 'apply' },
        { text: 'Dibuat Tanggal', value: 'dibuat_tgl' },
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

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        this.gudang = [
          {
            kd_nota:'0101/PO/2006/000055',
            tanggal:'06/06/2020',
            nm_supplier:'Leonardo Gordfrans'
          },
        ]
      },

      editItem (item) {
        this.editedIndex = this.gudang.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.gudang.indexOf(item)
        confirm('Anda Yakin Menghapus Gudang ini?') && this.gudang.splice(index, 1)
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
        }
        this.close()
      },
    },
  }
</script>