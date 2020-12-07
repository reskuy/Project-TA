<template>
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
                  field='Nama'
                  headerText='Barang'
                  textAlign='Left'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Rasio'
                  headerText='Rasio'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='MataUang'
                  headerText='MataUang'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='TanggalHargaBeli'
                  headerText='Tanggal'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='Gudang'
                  headerText='Cabang '
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='HargaBeli'
                  headerText='Harga'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='DiskonHargaBeli'
                  headerText='Diskon'
                  width=180
                ></e-column>

                <e-column
                  :filter='filter'
                  field='created_by'
                  headerText='Dibuat Oleh'
                  width=180
                ></e-column>
            </e-columns>
        </ejs-grid>
</template>

<script>
import Vue from "vue";
import { GridPlugin, Toolbar, Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder,   } from "@syncfusion/ej2-vue-grids";
import api from '@/axios/http'
Vue.use(GridPlugin);
export default {
    data() {
        return {
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
      
    },

    computed: {
        formTitleSupplier(){
            return this.editedIndex === -1 ? "Tambah Supplier" : "Edit Supplier";
        },
        
    },
    
    methods: {
        getData(){
            api.get('/barang?token='+this.token).then(
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