<template>
  <v-data-table
  dense
    :headers="selectedHeaders"
    :items="gudang"
    sort-by="kode"
    class="elevation-1"
    >

    <template v-slot:top>
      <v-toolbar flat color="white">

        <v-toolbar-title>Purchase Order</v-toolbar-title>

          <v-divider
            class="mx-6"
            inset
            vertical
          ></v-divider>

        <v-toolbar-title>List Purchase Order</v-toolbar-title>

          <v-spacer></v-spacer>
          <v-col>
          <v-select
      max-width="200"
      v-model="valueHeaders"
      :items="headers"
      label="Pilih Group"
      multiple
      class="mb-0"
      return-object
    >
      <template v-slot:selection="{ item, index }">
        <v-chip v-if="index === 0">
          <span>{{ item.text }}</span>
        </v-chip>
        <span
          v-if="index === 1"
          class="grey--text caption"
        >(+{{ valueHeaders.length - 1 }} lainnya)</span>
      </template>
    </v-select>
    </v-col>


            <v-dialog
              v-model="dialog"
              max-width="1200px"
              >
                
                <template v-slot:activator="{ on, additem }">
                  <v-btn
                    color="primary"
                    dark
                    class="mb-2"
                    v-bind="additem"
                    v-on="on">
                    Add Purchase Order
                  </v-btn>
                </template>

          <v-card>
                   <v-app-bar
      color="primary"
      dark
      dense 
    >           <span class="headline">{{ formTitle }}</span>
                   </v-app-bar>

              <v-card-text>
                <v-container>
                  <v-row dense>
                    <v-col cols="14"  md="6">
                      <v-text-field outlined dense
                        v-model="editedItem.kd_nota" 
                        label="Kode Nota">
                      </v-text-field>
                    </v-col>

                  <v-col cols="14"  md="2">
                   <v-menu
        v-model="menu_tanggal1"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field outlined dense
            v-model="editedItem.tanggalan"
            label="Tanggal"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
        locale="id"
          v-model="editedItem.tanggalan"
          @input="menu_tanggal1 = false"
        ></v-date-picker>
      </v-menu>
                  </v-col>

                  <v-col cols="14"  md="3">
                    <v-menu
        v-model="menu_tanggal2"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field outlined dense
            v-model="editedItem.tgl_kirim"
            label="Tanggal Kirim"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
        locale="id"
          :min="tanggal"
          v-model="editedItem.tgl_kirim"
          @input="menu_tanggal2 = false"
        ></v-date-picker>
      </v-menu>
                  </v-col>

                  <v-col cols="14"  md="1">
                    <v-text-field outlined dense
                      v-model="editedItem.kurs" 
                      label="Kurs">
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-combobox
                     v-model="editedItem.nm_supplier"
                      :items="data_supplier"
                      item-text="nama"
                      
                       label="Supplier"
                       outlined
                        dense
                    ></v-combobox>
                    {{editedItem.nm_supplier}}
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.billfrom" 
                      label="Bill From" required>
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.sellfrom" 
                      label="Sell From">
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.payment_term" 
                      label="Payment Term">
                    </v-text-field>
                  </v-col>

                  

                  <v-col cols="14"  md="6">
         <v-combobox
          v-model="editedItem.matauang"
          :items="matauang"
          label="Mata uang"
          outlined
          dense
        ></v-combobox>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.refrensi" 
                      label="Refrensi">
                    </v-text-field>
                  </v-col>
                  <v-col cols="12"  md="5">
        
                    <v-text-field
                     v-model="editedItem.nomor_wo"
                      
                       label="Nomor WO"
                       outlined
                        dense
                    ></v-text-field>
                  </v-col>
                  <v-col cols="2"  md="1">
                    <v-dialog
          v-model="dialog2"
          max-width="1200px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
         
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              <v-icon>mdi-dots-horizontal</v-icon>
            </v-btn>
          </template>
          <v-card>
             <v-app-bar
      color="primary"
      dark
      dense 
    >           <span class="headline">Work Order</span>
                   </v-app-bar>
            <v-card-text>
              <v-container>
                <v-card-title>
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
    :single-select="singleSelect"
    item-key="kd_wo"
    show-select
      :headers="headerswo"
      :items="itemspo"
      :search="search"
    ></v-data-table>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
                  </v-col>

                  <v-col cols="12"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.nomor_rangka" 
                      label="Nomor Rangka">
                    </v-text-field>
                  </v-col>
                 
{{selected}}
            

                  <v-col cols="14"  md="6">
                  <v-btn color="success" text >Load Part Order</v-btn>
                  </v-col>
                  <v-col cols="14"  md="6">
                    
                  </v-col>
                  <v-col cols="12">
                   <v-card>
                 <ItemsPurchaseOrder/>
                  </v-card>
                  </v-col>
                  <v-col cols="12"  md="8">
                    <v-text-field 
                     v-model="editedItem.nomor_wo"
                       label="Keterangan"
                       outlined
                        dense
                    ></v-text-field>
                  </v-col>
                  <v-col cols="6" md="4">
                    <v-text-field
                     v-model="editedItem.nomor_wo"
                      
                       label="Keterangan"
                       outlined
                        dense
                    ></v-text-field></v-col>

                     <v-col cols="5" md="2" offset-md="8">
                    <v-text-field
                     v-model="editedItem.nomor_wo"
                      
                       label="Keterangan"
                       outlined
                        dense
                    ></v-text-field></v-col>
                  <v-col cols="5" md="2" offset-md="0">
                    <v-text-field
                     v-model="editedItem.nomor_wo"
                      
                       label="Keterangan"
                       outlined
                        dense
                    ></v-text-field></v-col>
                  
                </v-row>
              </v-container>
            </v-card-text>
   
 
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="error" text @click="close">Batal</v-btn>
              <v-btn color="success" text @click="save">Simpan</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>

<template v-slot:[`item.apply`] = "{ item }">
      <v-checkbox 
      dense
      small
      @click="apply(item)"
      class="mr-2"
      ></v-checkbox>

    </template>

    <template v-slot:[`item.aksi`]= "{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)">
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)">
        mdi-delete
      </v-icon>

    </template>
    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize">Load Data</v-btn>
    </template>
 
    </v-data-table>
</template>
<script>
import api from '@/axios/http'
import ItemsPurchaseOrder from '@/views/purchase_order/items'
  export default {
    components: {
      ItemsPurchaseOrder
    },
    data: () => ({
        tanggal: new Date().toISOString().substr(0, 10),
      dialog: false,
      dialog2:false,
      tab:true,
      search: '',
      menu_tanggal1: false,
      menu_tanggal2: false,
      data_supplier: [],

      valueHeaders: [],
      selectedHeaders: [],
      matauang: [
          'Rupiah',
          'Dollar',
        ],

      GudangSwitchAktif: ['✓'],
      headers: [
        {
          text: 'Kode Nota',
          align: 'start',
          value: 'kd_nota',
        },
        { text: 'Tanggal', value: 'tanggalan'},
        { text: 'Nama Supplier', value: 'nm_supplier' },
        { text: 'Tanggal Kirim', value: 'tgl_kirim' },
        { text: 'Status', value: 'status' },
        { text: 'Total', value: 'total' },
        { text: 'Diskon', value: 'diskon' },
        { text: 'DPP', value: 'dpp' },
        { text: 'PPn', value: 'ppn' },
        { text: 'Total Bayar', value: 'total_bayar' },
        { text: 'Keterangan', value: 'keterangan' },
        { text: 'Referensi', value: 'referensi' },
        { text: 'Nomor Rangka', value: 'nomor_rangka' },
        { text: 'Nomor Polisi', value: 'nomor_polisi' },
        { text: 'Nomor WO', value: 'nomor_wo' },
        { text: 'Apply', value: 'apply' },
        { text: 'Dibuat Tanggal', value: 'dibuat_tgl' },
        { text: 'Aksi', value: 'aksi', sortable: false },
      ],

      singleSelect: true,
      selected: [],

      headerswo: [
        {
          text: 'Kode WO',
          align: 'start',
          value: 'kd_wo',
        },
        { text: 'Tanggal', value: 'tanggal'},
        { text: 'Nama Pelanggan', value: 'nm_pelanggan' },
        { text: 'Nomor Rangka', value: 'no_rangka' },
        { text: 'Nomor Polisi', value: 'no_pol' },
        { text: 'Nomor Mesin', value: 'no_mesin' },
        { text: 'Keterangan', value: 'keterangan' },
        { text: 'Aksi', value: 'aksi', sortable: false },
      ],
      gudang: [],
      itemspo: [],
      editedIndex: -1,
      editedItem: {
        kd_wo: '',
        kd_nota: '',
        tanggalan: '',
        nm_supplier: '',
        tgl_kirim: '',
        status: '',
        total: '',
        diskon: '',
        dpp: '',
        ppn: '',
        total_bayar: '',
        keterangan: '',
        referensi: '',
        nomor_rangka: '',
        nomor_polisi: '',
        nomor_wo: '',
        matauang: 'Rupiah',
        kurs: '1.00',
        payment_term: '',
        apply: true,
        dibuat_tgl: '',
      },
      defaultItem: {
        kd_nota: '',
        tanggalan: '',
        nm_supplier: '',
        tgl_kirim: '',
        status: '',
        total: '',
        diskon: '',
        dpp: '',
        ppn: '',
        total_bayar: '',
        keterangan: '',
        referensi: '',
        nomor_rangka: '',
        nomor_polisi: '',
        nomor_wo: '',
        apply: true,
        matauang: 'Rupiah',
        kurs: '1.00',
        payment_term: '',
        dibuat_tgl: ''
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Purchase Order' : 'Edit Purchase Order'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      valueHeaders(val) {
      this.selectedHeaders = val;
    },
    },

    created () {
      this.initialize(),
      this.selectedHeaders = this.headers,
      setInterval(this.getNow, 1000)
    },
    mounted() {
      this.getSupplier()
    },

    methods: {
      getSupplier() {
        api.get('/supplier').then(
          result => {
            console.log(result.data)
            this.data_supplier = result.data
          },
          error => {
            console.error(error)
          }
        )
      },
      initialize () {
        this.gudang = [
          {
            kd_nota:'0101/PO/2006/000055',
            tanggalan:'06/06/2020',
            nm_supplier:'LeonardoGordfrans',
            total: '1.500.000.00',
            diskon: '0.00',
            dpp: '1.500.000.00',
            ppn: '0.00',
            total_bayar: '1.500.000.00',
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tanggalan:'06/06/2020',
            nm_supplier:'Contoh2',
            total: '1.500.000.00',
            diskon: '0.00',
            dpp: '1.500.000.00',
            ppn: '0.00',
            total_bayar: '1.500.000.00',
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tanggalan:'06/06/2020',
            nm_supplier:'Contoh3',
            total: '1.500.000.00',
            diskon: '0.00',
            dpp: '1.500.000.00',
            ppn: '0.00',
            total_bayar: '1.500.000.00',
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
        ],
        this.itemspo = [
          {
            kd_wo: '0101/WO/2003/000650',
            tanggal: '2',
            nm_pelanggan: 'jajank',
            no_rangka: '1',
            no_pol : '1',
            no_mesin: '1',
            keterangan: '2'
          },
          {
            kd_wo: '0101/WO/2003/000190',
            tanggal: '2',
            nm_pelanggan: 'ujank',
            no_rangka: '1',
            no_pol : '1',
            no_mesin: '1',
            keterangan: '2'
          },
        ]
      },
      editItem (item) {
        this.editedIndex = this.gudang.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.gudang.indexOf(item)
        confirm('Anda Yakin Menghapus ini?') && this.gudang.splice(index, 1)
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
          Object.assign(this.gudang[this.editedIndex], this.editedItem)
        } else {
          this.gudang.push(this.editedItem)
        }
        this.close()
      },
      getNow: function(){
        let today = new Date() 
        let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        this.editedItem.dibuat_tgl = date
        this.editedItem.tanggalan = date
      }
    },
  }
</script>