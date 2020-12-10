<template>
    <v-col cols="12" md="12">
        <v-toolbar flat dark dense color="danger" class="elevation-1">
            <v-toolbar-title dark>
                detail Pekerjaan
            </v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <CariPekerjaan v-on:lempar="updatePekerjaan($event)"/>
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
                        field='kode'
                        headerText='Kode'
                        textAlign='Left'
                        width=180
                        :isPrimaryKey="true"
                    ></e-column>

                    <e-column
                        :filter='filter'
                        field='jenis_pekerjaan'
                        headerText='Jenis Pekerjaan'
                        textAlign='Left'
                        width=180
                    ></e-column>

                    <e-column
                        :filter='filter'
                        field='perkiraan'
                        headerText='Perkiraan'
                        width=180
                    ></e-column>

                    <e-column
                        :filter='filter'
                        field='keterangan'
                        headerText='Keterangan'
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
                        field='rasio'
                        headerText='Rasio'
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
            <!-- <li v-for="(message) in datasync" :key="message" >
            {{ message }}
            </li> -->
            <h5>
                data dari eventbus:{{dataTampung}}
            </h5>
        </div>
    </v-col>
</template>

<script>
// import { EventBus } from "../bus";
import Vue from "vue";
import { GridPlugin, Toolbar, Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder,   } from "@syncfusion/ej2-vue-grids";
import CariPekerjaan from "@/views/Invoice/CariPekerSync";
import { EventBus } from '@/bus';
// import { Input } from '@syncfusion/ej2-vue-inputs';
Vue.use(GridPlugin);

export default {
    components:{
        CariPekerjaan
    },
    
    data(){
        return{
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
            editSettings: { showDeleteConfirmDialog: true, allowEditing: true, allowAdding: true, allowDeleting: true, mode: 'Batch'  },
        }
    },

    provide: {
        grid: [Page, Toolbar, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder]
    },

    mounted(){
        // EventBus.$on("lempar",Input =>{
        //     this.dataTampung=Input
        // },
        // this.dataTampung = [...this.dataTampung]
        // )
        // this.datasync = this.dataTampung
    },

    created(){
        EventBus.$on("lempar",Input =>{
            this.dataTampung=Input
            
            // let newArraySync = this.datasync.map(item=>({
            //     kode: item.kode,
            //         jenis_pekerjaan: item.jenis_pekerjaan,
            //         perkiraan: item.perkiraan,
            //         keterangan: item.keterangan,
            //         jumlah: item.jumlah,
            //         rasio: item.rasio,
            //         harga: item.harga,
            //         diskon: item.diskon,
            //         diskonRp : item.diskonRp,
            //         subtotal: item.subTotal
            // }))
            // console.log("new:",newArraySync)
            //Rename object proper
            
            // for (let a = 0; a < this.dataTampung.length; a++) {
            //     this.dataTampung[a].subtotal = this.dataTampung[a]['subTotal']
            //     delete this.dataTampung[a].subTotal
            // }
            this.datasync = this.dataTampung
            // let newArraySync = this.dataTampung.map(item=>{
            //     return{
            //         kode: item.kode,
            //         jenis_pekerjaan: item.jenis_pekerjaan,
            //         perkiraan: item.perkiraan,
            //         keterangan: item.keterangan,
            //         jumlah: item.jumlah,
            //         rasio: item.rasio,
            //         harga: item.harga,
            //         diskon: item.diskon,
            //         diskonRp : item.diskonRp,
            //         subtotal: item.subTotal
            //     }
            // })
            // this.datasync=newArraySync
        })
        // EventBus.$on("lempar",input=>{
        //     const newArraySync = input.map(item => {
        //         return {perkiraan: item.nama_pekerjaan, harga: item.harga_jual_default, kode: item.kode}
        //     })
        //     // console.log(newArraySync)
        //     for (let index = 0; index < newArraySync.length; index++) {
        //         const element = newArraySync[index];
        //         this.datasync.push(element)
        //     }
        //     //Refresh data grid
        //     this.datasync=[...this.datasync]
        //     // this.datasync.push(input)
        // })
    },
    
    methods: {
        updatePekerjaan(data){
            this.data = data
            // console.log(this.data)
            let newArraySync = this.data.map(item => {
                return {
                    perkiraan: item.nama_pekerjaan,
                    harga: item.harga_jual_default,
                    kode: item.kode,
                    jenis_pekerjaan: "-",
                    keterangan:'-',
                    jumlah:1,
                    rasio:1,
                    diskon:0,
                    // diskonRp:0,
                    // // subtotal: item.harga_jual_default
                    diskonRp: function (){
                        return this.diskon*this.harga/100;
                    },
                    subtotal: function (){
                        return item.harga_jual_default * this.jumlah;
                    }
                    }
            })
            // let a = this.datasync[0]
            // console.log(a.kode)
            // if (condition) {
                
            // }
            // newArraySync.diskonRp = function(){
            //     return newArraySync.diskon * newArraySync.harga / 100;
            // }
            // console.log(newArraySync.diskonRp())
            // var tes = {
            //     a:1,
            //     b:2,
            //     c: function(){
            //         return this.a + this.b/100
            //     }
            // }
            // console.log(tes.c())
            // console.log(newArraySync.subtotal()) 
            for (let index = 0; index < newArraySync.length; index++) {
                const element = newArraySync[index];
                    var diskon = element.diskonRp()
                    var subtotal = element.subtotal()
                    // console.log(diskon)
                    // console.log(subtotal)
                    element.diskonRp = diskon
                    element.subtotal = subtotal
                    console.log('push baru')
                    this.datasync.push(element)
            }
                    this.datasync=[...this.datasync]
        //   let  things = new Object();

// things.thing = new Array();

// things.thing.push({place:"here",name:"stuff"});
// things.thing.push({place:"there",name:"morestuff"});
// things.thing.push({place:"there",name:"morestuff"});

// console.log(things.thing)
var obj = {};

for ( var i=0, len=this.datasync.length; i < len; i++ )
    obj[this.datasync[i]['kode']] = this.datasync[i];

this.datasync = new Array();
for ( var key in obj )
    this.datasync.push(obj[key]);
    
    // console.log(things.thing)
            //Refresh data grid
            // this.datasync=[...this.datasync]
            // console.log([... new Set(this.datasync)])
            console.log(this.datasync)
            // let a = newArraySync.harga
            // console.log(a)

            // let uniqKode=this.datasync.from(new Set(this.datasync))
            // console.log(uniqKode)

            // const userHasMap={}
            //     this.datasync = this.datasync.filter((item, )=>{
            //         let allreadyExists = userHasMap.prototype.hasOwnProperty.call(item.kode)
            //         return allreadyExists? false : userHasMap[item.kode] = 1
            //     })
            //     console.log(this.datasync)
        },
        // onCreated() {
        //     this.$refs.grid.ej2Instances.dataSource = this.datasync;
        // },
        commandClick: function(args) {
            console.log(args)
            // if(args.target.classList.containts("Delete")){
            //     var alert = confirm("Yakin Hapus Data?");
            //     if(alert==true){
            //         api.delete('/deductible/'+args.rowData.id+'?token='+this.token)
            //         .then((res)=>{
            //             console.log(res)
            //             this.getData()
            //         })
            //         .catch((err)=>{
            //             console.log(err)
            //         })
            //     }
            // }
        },
        onActionComplete(args) {
        // console.log("actionComplete", args);
            if (args.requestType === "batchsave" || args.requestType === "save") {
                // console.log(
                // "Updated data source: " + JSON.stringify(this.$refs.grid.ej2Instances.dataSource)
                // );
                // console.log("orderDetails: " + JSON.stringify(this.datasync));
                // console.log(this.$refs.grid.ej2Instances.dataSource)
                // console.log(this.element)
                //update subtotal dan diskon
                let update = this.datasync.map(item => {
                    return {
                            perkiraan: item.perkiraan,
                            harga: item.harga,
                            kode: item.kode,
                            jenis_pekerjaan: item.jenis_pekerjaan,
                            keterangan:item.keterangan,
                            jumlah:item.jumlah,
                            rasio:item.rasio,
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
                // console.log(update)
                // console.log(update[0].diskonRp())

                // let diskon = update[0].diskonRp()
                // let subtotal = update[0].subtotal()

                // console.log(subtotal)
                // console.log(this.datasync[0])
                // console.log(this.datasync[0].diskonRp())

                // this.datasync[0].diskonRp = diskon
                // this.datasync[0].subtotal = subtotal

                for (let index = 0; index < update.length; index++) {
                    const element = update[index];
                    let diskon = element.diskonRp()
                    let subtotal = element.subtotal()
                    this.datasync[index].diskonRp = diskon
                    this.datasync[index].subtotal = subtotal
                    // this.datasync.push(element)
                }
                //Refresh data grid
                this.datasync=[...this.datasync]
            }
            // console.log(this.datasync)
                EventBus.$emit('lempar',this.datasync)
        }
    }
}
</script>

<style>

</style>