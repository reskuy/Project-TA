<template>
<v-card class="pa-2">
    <v-toolbar
        flat
      >
        <v-toolbar-title>Barang</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialogbarang"
          max-width="1200px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              Cari Barang
            </v-btn>
          </template>
          <v-card>
             <v-app-bar
      color="primary"
      dark
      dense 
    >           <span class="headline">Barang</span>
                   </v-app-bar>
            <v-card-text>
              <v-container>
           
                <ejs-grid 
                id="Grid"
                :toolbar='toolbarOptionsSelect'
                :dataSource="itembaranglist" height='200' width='100%'
                :allowReordering = true
                :selectionSettings='selectionOptions'
                :allowSorting='true'
                :selectionOptions='selectionOptions'
                :allowMultiSorting='true'
                :allowFiltering='true'
                :filterSettings='filterOptions'
                :allowResizing='true'
                :allowPaging='true'
                :pageSettings='pageSettings'
                :rowSelected="rowSelectedBarangIPO" 
                >
                <e-columns>
                 
                    <e-column 
                  
                      fieldText=''
                      field='Kode' 
                      headerText='Kode' 
                      textAlign='Left'
                      width=180
                      >
                    </e-column>

                      <e-column
                      field='Nama'
                      headerText='Nama'
                      width=250
                      >
                    </e-column>

                    <e-column
                      
                      field='Merk'  
                      headerText='Merk' 
                      width=130
                      >
                    </e-column>

                    <e-column
                      field='PartNumber1'
                      headerText='Part Number 1'
                      width=170
                      >
                    </e-column>
                  </e-columns>
                </ejs-grid>
              </v-container>
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  dark
                  color="success"
                  @click="accbarang">
                  <v-icon class="mr-1">mdi-save-outlined</v-icon>Simpan
                </v-btn>
              </v-card-actions>
          </v-card>
        </v-dialog>
        </v-toolbar>
        <ejs-grid 
                ref="gridBarangList"
                id="gridBarangList"
                :toolbar='toolbarOptions'
                :dataSource="itembarangipo" height='200' width='100%'
                :allowReordering = true
                :editSettings='editSettings'
                :selectionSettings='selectionOptions'
                :selectionOptions='selectionOptions'
                :allowGrouping='true'
                :groupSettings='groupSettings'
                :allowSorting='true'
                :allowMultiSorting='true'
                :allowFiltering='true'
                :filterSettings='filterOptions'
                :allowResizing='true'
                :allowPaging='true'
                :pageSettings='pageSettings'
                @actionComplete="onActionComplete"
                >
                <e-columns>

                    <e-column 
                 :isPrimaryKey="true"
                      fieldText=''
                      field='Kode' 
                      headerText='Barang' 
                      textAlign='Left'
                      width=120
                      >
                    </e-column>

                      <e-column
                      field='Nama'
                      headerText='Nama'
                      width=270
                      >
                    </e-column>

                    <e-column
                   
                      field='PartNumber1'  
                      headerText='Part Number 1' 
                      width=280
                      >
                    </e-column>

                    <e-column
                      field='Merk'
                      headerText='Merk'
                      width=170
                      >
                    </e-column>

                    <e-column
                      field='Kendaraan'
                      headerText='Kendaraan'
                      width=170
                      >
                    </e-column>

                    <e-column
                      field='KdSupplier'
                      headerText='Kode Supplier'
                      width=170
                      >
                    </e-column>
                    <e-column
                      field='Keterangan'
                      headerText='Keterangan'
                      width=170
                      >
                    </e-column>
                    <e-column
                      field='Jumlah'
                      headerText='Jumlah'
                      width=170
                      >
                    </e-column>
                    <e-column
                      field='Satuan'
                      headerText='Satuan'
                      width=170
                      >
                    </e-column>
                  </e-columns>
                </ejs-grid>
             </v-card>
</template>
<script>
import Vue from 'vue'
import api from '@/axios/http'
import { GridPlugin, Toolbar, Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder } from "@syncfusion/ej2-vue-grids";

Vue.use(GridPlugin);

export default {
    data() {
        return {
      dialogbarang:false,
      itembarangipo: [],
      itembaranglist: [],
      itembarangipostorage: [],
      storeSelect:[],
      token : localStorage.getItem('token'),
      groupSettings: { allowReordering: true },
      selectionOptions: { type: 'Multiple'},
      // selectionOptionsCheck: { checkboxMode: 'resetOnClick', persistSelection: false },
      selectionOptionsSatuan: { type: 'Single' },
      toolbarOptions: ['Search', 'Update', 'Cancel'],
      toolbarOptionsSelect: ['Search'],
      pageSettings: {pageSizes: ['5','10','All']},
      filterOptions: { type: 'Menu' },
      // filter: { type : 'CheckBox' },
      
      editSettings: { showDeleteConfirmDialog: true, allowEditing: true, allowAdding: true, allowDeleting: true, mode: 'Batch'},
      
        }
    },
    provide:{
        grid: [Page, Toolbar, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder]
  },
  mounted() {
    this.getDataBarang()
    // if (localStorage.getItem("storage")) {
    //   this.itembarangipo = JSON.parse(localStorage.getItem("storage"));
    // }
  },
  watch: {
     dialog(val){
       val || this.close();
     },
    //  itembarangipo: {
    //     handler() {
    //     // console.log('Todos changed!');
    //     localStorage.setItem("storage", JSON.stringify(this.itembarangipo));
    //   },
    //   deep: true
    // }
   },
    methods: {
        close(){
            this.dialogbarang = false
            console.log(this.itembarangipo)
        },
        onActionComplete(args) {
      //console.log("actionComplete", args);
      if (args.requestType === "batchsave" || args.requestType === "save") {
       
        console.log(
          "Updated " 
        );
        console.log("data: " + JSON.stringify(this.itembarangipo));
      }
    },
        resetBarangIPO(){
          this.itembarangipo = []
        },
        rowSelectedBarangIPO: function() {
        let grid = document.getElementById("Grid").ej2_instances[0];
         this.storeSelect = grid.getSelectedRecords();
     
    },
    //simpan barang dari list
    accbarang(){
      this.dialogbarang= false
      if ( this.storeSelect.length > 1 ) {
         for (let i = 0; i < this.storeSelect.length; i++) {
           const element = this.storeSelect[i];
           delete element.Dimensi
           delete element.id
           delete element.PartNumber2
           delete element.updated_at
           delete element.created_at
           delete element.Aktif
           delete element.created_by
           delete element.StokMin
           delete element.StokMaks
           element.Keterangan = '-'
           element.Jumlah = '1',
           element.Satuan = 'PCS'
          //  itembarang.push(element);
           this.itembarangipo.push(element)
           this.itembarangipo=[...this.itembarangipo]
           console.log(this.itembarangipo)
          //  this.itembarangipo.push(this.itembarang);
            // this.itembarangipo = itembarang;
          //  localStorage.setItem("storage",JSON.stringify(itembarang));
         }
         this.$emit('SyncItemBarangIPO', this.itembarangipo)
       }else{
         for (let i = 0; i < this.storeSelect.length; i++) {
           const element = this.storeSelect[i];
           delete element.Dimensi
           delete element.PartNumber2
           delete element.updated_at
           delete element.created_at
           delete element.Aktif
           delete element.created_by
           delete element.StokMin
           delete element.StokMaks
           element.Keterangan = '-'
           element.Jumlah = '1',
           element.Satuan = 'PCS'
          //  itembarang.push(element);
          this.itembarangipo=[...this.itembarangipo]
           this.itembarangipo.push(element)
          //  this.itembarangipo.push(a)
          //  this.itembarangipo.push(this.itembarang);
            // this.itembarangipo = itembarang;
          //  localStorage.setItem("storage",JSON.stringify(itembarang));
         }
         this.$emit('SyncItemBarangIPO', this.itembarangipo)
       }
    },
        getDataBarang(){
          api.get('/barang?token='+this.token).then(
            res=>{
              //console.log(res)
              this.itembaranglist = res.data
            },
            err => {
              console.log(err)
              this.$router.push('/')
              this.localStorage.removeItem('token')
            }
          )
        }
    },
}
</script>