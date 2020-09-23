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
                    <v-text-field v-model="editedItem.partnumber2" label="PartNumber 1"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.partnumber2" label="PartNumber 2"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.kendaraan" label="Kendaraan"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.kodesuplier" label="Kode Suplier"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                    <v-text-field v-model="editedItem.dimensi" label="Dimensi"></v-text-field>
                  </v-col>
                  <v-col cols="18" sm="10" md="6">
                   <v-switch v-model="BarangSwitchAktif" color="primary" label=" Aktif "></v-switch>
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
    <template v-slot:item.aksi="{ item }">
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
  export default {
    data: () => ({
      dialog: false,
      BarangSwitchAktif: ['✓'],
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
        { text: 'Aksi', value: 'aksi', sortable: false },
      ],
      barang: [],
      editedIndex: -1,
      editedItem: {
        kode: '',
        nama: 0,
        merk: 0,
        partnumber1: 0,
        partnumber2: 0,
      },
      defaultItem: {
        kode: '',
        nama: 0,
        merk: 0,
        partnumber1: 0,
        partnumber2: 0,
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

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        this.barang = [
          {
            kode: '01/000001',
            nama: 'LAMP ASSY TURN SIGNAL SH',
            merk: 'HINO',
            partnumber1: '81510 E0010',
            partnumber2: '-',
          },
          {
            kode: '01/000002',
            nama: 'LAMP ASSY TURN SIGNAL LH',
            merk: 'HINO',
            partnumber1: '81520 E0010',
            partnumber2: '-',
          },
          {
            kode: '01/000003',
            nama: 'LAMP ASSY, RR COMBINATION LH',
            merk: 'HINO',
            partnumber1: '81530 E0010',
            partnumber2: '-',
          },
          {
            kode: '01/000004',
            nama: 'LAMP ASSY, RR COMBINATION LH',
            merk: 'HINO',
            partnumber1: '81540 E0010',
            partnumber2: '-',
          },
          {
            kode: '01/000005',
            nama: 'HEAD LAMP ASSY RH',
            merk: 'HINO',
            partnumber1: '81550 E0010',
            partnumber2: '-',
          },
          {
            kode: '01/000008',
            nama: 'HEAD LAMP ASSY LH',
            merk: 'HINO',
            partnumber1: '81560 E0010',
            partnumber2: '-',
          },
          {
            kode: '01/000007',
            nama: 'TANK ASSY RESERVE',
            merk: 'HINO',
            partnumber1: '81570 E0010',
            partnumber2: '-',
          },
          {
            kode: '01/000008',
            nama: 'SWITCH LIGHT',
            merk: 'HINO',
            partnumber1: '81580 E0010',
            partnumber2: '-',
          },
          {
            kode: '01/000009',
            nama: 'SWITCH ASSY, W/S',
            merk: 'HINO',
            partnumber1: '81590 E0010',
            partnumber2: '-',
          },
          {
            kode: '01/000010',
            nama: 'WASHER TRUST',
            merk: 'HINO',
            partnumber1: '81600 E0010',
            partnumber2: '-',
          },
        ]
      },

      editItem (item) {
        this.editedIndex = this.barang.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.barang.indexOf(item)
        confirm('Anda Yakin Menghapus Barang ini?') && this.barang.splice(index, 1)
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
        }
        this.close()
      },
    },
  }
</script>