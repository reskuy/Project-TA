<template>
  <v-col cols="12" md="12">
    <v-card class="elevation-3">
      <v-toolbar
        flat
        dark
        dense
        color="blue darken-4"
        class="elevation-1"
      >
        <v-toolbar-title dark>
          Nota Gudang
        </v-toolbar-title>

        <v-divider class="mx-4" inset vertical></v-divider>
        
        <v-spacer></v-spacer>

        <v-dialog v-model="dialog" scrollable max-width="1200px">
          <template v-slot:activator="{on, attrs}">
            <v-btn
              dark
              color="blue darken-4"
              v-bind="attrs"
              v-on="on" >
              <v-icon>mdi-plus</v-icon>Tambah
            </v-btn>
          </template>

          <v-card>
            <v-toolbar
              dark
              dense
              outline
              color="blue darken-4"
              class="elevation-1"
              >
            <v-card-title>
              <v-icon>mdi-note-plus</v-icon>
              <span class="headline">{{ formTitle }}</span>

            </v-card-title>
            <v-spacer></v-spacer>
             
                <v-btn
                  dark
                  text
                  fab
                  small
                  @click="close">
                  <v-icon class="mx-1">mdi-window-close</v-icon>
                </v-btn>
            </v-toolbar>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" md="6">
                    <v-text-field label="Kode Nota"></v-text-field>
                  </v-col>

                  <v-col cols="12" md="6">
                    <v-text-field 
                      label="Nomor Work Order"
                    >
                      <template v-slot:append-outer>
                        <v-dialog v-model="dialog2" scrollable max-width="1200px">
                          <template v-slot:activator="{on, attrs}">
                            <v-btn
                              permanent
                              small
                              v-bind="attrs"
                              v-on="on" >
                              <v-icon>mdi-dots-horizontal</v-icon>
                            </v-btn>
                          </template>

                          <v-card>
                            <v-toolbar
                              dark
                              dense
                              outline
                              color="blue darken-4"
                              class="elevation-1"
                              >
                            <v-card-title>
                              <v-icon>mdi-note-plus</v-icon>
                              <span class="headline">{{ formTitle }}</span>

                            </v-card-title>
                            </v-toolbar>
                          </v-card>
                        </v-dialog>
                      </template>
                    </v-text-field>
                  </v-col>
            <!-- |------------------------------------------------------------| -->
                  <v-col cols="12" md="6">
                    <v-text-field 
                      label="Nomor Part Order"
                    >
                      <template v-slot:append-outer>
                        <v-dialog v-model="dialog3" scrollable max-width="1200px">
                          <template v-slot:activator="{on, attrs}">
                            <v-btn
                              permanent
                              small
                              v-bind="attrs"
                              v-on="on" >
                              <v-icon>mdi-dots-horizontal</v-icon>
                            </v-btn>
                          </template>

                          <v-card>
                            <v-toolbar
                              dark
                              dense
                              outline
                              color="blue darken-4"
                              class="elevation-1"
                              >
                            <v-card-title>
                              <v-icon>mdi-note-plus</v-icon>
                              <span class="headline">{{ formTitle }}</span>

                            </v-card-title>
                            </v-toolbar>
                          </v-card>
                        </v-dialog>
                      </template>
                    </v-text-field>
                  </v-col>
            <!-- |------------------------------------------------------------| -->
                  <v-col cols="12" md="6">
                    <v-text-field label="Pelanggan"></v-text-field>
                  </v-col>

                  <v-tabs
                    background-color="blue darken-4"
                    color="white"
                    slider-color="white"
                    dark
                  >
                    <v-tab>Barang</v-tab>
                      <v-tab-item>
                        <v-card >
                          <v-container>
                            <ItemsBarang/>
                          </v-container>
                        </v-card>
                      </v-tab-item>
                  </v-tabs>

                  </v-row>
                </v-container>
              </v-card-text>

              <v-divider></v-divider>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  dark
                  color="error"
                  @click="close">
                  <v-icon class="mr-1">mdi-close-circle</v-icon>Batal
                </v-btn>

                <v-btn
                  dark
                  color="blue darken-4"
                  @click="save">
                  <v-icon class="mr-1">mdi-content-save</v-icon>Simpan
                </v-btn>
              </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>

    <div id="app">
        <ejs-grid
            :dataSource="data" height="100%" width="100%" gridLines='Both'
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
            :toolbar='toolbarOptions'
            :commandClick="commandClick"
            >
            <e-columns>
              <e-column field="Commands" headerText="Action" width="120" :commands="commands" textAlign='Left'>
                <div class="btn-group">
                  <button type="button" class="btn btn-default" (click)='prediemRowEdit($event)'>
                    <i class="fa fa-pencil"></i></button>
                  <button type="button" class="btn btn-default" (click)='prediemRowDelete($event)'>
                      <i class="fa fa-trash"></i></button>
                </div>
              </e-column>
              
                <e-column
                  :filter='filter'
                  field='NoBonBahan'
                  headerText='No. Bon Bahan'
                  textAlign='Left'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Tanggal'
                  headerText='Tanggal'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='NoPartOrder'
                  headerText='No. Part Order '
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='TipeKendaraan'
                  headerText='Tipe Kendaraan'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Warna'
                  headerText='Warna'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='NamaBarang'
                  headerText='Nama Barang'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='PartNumber1'
                  headerText='Part Number 1'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Memo'
                  headerText='Memo'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Merk'
                  headerText='Merk'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Kendaraan'
                  headerText='Kendaraan'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Keterangan'
                  headerText='Keterangan'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Jumlah'
                  headerText='Jumlah'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Harga'
                  headerText='Harga'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='SubTotal'
                  headerText='Sub Total'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='KodeSupplier'
                  headerText='Kode Supplier'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Status'
                  headerText='Status'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='KeteranganStatus'
                  headerText='Keterangan Status'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Up'
                  headerText='Up'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='DiBuatOleh'
                  headerText='Di Buat Oleh'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='DiBuatTgl'
                  headerText='Di Buat Tgl'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='DiUbahOleh'
                  headerText='Di Ubah Oleh'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='DiUbahTgl'
                  headerText='Di Ubah Tgl'
                  width=180
                ></e-column>
            </e-columns>

            <e-aggregates>
              <e-aggregate>
                <e-columns>
                  <e-column type="Sum" field="SubTotal" format='C2' :FooterTemplate="footerSum"></e-column>
                </e-columns>
              </e-aggregate>
          </e-aggregates>  
        </ejs-grid>
      </div>
    </v-card>
  </v-col>
</template>

<script>

import Vue from "vue";
import api from '../services/http';
import ItemsBarang from '@/views/NotaGudang/itemsbarang';
import { GridPlugin, Toolbar, Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder,   } from "@syncfusion/ej2-vue-grids";

Vue.use(GridPlugin);

export default {
  components: {
            ItemsBarang,
          },
    data() {
        return {
            editedIndex: -1,
            defaultItem: {
            kode: "",
            name: "",
            alamat: "",
            kota: "",
            aktif: "",
            memo: "",
          },

            editedItem: {
            kode: "",
            name: "",
            alamat: "",
            kota: "",
            aktif: "",
            memo: "",
          },
        dialog: false,
        token : localStorage.getItem('token'),
        data: [],
        commands: [
            { buttonOption: { cssClass: 'e-flat Edit', iconCss: 'e-edit e-icons' } },
            { buttonOption: { cssClass: 'e-flat Delete', iconCss: 'e-delete e-icons' } },
        ],
            
            groupSettings: { allowReordering: true },
            selectionOptions: { type: 'Multiple' },
            toolbarOptions: ['Search'],
            pageSettings: {pageSize: 5, pageSizes :['5','10','15','20','50','All']},
            filterOptions: { type: 'Menu' },
            filter: { type : 'CheckBox' },
            editSettings: { showDeleteConfirmDialog: true, allowEditing: true, allowAdding: true, allowDeleting: true, mode: 'Normal' }, 

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

    mounted(){
        this.getData()
    },

     watch: {
     dialog(val) {
         val || this.close();
        },
     },
    computed: {
        formTitle(){
            return this.editedIndex === -1 ? "Tambah Nota Gudang" : "Edit Nota Gudang";
        }
    },

    methods: {
        save(){
            if(this.formTitle === "Tambah Gudang"){
                this.TambahData()
            }else{
                this.UpdateData()
            }
            this.close()
        },

        UpdateData(){
        api.put('/gudangs/' + this.editedItem.id +'?token='+this.token, {
            Kode: this.editedItem.Kode,
            Nama: this.editedItem.Nama,
            Alamat: this.editedItem.Alamat,
            Kota: this.editedItem.Kota,
            Aktif: this.editedItem.Aktif,
            Memo: this.editedItem.Memo,
        })
        .then((res)=>{
            this.id = ''
            console.log(res)
            this.getData()
        })
        .catch((err)=> {
            console.log(err)
        })
        },

        TambahData(){
            api.post('/gudangs?token='+this.token, {
            Kode: this.editedItem.Kode,
            Nama: this.editedItem.Nama,
            Alamat: this.editedItem.Alamat,
            Kota: this.editedItem.Kota,
            Aktif: this.editedItem.Aktif,
            Memo: this.editedItem.Memo,
        })
        .then((res) => {
            this.Kode = ''
            this.Nama = ''                                                            
            this.Alamat=''
            this.Kota=''
            this.Aktif=''
            this.Memo=''
            console.log(res)
            this.getData()
            this.close()
        })
        .catch((err) => {
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
        } 
        
        else if (args.target.classList.contains("Delete")) {
            var r = confirm("Yakin Hapus Data?");
            if (r == true) {
                api.delete('/gudangs/'+args.rowData.id+'?token='+this.token)
                .then((res)=> {
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
            api.get('/gudangs?token='+this.token).then(
        res=>{
            console.log(res)
            this.data = res.data
        },
        err => {
            console.log(err)
        })},
    }
}
</script>

<style>
    .e-grid .e-groupdroparea.e-grouped { 
        background-color: rgb(25, 118, 210) ; 
    } 
    .e-grid .e-groupheadercell { 
        background-color: rgb(29, 79, 129) ; 
    } 
</style>