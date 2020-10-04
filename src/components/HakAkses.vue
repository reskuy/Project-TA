<template>
  <v-data-table
  :headers="headers"
  :items="hakakses"
  sort-by="nama_lengkap"
  class="elevation-1"
  >
  <template v-slot:top>
    <v-toolbar flat color="white">
      <v-toolbar-title>Hak Akses</v-toolbar-title>
      <v-divider
      class="mx-6"
      inset
      vertical
      ></v-divider>    
      <v-toolbar-title>Manajemen Hak Akses</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <template v-slot:activator="{ on, additem }">
          <v-btn
          color="primary"
          dark
          class="mb-2"
          v-bind="additem"
          v-on="on"
          >Tambahkan Hak Akses</v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>

          </v-card-title>

          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="18" sm="10" md="12">
                  <v-text-field v-model="editedItem.nama" label="Jabatan"></v-text-field>
                </v-col>
                <v-col cols="12">
                  <header>Modul Barang</header>
                </v-col>
                <v-checkbox v-model="tambah" class="mx-2" label="Tambah"></v-checkbox>
                <v-checkbox v-model="ubah" class="mx-2" label="Ubah"></v-checkbox>
                <v-checkbox v-model="lihat" class="mx-2" label="Lihat"></v-checkbox>
                <v-checkbox v-model="hapus" class="mx-2" label="Hapus"></v-checkbox>
                <v-col cols="12">
                  <header>Modul Gudang</header>
                </v-col>
                <v-checkbox v-model="tambah" class="mx-2" label="Tambah"></v-checkbox>
                <v-checkbox v-model="ubah" class="mx-2" label="Ubah"></v-checkbox>
                <v-checkbox v-model="lihat" class="mx-2" label="Lihat"></v-checkbox>
                <v-checkbox v-model="hapus" class="mx-2" label="Hapus"></v-checkbox>
                <v-col cols="12">
                  <header>Modul Supplier</header>
                </v-col>
                <v-checkbox v-model="tambah" class="mx-2" label="Tambah"></v-checkbox>
                <v-checkbox v-model="ubah" class="mx-2" label="Ubah"></v-checkbox>
                <v-checkbox v-model="lihat" class="mx-2" label="Lihat"></v-checkbox>
                <v-checkbox v-model="hapus" class="mx-2" label="Hapus"></v-checkbox>
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
    date: new Date().toISOString().substr(0, 10),
    menu: false,
    modal: false,
    menu2: false,
    dialog: false,
    BarangSwitchAktif: ['✓'],
    items: ['Laki-laki', 'Perempuan'],
    jabatans: ['HRD', 'IT', 'Security'],
    headers: [
    {
      text: 'Jabatan',
      align: 'start',
      value: 'nama_lengkap',
    },
    { text: 'Aksi', value: 'aksi', sortable: false },
    ],
    hakakses: [],
    editedIndex: -1,
    editedItem: {
      nama_lengkap: '',
      telepon: 0,
      jabatan: 0,
      jenkel: 0,
      partnumber2: 0,
    },
    defaultItem: {
      nama_lengkap: '',
      telepon: 0,
      jabatan: 0,
      jenkel: 0,
      partnumber2: 0,
    },
  }),

  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'Tambahkan Hak Akses' : 'Edit Hak Akses'
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
      this.hakakses = [
      {
        nama_lengkap: 'HRD',
      },
      {
        nama_lengkap: 'IT Developer',
      },
      {
        nama_lengkap: 'Administrator',
      },
      ]
    },

    editItem (item) {
      this.editedIndex = this.hakakses.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem (item) {
      const index = this.hakakses.indexOf(item)
      confirm('Anda Yakin Menghapus hakakses ini?') && this.hakakses.splice(index, 1)
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
        Object.assign(this.hakakses[this.editedIndex], this.editedItem)
      } else {
        this.hakakses.push(this.editedItem)
      }
      this.close()
    },
  },
}
</script>