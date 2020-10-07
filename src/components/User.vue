<template>
  <v-data-table
  :headers="headers"
  :items="user"
  sort-by="nama_lengkap"
  class="elevation-1"
  >
  <template v-slot:top>
    <v-toolbar flat color="white">
      <v-toolbar-title>User</v-toolbar-title>
      <v-divider
      class="mx-6"
      inset
      vertical
      ></v-divider>    
      <v-toolbar-title>Manajemen User</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <template v-slot:activator="{ on, additem }">
          <v-btn
          color="primary"
          dark
          class="mb-2"
          v-bind="additem"
          v-on="on"
          >Tambahkan User</v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>

          </v-card-title>

          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="18" sm="10" md="6">
                  <v-text-field v-model="editedItem.nama" label="Nama"></v-text-field>
                </v-col>
                <v-col cols="18" sm="10" md="6">
                  <v-text-field v-model="editedItem.nama_lengkap" label="Nama Lengkap"></v-text-field>
                </v-col>
                <v-col cols="18" sm="10" md="6">
                  <v-text-field v-model="editedItem.alamat" label="Alamat"></v-text-field>
                </v-col>
                <v-col cols="18" sm="10" md="6">
                  <v-text-field v-model="editedItem.telepon" type="number" label="Telepon"></v-text-field>
                </v-col>
                <v-col cols="18" sm="10" md="6">
                  <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
                </v-col>
                <v-col class="d-flex" cols="18" sm="10" md="6">
                  <v-select
                  :items="jabatans"
                  v-model="editedItem.jabatan"
                  label="Jabatan"
                  ></v-select>
                </v-col>
                <v-col class="d-flex" cols="18" sm="10" md="6">
                  <v-select
                  :items="items"
                  v-model="editedItem.jenkel"
                  label="Jenis Kelamin"
                  ></v-select>
                </v-col>
                <v-col cols="12" sm="6" md="4">
                  <v-menu
                  ref="menu"
                  v-model="menu"
                  :close-on-content-click="false"
                  :return-value.sync="date"
                  transition="scale-transition"
                  offset-y
                  min-width="290px"
                  >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                    v-model="date"
                    label="Picker in menu"
                    prepend-icon="mdi-calendar"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="date" no-title scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
                    <v-btn text color="primary" @click="$refs.menu.save(date)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
              </v-col>
              <v-spacer></v-spacer>
              <v-col cols="18" sm="10" md="6">
                <v-text-field v-model="editedItem.tanggal_mulai_kerja" label="Tanggal Mulai Kerja"></v-text-field>
              </v-col>
              <v-col cols="18" sm="10" md="6">
                <v-text-field v-model="editedItem.tanggal_berhenti_kerja" label="Tanggal Berhenti Kerja"></v-text-field>
              </v-col>
              <v-col cols="18" sm="10" md="6">
                <v-text-field v-model="editedItem.keterangan" label="Keterangan"></v-text-field>
              </v-col>
              <v-col cols="18" sm="10" md="6">
               <v-switch v-model="BarangSwitchAktif" color="primary" label=" Aktif "></v-switch>
             </v-col>
             <v-col cols="18" sm="10" md="6">
               <v-text-field v-model="editedItem.password" type="password" label="Password"></v-text-field>
             </v-col>
             <v-col cols="18" sm="10" md="6">
               <v-text-field v-model="editedItem.password_konfirmasi" type="password" label="Konfirmasi Password"></v-text-field>
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
      text: 'Nama lengkap',
      align: 'start',
      value: 'nama_lengkap',
    },
    { text: 'Telepon', value: 'telepon' },
    { text: 'Email', value: 'email' },
    { text: 'Jabatan', value: 'jabatan' },
    { text: 'Jenis Kelamin', value: 'jenkel' },
    { text: 'Aksi', value: 'aksi', sortable: false },
    ],
    user: [],
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
      return this.editedIndex === -1 ? 'Tambahkan User' : 'Edit User'
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
      this.user = [
      {
        nama_lengkap: 'Argi Nur',
        telepon: '0881213123',
        email: 'name@gmail.com',
        jabatan: 'IT Department',
        jenkel: 'L',
        partnumber2: '-',
      },
      {
        nama_lengkap: 'Faturrohman',
        telepon: '0881213123',
        email: 'name@gmail.com',
        jabatan: 'IT Department',
        jenkel: 'P',
        partnumber2: '-',
      },
      {
        nama_lengkap: 'Refi',
        telepon: '0881213123',
        email: 'name@gmail.com',
        jabatan: 'IT Department',
        jenkel: 'L',
        partnumber2: '-',
      },
      {
        nama_lengkap: 'Fahreza',
        telepon: '0881213123',
        email: 'name@gmail.com',
        jabatan: 'IT Department',
        jenkel: 'L',
        partnumber2: '-',
      },
      {
        nama_lengkap: 'Muhammad',
        telepon: '0881213123',
        email: 'name@gmail.com',
        jabatan: 'IT Department',
        jenkel: 'L',
        partnumber2: '-',
      },
      {
        nama_lengkap: 'Yusuf',
        telepon: '0881213123',
        email: 'name@gmail.com',
        jabatan: 'IT Department',
        jenkel: 'L',
        partnumber2: '-',
      },
      {
        nama_lengkap: 'Asrori',
        telepon: '0881213123',
        email: 'name@gmail.com',
        jabatan: 'IT Department',
        jenkel: 'L',
        partnumber2: '-',
      },
      {
        nama_lengkap: 'Adi',
        telepon: '0881213123',
        email: 'name@gmail.com',
        jabatan: 'IT Department',
        jenkel: 'L',
        partnumber2: '-',
      },
      {
        nama_lengkap: 'Kurnia',
        telepon: '0881213123',
        email: 'name@gmail.com',
        jabatan: 'IT Department',
        jenkel: 'L',
        partnumber2: '-',
      },
      {
        nama_lengkap: 'Wawan',
        telepon: '0881213123',
        email: 'name@gmail.com',
        jabatan: 'IT Department',
        jenkel: 'L',
        partnumber2: '-',
      },
      ]
    },

    editItem (item) {
      this.editedIndex = this.user.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem (item) {
      const index = this.user.indexOf(item)
      confirm('Anda Yakin Menghapus User ini?') && this.user.splice(index, 1)
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
        Object.assign(this.user[this.editedIndex], this.editedItem)
      } else {
        this.user.push(this.editedItem)
      }
      this.close()
    },
  },
}
</script>