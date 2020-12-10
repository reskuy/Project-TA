<template>
    <v-dialog v-model="dialog" max-width="720px">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary"
            dark
            class="mb-2"
            v-bind="attrs"
            v-on="on">Cari Pekerjaan</v-btn>
        </template>
        <v-card>
            <v-card-text>
                <v-container>
                    <v-card>
                        <v-card-title>
                            Cari Pekerjaan
                        </v-card-title>

                        <div id="app">
                            <ejs-grid
                            :rowSelected='rowSelected' 
                                :dataSource='datacari' 
                                :selectionSettings='selectionOptions' 
                                height="200"
                                width="100%"
                                :allowReordering = true
                                :editSettings='editSettings'
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
                                    field='kode'
                                    headerText='Kode'
                                    textAlign='Left'
                                    width=180
                                ></e-column>

                                <e-column
                                    :filter='filter'
                                    field='nama_pekerjaan'
                                    headerText='Nama Pekerjaan'
                                    width=180
                                ></e-column>

                                <e-column
                                    :filter='filter'
                                    field='grup_pekerjaan'
                                    headerText='Grup Pekerjaan'
                                    width=180
                                ></e-column>

                                <e-column
                                    :filter='filter'
                                    field='grup_kendaraan'
                                    headerText='Grup Kendaraan'
                                    width=180
                                ></e-column>

                                <e-column
                                    :filter='filter'
                                    field='harga_jual_default'
                                    headerText='Harga Jual Default'
                                    width=180
                                ></e-column>

                                <e-column
                                    :filter='filter'
                                    field='harga_beli_default'
                                    headerText='Harga Beli Default'
                                    width=180
                                ></e-column>

                            </e-columns>
                        </ejs-grid>
                        </div>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="primary" text v-on:click="lempar">
                                I accept
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import Vue from "vue";
import {EventBus} from "@/bus"
import { GridPlugin, Toolbar, Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder,   } from "@syncfusion/ej2-vue-grids";
Vue.use(GridPlugin);
export default {
    data(){
        return{
            // selected: [],
            datacari:[
                {kode:"01/0001", nama_pekerjaan:"Borongan", grup_pekerjaan:"Pekerjaan Perbaikan", grup_kendaraan:"-", harga_jual_default:0, harga_beli_default:0},
                {kode:"01/0002", nama_pekerjaan:"Repair Cabin", grup_pekerjaan:"Pekerjaan Perbaikan", grup_kendaraan:"-", harga_jual_default:0, harga_beli_default:0},
                {kode:"01/0003", nama_pekerjaan:"Repair AC", grup_pekerjaan:"Pekerjaan Perbaikan", grup_kendaraan:"-", harga_jual_default:3500000, harga_beli_default:0},
                {kode:"01/0008", nama_pekerjaan:"Sewa Self Loader Truck", grup_pekerjaan:"Evakuasi, Mobilisasi, & Pengawalan", grup_kendaraan:"-", harga_jual_default:0, harga_beli_default:0}
            ],
            dialog: false,
            pekerjaansync:[],
            groupSettings: { allowReordering: true },
            selectionOptions: { type: 'Multiple'},
            toolbarOptions: ['Search'],
            pageSettings: {pageSize: 5, pageSizes :['5','10','15','20','50','All']},
            filterOptions: { type: 'Menu' },
            filter: { type : 'CheckBox' },
            editSettings: { showDeleteConfirmDialog: true, allowEditing: true, allowAdding: true, allowDeleting: true, mode: 'Dialog' },
        }
    },
    provide: {
        grid: [Page, Toolbar, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder]
    },
    methods:{
        rowSelected: function(args){
        let tampung = args.data
        // console.log(tampung.length)
        let data=[]
        if (tampung.length > 1) {
            for (let a = 0; a < tampung.length; a++) {
                const element = tampung[a];
                // delete element.kode
                delete element.grup_kendaraan
                delete element.grup_pekerjaan
                delete element.harga_beli_default
                this.pekerjaansync= data
                this.pekerjaansync.push(element)
            }
            } else {
            // delete tampung.kode
            delete tampung.grup_kendaraan
            delete tampung.grup_pekerjaan
            delete tampung.harga_beli_default
            this.pekerjaansync= data
            this.pekerjaansync.push(tampung)
            }
            // console.log(tampung)
        },
        lempar: function(){
            this.dialog = false
            // const data = this.selected
            // console.log(this.selected)
            // var result=[];
            // for (let i = 0; i < data.length; i++) {
            // const element = data[i];
            // delete element.kode
            // delete element.grup_kendaraan
            // delete element.grup_pekerjaan
            // delete element.harga_beli_default
            // result.push(element)
            // }
            const newArraySync = this.pekerjaansync.map(item => {
                return {
                    perkiraan: item.nama_pekerjaan,
                    harga: item.harga_jual_default,
                    kode: item.kode,
                    jenis_pekerjaan: "-",
                    keterangan:'-',
                    jumlah:1,
                    rasio:1,
                    diskon:0,
                    diskonRp: function(){
                        return this.diskon*this.harga/100
                    },
                    subtotal: function(){
                        return this.harga-this.diskonRp
                    }
                    }
            })
            this.$emit('lempar', this.pekerjaansync)
            EventBus.$emit('wkwk', newArraySync)
        }
    }
}
</script>

<style>

</style>