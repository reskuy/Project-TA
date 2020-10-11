<template>
  <v-dialog v-model="dialog" max-width="1000px">
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        color="primary"
        dark
        class="mb-2"
        v-bind="attrs"
        v-on="on"
      >
        New Item
      </v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="headline">{{ formTitle }}</span>
      </v-card-title>

      <v-card-text>
        <v-container>
          <v-card>
            <v-card-title>
              Cari Barang
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
              :headers="headers"
              :items="barang"
              :search="search"
              v-model="selected"
              item-key="KodeBarang"
              show-select
              @click:row="handleClick"
            ></v-data-table>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="primary" text @click="dialog = false">
                I accept
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>
  
</template>

<script>
export default {
    data() {
        return{
            search:'',
            dialog: false,
            selected: [],
            headers:[
                {text:"Kode Barang", value:"KodeBarang"},
                {text:"Nama", value:"Nama"},
                {text:"Kategori", value:"Kategori"},
                {text:"Sub Kategori", value:"SubKategori"},
                {text:"Part Number 1", value:"PartNumber1"},
                {text:"Part Number 2", value:"PartNumber2"},
                {text:"Merk", value:"Merk"},
                {text:"Satuan", value:"Satuan"},
                {text:"Memo", value:"Memo"},
            ],
            barang:[
              {
                KodeBarang:"01/0000001",
                Nama:"LAMP ASSY TURN SIGNAL SH",
                Kategori:"-",
                SubKategori:"-",
                PartNumber1:"81510 E0010",
                PartNumber2:"",
                Merk:"HINO",
                Satuan:"",
                Memo:""
              },
              {
                KodeBarang:"01/0000002",
                Nama:"LAMP ASSY TURN SIGNAL LH",
                Kategori:"-",
                SubKategori:"-",
                PartNumber1:"81510 E0010",
                PartNumber2:"",
                Merk:"HINO",
                Satuan:"",
                Memo:""
              }
            ]
        }
    }
}
</script>

<style>

</style>