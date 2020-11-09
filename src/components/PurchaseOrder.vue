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
                Tambah Pembelian
              </v-toolbar-title>
              <span class="headline">{{ formTitle }}</span>
            </v-toolbar>
            
           <v-card-text>
                <v-container>
                  <v-row dense>
                    <v-col cols="14"  md="6">
                      <v-text-field outlined dense

                        label="Kode Nota">
                      </v-text-field>
                    </v-col>

                  <v-col cols="14"  md="2">
                   <v-menu
    
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field outlined dense
           
            label="Tanggal"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
        locale="id"
          
          
        ></v-date-picker>
      </v-menu>
                  </v-col>

                  <v-col cols="14"  md="3">
                    <v-menu
        
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field outlined dense
           
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
          
         
        ></v-date-picker>
      </v-menu>
                  </v-col>

                  <v-col cols="14"  md="1">
                    <v-text-field outlined dense
                      
                      label="Kurs">
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-menu
                   
                  :close-on-content-click="false"
                   :nudge-width="200"
                   offset-x
                   ><template v-slot:activator="{ on, attrs }">
                   <v-text-field outlined dense
                      
                      label="Supplier"
                      v-on="on"
                      v-bind="attrs">
                    </v-text-field>
                    </template>
                    <v-card>
             <v-app-bar
      color="primary"
      dark
      dense 
    >           <span class="headline">Supplier</span>
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
    item-key="id"
    
     single-select
      :headers="headerssup"
      :items="data_supplier"
      :search="search"
    >
    </v-data-table>
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
    </v-menu>

                  </v-col>
                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                     
                      label="Bill From" required>
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      
                      label="Sell From">
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      
                      label="Payment Term">
                    </v-text-field>
                  </v-col>

                  

                  <v-col cols="14"  md="6">
         <v-combobox
          
          
          label="Mata uang"
          outlined
          dense
        ></v-combobox>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                       
                      label="Refrensi">
                    </v-text-field>
                  </v-col>
                  <v-col cols="12"  md="5">
        
                    <v-text-field
                     
                      
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
    
     single-select
      :headers="headerswo"
      :items="itemspo"
      :search="search"

    >
    </v-data-table>
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
                      
                      label="Nomor Rangka">
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
                
                :dataSource="data" height='200' width='100%'
                :allowReordering='true'
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
                :toolbar='toolbarOptions'
                >
                <e-columns>
                
                    <e-column 
                      :filter='filter'
                      fieldText=''
                      field='kd_nota' 
                      headerText='Kode Nota' 
                      textAlign='Left'
                      width=180
                      >
                    </e-column>

                      <e-column
                      format='dd/MM/yyyy'
                      field='tgl'
                      editType='datepickeredit'
                      type="date"
                      headerText='Tanggal'
                      width=150
                      >
                    </e-column>
                    <!-- <ejs-datepicker field='tgl' headerText='Tanggal' width='150' id="datepicker" locale='id' ></ejs-datepicker> -->
                    

                    <e-column
                      :filter='filter'
                      field='nm_supplier'  
                      headerText='Nama Supplier' 
                      width=170
                      >
                    </e-column>

                    <e-column
                      field='referensi'
                      headerText='Referensi'
                      width=170
                      >
                    </e-column>

                    <e-column
                      field='total'
                      headerText='Total'
                      textAlign='Right'
                      :format="{format:'C2', currency:'IDR' }"
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='diskon'
                      headerText='Diskon'
                      textAlign='Right'
                      format='C2'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='dpp'
                      headerText='DPP'
                      textAlign='Right'
                      format='C2'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='ppn'
                      headerText='PPn'
                      textAlign='Right'
                      format='C2'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='total_bayar'
                      headerText='Total Bayar'
                      textAlign='Right'
                      format='C2'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='keterangan'
                      headerText='Keterangan'
                      textAlign='Right'
                      width=160
                      >
                    </e-column>

                  <e-column
                    :filter='filter'
                    field='nomor_polisi'
                    headerText='No. Polisi'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>

                  <e-column
                    :filter='filter'
                    field='nomor_wo'
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
      data: [
          {
            kd_nota:'0101/PO/2006/000055',
            tgl:'06/06/2020',
            nm_supplier:'LeonardoGordfrans',
            total: 3500000,
            diskon: '0.00',
            dpp: 1500000,
            ppn: '0.00',
            total_bayar: 2500000,
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tgl:'06/06/2020',
            nm_supplier:'Contoh2',
            total: 1500000,
            diskon: '0.00',
            dpp: 1500000,
            ppn: '0.00',
            total_bayar: 1500000,
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tgl:'06/06/2020',
            nm_supplier:'Contoh3',
            total: 1500000,
            diskon: '0.00',
            dpp: 1500000,
            ppn: '0.00',
            total_bayar: 1500000,
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tgl:'06/06/2020',
            nm_supplier:'LeonardoGordfrans',
            total: 3500000,
            diskon: '0.00',
            dpp: 1500000,
            ppn: '0.00',
            total_bayar: 2500000,
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tgl:'06/06/2020',
            nm_supplier:'Contoh2',
            total: 1500000,
            diskon: '0.00',
            dpp: 1500000,
            ppn: '0.00',
            total_bayar: 1500000,
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tgl:'06/06/2020',
            nm_supplier:'Contoh3',
            total: 1500000,
            diskon: '0.00',
            dpp: 1500000,
            ppn: '0.00',
            total_bayar: 1500000,
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tgl:'06/06/2020',
            nm_supplier:'LeonardoGordfrans',
            total: 3500000,
            diskon: '0.00',
            dpp: 1500000,
            ppn: '0.00',
            total_bayar: 2500000,
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tgl:'06/06/2020',
            nm_supplier:'Contoh2',
            total: 1500000,
            diskon: '0.00',
            dpp: 1500000,
            ppn: '0.00',
            total_bayar: 1500000,
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tgl:'06/06/2020',
            nm_supplier:'Contoh3',
            total: 1500000,
            diskon: '0.00',
            dpp: 1500000,
            ppn: '0.00',
            total_bayar: 1500000,
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tgl:'06/06/2020',
            nm_supplier:'LeonardoGordfrans',
            total: 3500000,
            diskon: '0.00',
            dpp: 1500000,
            ppn: '0.00',
            total_bayar: 2500000,
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tgl:'06/06/2020',
            nm_supplier:'Contoh2',
            total: 1500000,
            diskon: '0.00',
            dpp: 1500000,
            ppn: '0.00',
            total_bayar: 1500000,
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tgl:'06/06/2020',
            nm_supplier:'Contoh3',
            total: 1500000,
            diskon: '0.00',
            dpp: 1500000,
            ppn: '0.00',
            total_bayar: 1500000,
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tgl:'06/06/2020',
            nm_supplier:'LeonardoGordfrans',
            total: 3500000,
            diskon: '0.00',
            dpp: 1500000,
            ppn: '0.00',
            total_bayar: 2500000,
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tgl:'06/06/2020',
            nm_supplier:'Contoh2',
            total: 1500000,
            diskon: '0.00',
            dpp: 1500000,
            ppn: '0.00',
            total_bayar: 1500000,
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
          {
            kd_nota:'0101/PO/2006/000055',
            tgl:'06/06/2020',
            nm_supplier:'Contoh3',
            total: 1500000,
            diskon: '0.00',
            dpp: 1500000,
            ppn: '0.00',
            total_bayar: 1500000,
            keterangan: 'UP.OM',
            referensi: '0101/OP/2006/000030',
            nomor_polisi: 'KT5555DX',
            nomor_wo: '0101/WO/2003/000140'
          },
        ],
      groupSettings: { allowReordering: true },
      selectionOptions: { type: 'Multiple' },
      toolbarOptions: ['Search', 'Add', 'Edit', 'Delete', 'Update', 'Cancel'],
      pageSettings: {pageSizes: ['5','10','All']},
      filterOptions: { type: 'Menu' },
      filter: { type : 'CheckBox' },
      
      editSettings: { showDeleteConfirmDialog: true, allowEditing: true, allowAdding: true, allowDeleting: true, mode: 'Normal'},
      
       
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
  }
}
</script>

