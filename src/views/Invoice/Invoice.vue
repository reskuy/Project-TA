<template>
  <v-data-table
    :headers="headers"
    :items="invoice"
    sort-by="name"
    class="elevation-1 d.flex"
  >
    <template v-slot:top>
      <v-toolbar flat>
        <v-toolbar-title>Daftar Invoice</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="1000px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
              New Item
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.KodeNota"
                      label="Kode Nota"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-combobox
                      v-model="editedItem.MataUang"
                      label="Mata Uang"
                      :items="itemsMataUang"
                    ></v-combobox>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-menu
                      v-model="menu1"
                      :close-on-content-click="false"
                      :nudge-right="40"
                      transition="scale-transition"
                      offset-y
                      min-width="290px"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                          v-model="editedItem.Tanggal"
                          label="Tanggal"
                          prepend-icon="mdi-calendar"
                          readonly
                          v-bind="attrs"
                          v-on="on"
                        ></v-text-field>
                      </template>
                      <v-date-picker
                        v-model="editedItem.Tanggal"
                        @input="menu1 = false"
                      ></v-date-picker>
                    </v-menu>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.Kurs"
                      label="Kurs"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.Pelanggan"
                      label="Pelangan"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.Refrensi"
                      label="Refrensi"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field v-model="editedItem.NomorWO" label="Nomer WO">
                      <template v-slot:append-outer>
                        <CariWo />
                      </template>
                    </v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.Kass"
                      label="Kass"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.NomorRangka"
                      label="Nomer Rangka"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.KTtg"
                      label="KT tg"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.NomorMesin"
                      label="Nomor Mesin"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.Ddtb"
                      label="Dd tb"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.NomorPolisi"
                      label="Nomor Polisi"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.Kppn"
                      label="KPpn"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.Odometer"
                      label="Odometer"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.Kexc"
                      label="Kexc"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.PaymentTerm"
                      label="Payment Term"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.Kund"
                      label="KUND"
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-btn class="mb-2">Load Estimasi Terakhir</v-btn>
                </v-row>
                <v-row>
                  <v-tabs>
                    <v-tab
                      >Barang
                      <v-tab-item>h1 tes</v-tab-item>
                    </v-tab>
                    <v-tab>Pekerjaan</v-tab>
                    <v-tab-item>
                      <v-card>
                        <Barang />
                      </v-card>
                    </v-tab-item>
                    <v-tab-item>
                      <v-card>
                        <v-container>
                          <Pekerjaan />
                        </v-container>
                      </v-card>
                    </v-tab-item>
                  </v-tabs>
                </v-row>
                <v-row class="flex-row-reverse">
                  <v-col cols="4">
                    <v-text-field></v-text-field>
                  </v-col>
                  <v-col cols="1">
                    <v-subheader>DPP</v-subheader>
                  </v-col>
                </v-row>
                <v-row class="flex-row-reverse">
                  <v-col cols="3">
                    <v-text-field></v-text-field>
                  </v-col>

                  <v-col cols="1">
                    <v-text-field></v-text-field>
                  </v-col>
                  <v-col cols="1">
                    <v-subheader>PPN</v-subheader>
                  </v-col>
                </v-row>
                <v-row class="flex-row-reverse">
                  <v-col cols="4">
                    <v-text-field></v-text-field>
                  </v-col>
                  <v-col cols="1">
                    <v-subheader>Total Bayar</v-subheader>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close"> Cancel </v-btn>
              <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:[`item.WriteOff`]>
      <v-checkbox dense small class="mr-2"></v-checkbox>
    </template>
    <template v-slot:[`item.actions`]="{ item }">
      <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
      <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize"> Reset </v-btn>
    </template>
  </v-data-table>
</template>

<script>
import Barang from "./barang";
import Pekerjaan from "./pekerjaan";
import CariWo from "../../components/Invoice/CariWo";
export default {
  components: {
    Pekerjaan,
    Barang,
    CariWo,
  },
  data: () => ({
    dialog: false,
    dialogWo: false,
    date: new Date().toISOString().substr(0, 10),
    menu1: false,
    itemsMataUang: ["Dollar", "Rupiah", "Euro"],
    invoice_products: [
      {
        product_no: "",
        product_name: "",
        product_price: "",
        product_qty: "",
        line_total: 0,
      },
    ],
    headers: [
      {
        text: "Kode Nota",
        align: "start",
        sortable: false,
        value: "KodeNota",
      },
      { text: "Tanggal", value: "Tanggal" },
      { text: "Jenis Work Order", value: "JenisWorkOrder", width: "150px" },
      { text: "Lokasi", value: "Lokasi", width: "150px" },
      { text: "Ket WO", value: "KetWO", width: "150px" },
      { text: "Nama Pelanggan", value: "NamaPelanggan", width: "150px" },
      { text: "Nama Pemilik", value: "NamaPemilik", width: "150px" },
      { text: "Nomor Rangka", value: "NomorRangka" },
      { text: "Nomor Mesin", value: "NomorMesin" },
      { text: "Nomor Polisi", value: "NomorPolisi", width: "150px" },
      { text: "Odometer", value: "Odometer", width: "150px" },
      { text: "Status", value: "Status" },
      { text: "Keterangan Status", value: "KeteranganStatus" },
      { text: "Keterangan", value: "Keterangan" },
      { text: "Saran", value: "Saran" },
      { text: "Nomor WO", value: "NomorWO" },
      { text: "PaymentTerm", value: "PaymentTerm", width: "150px" },
      { text: "Total", value: "Total", width: "150px" },
      { text: "Diskon", value: "Diskon", width: "150px" },
      { text: "DPP", value: "DPP", width: "150px" },
      { text: "PPn", value: "PPn", width: "150px" },
      { text: "PPn Persen", value: "PPnPersen", width: "150px" },
      { text: "PPn Persen Manual", value: "PPnPersenManual", width: "160px" },
      { text: "ON Risk", value: "OnRisk", width: "150px" },
      { text: "Total Bayar", value: "TotalBayar", width: "150px" },
      { text: "Nett", value: "Nett", width: "150px" },
      { text: "Terbayar", value: "Terbayar", width: "150px" },
      { text: "Sisa Bayar", value: "SisaBayar", width: "150px" },
      { text: "Kass", value: "Kass", width: "150px" },
      { text: "KTtg", value: "KTtg", width: "150px" },
      { text: "Ddtb", value: "Ddtb", width: "150px" },
      { text: "KPpn", value: "Kppn", width: "150px" },
      { text: "Kexc", value: "Kexc", width: "150px" },
      { text: "Kund", value: "Kund", width: "150px" },
      { text: "Mata Uang", value: "MataUang", width: "150px" },
      { text: "Kurs", value: "Kurs", width: "150px" },
      { text: "Refrensi", value: "Refrensi", width: "150px" },
      {
        text: "Keterangan Penagihan",
        value: "KeteranganPenagihan",
        width: "150px",
      },
      { text: "PIC", value: "PIC", width: "150px" },
      { text: "Info Pemilik", value: "InfoPemilik", width: "150px" },
      { text: "No Faktur Pajak", value: "NoFakturPajak", width: "150px" },
      { text: "Tgl Kirim", value: "TglKirim", width: "150px" },
      {
        text: "Tgl Konfirmasi Terima",
        value: "NetTglKonfirmasiTerima",
        width: "150px",
      },
      { text: "No Resi", value: "NoResi", width: "150px" },
      { text: "Jumlah Cetak", value: "JumlahCetak", width: "150px" },
      { text: "Tanggal Masuk", value: "TanggalMasuk" },
      { text: "Tanggal Keluar", value: "TanggalKeluar" },
      { text: "Write Off", value: "WriteOff" },
      { text: "Di Buat Tgl", value: "DiBuatTgl", width: "100px" },
      { text: "Di Buat Oleh", value: "DiBuatOleh", width: "100px" },
      { text: "Di Ubah Tgl", value: "DiUbahTgl", width: "100px" },
      { text: "Di Ubah Oleh", value: "DiUbahOleh", width: "110px" },
      { text: "Pelanggan", value: "Pelanggan" },
      { text: "Sell To", value: "SellTo" },

      { text: "Actions", value: "actions", sortable: false },
    ],
    invoice: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
    },
    defaultItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
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
    addNewRow() {
      this.invoice_products.push({
        product_no: "",
        product_name: "",
        product_price: "",
        product_qty: "",
        line_total: 0,
      });
    },

    initialize() {
      this.invoice = [
        {
          KodeNota: "0101/FW/2007/000024",
          Tanggal: "03/07/2020",
          JenisWorkOrder: "CAR",
          Lokasi: "HO",
          KetWO: "KPP Indexim Kim",
          NamaPelanggan: "Frozen Yogurt",
          NamaPemilik: "Frozen Yogurt",
          NomorRangka: "0101/FW/2007/000024",
          NomorMesin: "0101/FW/2007/000024",
          NomorPolisi: "KT 2055 IW",
          Odometer: "0",
          Status: "0101/FW/2007/000024",
          KeteranganStatus: "0101/FW/2007/000024",
          Keterangan: "0101/FW/2007/000024",
          Saran: "0101/FW/2007/000024",
          NomorWO: "0101/WO/2006/000159",
          PaymentTerm: "0",
          Total: 7500000,
          Diskon: 0.0,
          DPP: 2500000,
          PPn: 250000,
          PPnPersen: 10.0,
          PPnPersenManual: 10.0,
          OnRisk: 0,
          TotalBayar: 10000000,
          Nett: 1000000,
          Terbayar: 10000000,
          SisaBayar: 10000000,
          Kass: 10000000,
          KTtg: 10000000,
          Ddtb: 1000000,
          Kppn: 0,
          Kexc: 0,
          Kund: 0,
          MataUang: "IDR",
          Kurs: 1,
          Refrensi: "",
          KeteranganPenagihan: "proses payment 06",
          PIC: "Me",
          InfoPemilik: "Me",
          NoFakturPajak: "13124124",
          TglKirim: "10/08/2020",
          TglKonfirmasiTerima: "10/08/2020",
          NoResi: "2313123",
          JumlahCetak: 2,
          TanggalMasuk: "10/08/2020",
          TanggalKeluar: "10/08/2020",
          WriteOff: "",
          DiBuatTgl: "10/08/2020",
          DiBuatOleh: "0101/DESY",
          DiUbahTgl: "10/08/2020",
          DiUbahOleh: "0101/DESY",
          Pelanggan: "0101/0284",
          SellTo: "0101/0284",
        },
        {
          KodeNota: "0101/FW/2007/000033",
          Tanggal: "04/07/2020",
          JenisWorkOrder: "HE",
          Lokasi: "HO",
          KetWO: "KPP Indexim Kim",
          NamaPelanggan: "Frozen Yogurt",
          NamaPemilik: "Frozen Yogurt",
          NomorRangka: "0101/FW/2007/000024",
          NomorMesin: "0101/FW/2007/000024",
          NomorPolisi: "KT 2055 IW",
          Odometer: "0",
          Status: "-",
          KeteranganStatus: "-",
          Keterangan: "-",
          Saran: "-",
          NomorWO: "0101/WO/2006/000129",
          PaymentTerm: "0",
          Total: 7500000,
          Diskon: 0.0,
          DPP: 2500000,
          PPn: 250000,
          PPnPersen: 10.0,
          PPnPersenManual: 10.0,
          OnRisk: 0,
          TotalBayar: 10000000,
          Nett: 1000000,
          Terbayar: 10000000,
          SisaBayar: 10000000,
          Kass: 10000000,
          KTtg: 10000000,
          Ddtb: 1000000,
          Kppn: 0,
          Kexc: 0,
          Kund: 0,
          MataUang: "IDR",
          Kurs: 1,
          Refrensi: "",
          KeteranganPenagihan: "proses payment 06",
          PIC: "Me",
          InfoPemilik: "Me",
          NoFakturPajak: "13124124",
          TglKirim: "10/08/2020",
          TglKonfirmasiTerima: "10/08/2020",
          NoResi: "2313123",
          JumlahCetak: 4,
          TanggalMasuk: "10/08/2020",
          TanggalKeluar: "10/08/2020",
          WriteOff: true,
          DiBuatTgl: "10/08/2020",
          DiBuatOleh: "0101/TITIN",
          DiUbahTgl: "10/08/2020",
          DiUbahOleh: "0101/TITIN",
          Pelanggan: "0101/0284",
          SellTo: "0101/0284",
        },
      ];
    },

    editItem(item) {
      this.editedIndex = this.invoice.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.invoice.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.invoice.splice(index, 1);
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
        Object.assign(this.invoice[this.editedIndex], this.editedItem);
      } else {
        this.invoice.push(this.editedItem);
      }
      this.close();
    },
  },
};
</script>