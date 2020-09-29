<template>
  <v-container>
    <h3 class="mt-4 mb-4 ml-4">DAFTAR PELANGGAN</h3>
    <v-divider vertical></v-divider>
    <v-data-table fixed-header :headers="headers" :items="item" sort-by="kode">
      <template v-slot:top>
        <v-toolbar flat color="white">
          <!-- <v-toolbar-title>DAFTAR PELANGGAN</v-toolbar-title> -->

          <v-dialog v-model="dialog" max-width="1000px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="primary" dark v-bind="attrs" v-on="on">
                <v-icon>mdi-plus</v-icon>TAMBAH
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="2">
                      <v-text-field
                        v-model="editedItem.kode"
                        label="Kode"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="8">
                      <v-text-field
                        v-model="editedItem.name"
                        label="Nama"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="2">
                      <v-text-field
                        v-model="editedItem.badanHukum"
                        label="Badan Hukum"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="12">
                      <v-text-field
                        v-model="editedItem.alamat"
                        label="Alamat"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.kota"
                        label="Kota"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.kodePos"
                        label="Kode Pos"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.negara"
                        label="Negara"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.telp"
                        label="Telepon"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.fax"
                        label="Fax"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.email"
                        label="Email"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.cp"
                        label="Contact Person"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.sales"
                        label="Sales Person"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.groupPelanggan"
                        label="Group Pelanggan"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-switch
                        v-model="editedItem.Aktif"
                        color="primary"
                        label="Aktif"
                      ></v-switch>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.kreditLimit"
                        label="Kredit Limit"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.lamaKredit"
                        label="Lama Kredit"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.CustSince"
                        label="Cust Since"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.memo"
                        label="Memo"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.asuransi"
                        label="Asuransi"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">
                  <v-icon>mdi-arrow-left</v-icon>Cancel
                </v-btn>
                <v-btn color="success" @click="save">
                  <v-icon class="mr-4">fas fa-save</v-icon>Save
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-text-field
            append-icon="mdi-magnify"
            single-line
            hide-details
            label="Search"
          ></v-text-field>
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
        <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    headers: [
      { text: "Kode", value: "kode" },
      { text: "Nama", value: "name" },
      { text: "Badan Hukum", value: "badanHukum" },
      { text: "Alamat", value: "alamat" },
      { text: "Kota", value: "kota" },
      { text: "Kode Pos", value: "kodePos" },
      { text: "Negara", value: "negara" },
      { text: "Telp", value: "telp" },
      { text: "Fax", value: "fax" },
      { text: "Email", value: "email" },
      { text: "Contact Person", value: "cp" },
      { text: "Sales Person", value: "sales" },
      { text: "Group Pelanggan", value: "groupPelanggan" },
      { text: "Aktif", value: "aktif" },
      { text: "Kredit Limit", value: "kreditLimit" },
      { text: "Lama Kredit", value: "lamaKredit" },
      { text: "Cust Since", value: "CustSince" },
      { text: "Memo", value: "memo" },
      { text: "Asuransi", value: "asuransi" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    item: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      badanHukum: "",
      alamat: "",
      kota: "",
      kodePos: "",
      negara: "",
      telp: "",
      fax: "",
      email: "",
      cp: "",
      sales: "",
      groupPelanggan: "",
      aktif: "",
      kreditLimit: "",
      lamaKredit: "",
      CustSince: "",
      memo: "",
      asuransi: "",
    },
    defaultItem: {
      name: "",
      badanHukum: "",
      alamat: "",
      kota: "",
      kodePos: "",
      negara: "",
      telp: "",
      fax: "",
      email: "",
      cp: "",
      sales: "",
      groupPelanggan: "",
      aktif: "",
      kreditLimit: "",
      lamaKredit: "",
      CustSince: "",
      memo: "",
      asuransi: "",
    },
  }),
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Add New Customer" : "Edit Customer";
    },
  },
  watch: {
    dialog(val) {
      val || this.close();
    },
  },
  created() {
    this.initialize();
  },
  methods: {
    initialize() {
      this.item = [
        {
          kode: "001",
          name: "Trakindo Utama Tbk",
          badanHukum: "PT",
          alamat: "Jl. Cipto Mangun Kusumo",
          kota: "Samarinda",
          kodePos: 75131,
          negara: "Indonesia",
          telp: "0541 - 72222",
          fax: "0541 - 72222",
          email: "test@yahoo.co.id",
          cp: "+6285372722727",
          sales: "Ronaldo Messi",
          groupPelanggan: "test",
          aktif: "Aktif",
          kreditLimit: "5 Tahun",
          lamaKredit: "3 Tahun",
          CustSince: "Test",
          memo: "nothing",
          asuransi: "nothing",
        },
        {
          kode: "002",
          name: "Pama Persada Nusantara",
          badanHukum: "PT",
          alamat:
            "Jl. Rawagelam 1 No. 9 Kawasan Industri Pulogadung Jakarta Timur ",
          kota: "Samarinda",
          kodePos: 13930,
          negara: "Indonesia",
          telp: "0541 - 72222",
          fax: "0541 - 72222",
          email: "test@yahoo.co.id",
          cp: "+6285372722727",
          sales: "Ronaldo",
          groupPelanggan: "test",
          aktif: "Aktif",
          kreditLimit: "5 Tahun",
          lamaKredit: "3 Tahun",
          CustSince: "Test",
          memo: "nothing",
          asuransi: "nothing",
        },
        {
          kode: "003",
          name: "Pertamina Hulu Mahakam",
          badanHukum: "PT",
          alamat:
            "Jl. Rawagelam 1 No. 9 Kawasan Industri Pulogadung Jakarta Timur ",
          kota: "Samarinda",
          kodePos: 75131,
          negara: "Indonesia",
          telp: "0541 - 72222",
          cp: "+6285372722727",
          sales: "Ronaldo",
        },
      ];
    },
    editItem(item) {
      this.editedIndex = this.item.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    deleteItem(item) {
      const index = this.item.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.item.splice(index, 1);
    },
    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.item[this.editedIndex], this.editedItem);
      } else {
        this.item.push(this.editedItem);
      }
      this.close();
    },
  },
};
</script>

<style></style>