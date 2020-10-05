<template>
  <v-data-table
  dense
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
              max-width="1200px"
              >
                
                <template v-slot:activator="{ on, additem }">
                  <v-btn
                    color="primary"
                    dark
                    class="mb-2"
                    v-bind="additem"
                    v-on="on">
                    Tambahkan Purchase Order
                  </v-btn>
                </template>

          <v-card>
                   <v-toolbar
      color="primary"
      dark
      flat
    >           <span class="headline">{{ formTitle }}</span>
                   </v-toolbar>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="18" sm="10" md="6">
                      <v-text-field
                        v-model="editedItem.kd_nota" 
                        label="Kode Nota">
                      </v-text-field>
                    </v-col>

                  <v-col cols="18" sm="10" md="6">
                   <v-menu
        v-model="menu2"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="editedItem.tanggalan"
            label="Tanggal"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
          v-model="editedItem.tanggalan"
          @input="menu2 = false"
        ></v-date-picker>
      </v-menu>
                  </v-col>

                  <v-col cols="18" sm="10" md="6">
                    <v-text-field 
                      v-model="editedItem.nm_supplier" 
                      label="Supplier">
                    </v-text-field>
                  </v-col>

                  <v-col cols="18" sm="10" md="6">
                    <v-text-field 
                      v-model="editedItem.billfrom" 
                      label="Bill From" required>
                    </v-text-field>
                  </v-col>

                  <v-col cols="18" sm="10" md="6">
                    <v-text-field 
                      v-model="editedItem.sellfrom" 
                      label="Sell From">
                    </v-text-field>
                  </v-col>

                  <v-col cols="18" sm="10" md="6">
                    <v-text-field 
                      v-model="editedItem.payment_term" 
                      label="Payment Term">
                    </v-text-field>
                  </v-col>

                  <v-col cols="18" sm="10" md="6">
                    <v-text-field 
                      v-model="editedItem.matauang" 
                      label="Mata Uang">
                    </v-text-field>
                  </v-col>

                  <v-col cols="18" sm="10" md="6">
                    <v-text-field 
                      v-model="editedItem.kurs" 
                      label="Kurs">
                    </v-text-field>
                  </v-col>

                  <v-col cols="18" sm="10" md="6">
                    <v-menu
        v-model="menu_tanggal2"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="editedItem.tgl_kirim"
            label="Tanggal Kirim"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
          v-model="editedItem.tgl_kirim"
          @input="menu_tanggal2 = false"
        ></v-date-picker>
      </v-menu>
                  </v-col>

                  <v-col cols="18" sm="10" md="6">
                    <v-text-field 
                      v-model="editedItem.refrensi" 
                      label="Refrensi">
                    </v-text-field>
                  </v-col>

                  <v-col cols="18" sm="10" md="6">
                    <v-text-field 
                      v-model="editedItem.nomor_wo" 
                      label="Nomor WO">
                    </v-text-field>
                  </v-col>

                  <v-col cols="18" sm="10" md="6">
                    <v-text-field 
                      v-model="editedItem.nomor_rangka" 
                      label="Nomor Rangka">
                    </v-text-field>
                  </v-col>

                  <v-col cols="18" sm="10" md="6">
                  <v-btn color="success" text @click="loadpartorder">Load Part Order</v-btn>
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

            <v-card>
    <v-tabs
      v-model="tab"
      background-color="primary"
      dark
    >
      <v-tab>
        Items
      </v-tab>
    </v-tabs>

    <v-tabs-items v-model="tab">
      <v-tab-item
      >
        <v-card flat>
          <v-card-text></v-card-text>
        </v-card>
      </v-tab-item>
    </v-tabs-items>
  </v-card>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="error" text @click="close">Batal</v-btn>
              <v-btn color="success" text @click="save">Simpan</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>

    <template v-slot:[`item.aksi`]= "{ item }">
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
        tanggal: new Date().toISOString().substr(0, 10),
      dialog: false,
      GudangSwitchAktif: ['✓'],
      headers: [
        {
          text: 'Kode Nota',
          align: 'start',
          value: 'kd_nota',
        },
        { text: 'Tanggal', value: 'tanggalan'},
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
        kd_nota: '',
        tanggal: '',
        nm_supplier: '',
        tgl_kirim: '',
        status: '',
        total: '',
        diskon: '',
        dpp: '',
        ppn: '',
        total_bayar: '',
        keterangan: '',
        referensi: '',
        nomor_rangka: '',
        nomor_polisi: '',
        nomor_wo: '',
        matauang: 'Rupiah',
        kurs: '1.00',
        payment_term: '',
        apply: '',
        dibuat_tgl: ''
      },
      defaultItem: {
        kd_nota: '',
        tanggal: '',
        nm_supplier: '',
        tgl_kirim: '',
        status: '',
        total: '',
        diskon: '',
        dpp: '',
        ppn: '',
        total_bayar: '',
        keterangan: '',
        referensi: '',
        nomor_rangka: '',
        nomor_polisi: '',
        nomor_wo: '',
        apply: '',
        matauang: 'Rupiah',
        kurs: '1.00',
        payment_term: '',
        dibuat_tgl: ''
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Purchase Order' : 'Edit Purchase Order'
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