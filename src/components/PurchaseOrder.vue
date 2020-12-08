<template>
  
        <v-col cols="12" md="12">
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
              Purchase Order
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
              scrollable
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
                  <v-row dense>
                    <v-col cols="14"  md="6">
                      <v-text-field outlined dense
                        v-model="editedItem.KodeNota"
                        label="Kode Nota">
                      </v-text-field>
                    </v-col>

                  <v-col cols="14"  md="2">
                   <v-menu
          v-model="menutanggalpo"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field outlined dense
           v-model="editedItem.Tanggal"
            label="Tanggal"
            append-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
        locale="id"
        v-model="editedItem.Tanggal"
          @input="menutanggalpo = false"
          :min="HariIni"
        ></v-date-picker>
      </v-menu>
                  </v-col>

                  <v-col cols="14"  md="3">
                    <v-menu
        v-model="menutanggalkirimpo"
        :close-on-content-cl4ick="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field outlined dense
          v-model="editedItem.TanggalKirim"
            label="Tanggal Kirim"
            append-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
        locale="id"
        v-model="editedItem.TanggalKirim"
        @input="menutanggalkirimpo = false"
         :min="HariIni"
        ></v-date-picker>
      </v-menu>
                  </v-col>

                  <v-col cols="14"  md="1">
                    <v-text-field outlined dense
                      v-model="editedItem.Kurs"
                      label="Kurs">
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                   <v-text-field outlined dense
                      v-model="editedItem.NamaSupplier"
                      label="Supplier"
                      append-icon="mdi-dots-horizontal"
                      @click:append="dialogsupplier = !dialogsupplier">
                    </v-text-field>
                  </v-col>
                    <v-dialog
          v-model="dialogsupplier"
          max-width="1200px"
        >
          <v-card>
             <v-app-bar
      color="blue darken-4"
      dark
      dense 
    >           <span class="headline">Supplier</span>
                   </v-app-bar>
            <v-card-text>
              <v-container>
    <ejs-grid 
                :dataSource="supplier" height='200' width='100%'
                :allowReordering = true
                :editSettings='editSettings'
                :toolbar='toolbarOptions'
                :selectionSettings='selectionOptionsSatuan'
                :allowSorting='true'
                :allowFiltering='true'
                :filterSettings='filterOptions'
                :allowResizing='true'
                :allowPaging='true'
                :pageSettings='pageSettings'
                :commandClick="commandClick"
                :rowSelected="rowSelectedSupplier" 
                >
                <e-columns>
                
                    <e-column 
                      :filter='filter'
                      fieldText=''
                      field='id' 
                      headerText='ID' 
                      textAlign='Left'
                      width=180
                      >
                    </e-column>

                      <e-column
                      field='Nama'
                      headerText='Nama'
                      width=250
                      >
                    </e-column>

                    <e-column
                      :filter='filter'
                      field='SellFrom' 
                      headerText='Sell From' 
                      width=170
                      >
                    </e-column>

                    <e-column
                      field='BillFrom'
                      headerText='Bill From'
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
                @click="closeSupplier"
              >
                Simpan
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                     v-model="editedItem.BillFrom"
                     
                      label="Bill From" required>
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.SellFrom"
                      label="Sell From">
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.PaymentTerm"
                      label="Payment Term">
                    </v-text-field>
                  </v-col>  

                  <v-col cols="14"  md="6">
         <v-combobox
          
          v-model="editedItem.MataUang"
          label="Mata uang"
          outlined
          dense
        ></v-combobox>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                       v-model="editedItem.Referensi"
                      label="Refrensi">
                    </v-text-field>
                  </v-col>
                  <v-col cols="14"  md="6">
        
                    <v-text-field
                     
                      v-model="editedItem.NomorWO"
                       label="Nomor Work Order"
                       outlined
                        dense
                        append-icon="mdi-dots-horizontal"
                        @click:append="dialog2 = !dialog2"
                    ></v-text-field>
                  </v-col>
                    <v-dialog
          v-model="dialog2"
          max-width="1200px"
        >
          <v-card>
             <v-app-bar
      color="blue darken-4"
      dark
      dense 
    >           <span class="headline">Work Order</span>
                   </v-app-bar>
            <v-card-text>
              <v-container>
    <ejs-grid 
                
                :dataSource="itemswo" height='200' width='100%'
                :allowReordering = true
                :toolbar='toolbarOptions'
                :editSettings='editSettings'
                :selectionSettings='selectionOptionsSatuan'
                :allowSorting='true'
                :allowMultiSorting='true'
                :allowFiltering='true'
                :filterSettings='filterOptions'
                :allowResizing='true'
                :allowPaging='true'
                :pageSettings='pageSettings'
                :commandClick="commandClick"
                :rowSelected="rowSelectedWorkOrder" 
                >
                <e-columns>
                
                    <e-column 
                      :filter='filter'
                      fieldText=''
                      field='KodeNota' 
                      headerText='Kode Nota' 
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
                      field='MataUang'
                      headerText='Mata Uang'
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
                @click="closewodialog"
              >
                Simpan
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
 
                  <v-col cols="14" md="6" offset-md="0">
                    <v-text-field outlined dense
                      v-model="editedItem.NomorRangka"
                      label="Nomor Rangka">
                    </v-text-field>
                  </v-col>           

                  <v-col cols="14"  md="6">
                  <v-btn color="success" text >Load Part Order</v-btn>
                  </v-col>
                  <v-col cols="14"  md="6">
                    
                  </v-col>
                  <v-col cols="12">
                   <ItemsPurchaseOrder/>
                  </v-col>
                  <v-col cols="12"  md="8">
                    <v-text-field 
                       label="Keterangan"
                       outlined
                        dense
                    ></v-text-field>
                  </v-col>
                  <v-col cols="6" md="4">
                    <v-text-field
                       label="Keterangan"
                       outlined
                        dense
                    ></v-text-field></v-col>

                     <v-col cols="5" md="2" offset-md="8">
                    <v-text-field
                     
                      
                       label="Keterangan"
                       outlined
                        dense
                    ></v-text-field></v-col>
                  <v-col cols="5" md="2" offset-md="0">
                    <v-text-field
                     
                      
                       label="Keterangan"
                       outlined
                        dense
                    ></v-text-field></v-col>
                  
                </v-row>
              </v-container>
            </v-card-text>

    <v-divider></v-divider>
 
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
                :dataSource="data" height='200' width='100%'
                :allowReordering = true
                :toolbar='toolbarOptions'
                :editSettings='editSettings'
                :selectionSettings='selectionOptions'
                :allowGrouping='true'
                :groupSettings='groupSettings'
                :allowSorting='true'
                :allowMultiSorting='true'
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
                      headerText='Kode Nota' 
                      textAlign='Left'
                      width=180
                      >
                    </e-column>

                      <e-column
                      field='Tanggal'
                      editType='datepickeredit'
                      type="date"
                      headerText='Tanggal'
                      width=150
                      >
                    </e-column>

                    <e-column
                      :filter='filter'
                      field='NamaSupplier'  
                      headerText='Nama Supplier' 
                      width=170
                      >
                    </e-column>

                    <e-column
                      field='Referensi'
                      headerText='Referensi'
                      width=170
                      >
                    </e-column>

                    <e-column
                      field='Total'
                      headerText='Total'
                      textAlign='Right'
                      :format="{format:'C2', currency:'IDR' }"
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='Diskon'
                      headerText='Diskon'
                      textAlign='Right'
                      format='C2'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='DPp'
                      headerText='DPp'
                      textAlign='Right'
                      format='C2'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='PPn'
                      headerText='PPn'
                      textAlign='Right'
                      format='C2'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='TotalBayar'
                      headerText='Total Bayar'
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
                      field='NomorRangka'
                      headerText='Keterangan'
                      textAlign='Right'
                      width=160
                      >
                    </e-column>

                  <e-column
                    :filter='filter'
                    field='NomorPolisi'
                    headerText='No. Polisi'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>

                  <e-column
                    :filter='filter'
                    field='NomorWO'
                    headerText='No Work Order'
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
        </v-col>
 
</template>
<script>
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
import ItemsPurchaseOrder from '@/views/purchaseorder/items'
L10n.load({
    'id': {
       'datepicker': { placeholder: 'Tanggal', today: 'Hari ini' },
        'grid': {
          'Add': 'Tambahkan',
          'Delete': 'Hapus',
          'Cancel': 'Batal',
          'Search': 'Pencarian',
            'EmptyRecord': 'Record Kosong',
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
      ItemsPurchaseOrder
    },
  data() {
    return {
      HariIni: new Date().toISOString().substr(0,10),
      editedItem: {
            KodeNota: "",
            Tanggal: "",
            NamaSupplier: "",
            TanggalKirim: "",
            Status: "",
            Total: "",
            Diskon: "",
            DPp: "",
            PPn: "",
            TotalBayar: "",
            Keterangan: "",
            Referensi: "",
            NomorRangka: "",
            NomorPolisi: "",
            NomorWO: "",
            BillFrom: "",
            SellFrom: "",
            PaymentTerm: "",
            MataUang: "",
            Kurs: "",
            Apply: ""
        },
        defaultItem: {
            KodeNota: "",
            Tanggal: "",
            NamaSupplier: "",
            TanggalKirim: "",
            Status: "",
            Total: "",
            Diskon: "",
            DPp: "",
            PPn: "",
            TotalBayar: "",
            Keterangan: "",
            Referensi: "",
            NomorRangka: "",
            NomorPolisi: "",
            NomorWO: "",
            BillFrom: "",
            SellFrom: "",
            PaymentTerm: "",
            MataUang: "",
            Kurs: "",
            Apply: ""
        },
      data: [],
      supplier: [],
      search: '',
      dialog: false,
      dialog2: false,
      dialogDelete:false,
      dialogsupplier:false,
      menutanggalkirimpo: false,
      menutanggalpo:false,
      editedIndex: -1,
      itembaranglist:[],
      itembarangpo:[],
      itemswo: [],
      token : localStorage.getItem('token'),
      groupSettings: { allowReordering: true },
       selectionOptions: { type: 'Multiple'},
      //  selectionOptions: { type: 'Multiple', persistSelection: true, enableSimpleMultiRowSelection: true},
      selectionOptionsSatuan: { type: 'Single'},
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
    this.getDataSupplier(),
    this.getDataWo()
  },
  watch: {
     dialog(val){
       val || this.close();
     },
   },
   computed: {
        formTitle(){
            return this.editedIndex === -1 ? "Tambah Purchase Order" : "Edit Purchase Order";
        }
   },
  methods: {
    save(){
            if(this.formTitle === "Tambah Purchase Order"){
                this.TambahData()
            }else{
                this.UpdateData()
            }
            this.close()
            
        },
    TambahData(){
            api.post('/po?token='+this.token, {
            KodeNota: this.editedItem.KodeNota,
            Tanggal: this.editedItem.Tanggal,
            NamaSupplier: this.editedItem.NamaSupplier,
            TanggalKirim: this.editedItem.TanggalKirim,
            Status: this.editedItem.Status,
            Total: this.editedItem.Total,
            Diskon: this.editedItem.Diskon,
            DPp: this.editedItem.DPp,
            PPn: this.editedItem.PPn,
            TotalBayar: this.editedItem.TotalBayar,
            Keterangan: this.editedItem.Keterangan,
            Referensi: this.editedItem.Referensi,
            NomorRangka: this.editedItem.NomorRangka,
            NomorPolisi: this.editedItem.NomorPolisi,
            NomorWO: this.editedItem.NomorWO,
            BillFrom: this.editedItem.BillFrom,
            SellFrom: this.editedItem.SellFrom,
            PaymentTerm: this.editedItem.PaymentTerm,
            MataUang: this.editedItem.MataUang,
            Kurs: this.editedItem.Kurs,
            Apply: this.editedItem.Apply
        })
        .then((res) => {
            this.KodeNota = ''
            this.Tanggal = ''
            this.NamaSupplier=''
            this.TanggalKirim=''
            this.Status=''
            this.Total=''
            this.Diskon=''
            this.DPp=''
            this.PPn=''
            this.TotalBayar=''
            this.Keterangan=''
            this.Referensi=''
            this.NomorRangka=''
            this.NomorPolisi=''
            this.NomorWO=''
            this.BillFrom=''
            this.SellFrom=''
            this.PaymentTerm=''
            this.MataUang=''
            this.Kurs=''
            this.Apply=''
            console.log(res)
            this.close()
            this.getData()
        })
        .catch((err) => {
            console.log(err)
        })
        },
        UpdateData(){
        api.put('/po/' + this.editedItem.id +'?token='+this.token, {
            KodeNota: this.editedItem.KodeNota,
            Tanggal: this.editedItem.Tanggal,
            NamaSupplier: this.editedItem.NamaSupplier,
            TanggalKirim: this.editedItem.TanggalKirim,
            Status: this.editedItem.Status,
            Total: this.editedItem.Total,
            Diskon: this.editedItem.Diskon,
            DPp: this.editedItem.DPp,
            PPn: this.editedItem.PPn,
            TotalBayar: this.editedItem.TotalBayar,
            Keterangan: this.editedItem.Keterangan,
            Referensi: this.editedItem.Referensi,
            NomorRangka: this.editedItem.NomorRangka,
            NomorPolisi: this.editedItem.NomorPolisi,
            NomorWO: this.editedItem.NomorWO,
            BillFrom: this.editedItem.BillFrom,
            SellFrom: this.editedItem.SellFrom,
            PaymentTerm: this.editedItem.PaymentTerm,
            MataUang: this.editedItem.MataUang,
            Kurs: this.editedItem.Kurs,
            Apply: this.editedItem.Apply
        })
        .then((res)=>{
            this.KodeNota = ''
            this.Tanggal = ''
            this.NamaSupplier=''
            this.TanggalKirim=''
            this.Status=''
            this.Total=''
            this.Diskon=''
            this.DPp=''
            this.PPn=''
            this.TotalBayar=''
            this.Keterangan=''
            this.Referensi=''
            this.NomorRangka=''
            this.NomorPolisi=''
            this.NomorWO=''
            this.BillFrom=''
            this.SellFrom=''
            this.PaymentTerm=''
            this.MataUang=''
            this.Kurs=''
            this.Apply=''
            console.log(res)
            this.close()
            this.getData()
        })
        .catch((err)=> {
            console.log(err)
        })
        },

        close() {
        this.dialog = false
        this.dialog2 = false
        this.menutanggalkirimpo= false
        this.menutanggalpo= false
        this.editedItem = this.defaultItem
        this.editedIndex = -1
        this.itembarangpo = []
        },
        accbarang(){
          this.dialogbarang = false
        },
        closewodialog(){
          this.dialog2 = false
        },
        closeSupplier(){
          this.dialogsupplier = false
        },
        commandClick: function(args) {
        if (args.target.classList.contains("custombutton")) {
            // let data = JSON.stringify(args.rowData)
            // console.log(data)
            console.log()
        } else if (args.target.classList.contains("Delete")) {
            var r = confirm("Yakin Hapus Data?");
            if (r == true) {
                api.delete('/po/'+args.rowData.id+'?token='+this.token)
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

        actionComplete(args) {
        console.log(args)
    },
    //fungsi pilihan WO
    rowSelectedWorkOrder: function(args) { 
      this.editedItem.NomorWO = args.data.KodeNota
      this.editedItem.MataUang = args.data.MataUang
      this.editedItem.NomorRangka = args.data.NomorRangka
      this.editedItem.PaymentTerm = args.data.PaymentTerm
      this.editedItem.Kurs = args.data.Kurs
    },
    //fungsi pilihan Supplier
    rowSelectedSupplier: function(args) { 
      this.editedItem.NamaSupplier = args.data.Nama
      this.editedItem.BillFrom = args.data.BillFrom
      this.editedItem.SellFrom = args.data.SellFrom
    },
    //fungsi pilihan Barang
    rowSelectedBarang: function() {
       let grid = document.getElementById("Grid").ej2_instances[0];
       this.itembarangpo = grid.getSelectedRecords();
    },
    //fungsi pilihan Work Order Vuetify
    // pilihWorkOrder: function(item, row){
    //   row.select(true);
    //   this.editedItem.NomorWO = item.KodeNota
    //   this.editedItem.NomorRangka = item.NomorRangka
    //   this.editedItem.MataUang = item.MataUang
    //   this.editedItem.PaymentTerm = item.PaymentTerm
    //   this.editedItem.Kurs = item.Kurs

    // },
    //ambil data PO
        getData(){
            api.get('/po?token='+this.token).then(
        res=>{
            console.log(res)
            this.data = res.data
        },
        err => {
            console.log(err)
            this.$router.push('/')
            this.localStorage.removeItem('token')
        })},
    //ambil data Supplier
        getDataSupplier(){
          api.get('/supplier?token='+this.token).then(
            res=>{
              console.log(res)
              this.supplier = res.data
            },
            err => {
              console.log(err)
              this.$router.push('/')
              this.localStorage.removeItem('token')
            }
          )
        },
    //ambil data WO
        getDataWo(){
          api.get('/wo?token='+this.token).then(
            res=>{
              console.log(res)
              this.itemswo = res.data
            },
            err => {
              console.log(err)
              this.$router.push('/')
              this.localStorage.removeItem('token')
            }
          )
        }
    
  },
}
</script>

