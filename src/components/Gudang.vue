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
        Gudang
        </v-toolbar-title>

        <v-divider class="mx-4" inset vertical></v-divider>
        
        <v-spacer></v-spacer>

        <v-dialog v-model="dialog" scrollable max-width="700px">
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
              <v-icon>mdi-cart-plus</v-icon>
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
              <v-container class="my-10">
                <v-row>
                  <v-col cols="12" sm="6" md="6" class="mt-n8">
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.Kode"
                      label="Kode">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="6" class="mt-n8">
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.Nama"
                      label="Nama">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="12" class="mt-n8">
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.Alamat"
                      label="Alamat">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="6" class="mt-n8">
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.Kota"
                      label="Kota">
                    </v-text-field>
                  </v-col>
                  
                  <v-col cols="12" sm="6" md="6" class="mt-n8">
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.Memo"
                      label="Memo">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="6" class="mt-n8">
                    <v-switch outlined dense
                      v-model="editedItem.Aktif"
                      label="Aktif"
                      true-value="True"
                      false-value="False"
                    >
                    </v-switch>
                  </v-col>
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
                    field='Kode'
                    headerText='Kode'
                    textAlign='Left'
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='Nama'
                    headerText='Nama'
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='Alamat'
                    headerText='Alamat '
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='Kota'
                    headerText='Kota '
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='Aktif'
                    headerText='Aktif'
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='Memo'
                    headerText='Memo'
                    width=180
                ></e-column>

            </e-columns>
        </ejs-grid>
    </div>
        </v-card>
  </v-col>
</template>

<script>
import Vue from "vue";
import { GridPlugin, Toolbar, Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder,   } from "@syncfusion/ej2-vue-grids";
import api from '@/axios/http'
Vue.use(GridPlugin);

export default {
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
            {  buttonOption: { cssClass: 'e-flat Edit', iconCss: 'e-edit e-icons' } },
        { buttonOption: { cssClass: 'e-flat Delete', iconCss: 'e-delete e-icons' } },
        ],    
            groupSettings: { allowReordering: true },
            selectionOptions: { type: 'Multiple' },
            toolbarOptions: ['Search'],
            pageSettings: {pageSize: 5, pageSizes :['5','10','15','20','50','All']},
            filterOptions: { type: 'Menu' },
            filter: { type : 'CheckBox' },
            editSettings: { showDeleteConfirmDialog: true, allowEditing: true, allowAdding: true, allowDeleting: true, mode: 'Normal' },
        }
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
            return this.editedIndex === -1 ? "Tambah Gudang" : "Edit Gudang";
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
        api.put('/gudang/' + this.editedItem.id +'?token='+this.token, {
            Kode: this.editedItem.Kode,
            Nama: this.editedItem.Nama,
            Alamat: this.editedItem.Alamat,
            Kota: this.editedItem.Kota,
            Aktif: this.editedItem.Aktif,
            Memo: this.editedItem.Memo,
        })
        .then(()=>{
            this.id = ''
            this.getData()
        })
        .catch((err)=> {
            console.log(err)
        })
        },

        TambahData(){
            api.post('/gudang?token='+this.token, {
            Kode: this.editedItem.Kode,
            Nama: this.editedItem.Nama,
            Alamat: this.editedItem.Alamat,
            Kota: this.editedItem.Kota,
            Aktif: this.editedItem.Aktif,
            Memo: this.editedItem.Memo,
        })
        .then(() => {
            this.Kode = ''
            this.Nama = ''                                                            
            this.Alamat=''
            this.Kota=''
            this.Aktif=''
            this.Memo=''
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
        } else if (args.target.classList.contains("Delete")) {
            var r = confirm("Yakin Hapus Data?");
            if (r == true) {
                api.delete('/gudang/'+args.rowData.id+'?token='+this.token)
                .then(()=> {
                    this.getData()
                })
                .catch((err)=> {
                    console.log(err)
                })
            } 

        } else if (args.target.classList.contains('Edit')) {
            let data = args
            this.editedIndex = 1;
            this.editedItem = data.rowData
            this.dialog = true
        }},

        getData(){
            api.get('/gudang?token='+this.token).then(
        res=>{
            this.data = res.data
        },
        err => {
            console.log(err)
            this.$router.push('/')
             localStorage.removeItem('token')
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