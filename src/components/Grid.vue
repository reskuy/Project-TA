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
              Pembelian
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
                Tambah Pembelian
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
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                  
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            </v-card>

            </v-dialog>

          </v-toolbar>

            <div id="app">
                <ejs-grid 
                
                :dataSource="data" height='100%' width='100%'
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
                      field='kodenota' 
                      headerText='Kode Nota' 
                      textAlign='Left'
                      width=180
                      >
                    </e-column>

                    <e-column
                      format='dd/MM/yyyy' type='date'
                      field='tanggal'
                      headerText='Tanggal'
                      width=150
                      >
                    </e-column>

                    <e-column
                      :filter='filter'
                      field='namasupplier'  
                      headerText='Nama Supplier' 
                      width=170
                      >
                    </e-column>

                    <e-column
                      format='dd/MM/yyyy' type='date'
                      field='tanggalpengiriman'
                      headerText='Tanggal Pengiriman'
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
                      format='C2'
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
                      field='hasildiskon'
                      headerText=''
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
                      field='totalbayar'
                      headerText='Total Bayar'
                      textAlign='Right'
                      format='C2'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='ppnfaktur'
                      headerText='PPn Faktur'
                      textAlign='Right'
                      format='C2'
                      width=160
                      >
                    </e-column>

                  <template>
                    <e-column 
                      
                      field='cekFisikinv'
                      headerText='CekFisikInv'
                      textAlign='Center'
                      displayAsCheckBox='true'
                      width=160
                      >
                    </e-column>
                  </template>

                  <e-column
                    :filter='filter'
                    field='nopo'
                    headerText='No. PO'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>

                  <e-column
                    :filter='filter'
                    field='noworkorder'
                    headerText='No Wor kOrder'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>

                    <e-column
                      :filter='filter'
                      field='nomorpolisi'
                      headerText='Nomor Polisi'
                      textAlign='Left'
                      width=160
                      >
                    </e-column>

                    <e-column
                      :filter='filter'
                      field='status'
                      headerText='Status'
                      textAlign='Left'
                      width=160
                      >
                    </e-column>

                    <e-column
                      :filter='filter'
                      field='keteranganstatus'
                      headerText='Keterangan Status'
                      textAlign='Left'
                      width=190
                      >
                    </e-column>
                </e-columns>
                
                <e-aggregates>
                  <e-aggregate>
                    <e-columns>
                      <e-column type="Sum" field="total" format='C2' :FooterTemplate="footerSum"></e-column>
                      <e-column type="Sum" field="totalbayar" format='C2' :FooterTemplate="footerSum"></e-column>
                    </e-columns>
                  </e-aggregate>

                  <e-aggregate>
                    <e-columns>
                      <e-column type="Max" field="total" format='C2' :CaptionTemplate="footerMax"></e-column>
                    </e-columns>
                  </e-aggregate>
                </e-aggregates>  
              </ejs-grid>
            </div>
        </v-col>
 
</template>
<script>
import Vue from "vue";
import { GridPlugin, Toolbar, Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder } from "@syncfusion/ej2-vue-grids";
import { setCurrencyCode} from '@syncfusion/ej2-base';
import {setCulture} from '@syncfusion/ej2-base';

setCulture('id');
setCurrencyCode('IDR');
Vue.use(GridPlugin);

export default {
  data() {
    return {
      data: [
          { 
            kodenota: '0101/FB/2006/000061', 
            tanggal: '05/06/2020', 
            namasupplier: 'ENDHYARNIE', 
            tanggalpengiriman: '', 
            referensi: '1234567890', 
            total: 1520000,
            diskon: 0,
            hasildiskon: 1520000,
            ppn: 0,
            totalbayar: 1520000,
            ppnfaktur: 0,
            cekfisikinv: '',
            nopo: '0101/PO/2005',
            noworkorder: '0101/WO/2005',
            nomorpolisi: 'KT 0101 AB',
            status: '',
            keteranganstatus: '',
          },

          {
            kodenota: '0101/FB/2006/000062', 
            tanggal: '05/06/2020', 
            namasupplier: 'ENDHYARNIE', 
            tanggalpengiriman: '', 
            referensi: '1234567890', 
            total: 5278000,
            diskon: 0,
            hasildiskon: 5278000,
            ppn: 0,
            totalbayar: 5278000,
            ppnfaktur: 0,
            cekfisikinv: '',
            nopo: '0101/PO/2005',
            noworkorder: '0101/WO/2005',
            nomorpolisi: 'B 0101 AC',
            status: '',
            keteranganstatus: '',
          },

          {
            kodenota: '0101/FB/2006/000063',
            tanggal: '05/06/2020',
            namasupplier: 'BAYU',
            tanggalpengiriman: '',
            referensi: '1234567890',
            total: 3147555,
            diskon: 314755,
            hasildiskon: 2832799.50,
            ppn: 283279.95,
            totalbayar: 3116079.45,
            ppnfaktur: 0,
            cekfisikinv: '',
            nopo: '0101/PO/2005',
            noworkorder: '0101/WO/2004',
            nomorpolisi: 'KT 2020 BA',
            status: '',
            keteranganstatus: '',
          },

          { 
            kodenota: '0101/FB/2006/000064',
            tanggal: '05/06/2020',
            namasupplier: 'BAYU',
            tanggalpengiriman: '',
            referensi: '1234567890',
            total: 7521066,
            diskon: 752106.60,
            hasildiskon: 6768959.40,
            ppn: 676895.94,
            totalbayar: 7445855.34,
            ppnfaktur: 0,
            cekfisikinv: '',
            nopo: '0101/PO/2005',
            noworkorder: '0101/WO/2004',
            nomorpolisi: 'B 0101 AC',
            status: '',
            keteranganstatus: '',
          },

          {
            kodenota: '0101/FB/2006/000065',
            tanggal: '05/06/2020',
            namasupplier: 'RESKI',
            tanggalpengiriman: '',
            referensi: '1234567890',
            total: 500000,
            diskon: 0,
            hasildiskon: 500000,
            ppn: 0,
            totalbayar: 500000,
            ppnfaktur: 0,
            cekfisikinv: '',
            nopo: '0101/PO/2006',
            noworkorder: '0101/WO/2006',
            nomorpolisi: 'KT 0202 BB',
            status: '',
            keteranganstatus: '',
          },

          {
            kodenota: '0101/FB/2006/000066',
            tanggal: '05/06/2020',
            namasupplier: 'RESKI',
            tanggalpengiriman: '',
            referensi: '1234567890',
            total: 10130000,
            diskon: 0,
            hasildiskon: 10130000,
            ppn: 1013000,
            totalbayar: 11143000,
            ppnfaktur: 0,
            cekfisikinv: '',
            nopo: '0101/PO/2006',
            noworkorder: '0101/WO/2005',
            nomorpolisi: 'KT 2323 FF',
            status: '',
            keteranganstatus: '',
          },

          {
            kodenota: '0101/FB/2006/000067',
            tanggal: '06/06/2020',
            namasupplier: 'ENDHYARNIE',
            tanggalpengiriman: '',
            referensi: '1234567890',
            total: 2600000,
            diskon: 0,
            hasildiskon: 2600000,
            ppn: 0,
            totalbayar: 2600000,
            ppnfaktur: 0,
            cekfisikinv: '',
            nopo: '0101/PO/2006',
            noworkorder: '0101/WO/2002',
            nomorpolisi: 'KT 1212 F',
            status: '',
            keteranganstatus: '',
          },

          {
            kodenota: '0101/FB/2006/000068', 
            tanggal: '06/06/2020', 
            namasupplier: 'RESKI', 
            tanggalpengiriman: '', 
            referensi: '1234567890', 
            total: 350000,
            diskon: 0,
            hasildiskon: 350000,
            ppn: 0,
            totalbayar: 350000,
            ppnfaktur: 0,
            cekfisikinv: '',
            nopo: '0101/PO/2006',
            noworkorder: '0101/WO/2004',
            nomorpolisi: 'F 5656 BC',
            status: '',
            keteranganstatus: '',
          },

          {
            kodenota: '0101/FB/2006/000069',
            tanggal: '06/06/2020',
            namasupplier: 'BAYU',
            tanggalpengiriman: '',
            referensi: '1234567890',
            total: 200000,
            diskon: 0.00,
            hasildiskon: 200000,
            ppn: 0,
            totalbayar: 200000,
            ppnfaktur: 0,
            cekfisikinv: '',
            nopo: '0101/PO/2006',
            noworkorder: '0101/WO/2004',
            nomorpolisi: 'F 5445 FB',
            status: '',
            keteranganstatus: '',
          },

          {
            kodenota: '0101/FB/2006/000070',
            tanggal: '06/06/2020',
            namasupplier: 'BAYU',
            tanggalpengiriman: '',
            referensi: '1234567890',
            total: 1050000,
            diskon: 0.00,
            hasildiskon: 1050000,
            ppn: 0,
            totalbayar: 1050000,
            ppnfaktur: 0,
            cekfisikinv: '',
            nopo: '0101/PO/2004',
            noworkorder: '0101/WO/2004',
            nomorpolisi: 'B 0101 AC',
            status: '',
            keteranganstatus: '',
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

