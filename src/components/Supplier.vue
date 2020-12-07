<template>
  <v-col cols="12" md="12">
    <v-card class="elevation-3">
      <v-toolbar
        flat
        dark
        dense
        color='blue darken-4'
        class="elevation-1"
      >
        <v-toolbar-title dark>
          Supplier
        </v-toolbar-title>

        <v-divider class="mx-4" inset vertical></v-divider>

        <v-spacer></v-spacer>

        <v-dialog v-model="dialogSupplier" scrollable max-width="1200px" >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              dark
              class="mx-n2"
              color="blue darken-4"
              v-bind="attrs"
              v-on="on">
              <v-icon>mdi-plus</v-icon>
              Tambah
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
              <span class="headline">{{ formTitleSupplier }}</span>
            </v-card-title>
            <v-spacer></v-spacer>
             
              <v-btn
                dark
                text
                fab
                small
                @click="closeSupplier">
                  <v-icon class="mx-1">mdi-window-close</v-icon>
              </v-btn>
            </v-toolbar>

            <v-card-text>
              <v-container class="my-10">
                <v-row>
                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.Kode"
                      label="Kode" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.Nama"
                      label="Nama" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.BadanHukum"
                      label="Badan Hukum" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.Alamat"
                      label="Alamat" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.Kota"
                      label="Kota" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.KodePos"
                      label="Kode Pos" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.Negara"
                      label="Negara" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.Telp"
                      label="Telp" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.Fax"
                      label="Fax" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.Email"
                      label="Email" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.ContactPerson"
                      label="Contact Person" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.GrupSupplier"
                      label="Grup Supplier" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.KreditLimit"
                      label="Kredit Limit" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.LamaKredit"
                      label="Lama Kredit" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.Memo"
                      label="Memo" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.npwp"
                      label="NPWP" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.nppkp"
                      label="NPPKP" outlined>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      clearable
                      v-model="editedItem.TglPengukuhan"
                      label="TglPengukuhan" outlined>
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
                  @click="closeSupplier">
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
            :dataSource="data" height="270" width="100%" gridLines='Both'
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
              <e-column field="Commands" headerText="Action" width="115" :commands="commands" textAlign='center'>
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
                  field='BillFrom'
                  headerText='BillFrom'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='SellFrom'
                  headerText='SellFrom'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='BadanHukum'
                  headerText='Badan Hukum '
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Alamat'
                  headerText='Alamat'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Kota'
                  headerText='Kota'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='KodePos'
                  headerText='Kode Pos'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Negara'
                  headerText='Negara'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Telp'
                  headerText='Telp'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Fax'
                  headerText='Fax'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Email'
                  headerText='Email'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='ContactPerson'
                  headerText='Contact Person'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='GrupSupplier'
                  headerText='Grup Supplier'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='KreditLimit'
                  headerText='Kredit Limit'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='LamaKredit'
                  headerText='Lama Kredit'
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
                  field='NPWP'
                  headerText='NPWP'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='NPPKP'
                  headerText='NPPKP'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='TglPengukuhan'
                  headerText='TglPengukuhan'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Aktif'
                  headerText='Aktif'
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
            Kode: "",
            Nama: "",
            BillFrom: "",
            SellFrom: "",
            BadanHukum: "",
            Alamat: "",
            Kota: "",
            KodePos: "",
            Negara: "",
            Telp: "",
            Fax: "",
            Email: "",
            ContactPerson: "",
            GrupSupplier: "",
            KreditLimit: "",
            LamaKredit: "",
            Memo: "",
            npwp: "",
            nppkp: "",
            TglPengukuhan: "",
            Aktif: "",
            
          },

            editedItem: {
            Kode: "",
            Nama: "",
            BillFrom: "",
            SellFrom: "",
            BadanHukum: "",
            Alamat: "",
            Kota: "",
            KodePos: "",
            Negara: "",
            Telp: "",
            Fax: "",
            Email: "",
            ContactPerson: "",
            GrupSupplier: "",
            KreditLimit: "",
            LamaKredit: "",
            Memo: "",
            npwp: "",
            nppkp: "",
            TglPengukuhan: "",
            Aktif: "",
          },
        dialogSupplier: false,
        dialogNoWorkOrder: false,
        dialogNoPartOrder: false,
        token : localStorage.getItem('token'),
        data: [],
        commands: [
            {  buttonOption: { cssClass: 'e-flat Edit', iconCss: 'e-edit e-icons' } },
            {  buttonOption: { cssClass: 'e-flat Delete', iconCss: 'e-delete e-icons' } },
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
      dialogSupplier(val) {
         val || this.closeSupplier();
      },
      dialogNoWorkOrder(val) {
         val || this.closeNoWorkOrder();
      },
      dialogNoPartOrder(val) {
         val || this.closeNoPartOrder();
      },
      
    },

    computed: {
        formTitleSupplier(){
            return this.editedIndex === -1 ? "Tambah Supplier" : "Edit Supplier";
        },

        formTitleNoWorkOrder(){
            return this.editedIndex === -1 ? "Tambah No.Work Order" : "Edit No.Work Order";
        },

        formTitleNoPartOrder(){
            return this.editedIndex === -1 ? "Tambah No.Part Order" : "Edit No.Part Order";
        },
        
    },
    
    methods: {
        save(){
            if(this.formTitleSupplier === "Tambah Supplier"){
                this.TambahData()
            }else{
                this.UpdateData()
            }
            this.closeSupplier()
        },

        UpdateData(){
        api.put('/suppliers/' + this.editedItem.id +'?token='+this.token, {
            Kode: this.editedItem.Kode,
            Nama: this.editedItem.Nama,
            BillFrom: this.editedItem.BillFrom,
            SellFrom: this.editedItem.SellFrom,
            BadanHukum: this.editedItem.BadanHukum,
            Alamat: this.editedItem.Alamat,
            Kota: this.editedItem.Kota,
            KodePos: this.editedItem.KodePos,
            Negara: this.editedItem.Negara,
            Telp: this.editedItem.Telp,
            Fax: this.editedItem.Fax,
            Email: this.editedItem.Email,
            ContactPerson: this.editedItem.ContactPerson,
            GrupSupplier: this.editedItem.GrupSupplier,
            KreditLimit: this.editedItem.KreditLimit,
            LamaKredit: this.editedItem.LamaKredit,
            Memo: this.editedItem.Memo,
            NPWP: this.editedItem.npwp,
            NPPKP: this.editedItem.nppkp,
            TglPengukuhan: this.editedItem.TglPengukuhan,
            Aktif: this.editedItem.Aktif,
            
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
            api.post('/suppliers?token='+this.token, {
            Kode: this.editedItem.Kode,
            Nama: this.editedItem.Nama,
            BillFrom: this.editedItem.BillFrom,
            SellFrom: this.editedItem.SellFrom,
            BadanHukum: this.editedItem.BadanHukum,
            Alamat: this.editedItem.Alamat,
            Kota: this.editedItem.Kota,
            KodePos: this.editedItem.KodePos,
            Negara: this.editedItem.Negara,
            Telp: this.editedItem.Telp,
            Fax: this.editedItem.Fax,
            Email: this.editedItem.Email,
            ContactPerson: this.editedItem.ContactPerson,
            GrupSupplier: this.editedItem.GrupSupplier,
            KreditLimit: this.editedItem.KreditLimit,
            LamaKredit: this.editedItem.LamaKredit,
            Memo: this.editedItem.Memo,
            NPWP: this.editedItem.npwp,
            NPPKP: this.editedItem.nppkp,
            TglPengukuhan: this.editedItem.TglPengukuhan,
            Aktif: this.editedItem.Aktif,
        })
        .then((res) => {
            this.Kode = ''
            this.Nama = ''                                                            
            this.BillFrom=''
            this.SellFrom=''
            this.BadanHukum=''
            this.Alamat=''
            this.Kota=''
            this.KodePos=''
            this.Negara=''
            this.Telp=''
            this.Fax=''
            this.Email=''
            this.ContactPerson=''
            this.GrupSupplier=''
            this.KreditLimit=''
            this.LamaKredit=''
            this.Memo=''
            this.NPWP=''
            this.NPPKP=''
            this.TglPengukuhan=''
            this.Aktif=''
            console.log(res)
            this.getData()
            this.closeSupplier()
        })
        .catch((err) => {
            console.log(err)
        })
        },

        closeSupplier() {
        this.dialogSupplier = false;
        this.editedItem = this.defaultItem
        this.editedIndex = -1
        },
        closeNoWorkOrder() {
        this.dialogNoWorkOrder = false;
        },
        closeNoPartOrder() {
        this.dialogNoPartOrder = false;
        },

        commandClick: function(args) {
        if (args.target.classList.contains("custombutton")) {
            
            let data = JSON.stringify(args.rowData)
            
            console.log(data)
        } else if (args.target.classList.contains("Delete")) {
            var r = confirm("Yakin Hapus Data?");
            if (r == true) {
                api.delete('/notaGudangs/'+args.rowData.id+'?token='+this.token)
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
            this.dialogSupplier = true
        }},

        actionComplete(args) {
        console.log(args)
    },

        getData(){
            api.get('/supplier?token='+this.token).then(
        res=>{
            console.log(res)
            this.data = res.data
        },
        err => {
            console.log(err)
            // this.$router.push('/')
            // localStorage.removeItem('token')
        })},
    }
}
</script>

<style>
    .centered-input input {
    text-align: right
  }

    .e-grid .e-groupdroparea.e-grouped { 
        background-color: rgb(25, 118, 210) ; 
    } 
    .e-grid .e-groupheadercell { 
        background-color: rgb(29, 79, 129) ; 
    } 
</style>