<template>
        <v-col cols="12" md="12">
        <v-card class="elevation-4">
          <v-toolbar
            flat
            dark
            dense
            color='blue darken-4'
            class="elevation-1"
            >
            <v-toolbar-title 
              dark
            >
              <v-icon>mdi-cart</v-icon>
              Internal Part Order
            </v-toolbar-title>
            <v-divider
              class="mx-4"
              inset
              vertical
            >
            </v-divider>
            <v-spacer></v-spacer>
      <v-dialog
              v-model="dialog"
              max-width="1200px"
            >

            <template v-slot:activator="{ on, attrs }">
              <v-btn
                dark
                small
                rounded
                color="blue darken-4"
                class="mb-2"
                v-bind="attrs"
                v-on="on"
              >
                <v-icon>mdi-plus</v-icon>
              </v-btn>
            </template>

            <v-card>
              <v-toolbar
                dark
                dense
                color= 'blue darken-4'
                class="elevation-1"
              >
              <v-toolbar-title dark>
                <v-icon>mdi-cart-plus</v-icon>
              </v-toolbar-title>
              <span class="headline">{{ formTitle }}</span>
            </v-toolbar>
            
           <v-card-text>
                <v-container>
                <v-card class="pa-2" max-width="1200">
                  <v-row dense>
                  <v-col cols="12" md="4">
                    <v-text-field
                     v-model="editedItem.NoPartOrder"
                       label="Kode Nota"
                       outlined
                        dense
                    ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="5">
                   <v-text-field outlined dense
                      v-model="editedItem.NomorWO"
                      label="Nomor Work Order"
                      append-icon="mdi-dots-horizontal"
                      @click:append="dialogwo = !dialogwo">
                    </v-text-field>
                </v-col>
  
                    <v-dialog
          v-model="dialogwo"
          max-width="1200px"
        >
          <v-card>
             <v-app-bar
      color="blue darken-4"
      dark
      dense 
    >           <span class="headline">Nomor Work Order</span>
                   </v-app-bar>
            <v-card-text>
              <v-container>
    <ejs-grid 
                :dataSource="workorder" height='200' width='100%'
                :allowReordering = true
                :editSettings='editSettings'
                :selectionSettings='selectionOptionsSatuan'
                :allowSorting='true'
                :toolbar='toolbarOptions'
                :allowFiltering='true'
                :filterSettings='filterOptions'
                :allowResizing='true'
                :allowPaging='true'
                :pageSettings='pageSettings'
                :commandClick="commandClick"
                :rowSelected="rowSelectedNomorWO" 
                >
                <e-columns>
                
                    <e-column 
                      :filter='filter'
                      field='KodeNota' 
                      headerText='Nomor Work Order' 
                      textAlign='Left'
                      width=180
                      >
                    </e-column>

                      <e-column
                      field='Tanggal'
                      headerText='Tanggal'
                      width=250
                      >
                    </e-column>

                    <e-column
                      :filter='filter'
                      field='NomorRangka' 
                      headerText='Nomor Rangka' 
                      width=170
                      >
                    </e-column>

                    <e-column
                      field='JenisWorkOrder'
                      headerText='Jenis Work Order'
                      width=170
                      >
                    </e-column>
                      <e-column
                      field='NomorPolisi'
                      headerText='Nomor Polisi'
                      width=170
                      >
                    </e-column>
                    <e-column
                      field='NamaKendaraan'
                      headerText='Nama Kendaraan'
                      width=170
                      >
                    </e-column>
                  </e-columns>
                </ejs-grid>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="closeWO"
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
    
      <v-col cols="12" md="3">
                    <v-menu
                    v-model="menutanggal"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    tranition="scale-transition"
                    offset-y
                    min-width="290px">
                   <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                    v-model="editedItem.Tanggal"
                       label="Tanggal"
                       outlined
                        dense
                        append-icon="mdi-calendar"
                        v-bind="attrs"
                        v-on="on"
                    ></v-text-field>
                    </template>
        <v-date-picker
        locale="id"
        v-model="editedItem.Tanggal"
          @input="menutanggal = false"
          :min="HariIni"
        ></v-date-picker>
      </v-menu>
      </v-col>
      <v-col cols="12" md="12"> 
                     <v-btn>Load Estimasi Terakhir</v-btn>
                     </v-col>
                     {{itembarangipo}}
                </v-row>
                </v-card>
         <v-col cols="12" md="12">            
                  <BarangInternalPartOrder ref='BarangIPO' @SyncItemBarangIPO='rowSelectedBarang' :isi='itembarangipo'/>
         </v-col>
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

            <div id="app">
                <ejs-grid 
                :dataSource="data" height='300' width='100%'
                :allowReordering = true
                :editSettings='editSettings'
                :selectionSettings='selectionOptions'
                :allowGrouping='true'
                :groupSettings='groupSettings'
                :allowSorting='true'
                :allowMultiSorting='true'
                :toolbar='toolbarOptions'
                :allowFiltering='true'
                :filterSettings='filterOptions'
                :allowResizing='true'
                :allowPaging='true'
                :pageSettings='pageSettings'
                :commandClick="commandClick"
                >
                <e-columns>
                
                    <e-column 
                      :filter='filter'
                      fieldText=''
                      field='KodeNota' 
                      headerText='No Part Order' 
                      textAlign='Left'
                      width=180
                      >
                    </e-column>

                      <e-column
                      field='Tanggal'
           
                      headerText='Tanggal'
                      width=150
                      >
                    </e-column>
                    <!-- <ejs-datepicker field='tgl' headerText='Tanggal' width='150' id="datepicker" locale='id' ></ejs-datepicker> -->
                    <e-column
                      :filter='filter'
                      field='NoWorkOrder'  
                      headerText='No Work Order' 
                      width=170>
                    </e-column>
                    <e-column
                      field='JenisWorkOrder'
                      headerText='Jenis Work Order'
                      width=170
                      >
                    </e-column>

                    <e-column
                      field='NomorPolisi'
                      headerText='Nomor Polisi'
                      textAlign='Right'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='TipeKendaraan'
                      headerText='Tipe Kendaraan'
                      textAlign='Right'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='Warna'
                      headerText='Warna'
                      textAlign='Right'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='NamaBarang'
                      headerText='Nama Barang'
                      textAlign='Right'
                      format='C2'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='PartNumber1'
                      headerText='Part Number 1'
                      textAlign='Right'
                      format='C2'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='Keterangan'
                      headerText='Keterangan'
                      textAlign='Right'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='Merk'
                      headerText='Merk'
                      textAlign='Right'
                      width=160
                      >
                    </e-column>

                  <e-column
                    :filter='filter'
                    field='Kendaraan'
                    headerText='Kendaraan'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>

                  <e-column
                    :filter='filter'
                    field='KodeSupplier'
                    headerText='Kode Supplier'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>
                  <e-column
                    :filter='filter'
                    field='Status'
                    headerText='Status'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>
                  <e-column
                    :filter='filter'
                    field='KeteranganStatus'
                    headerText='Keterangan Status'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>

                  <e-column
                    :filter='filter'
                    field='Terpenuhi'
                    headerText='Terpenuhi'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>
                </e-columns>
                
                <e-aggregates>
                  <e-aggregate>
                    <e-columns>
                      <e-column type="Sum" field="total" format='C2' :FooterTemplate="footerSum"></e-column>
                      <e-column type="Sum" field="total_bayar" format='C2' :FooterTemplate="footerSum"></e-column>
                    </e-columns>
                  </e-aggregate>

                  <e-aggregate>
                    <e-columns>
                      <e-column type="Max" field="total_bayar" format='C2' :CaptionTemplate="footerMax"></e-column>
                    </e-columns>
                  </e-aggregate>
                </e-aggregates>  
              </ejs-grid>
            </div>
            </v-card>
        </v-col>
  
</template>
<script>
import BarangInternalPartOrder from "@/views/InternalPartOrder/BarangInternalPartOrder"
import Vue from "vue";
import api from "@/axios/http";
import { DatePickerPlugin } from "@syncfusion/ej2-vue-calendars"
import { GridPlugin, Toolbar, Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder } from "@syncfusion/ej2-vue-grids";
import { loadCldr,L10n, setCulture, setCurrencyCode } from '@syncfusion/ej2-base';
loadCldr(require('../cldr/id/currencies.json'),                 
        require('../cldr/id/numbers.json'),  
        require('../cldr/supplemental/numberingSystems.json'),
        require('../cldr/id/timeZoneNames.json'),
        require('../cldr/supplemental/weekData.json'),
        require('../cldr/id/ca-gregorian.json'));  
setCulture('id');
setCurrencyCode('IDR');
//import ItemsPurchaseOrder from '@/views/purchase_order/items'
L10n.load({
    'id': {
       'datepicker': { placeholder: 'Tanggal', today: 'Hari ini' },
        'grid': {
          'Add': 'Tambahkan',
          'Delete': 'Hapus',
          'Cancel': 'Batal',
          'Search': 'Pencarian',
            'EmptyRecord': 'Data Unavailable',
            'GroupDropArea': 'Drag Data ke sini untuk Grouping',
            'UnGroup': 'Klik di sini untuk memisahkan grup',
            'EmptyDataSourceError': 'DataSource tidak boleh kosong pada pemuatan pertama, karena kolom dari dataSource di kisi kolom Buat Otomatis',
            'Item': 'Item',
            'Items': 'Item'
        },
        'pager':{
            'currentPageInfo': '{0} dari {1} halaman',
            'totalItemsInfo': '({0} items)',
            'firstPageTooltip': 'Ke halaman pertama',
            'lastPageTooltip': 'Ke halaman terakhir',
            'nextPageTooltip': 'Ke halaman selanjutnya',
            'previousPageTooltip': 'Kembali ke halaman terakhir',
            'nextPagerTooltip': 'Ke pager berikutnya',
            'previousPagerTooltip': 'Ke halaman sebelumnya'
        }
    }
});

Vue.use(DatePickerPlugin);
Vue.use(GridPlugin);

export default {
  components: {
     BarangInternalPartOrder
    },
  data() {
    return {
      HariIni: new Date().toISOString().substr(0,10),
      editedItem: {
            NoPartOrder: "",
            Tanggal: "",
            NomorWO: "",
            JenisWorkOrder: "",
            TipeKendaraan: "",
            Warna: "",
            KeteranganStatus: "",
            Terpenuhi: "",
            Keterangan: "",
            NomorPolisi: ""
        },
        defaultItem: {
            NoPartOrder: "",
            Tanggal: "",
            NomorWO: "",
            JenisWorkOrder: "",
            TipeKendaraan: "",
            Warna: "",
            KeteranganStatus: "",
            Terpenuhi: "",
            Keterangan: "",
            NomorPolisi: ""
        },
      data: [],
      workorder: [],
      itembarangipo:[],
      itembaranglist:[],
      search: '',
      dialog: false,
      dialogbarang:false,
      dialogwo:false,
      menutanggal:false,
      editedIndex: -1,
      token : localStorage.getItem('token'),
      groupSettings: { allowReordering: true },
      selectionOptions: { type: 'Multiple' },
      selectionOptionsSatuan: { type: 'Single' },
      toolbarOptions: ['Search'],
      pageSettings: {pageSizes: ['5','10','All']},
      filterOptions: { type: 'Menu' },
      filter: { type : 'CheckBox' },
      
      editSettings: { showDeleteConfirmDialog: true, allowEditing: false, allowAdding: true, allowDeleting: true, mode: 'Normal'},
      
       
      footerSum: function () {
        return  { template : Vue.component('SumTemplate', {
            template: `<span>Sum: {{data.Sum}}</span>`,
            data () {return { data: {}};}
            })
          }
      },
      footerMax: function () {
        return  { template : Vue.component('MaxTemplate', {
            template: `<span>Max: {{data.Max}}</span>`,
            data () {return { data: {}};}
            })
          }
      }
    };
  },
  provide: {
    grid: [Page, Toolbar, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder]
  },
  mounted() {
    this.getData(),
    this.getDataWorkOrder(),
    this.getDataBarang()
  },
  watch: {
     dialog(val){
       val || this.close();
     },
   },
   computed: {
        formTitle(){
            return this.editedIndex === -1 ? "Tambah Data" : "Edit Data";
        }
   },
  methods: {
    save(){
            if(this.formTitle === "Tambah Data"){
                this.TambahData()
            }else{
                this.UpdateData()
            }
            this.close()
            
        },
    TambahData(){
            api.post('/ipo?token='+this.token, {
            KodeNota: this.editedItem.NoPartOrder,
            Tanggal: this.editedItem.Tanggal,
            NoWorkOrder: this.editedItem.NomorWO,
            JenisWorkOrder: this.editedItem.JenisWorkOrder,
            TipeKendaraan: this.editedItem.TipeKendaraan,
            NomorPolisi: this.editedItem.NomorPolisi,
            Warna: this.editedItem.Warna,
            Keterangan: this.editedItem.Keterangan,
            KeteranganStatus: this.editedItem.KeteranganStatus,
            Terpenuhi: this.editedItem.Terpenuhi
        })
        .then((res) => {
            this.KodeNota = ''
            this.Tanggal = ''
            this.NoWorkOrder=''
            this.JenisWorkOrder=''
            this.TipeKendaraan=''
            this.NomorPolisi=''
            this.Warna=''
            this.Keterangan=''
            this.KeteranganStatus=''
            this.Terpenuhi=''
            console.log(res)
            this.close()
            this.getData()
        })
        .catch((err) => {
            console.log(err)
        })
        },
        UpdateData(){
        api.put('/ipo/' + this.editedItem.id +'?token='+this.token, {
            KodeNota: this.editedItem.NoPartOrder,
            Tanggal: this.editedItem.Tanggal,
            NoWorkOrder: this.editedItem.NomorWO,
            JenisWorkOrder: this.editedItem.JenisWorkOrder,
            TipeKendaraan: this.editedItem.TipeKendaraan,
            NomorPolisi: this.editedItem.NomorPolisi,
            Warna: this.editedItem.Warna,
            Keterangan: this.editedItem.Keterangan,
            KeteranganStatus: this.editedItem.KeteranganStatus,
            Terpenuhi: this.editedItem.Terpenuhi
        })
        .then((res)=>{
            this.KodeNota = ''
            this.Tanggal = ''
            this.NoWorkOrder=''
            this.JenisWorkOrder=''
            this.TipeKendaraan=''
            this.NomorPolisi=''
            this.Warna=''
            this.Keterangan=''
            this.KeteranganStatus=''
            this.Terpenuhi=''
            console.log(res)
            this.close()
            this.getData()
        })
        .catch((err)=> {
            console.log(err)
        })
        },

        close() {
        this.dialog = false;
        this.menutanggalkirimpo= false;
        this.menutanggalpo= false;
        this.editedItem = this.defaultItem
        this.editedIndex = -1
        this.itembarangipo = []
        this.$refs.BarangIPO.resetBarangIPO()

        },
        closeWO() {
        this.dialogwo = false;
        },
        commandClick: function(args) {
        if (args.target.classList.contains("custombutton")) {
            let data = JSON.stringify(args.rowData)
            console.log(data)
        } else if (args.target.classList.contains("Delete")) {
            var r = confirm("Yakin Hapus Data?");
            if (r == true) {
                api.delete('/ipo/'+args.rowData.id+'?token='+this.token)
                .then((res)=> {
                    // this.item.splice(index, 1)
                    console.log(res)
                    this.getData()
                })
                .catch((err)=> {
                    console.log(err)
                })
            } 
        } else if (args.target.classList.contains('Edit')) {
            let data = args
            this.editedIndex = 1;
            console.log(data)
            this.editedItem = data.rowData
            this.dialog = true
        }},

    //     actionComplete(args) {
    //     console.log(args)
    // },

    //  rowSelectedBarang: function() {
    //    let grid = document.getElementById("Grid").ej2_instances[0];
    //    this.itembarangipo = grid.getSelectedRecords();
    // },
    rowSelectedBarang(isi) {
      this.itembarangipo = isi
    },
    rowSelectedNomorWO:function(args){
      this.editedItem.NomorWO = args.data.KodeNota
      this.editedItem.JenisWorkOrder = args.data.JenisWorkOrder
      this.editedItem.NomorPolisi = args.data.NomorPolisi
    },
        getData(){
            api.get('/ipo?token='+this.token).then(
        res=>{
            // console.log(res)
            this.data = res.data
        },
        err => {
            console.log(err)
            this.$router.push('/')
            this.localStorage.removeItem('token')
        })},
        getDataWorkOrder(){
          api.get('/wo?token='+this.token).then(
            res=>{
              // console.log(res)
              this.workorder = res.data
            },
            err => {
              console.log(err)
              this.$router.push('/')
              this.localStorage.removeItem('token')
            }
          )
        },
        //ambil data Barang
        getDataBarang(){
          api.get('/barang?token='+this.token).then(
            res=>{
              // console.log(res)
              this.itembaranglist = res.data
            },
            err => {
              console.log(err)
              this.$router.push('/')
              this.localStorage.removeItem('token')
            }
          )
        },
  },
}
</script>

