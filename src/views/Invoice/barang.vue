<template>
  <v-container>
    <div>
      <h5>Barang: {{ selected }}</h5>
      <v-data-table
        v-model="selected"
        :headers="headers"
        :items="dtbarang"
        item-key="name"
        show-select
        @click:row="handleClick"
        class="elevation-1"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Barang</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            
              <CariBarang/>
          </v-toolbar>
        </template>
        <template v-slot:[`item.BarangBekas`]>
          <v-checkbox dense small class="mr-2"></v-checkbox>
        </template>
        <template v-slot:[`item.barang`]="props">
          <v-edit-dialog
            :return-value.sync="props.item.barang"
            @save="save"
            @cancel="cancel"
            @open="open"
            @close="close"
          >
            {{ props.item.barang }}
            <template v-slot:input>
              <v-text-field
                v-model="props.item.barang"
                :rules="[max25chars]"
                label="Edit"
                single-line
                counter
              ></v-text-field>
            </template>
          </v-edit-dialog>
        </template>
        <template v-slot:[`item.jumlah`]="props">
          <v-edit-dialog
            :return-value.sync="props.item.jumlah"
            @save="save"
            @cancel="cancel"
            @open="open"
            @close="close"
          >
            {{ props.item.jumlah }}
            <template v-slot:input>
              <v-text-field
                v-model="props.item.jumlah"
                :rules="[max25chars]"
                label="Edit"
                single-line
                counter
              ></v-text-field>
            </template>
          </v-edit-dialog>
        </template>
        <template v-slot:[`item.diskon`]="props">
          <v-edit-dialog
            :return-value.sync="props.item.diskon"
            @save="save"
            @cancel="cancel"
            @open="open"
            @close="close"
          >
            {{ props.item.diskon }}
            <template v-slot:input>
              <v-text-field
                v-model="props.item.diskon"
                :rules="[max25chars]"
                label="Edit"
                single-line
                counter
              ></v-text-field>
            </template>
          </v-edit-dialog>
        </template>
        <template v-slot:[`item.diskonRp`]="{ item }">
      {{ (item.diskonRp = (item.harga * item.diskon) / 100) }}
    </template>
    
    <template v-slot:[`item.subTotal`]="{ item }">{{
      item.harga * item.jumlah - item.diskonRp
    }}</template>
      </v-data-table>
    </div>
  </v-container>
</template>

<script>
import CariBarang from "../../components/Invoice/CariBarang";
export default {
  components:{
    CariBarang
  },
  data() {
    return {
      dialog: false,
      singleSelect: false,
      selected: [],
      headers: [
        { text: "Barang Bekas", value: "BarangBekas" },
        {
          text: "Barang",
          align: "start",
          sortable: false,
          value: "barang",
        },

        { text: "Nama", value: "name", width: "160px" },
        { text: "Part Number 1", value: "partNumber1", width: "150px" },
        { text: "Merk", value: "merk" },
        { text: "Kendaran", value: "kendaraan" },
        { text: "Jumlah", value: "jumlah" },
        { text: "Satuan", value: "satuan" },
        { text: "Harga", value: "harga" },
        { text: "Diskon (%)", value: "diskon" },
        { text: "Diskon (Rp)", value: "diskonRp" },
        { text: "Sub Total", value: "subTotal" },
      ],
      dtbarang: [
        {
          barang: "0000247",
          name: "ALL PART",
          partNumber1: "ALL",
          merk: "ALL",
          kendaraan: "ALL",
          jumlah: 1,
          satuan: "PCS",
          harga: 15000000,
          diskon: 0.0,
          diskonRp: 0.0,
          subTotal: 15000000,
        },
        {
          name: "Ice cream sandwich",
          partNumber1: "ALL",
          merk: "ALL",
          kendaraan: "ALL",
          jumlah: 1,
          satuan: "PCS",
          harga: 15000000,
          diskon: 0.0,
          diskonRp: 0.0,
          subTotal: 15000000,
        },
        {
          name: "Eclair",
          partNumber1: "ALL",
          merk: "ALL",
          kendaraan: "ALL",
          jumlah: 1,
          satuan: "PCS",
          harga: 15000000,
          diskon: 0.0,
          diskonRp: 0.0,
          subTotal: 15000000,
        },
      ],
    };
  },
};
</script>

<style>
</style>