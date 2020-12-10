<template>
    <v-dialog v-model="dialog" max-width="720px">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary"
            dark
            class="mb-2"
            v-bind="attrs"
            v-on="on">Cari Barang</v-btn>
        </template>
        <v-card>
            <v-card-text>
                <v-container>
                    <v-card>
                        <v-card-title>
                            Cari Barang
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
                                    field='nama'
                                    headerText='Nama'
                                    width=180
                                ></e-column>

                                <e-column
                                    :filter='filter'
                                    field='kategori'
                                    headerText='Kategori'
                                    width=180
                                ></e-column>

                                <e-column
                                    :filter='filter'
                                    field='sub_kategori'
                                    headerText='Sub Kategori'
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
                                    field='part_number2'
                                    headerText='Part Number 2'
                                    width=180
                                ></e-column>

                                <e-column
                                    :filter='filter'
                                    field='merk'
                                    headerText='Merk'
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
                                    field='memo'
                                    headerText='Memo'
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
import { GridPlugin, Toolbar, Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder,   } from "@syncfusion/ej2-vue-grids";
import { bis } from '@/busBrg';
Vue.use(GridPlugin);
export default {
    data(){
        return{
            // selected: [],
            datacari:[
                {kode:"01/0000001", nama:"LAMP ASSY TURN SIGNAL SH", kategori:"-", sub_kategori:"-", part_number1:"81510 E0010", part_number2:"-", merk:"HINO", satuan:"-", memo:"-"},
                {kode:"01/0000002", nama:"LAMP ASSY TURN SIGNAL LH", kategori:"-", sub_kategori:"-", part_number1:"81511 E0011", part_number2:"-", merk:"HINO", satuan:"-", memo:"-"},
                {kode:"01/0000003", nama:"LL LH", kategori:"-", sub_kategori:"-", part_number1:"1", part_number2:"-", merk:"HINO", satuan:"-", memo:"-"},
                {kode:"01/0000004", nama:"LAMP ", kategori:"-", sub_kategori:"-", part_number1:"81511 E0011", part_number2:"-", merk:"HINO", satuan:"-", memo:"-"}
            ],
            dialog: false,
            brgsync:[],
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
        let data=[]
        if (tampung.length > 1) {
            for (let a = 0; a < tampung.length; a++) {
                const element = tampung[a];
                // delete element.kode
                delete element.kategori
                delete element.sub_kategori
                delete element.part_number2
                delete element.memo
                this.brgsync= data
                this.brgsync.push(element)
            }
            } else {
            // delete tampung.kode
            delete tampung.kategori
            delete tampung.sub_kategori
            delete tampung.part_number2
            delete tampung.memo
            this.brgsync= data
            this.brgsync.push(tampung)
            }
            // console.log(tampung)
        },
        lempar: function(){
            this.dialog = false
            // const data = this.selected
            // var result=[];
            // for (let i = 0; i < data.length; i++) {
            // const element = data[i];
            // delete element.kode
            // delete element.GrupKendaraan
            // delete element.GrupPekerjaan
            // delete element.HargaBeliDefault
            // result.push(element)
            // }
            const newArraySync = this.brgsync.map(item => {
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
                    }
                )
            bis.$emit('wkwk', newArraySync)
            this.$emit('lempar', this.brgsync)
        }
    }
}
</script>

<style>

</style>