<template>
<v-col cols="12" md="12">
    <v-toolbar flat dark dense color="danger" class="elevation-1">
        <v-toolbar-title dark>
            <v-icon>mdi-cart</v-icon>
            Customers
        </v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-dialog v-model="dialog" max-width="1000px">
            <template v-slot:activator="{ on, attrs }">
                <v-btn color="primary" dark v-bind="attrs" v-on="on">
                    <v-icon>mdi-plus</v-icon>TAMBAH
                </v-btn>
            </template>
            <v-card>
                <v-card-title>
                <!-- <span class="headline">{{ formTitle }}</span> -->
                    <h3>Tambah data</h3>
                </v-card-title>

                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="6" md="2">
                            <v-text-field
                                v-model="editedItem.id"
                                label="Kode"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="8">
                            <v-text-field
                                v-model="editedItem.Nama"
                                label="Nama"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                            <v-text-field
                                v-model="editedItem.BadanHukum"
                                label="Badan Hukum"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="12">
                            <v-text-field
                                v-model="editedItem.Alamat"
                                label="Alamat"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                v-model="editedItem.Kota"
                                label="Kota"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                v-model="editedItem.KodePos"
                                label="Kode Pos"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                v-model="editedItem.Negara"
                                label="Negara"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                v-model="editedItem.Telp"
                                label="Telepon"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                v-model="editedItem.Fax"
                                label="Fax"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                v-model="editedItem.Email"
                                label="Email"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                v-model="editedItem.ContactPerson"
                                label="Contact Person"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                v-model="editedItem.SalesPerson"
                                label="Sales Person"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                v-model="editedItem.GrupPelanggan"
                                label="Group Pelanggan"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                            <!-- <v-switch
                                v-model="editedItem.Aktif"
                                color="primary"
                                label="Aktif"
                            ></v-switch> -->
                            <v-text-field v-model="editedItem.Aktif" label="Aktif"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                v-model="editedItem.KreditLimit"
                                label="Kredit Limit"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                v-model="editedItem.lamaKredit"
                                label="Lama Kredit"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                v-model="editedItem.CustSince"
                                label="Cust Since"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                v-model="editedItem.Memo"
                                label="Memo"
                            ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                v-model="editedItem.Asuransi"
                                label="Asuransi"
                            ></v-text-field>
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
                <v-btn color="success" @click="UpdateData">
                  <v-icon class="mr-4">fas fa-save</v-icon>update
                </v-btn>
              </v-card-actions>
            </v-card>
        </v-dialog>
    </v-toolbar>

    <div id="app">
        <ejs-grid
            :dataSource="data"
            :dataStateChange = 'dataStateChange'
            :dataSourceChanged={dataSourceChanged}
            height="200%"
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
            :toolbar='toolbarOptions'
            :commandClick="commandClick"
            >
            <e-columns>
                <e-column field="Commands" headerText="Action" width="150" :commands="commands">
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
                    headerText='Kode Customers'
                    textAlign='Left'
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='Nama'
                    headerText='Nama Customers'
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='BadanHukum'
                    headerText='Badan Hukum'
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
                    field='KodePos'
                    headerText='Kode POs'
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
                    headerText='Email Customers'
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
                    field='SalesPerson'
                    headerText='Sales Person'
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='GrupPelanggan'
                    headerText='Grup Pelanggan'
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
                    field='CustSince'
                    headerText='CustSince'
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
                    field='Asuransi'
                    headerText='Asuransi'
                    width=180
                ></e-column>
            </e-columns>
        </ejs-grid>
    </div>
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
            editedItem: {
            name: "",
            badanHukum: "",
            alamat: "",
            kota: "",
            kodePos: "",
            negara: "",
            telp: "",
            fax: "",
            email: "",
            cp: "",
            sales: "",
            groupPelanggan: "",
            aktif: "",
            kreditLimit: "",
            lamaKredit: "",
            CustSince: "",
            memo: "",
            asuransi: "",
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
            toolbarOptions: ['Search', 'Add', 'Edit', 'Delete', 'Update', 'Cancel'],
            pageSettings: {pageSize: 5, pageSizes :['5','10','15','20','50','All']},
            filterOptions: { type: 'Menu' },
            filter: { type : 'CheckBox' },
            editSettings: { showDeleteConfirmDialog: true, allowEditing: true, allowAdding: true, allowDeleting: true, mode: 'Dialog' },
            toolbar: ['Add', 'Edit', 'Delete', 'Update', 'Cancel'],
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
    watch: {
    dialog(val) {
        val || this.close();
        },
    },
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
        save(){
            api.post('/customers?token='+this.token, {
            Nama: this.editedItem.Nama,
            BadanHukum: this.editedItem.BadanHukum,
            Alamat: this.editedItem.Alamat,
            Kota: this.editedItem.Kota,
            KodePos: this.editedItem.KodePos,
            Negara: this.editedItem.Negara,
            Telp: this.editedItem.Telp,
            Fax: this.editedItem.Fax,
            Email: this.editedItem.Email,
            ContactPerson: this.editedItem.ContactPerson,
            SalesPerson: this.editedItem.SalesPerson,
            GrupPelanggan: this.editedItem.GrupPelanggan,
            Aktif: this.editedItem.Aktif,
            KreditLimit: this.editedItem.KreditLimit,
            CustSince: this.editedItem.CustSince,
            Memo: this.editedItem.Memo,
            Asuransi: this.editedItem.Asuransi
        })
        .then((res) => {
            this.Nama = ''
            this.BadanHukum = ''
            this.Alamat=''
            this.Kota=''
            this.KodePos=''
            this.Negara=''
            this.Telp=''
            this.Fax=''
            this.Email=''
            this.ContactPerson=''
            this.SalesPerson=''
            this.GrupPelanggan=''
            this.Aktif=''
            this.KreditLimit=''
            this.CustSince=''
            this.Memo=''
            this.Asuransi=''
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
            // let data = JSON.stringify(args.rowData)
            // console.log(data)
            // console.log(args)
            api.delete('/customers/'+args.rowData.id+'?token='+this.token)
            .then((res)=> {
                // this.item.splice(index, 1)
                console.log(res)
            })
            .catch((err)=> {
                console.log(err)
            })
        } else if (args.target.classList.contains('Edit')) {
            let data = args
            console.log(data)
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
            api.get('/customers?token='+this.token).then(
        res=>{
            console.log(res)
            this.data = res.data
        },
        err => {
            console.log(err)
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

</style>