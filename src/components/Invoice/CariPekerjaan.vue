<template>
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
                <v-card>
                  <v-card-title>
                    Cari Pekerjaan
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
                    :headers="headers"
                    :items="pekerjaan"
                    :search="search"
                    item-key="kode"
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
    data(){
        return{
          search:'',
            dialog: false,
            headers:[
                {text:"Kode", value:"kode"},
                {text:"Nama Pekerjaan", value:"NamaPekerjaan"},
                {text:"Grup Pekerjaan", value:"GrupPekerjaan"},
                {text:"Grup Kendaraan", value:"GrupKendaraan"},
                {text:"Harga Jual Default", value:"HargaJualDefault"},
                {text:"Harga Beli Default", value:"HargaBeliDefault"},
            ],
            pekerjaan: [
              {
                kode:"01/0001",
                NamaPekerjaan:"Borongan",
                GrupPekerjaan:"Pekerjaan Perbaikan",
                GrupKendaraan:"-",
                HargaBeliDefault:0,
                HargaJualDefault:0
              },
              {
                kode:"01/0002",
                NamaPekerjaan:"Repair Cabin",
                GrupKendaraan:"-",
                GrupPekerjaan:"Pekerjaan Perbaikan",
                HargaJualDefault:0,
                HargaBeliDefault:0,
              },
              {
                kode:"01/0003",
                NamaPekerjaan:"Repair AC",
                GrupPekerjaan:"Pekerjaan Perbaikan",
                GrupKendaraan:"-",
                HargaJualDefault:3500000,
                HargaBeliDefault:0
              },
              {
                kode:"01/0008",
                NamaPekerjaan:"Sewa Self Loader Truck",
                GrupPekerjaan:"Evakuasi, Mobilisasi, & Pengawalan",
                GrupKendaraan:"-",
                HargaJualDefault:0,
                HargaBeliDefault:0
              }
            ]
        }
    }
}
</script>

<style>

</style>