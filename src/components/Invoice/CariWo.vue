<template>
  <v-dialog v-model="dialogWo" width="1000">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="red lighten-2" dark v-bind="attrs" v-on="on">
        Cari WO
      </v-btn>
    </template>

    <v-card>
      <v-card-title>
        Cari Nomer WO
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <v-data-table
        v-model="selected"
        item-key="KodeWo"
        show-select
        @click:row="handleClick"
        :headers="headers"
        :items="wo"
        :search="search"
      >
        <template v-slot:top>
          <h5>WO: {{ selected }}</h5>
        </template>
      </v-data-table>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="primary" text @click="dialogWo = false"> I accept </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  data: () => ({
    search: '',
    selected: [],
    dialogWo: false,
    headers: [
      { text: "Kode WO", value: "KodeWo" },
      { text: "Tanggal", value: "Tanggal" },
      { text: "Nama Pelanggan", value: "NamaPelanggan" },
      { text: "Nomor Rangka", value: "NomorRangka" },
      { text: "Nomor Polisi", value: "NomorPolisi" },
      { text: "Nomor Mesin", value: "NomorMesin" },
      { text: "Keterangan", value: "Keterangan" },
    ],
    wo: [
      {
        KodeWo:"0101/WO/2006/000 100",
        Tanggal:"17/06/2020",
        NamaPelanggan:"Ronaldo",
        NomorRangka:"123214",
        NomorPolisi:"KT 231231",
        NomorMesin:"211312",
        Keterangan:"TA 2"
      },
      {
        KodeWo:"0101/WO/2006/000 104",
        Tanggal:"17/06/2020",
        NamaPelanggan:"Messi",
        NomorRangka:"123214",
        NomorPolisi:"KT 231231",
        NomorMesin:"211312",
        Keterangan:"WS TFI BPP"
      }
    ]
  }),
};
</script>

<style>
</style>