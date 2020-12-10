<template>
    <v-dialog v-model="dialog" max-width="720px">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary"
            dark
            class="mb-2"
            v-bind="attrs"
            v-on="on">Cari Wo</v-btn>
        </template>
        <v-card>
            <v-card-text>
                <v-container>
                    <v-card>
                        <v-card-title>
                            Cari Work Order
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
                                    headerText='Kode WO'
                                    textAlign='Left'
                                    width=180
                                ></e-column>

                                <e-column
                                    :filter='filter'
                                    field='tanggal'
                                    headerText='Tanggal'
                                    width=180
                                ></e-column>

                                <e-column
                                    :filter='filter'
                                    field='nama_pelanggan'
                                    headerText='Nama Pelanggan'
                                    width=180
                                ></e-column>

                                <e-column
                                    :filter='filter'
                                    field='no_rangka'
                                    headerText='Nomor Rangka'
                                    width=180
                                ></e-column>

                                <e-column
                                    :filter='filter'
                                    field='no_polisi'
                                    headerText='Nomor Polisi'
                                    width=180
                                ></e-column>

                                <e-column
                                    :filter='filter'
                                    field='no_mesin'
                                    headerText='Nomor Mesin'
                                    width=180
                                ></e-column>

                                <e-column
                                    :filter='filter'
                                    field='keterangan'
                                    headerText='Keterangan'
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
Vue.use(GridPlugin);
export default {
    data(){
        return{
            selected: [],
            datacari:[
                {kode:"0101/WO/2006/000100", tanggal:"17/06/2020", nama_pelanggan:"Ronaldo", no_rangka:"123214", no_polisi:"KT 231231", no_mesin:"211312", keterangan:"TA 2"},
                {kode:"0101/WO/2006/000104", tanggal:"17/06/2020", nama_pelanggan:"Messi", no_rangka:"123214", no_polisi:"KT 231231", no_mesin:"211312", keterangan:"WS TFI BPP"},
            ],
            dialog: false,
            wosync:[],
            groupSettings: { allowReordering: true },
            selectionOptions: { type: 'Single'},
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
        let data=[]
        let tampung = args.data
        console.log(tampung)
        delete tampung["tanggal"]
        delete tampung["keterangan"]
        this.wosync= data
        this.wosync.push(tampung)
        },
        lempar: function(){
            this.dialog = false
            this.$emit('lempar', this.wosync)
        }
    }
}
</script>

<style>

</style>