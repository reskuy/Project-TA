<template>
  
        <v-col cols="12" md="12">
          <v-toolbar
            flat
            dark
            dense
            color='primary'
            class="elevation-1"
            >
            <v-toolbar-title 
              dark
            >
              <v-icon>mdi-cart</v-icon>
             Barang
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
                color="primary"
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
                color= 'primary'
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
                        v-model="editedItem.kode"
                        label="Kode">
                      </v-text-field>
                    </v-col>

                  <v-col cols="14"  md="6">
                   <v-text-field outlined dense
                     v-model="editedItem.kdsupplier"
                      label="Supplier" required>
                    </v-text-field>

                  </v-col>
                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                     v-model="editedItem.nama"
                      label="Nama" required>
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.merk"
                      label="Merk">
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.kategori"
                      label="Kategori">
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                       v-model="editedItem.partnumber1"
                      label="Partnumber1">
                    </v-text-field>
                  </v-col>
                  <v-col cols="12"  md="6">
        
                    <v-text-field
                     
                      v-model="editedItem.kendaraan"
                       label="Kendaraan"
                       outlined
                        dense
                    ></v-text-field>
                  </v-col>
                  

                  <v-col cols="12"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.partnumber2"
                      label="Partnumber2">
                    </v-text-field>
                  </v-col>     

                  <v-col cols="12"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.dimensi"
                      label="Dimensi">
                    </v-text-field>
                  </v-col> 

                  <v-col cols="12"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.gudang"
                      label="Gudang">
                    </v-text-field>
                  </v-col>   

                  <v-col cols="12"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.memo"
                      label="Memo">
                    </v-text-field>
                  </v-col>     

                  <v-col cols="12"  md="6">
                    <v-switch outlined dense
                      v-model="editedItem.aktif"
                      label="Aktif"
                      true-value="True"
                      false-value="False"
                      >
                    </v-switch>
                  </v-col>     

                  <v-col cols="12"  md="3">
                    <v-text-field outlined dense
                      v-model="editedItem.stokmin"
                      label="Stok Minimum">
                    </v-text-field>
                  </v-col>   

                  <v-col cols="12"  md="9">
                    
                  </v-col>   

                  <v-col cols="12"  md="3">
                    <v-text-field outlined dense
                      v-model="editedItem.stokmaks"
                      label="Stok Maksimum">
                    </v-text-field>
                  </v-col>         

                  
                  <v-col cols="14"  md="6">
                  <v-btn color="success" text >Load Part Order</v-btn>
                  </v-col>
                  <v-col cols="14"  md="6">
                    
                  </v-col>
                  <v-col cols="12">
                   <v-card>
                 <!-- <ItemsPurchaseOrder/> -->
                  </v-card>
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
                :dataSource="data"
            height="300"
            width="100%"
            :allowReordering = true
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
                <e-column field="Commands" headerText="🔧" width="105" :commands="commands">
                    <div class="btn-group">
                              <button type="button" class="btn btn-default" (click)='prediemRowEdit($event)'>
                                <i class="fa fa-pencil"></i></button>
                              <button type="button" class="btn btn-default" (click)='prediemRowDelete($event)'>
                                <i class="fa fa-trash"></i></button>
                            </div>
                </e-column>
                    <e-column 
                      :filter='filter'
                      fieldText=''
                      field='kode' 
                      headerText='Kode' 
                      textAlign='Left'
                      width=120
                      >
                    </e-column>

                      <e-column
                  
                      field='nama'
                      headerText='Nama'
                      width=250
                      >
                    </e-column>
                    <!-- <ejs-datepicker field='tgl' headerText='Tanggal' width='150' id="datepicker" locale='id' ></ejs-datepicker> -->
                    

                    <e-column
                      :filter='filter'
                      field='merk'  
                      headerText='Merk' 
                      width=140
                      >
                    </e-column>

                    <e-column
                      field='kategori'
                      headerText='Kategori'
                      width=170
                      >
                    </e-column>

                    <e-column
                      field='partnumber1'
                      headerText='Part Number 1'
                      textAlign='Left'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='partnumber2'
                      headerText='Part Number 2'
                      textAlign='Left'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='kendaraan'
                      headerText='Kendaraan'
                      textAlign='Left'
                      width=140
                      >
                    </e-column>

                    <e-column
                      field='kdsupplier'
                      headerText='Kode Supplier'
                      textAlign='Left'
                      width=130
                      >
                    </e-column>

                    <e-column
                      field='dimensi'
                      headerText='Dimensi'
                      textAlign='Left'
                      width=160
                      >
                    </e-column>

                  <e-column
                    :filter='filter'
                    field='aktif'
                    headerText='Aktif'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>

                  <e-column
                    :filter='filter'
                    field='gudang'
                    headerText='Gudang'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>

                  <e-column
                    :filter='filter'
                    field='stokmin'
                    headerText='Stok Minimal'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>

                  <e-column
                    :filter='filter'
                    field='stokmaks'
                    headerText='Stok Maksimal'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>

                </e-columns>
                
              </ejs-grid>
            </div>
        </v-col>
 
</template>
<script>
import Vue from "vue";
import api from "@/axios/http";
import { DatePickerPlugin } from "@syncfusion/ej2-vue-calendars"
import { GridPlugin, Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder } from "@syncfusion/ej2-vue-grids";
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
   //   ItemsPurchaseOrder
    },
  data() {
    return {
            editedIndex: -1,
            editedItem: {
            kode: "",
            nama: "",
            merk: "",
            kategori: "",
            partnumber1: "",
            partnumber2: "",
            kendaraan: "",
            kdsupplier: "",
            dimensi: "",
            aktif: "",
            gudang: "",
            memo: "",
            stokmin: "",
            stokmaks: ""
        },
        defaultItem: {
            kode: "",
            nama: "",
            merk: "",
            kategori: "",
            partnumber1: "",
            partnumber2: "",
            kendaraan: "",
            kdsupplier: "",
            dimensi: "",
            aktif: "",
            gudang: "",
            memo: "",
            stokmin: "",
            stokmaks: ""
        },
        dialog: false,
        dataStateChange: false,
        token : localStorage.getItem('token'),
        data: [],
        commands: [
        {  buttonOption: { cssClass: 'e-flat Edit', iconCss: 'e-edit e-icons' } },
        { buttonOption: { cssClass: 'e-flat Delete', iconCss: 'e-delete e-icons' } },
        ],
      groupSettings: { allowReordering: true },
      selectionOptions: { type: 'Multiple' },
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
    grid: [Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder]
  },
  mounted() {
    this.getData()
  },
  watch: {
     dialog(val){
       val || this.close();
     },
   },
   computed: {
        formTitle(){
            return this.editedIndex === -1 ? "Tambah Barang" : "Edit Barang";
        }
   },
  methods: {
    save(){
            if(this.formTitle === "Tambah Barang"){
                this.TambahData()
            }else{
                this.UpdateData()
            }
            this.close()
            
        },
    TambahData(){
            api.post('/barang?token='+this.token, {
            kode: this.editedItem.kode,
            nama: this.editedItem.nama,
            merk: this.editedItem.merk,
            kategori: this.editedItem.kategori,
            partnumber1: this.editedItem.partnumber1,
            partnumber2: this.editedItem.partnumber2,
            kendaraan: this.editedItem.kendaraan,
            kdsupplier: this.editedItem.kdsupplier,
            dimensi: this.editedItem.dimensi,
            aktif: this.editedItem.aktif,
            gudang: this.editedItem.gudang,
            memo: this.editedItem.memo,
            stokmin: this.editedItem.stokmin,
            stokmaks: this.editedItem.stokmaks
        })
        .then((res) => {
            this.nama = ''
            this.merk = ''
            this.kategori=''
            this.partnumber1=''
            this.partnumber2=''
            this.kendaraan=''
            this.ksupplier=''
            this.dimensi=''
            this.aktif=''
            this.gudang=''
            this.memo=''
            this.stokmin=''
            this.stokmaks=''
            console.log(res)
            this.close()
            this.getData()
        })
        .catch((err) => {
            console.log(err)
        })
        },
        UpdateData(){
        api.put('/barang/' + this.editedItem.id +'?token='+this.token, {
            kode: this.editedItem.kode,
            nama: this.editedItem.nama,
            merk: this.editedItem.merk,
            kategori: this.editedItem.kategori,
            partnumber1: this.editedItem.partnumber1,
            partnumber2: this.editedItem.partnumber2,
            kendaraan: this.editedItem.kendaraan,
            kdsupplier: this.editedItem.kdsupplier,
            dimensi: this.editedItem.dimensi,
            aktif: this.editedItem.aktif,
            gudang: this.editedItem.gudang,
            memo: this.editedItem.memo,
            stokmin: this.editedItem.stokmin,
            stokmaks: this.editedItem.stokmaks
        })
        .then((res)=>{
            this.nama = ''
            this.merk = ''
            this.kategori=''
            this.partnumber1=''
            this.partnumber2=''
            this.kendaraan=''
            this.ksupplier=''
            this.dimensi=''
            this.aktif=''
            this.gudang=''
            this.memo=''
            this.stokmin=''
            this.stokmaks=''
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
        this.editedItem = this.defaultItem
        this.editedIndex = -1
        },
        commandClick: function(args) {
        if (args.target.classList.contains("custombutton")) {
            let data = JSON.stringify(args.rowData)
            console.log(data)
        } else if (args.target.classList.contains("Delete")) {
            var r = confirm("Yakin Hapus Data?");
            if (r == true) {
                api.delete('/gudangs/'+args.rowData.id+'?token='+this.token)
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
        getData(){
            api.get('/barang?token='+this.token).then(
        res=>{
            console.log(res)
            this.data = res.data
        },
        err => {
            console.log(err)
            this.$router.push('/')
            this.localStorage.removeItem('token')
        })},
  },
}
</script>

