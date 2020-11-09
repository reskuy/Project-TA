<template>
  <v-col cols="12" md="12">
    <v-card class="elevation-3">
      <v-toolbar
        flat
        dark
        dense
        color="primary"
        class="elevation-1"
      >
        <v-toolbar-title dark>
          <v-icon>mdi-warehouse</v-icon>Gudang
        </v-toolbar-title>

        <v-divider class="mx-4" inset vertical></v-divider>

        <v-spacer></v-spacer>

        <v-dialog v-model="dialog" scrollable max-width="800px">
          <template v-slot:activator="{on, attrs}">
            <v-btn
              dark
              color="primary"
              v-bind="attrs"
              v-on="on" >
              <v-icon>mdi-plus</v-icon>
              Tambah Gudang 
            </v-btn>
          </template>

          <v-card>
            <v-toolbar
              dark
              dense
              outline
              color="primary"
              class="elevation-1"
              >
            <v-card-title>
              <v-icon>mdi-cart-plus</v-icon>
              <span class="headline">{{ formTitle }}</span>
                            <!-- <h3>Tambah data</h3> -->
            </v-card-title>
            </v-toolbar>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      dense
                      v-model="editedItem.id"
                      label="Kode">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      dense
                      v-model="editedItem.Nama"
                      label="Nama">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="12">
                    <v-text-field
                      dense
                      v-model="editedItem.Alamat"
                      label="Alamat">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      dense
                      v-model="editedItem.Kota"
                      label="Kota">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="6">
                                    <!-- <v-switch
                                        v-model="editedItem.Aktif"
                                        color="primary"
                                        label="Aktif"
                                    ></v-switch> -->
                    <v-text-field 
                      dense
                      v-model="editedItem.Aktif"
                      label="Aktif"></v-text-field>
                    </v-col>

                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        dense
                        v-model="editedItem.Memo"
                        label="Memo">
                      </v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close">
                        <v-icon>mdi-arrow-left</v-icon>Cancel
                    </v-btn>
                    <v-btn color="success" @click="save">
                        <v-icon class="mr-4">fas fa-save</v-icon>Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-toolbar>

    <div id="app">
        <ejs-grid
            :dataSource="data" height="240" width="100%" gridLines='Both'
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
                    field='id'
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

// import  OrderService  from "../services/order-service";
import Vue from "vue";
// import { DataManager, UrlAdaptor} from "@syncfusion/ej2-data";
import { GridPlugin, Toolbar, Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder,   } from "@syncfusion/ej2-vue-grids";
// const baseUrl = "http://localhost:8000/api";
import api from '../axios/http'
// const [data, setData] = useState()
Vue.use(GridPlugin);

export default {
    data() {
        return {
            editedIndex: -1,
            defaultItem: {
            name: "",
            alamat: "",
            kota: "",
            aktif: "",
            memo: "",
          },

            editedItem: {
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
            // {
            //     buttonOption: { content: "aa", cssClass: "e-flat custombutton" }
            // },
            {  buttonOption: { cssClass: 'e-flat Edit', iconCss: 'e-edit e-icons' } },
        { buttonOption: { cssClass: 'e-flat Delete', iconCss: 'e-delete e-icons' } },
        // { type: 'Save', buttonOption: { cssClass: 'e-flat', iconCss: 'e-update e-icons' } },
        // { type: 'Cancel', buttonOption: { cssClass: 'e-flat', iconCss: 'e-cancel-icon e-icons' } }
        ],
            // orderService: new OrderService(),
            // data: [
            //     {
            //         id: "Test",
            //         Nama: "Test",
            //         BadanHukum: "Test",
            //         Alamat: "Test",
            //         Kota: "Test",
            //         KodePos: "Test",
            //         Negara: "Test",
            //         Telp: "Test",
            //         Fax: "Test",
            //         Email: "Test",
            //         ContactPerson: "Test",
            //         SalesPerson: "Test",
            //         GrupPelanggan: "Test",
            //         Aktif: "Test",
            //         KreditLimit: "Test",
            //         LamaKredit: "Test",
            //         CustSince: "Test",
            //         Memo: "Test",
            //         Asuransi: "Test",
            //     },
                
            //     {
            //         id: "Test1",
            //         Nama: "Test1",
            //         BadanHukum: "Test1",
            //         Alamat: "Test",
            //         Kota: "Test",
            //         KodePos: "Test",
            //         Negara: "Test",
            //         Telp: "Test",
            //         Fax: "Test",
            //         Email: "Test",
            //         ContactPerson: "Test",
            //         SalesPerson: "Test",
            //         GrupPelanggan: "Test",
            //         Aktif: "Test",
            //         KreditLimit: "Test",
            //         LamaKredit: "Test",
            //         CustSince: "Test",
            //         Memo: "Test",
            //         Asuransi: "Test",
            //     },
            // ],
            
            groupSettings: { allowReordering: true },
            selectionOptions: { type: 'Multiple' },
            toolbarOptions: ['Search'],
            pageSettings: {pageSize: 5, pageSizes :['5','10','15','20','50','All']},
            filterOptions: { type: 'Menu' },
            filter: { type : 'CheckBox' },
            editSettings: { showDeleteConfirmDialog: true, allowEditing: true, allowAdding: true, allowDeleting: true, mode: 'Normal' },
            // toolbar: ['Add', 'Edit', 'Delete', 'Update', 'Cancel'],
            // data: new DataManager({ 
            //     url: 'http://localhost:8000/api/customers?token='+this.token,
            //     adaptor: new WebApiAdaptor(), 
            //     crossDomain: true 
            // }) 
            // data: new DataManager({ 
            //     url: 'http://localhost:8000/api/customers?token='+localStorage.getItem('token') + {method:'get'}, 
                
            //     updateUrl: 'customers?token='+this.token,
            //     insertUrl: 'customers?token='+this.token, 
            //     removeUrl: 'customers?token='+this.token, 
            //     adaptor: new UrlAdaptor() 
            // }), 
        }
    },

    provide: {
        grid: [Page, Toolbar, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder]
    },

    mounted(){
        this.getData()
        // let state = any;
        // this.dataStateChange();
        // this.dataStateChange(state);


    },

    
    // dataStateChange(state){
    //     console.log(state)
    // },
    // watch: {
    // dialog(val) {
    //     val || this.close();
    //     },
    // },
    computed: {
        formTitle(){
            return this.editedIndex === -1 ? "Tambah Gudang" : "Edit Gudang";
        }
    },
    // computed: {
    //     formTitle(){
    //         if(this.editedItem.id == ""){
    //             return "Edit Data"
    //         } else if(this.editedItem.id != "") {
    //             return "Add Data"
    //         } else {
    //             return ""
    //         }
    //     }
    // },
    methods: {
        // dataStateChange: function () {
        //     // this.orderService.execute(state).then(( gridData ) => this.data = gridData );
        //     this.getData()
        // },
        // dataSourceChanged: function (state) {
        //     if (state.action === 'add') {
        //     this.orderService.add(state).subscribe(() => state.endEdit());
        //     } else if (state.action === 'edit') {
        //     this.orderService.update(state).subscribe(() => state.endEdit());
        //     } else if (state.requestType === 'delete') {
        //     this.orderService.hapus(state).subscribe(() => state.endEdit());
        //     }
        // },
        title(){
            // let formTitle = ''
            // if(this.editedItem.Nama == null){
            //     formTitle = "Add New Customers"
            // } else {
            //     formTitle = "Edit Item"
            // }
        },
        save(){
            if(this.formTitle === "Tambah Baru Gudang"){
                this.TambahData()
            }else{
                this.UpdateData()
            }
            this.close()
            
        },

        UpdateData(){
        api.put('/gudang/' + this.editedItem.id +'?token='+this.token, {
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
            api.post('/gudang?token='+this.token, {
            Nama: this.editedItem.Nama,
            Alamat: this.editedItem.Alamat,
            Kota: this.editedItem.Kota,
            Aktif: this.editedItem.Aktif,
            Memo: this.editedItem.Memo,
        })
        .then((res) => {
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
            // let tampung = []
            let data = JSON.stringify(args.rowData)
            // console.log(args);
            // alert(JSON.stringify(args.rowData));
            // console.log(JSON.stringify(args.rowData))
            // tampung.push(args.rowData)
            // this.editedItem = Object.assign({},data)
            console.log(data)
        } else if (args.target.classList.contains("Delete")) {
            var r = confirm("Yakin Hapus Data?");
            if (r == true) {
                api.delete('/gudang/'+args.rowData.id+'?token='+this.token)
                .then((res)=> {
                    // this.item.splice(index, 1)
                    console.log(res)
                    this.getData()
                })
                .catch((err)=> {
                    console.log(err)
                })
            } 
            // let data = JSON.stringify(args.rowData)
            // console.log(data)
            // console.log(args)
            
        } else if (args.target.classList.contains('Edit')) {
            let data = args
            this.editedIndex = 1;
            console.log(data)
            this.editedItem = data.rowData
            this.dialog = true
        }},

        actionComplete(args) {
        // if ((args.requestType === 'beginEdit' || args.requestType === 'add')) {
        //     let dialog = args.dialog;
        //     dialog.height = 400;
        //     // change the header of the dialog
        //     dialog.header = args.requestType === 'beginEdit' ? 'Edit Record' : 'New Record';
        // }
        console.log(args)
    },

        getData(){
            api.get('/gudang?token='+this.token).then(
        res=>{
            console.log(res)
            this.data = res.data
        },
        err => {
            console.log(err)
            // this.$router.push('/')
            // localStorage.removeItem('token')
        })},

        // TambahData(order){
        //     // api.post('/customers?token='+this.token, {
        //     //     body
        //     // })
        //     return fetch(baseUrl+'/customers?token='+this.token,{
        //         method: "post",
        //         headers: {"Content-type": "application/json"},
        //         body: JSON.stringify({
        //             value: order
        //         })
        //     }).then(data => {
        //         return data;
            
        //     })
        // }
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