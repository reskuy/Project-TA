<template>
<v-col cols="12" md="12">
    <v-toolbar flat dark dense color="danger" class="elevation-1">
        <v-toolbar-title dark>
            detail barang
        </v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <CariBarang v-on:lempar="updateBarang($event)"/>
    </v-toolbar>

    <div id="app">
        <ejs-grid
            :dataSource="datasync"
            height="200"
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
            @actionComplete="onActionComplete"
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
                    field='barang'
                    headerText='Barang'
                    textAlign='Left'
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='kode'
                    headerText='Kode'
                    width=180
                    :isPrimaryKey="true"
                ></e-column>

                <e-column
                    :filter='filter'
                    field='nama'
                    headerText='Nama'
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='part_number1'
                    headerText='Part Number 1'
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='merk'
                    headerText='Merk '
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='kendaraan'
                    headerText='Kendaraan '
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='jumlah'
                    headerText='Jumlah'
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='satuan'
                    headerText='Satuan'
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='harga'
                    headerText='Harga'
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='diskon'
                    headerText='Diskon (%)'
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='diskonRp'
                    headerText='Diskon (Rp)'
                    width=180
                ></e-column>

                <e-column
                    :filter='filter'
                    field='subtotal'
                    headerText='Sub Total'
                    width=180
                ></e-column>

            </e-columns>
        </ejs-grid>
    </div>
    <div>
        <h5>
            data dari eventbus:{{dataTampung}}
        </h5>
    </div>
</v-col>
</template>

<script>
import { bis } from '@/busBrg';
import Vue from "vue";
import { GridPlugin, Toolbar, Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder,   } from "@syncfusion/ej2-vue-grids";
import CariBarang from "@/views/Invoice/CariBrgSync";
Vue.use(GridPlugin);

export default {
    components:{
        CariBarang
    },
    data() {
        return {
        dialog: false,
        dataTampung:[],
        datasync: [],
        commands: [
            {  buttonOption: { cssClass: 'e-flat Edit', iconCss: 'e-edit e-icons' } },
            { buttonOption: { cssClass: 'e-flat Delete', iconCss: 'e-delete e-icons' } },
        ],
            
            groupSettings: { allowReordering: true },
            selectionOptions: { type: 'Multiple' },
            toolbarOptions: ['Search', "Update", "Cancel"],
            pageSettings: {pageSize: 5, pageSizes :['5','10','15','20','50','All']},
            filterOptions: { type: 'Menu' },
            filter: { type : 'CheckBox' },
            editSettings: { showDeleteConfirmDialog: true, allowEditing: true, allowAdding: true, allowDeleting: true, mode: 'Batch' },
        }
    },

    provide: {
        grid: [Page, Toolbar, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder]
    },

    mounted(){
        bis.$on("lempar",Input =>{
            this.dataTampung=Input
        },
        this.dataTampung = [...this.dataTampung]
        )
        this.datasync = this.dataTampung
    },

    created(){
        bis.$on("lempar",Input =>{
            this.dataTampung=Input
            // for (let a = 0; a < this.dataTampung.length; a++) {
            //     this.dataTampung[a].barang = this.dataTampung[a]['brg']
            //     this.dataTampung[a].jumlah = this.dataTampung[a]['jml']
            //     this.dataTampung[a].part_number1 = this.dataTampung[a]['partnumber1']
            //     this.dataTampung[a].subtotal = this.dataTampung[a]['subTotal']
            //     delete this.dataTampung[a].brg
            //     delete this.dataTampung[a].jml
            //     delete this.dataTampung[a].partnumber1
            //     delete this.dataTampung[a].subTotal
            // }
            this.datasync = this.dataTampung
        })
    },

    methods: {
        updateBarang(data){
            this.data = data
            let newArraySync = this.data.map(item => {
                return {
                        barang: "-",
                        kode: item.kode,
                        nama: item.nama,
                        part_number1: item.part_number1,
                        merk:item.merk,
                        kendaraan:"-",
                        jumlah:1,
                        satuan:item.satuan,
                        harga: 0,
                        diskon:0,
                        diskonRp: function (){
                            return this.diskon*this.harga/100;
                        },
                        subtotal: function (){
                            return this.harga * this.jumlah - this.diskonRp();
                        }
                    }
            })
            
            for (let index = 0; index < newArraySync.length; index++) {
                const element = newArraySync[index];
                var diskon = element.diskonRp()
                var subtotal = element.subtotal()
                element.diskonRp = diskon
                element.subtotal = subtotal
                this.datasync.push(element)
            }
            //Refresh data grid
            this.datasync=[...this.datasync]

            var obj = {}
            for(var i = 0, len=this.datasync.length; i < len; i++)
                obj[this.datasync[i]['kode']] = this.datasync[i]
            this.datasync = new Array()
            for (var key in obj)
            this.datasync.push(obj[key])

            console.log(this.datasync)
        },
        commandClick: function(args) {
            console.log(args)
        // if (args.target.classList.contains("custombutton")) {
        //     // let tampung = []
        //     let data = JSON.stringify(args.rowData)
        //     // console.log(args);
        //     // alert(JSON.stringify(args.rowData));
        //     // console.log(JSON.stringify(args.rowData))
        //     // tampung.push(args.rowData)
        //     // this.editedItem = Object.assign({},data)
        //     console.log(data)
        // } else if (args.target.classList.contains("Delete")) {
        //     var r = confirm("Yakin Hapus Data?");
        //     if (r == true) {
        //         api.delete('/customers/'+args.rowData.id+'?token='+this.token)
        //         .then((res)=> {
        //             // this.item.splice(index, 1)
        //             console.log(res)
        //             this.getData()
        //         })
        //         .catch((err)=> {
        //             console.log(err)
        //         })
        //     } 
        //     // let data = JSON.stringify(args.rowData)
        //     // console.log(data)
        //     // console.log(args)
            
        // } else if (args.target.classList.contains('Edit')) {
        //     let data = args
        //     this.editedIndex = 1;
        //     console.log(data)
        //     this.editedItem = data.rowData
        //     this.dialog = true
        // }
        },
        onActionComplete(args) {
            if (args.requestType === "batchsave" || args.requestType === "save") {
                let update = this.datasync.map(item => {
                    return {
                            barang: item.barang,
                            kode: item.kode,
                            nama: item.nama,
                            part_number1: item.part_number1,
                            merk:item.merk,
                            kendaraan:item.kendaraan,
                            jumlah:item.jumlah,
                            satuan:item.satuan,
                            harga: item.harga,
                            diskon:item.diskon,
                            diskonRp: function (){
                                return this.diskon*this.harga/100;
                            },
                            subtotal: function (){
                                return this.harga * this.jumlah - this.diskonRp();
                            }
                        }
                    }
                )

                for (let index = 0; index < update.length; index++) {
                    const element = update[index];
                    let diskon = element.diskonRp()
                    let subtotal = element.subtotal()
                    this.datasync[index].diskonRp = diskon
                    this.datasync[index].subtotal = subtotal
                }
                this.datasync=[...this.datasync]
            }
                bis.$emit('lempar',this.datasync)
        }
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