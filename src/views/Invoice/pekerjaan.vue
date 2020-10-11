<template>
  <v-data-table
    :headers="headers"
    :items="pekerjaan"
    sort-by="JenisPekerjaan"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat>
        <v-toolbar-title>Pekerjaan</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <CariPekerjaan/>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="headline"
              >Are you sure you want to delete this item?</v-card-title
            >
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete"
                >Cancel</v-btn
              >
              <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                >OK</v-btn
              >
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:[`item.actions`]="{ item }">
      <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
      <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
    </template>
    <template v-slot:[`item.SubTotal`]="{ item }">{{
      item.Harga * item.Jumlah - item.DiskonRp
    }}</template>
    <template v-slot:[`item.DiskonRp`]="{ item }">
      {{ (item.DiskonRp = (item.Harga * item.DiskonPr) / 100) }}
    </template>
    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize"> Reset </v-btn>
    </template>
    <template v-slot:[`item.JenisPekerjaan`]="props">
      <v-edit-dialog
        :return-value.sync="props.item.JenisPekerjaan"
        @cancel="cancel"
        @open="open"
        @close="close"
      >
        {{ props.item.JenisPekerjaan }}
        <template v-slot:input>
          <v-text-field
            v-model="props.item.JenisPekerjaan"
            :rules="[max25chars]"
            label="Edit"
            single-line
            counter
          ></v-text-field>
        </template>
      </v-edit-dialog>
    </template>
  </v-data-table>
</template>


<script>
import CariPekerjaan from "../../components/Invoice/CariPekerjaan";
export default {
  components:{
    CariPekerjaan
  },
  data: () => ({
    dialog: false,
    selected: [],
    dialogDelete: false,
    headers: [
      {
        text: "Jenis Pekerjaan",
        align: "start",
        sortable: false,
        value: "JenisPekerjaan",
      },
      { text: "Perkiraan", value: "Perkiraan" },
      { text: "Keterangan", value: "Keterangan" },
      { text: "Jumlah", value: "Jumlah" },
      { text: "Rasio", value: "Rasio" },
      { text: "Harga", value: "Harga" },
      { text: "Diskon (%)", value: "DiskonPr" },
      { text: "Diskon (Rp)", value: "DiskonRp" },
      { text: "Sub Total", value: "SubTotal" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    pekerjaan: [],
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
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      this.pekerjaan = [
        {
          JenisPekerjaan: "JASA MURNI PERBAIKAN",
          Perkiraan: "PENDAPATAN JASA HE",
          Keterangan: "",
          Jumlah: 2,
          Rasio: 1,
          Harga: 4000000,
          DiskonPr: 1,
          DiskonRp: 100,
          SubTotal: 4000000,
        },
        {
          JenisPekerjaan: "TRANSPORTASI & AKOMODASI",
          Perkiraan: "PENDAPATAN TRANSPORT",
          Keterangan: "",
          Jumlah: 1,
          Rasio: 1,
          Harga: 4000000,
          DiskonPr: 0.0,
          DiskonRp: 0.0,
          SubTotal: 4000000,
        },
      ];
    },

    editItem(item) {
      this.editedIndex = this.pekerjaan.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.pekerjaan.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.pekerjaan.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.pekerjaan[this.editedIndex], this.editedItem);
      } else {
        this.pekerjaan.push(this.editedItem);
      }
      this.close();
    },
  },
};
</script>

<style>
</style>