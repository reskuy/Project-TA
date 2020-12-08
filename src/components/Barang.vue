<template>
        <v-col cols="12" md="12">
          <v-toolbar
            flat
            dark
            dense
            color='blue darken-4'
            class="elevation-1"
            >
            <v-toolbar-title 
              dark
            >
              <v-icon>mdi-cart</v-icon>
             Barang
            </v-toolbar-title>
            <v-divider
              class="mx-4"
              inset
              vertical
            >
            </v-divider>
            <v-spacer></v-spacer>
      <v-dialog
              v-model="dialog"
              max-width="1200px"
            >

            <template v-slot:activator="{ on, attrs }">
              <v-btn
                dark
                small
                rounded
                color="blue darken-4"
                class="mb-2"
                v-bind="attrs"
                v-on="on"
              >
                <v-icon>mdi-plus</v-icon>
              </v-btn>
            </template>

            <v-card>
              <v-toolbar
                dark
                dense
                color= 'blue darken-4'
                class="elevation-1"
              >
              <v-toolbar-title dark>
                <v-icon>mdi-cart-plus</v-icon>
              </v-toolbar-title>
              <span class="headline">{{ formTitle }}</span>
            </v-toolbar>
            
           <v-card-text>
                <v-container>
                  <v-row dense>
                    <v-col cols="14"  md="6">
                      <v-text-field outlined dense
                        v-model="editedItem.Kode"
                        label="Kode">
                      </v-text-field>
                    </v-col>

                  <v-col cols="14"  md="6">
                   <v-text-field outlined dense
                     v-model="editedItem.KdSupplier"
                      label="Supplier" required>
                    </v-text-field>

                  </v-col>
                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                     v-model="editedItem.Nama"
                      label="Nama" required>
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.Merk"
                      label="Merk">
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.Kategori"
                      label="Kategori">
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                       v-model="editedItem.PartNumber1"
                      label="Partnumber1">
                    </v-text-field>
                  </v-col>
                  <v-col cols="12"  md="6">
        
                    <v-text-field
                     
                      v-model="editedItem.Kendaraan"
                       label="Kendaraan"
                       outlined
                        dense
                    ></v-text-field>
                  </v-col>
                  

                  <v-col cols="12"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.PartNumber2"
                      label="Partnumber2">
                    </v-text-field>
                  </v-col>     

                  <v-col cols="12"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.Dimensi"
                      label="Dimensi">
                    </v-text-field>
                  </v-col> 

                  <v-col cols="12"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.Gudang"
                      label="Gudang">
                    </v-text-field>
                  </v-col>   

                  <v-col cols="12"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.Memo"
                      label="Memo">
                    </v-text-field>
                  </v-col>     

                  <v-col cols="12"  md="6">
                    <v-switch outlined dense
                      v-model="editedItem.Aktif"
                      label="Aktif"
                      true-value="True"
                      false-value="False"
                      >
                    </v-switch>
                  </v-col>     

                  <v-col cols="12"  md="3">
                    <v-text-field outlined dense
                      v-model="editedItem.StokMin"
                      label="Stok Minimum">
                    </v-text-field>
                  </v-col>   

                  <v-col cols="12"  md="9">
                    
                  </v-col>   

                  <v-col cols="12"  md="3">
                    <v-text-field outlined dense
                      v-model="editedItem.StokMaks"
                      label="Stok Maksimum">
                    </v-text-field>
                  </v-col>         

                  <v-col cols="12">
                   <v-card>
                <v-tabs v-model="tab"
      background-color="gray"
      dark
      dense
    >
      <v-tabs-slider></v-tabs-slider>

      <v-tab href="#tab-1">
        Satuan
      </v-tab>

      <v-tab href="#tab-2">
        Harga Jual
      </v-tab>

      <v-tab href="#tab-3">
        Harga Beli
      </v-tab>
    </v-tabs>

    <v-tabs-items v-model="tab">
      <v-tab-item value="tab-1" >
        <v-card flat>
           <v-toolbar
        flat dense
      >
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialogsatuan"
          max-width="1200px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="blue darken-4"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              Add Items
            </v-btn>
          </template>
          <v-card>
             <v-app-bar
     
      dark
      dense 
    >           <span class="headline">Items</span>
                   </v-app-bar>
            <v-card-text>
              <v-container class="my-10">
                <v-row>
                  <v-col cols="12" sm="4" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.Rasio"
                      label="Rasio">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="8" md="8" class="mt-n8">
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.Nama"
                      label="Nama">
                    </v-text-field>
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
                        @click="close">
                        <v-icon class="mr-1">mdi-close-circle</v-icon>Batal
                      </v-btn>
                      <v-btn
                        dark
                        color="blue darken-4"
                        @click="saveSatuan">
                        <v-icon class="mr-1">mdi-content-save</v-icon>Simpan
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        </v-toolbar>
        <ejs-grid 
                :dataSource="itemtabsatuan" height='200' width='100%'
                :toolbar='toolbarOptionsSelect'
                :allowReordering = true
                :editSettings='editSettings'
                :selectionSettings='selectionOptions'
                :groupSettings='groupSettings'
                :allowSorting='true'
                :allowMultiSorting='true'
                :allowFiltering='true'
                :filterSettings='filterOptions'
                :allowResizing='true'
                :allowPaging='true'
                :pageSettings='pageSettings'
                :commandClick="commandClick"
                >
                <e-columns>
                
                    <e-column 
                      :filter='filter'
                      fieldText=''
                      field='Rasio' 
                      headerText='Rasio' 
                      textAlign='Left'
                      width=80
                      >
                    </e-column>

                      <e-column
                      field='Nama'
                      headerText='Nama'
                      width=200
                      >
                    </e-column>
                  </e-columns>
                </ejs-grid>
        </v-card>
      </v-tab-item>

<!-- CODE TAB HARGA JUAL -->

      <v-tab-item value="tab-2" >
        <v-card flat>
            <v-toolbar
        flat dense
      >
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialoghargajual"
          max-width="1200px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="blue darken-4"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              Add Items
            </v-btn>
          </template>
          <v-card>
             <v-app-bar
     
      dark
      dense 
    >           <span class="headline">Items</span>
                   </v-app-bar>
            <v-card-text>
              <v-container class="my-10">
                <v-row>
                  <v-col cols="12" sm="6" md="6" class="mt-n8">
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.Rasio"
                      label="Rasio">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="6" class="mt-n8">
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.MataUang"
                      label="Mata Uang">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="6" class="mt-n8">
                    <v-menu
          v-model="menutanggalhargajual"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field outlined dense
           v-model="editedItem.TanggalHargaJual"
            label="Tanggal"
            append-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
        locale="id"
        v-model="editedItem.TanggalHargaJual"
          @input="menutanggalhargajual = false"
          :min="HariIni"
        ></v-date-picker>
      </v-menu>
                  </v-col>

                  <v-col cols="12" sm="6" md="6" class="mt-n8">
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.HargaJual"
                      label="Harga">
                    </v-text-field>
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
                        @click="close">
                        <v-icon class="mr-1">mdi-close-circle</v-icon>Batal
                      </v-btn>
                      <v-btn
                        dark
                        color="blue darken-4"
                        @click="saveHargaJual">
                        <v-icon class="mr-1">mdi-content-save</v-icon>Simpan
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        </v-toolbar>
        <ejs-grid 
                :dataSource="itemtabhargajual" height='200' width='100%'
                :toolbar='toolbarOptionsSelect'
                :allowReordering = true
                :editSettings='editSettings'
                :selectionSettings='selectionOptions'
                :groupSettings='groupSettings'
                :allowSorting='true'
                :allowMultiSorting='true'
                :allowFiltering='true'
                :filterSettings='filterOptions'
                :allowResizing='true'
                :allowPaging='true'
                :pageSettings='pageSettings'
                :commandClick="commandClick"
                >
                <e-columns>
                
                    <e-column 
                      :filter='filter'
                      fieldText=''
                      field='Rasio' 
                      headerText='Rasio' 
                      textAlign='Left'
                      width=100
                      >
                    </e-column>

                      <e-column
                      field='MataUang'
                      headerText='Mata Uang'
                      width=120
                      >
                    </e-column>

                    <e-column
                      field='TanggalHargaJual'
                      headerText='Tanggal'
                      width=120
                      >
                    </e-column>
                    <e-column
                      field='HargaJual'
                      headerText='Harga'
                      width=120
                      >
                    </e-column>
                  </e-columns>
                </ejs-grid>
        </v-card>
      </v-tab-item>

      <!-- CODE TAB HARGA BELI -->


      <v-tab-item value="tab-3" >
       <v-card flat>
            <v-toolbar
        flat dense
      >
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialoghargabeli"
          max-width="1200px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="blue darken-4"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              Add Items
            </v-btn>
          </template>
          <v-card >
             <v-app-bar
      dark
      dense 
    >           <span class="headline">Items</span>
                   </v-app-bar>
           
              <v-container class="my-10">
                <v-card class="mt-n9 pa-2">
                <v-row>
                  <v-col cols="12" sm="3" md="3" >
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.Rasio"
                      label="Rasio">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="6" >
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.Nama"
                      label="Nama">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="3" md="3" >
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.MataUang"
                      label="Mata Uang">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="4" md="4" class="mt-n8">
                    <v-menu
          v-model="menutanggalhargabeli"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field outlined dense
           v-model="editedItem.TanggalHargaBeli"
            label="Tanggal"
            append-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
        locale="id"
        v-model="editedItem.TanggalHargaBeli"
          @input="menutanggalhargabeli = false"
          :min="HariIni"
        ></v-date-picker>
      </v-menu>
                  </v-col>
                  
                  <v-col cols="12" sm="4" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.HargaBeli"
                      label="Harga">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="4" md="4" class="mt-n8">
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.DiskonHargaBeli"
                      label="Diskon">
                    </v-text-field>
                  </v-col>

                  </v-row>
                  </v-card>
                </v-container>
              

              <v-divider class="mt-n8"/>

              <v-card-actions>
                    <v-spacer></v-spacer>
                      <v-btn
                        dark
                        color="error"
                        @click="close">
                        <v-icon class="mr-1">mdi-close-circle</v-icon>Batal
                      </v-btn>
                      <v-btn
                        dark
                        color="blue darken-4"
                        @click="saveHargaBeli">
                        <v-icon class="mr-1">mdi-content-save</v-icon>Simpan
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        </v-toolbar>
        <ejs-grid 
                :dataSource="itemtabhargabeli" height='200' width='100%'
                :toolbar='toolbarOptionsSelect'
                :allowReordering = true
                :editSettings='editSettings'
                :selectionSettings='selectionOptions'
                :groupSettings='groupSettings'
                :allowSorting='true'
                :allowMultiSorting='true'
                :allowFiltering='true'
                :filterSettings='filterOptions'
                :allowResizing='true'
                :allowPaging='true'
                :pageSettings='pageSettings'
                :commandClick="commandClick"
                >
                <e-columns>
                
                    <e-column 
                      :filter='filter'
                      fieldText=''
                      field='Rasio' 
                      headerText='Rasio' 
                      textAlign='Left'
                      width=100
                      >
                    </e-column>

                      <e-column
                      field='MataUang'
                      headerText='Mata Uang'
                      width=120
                      >
                    </e-column>

                    <e-column
                      field='TanggalHargaBeli'
                      headerText='Tanggal'
                      width=120
                      >
                    </e-column>
                    <e-column
                      field='HargaBeli'
                      headerText='Harga'
                      width=120
                      >
                    </e-column>
                    <e-column
                      field='DiskonHargaBeli'
                      headerText='Diskon'
                      width=120
                      >
                    </e-column>
                  </e-columns>
                </ejs-grid>
        </v-card>
      </v-tab-item>
    </v-tabs-items>
                  </v-card>
                  </v-col>

                  <v-col cols="12">
                   <v-card>
                <v-tabs v-model="tab1"
      background-color="gray"
      dark
      dense
    >
      <v-tabs-slider></v-tabs-slider>
      <v-tab href="#tab-1">
        Stok
      </v-tab>
    </v-tabs>

    <v-tabs-items v-model="tab1">
      <v-tab-item value="tab-1" >
        <v-card flat>
          <v-toolbar
        flat dense
      >
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialogstok"
          max-width="1200px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="blue darken-4"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              Add Items
            </v-btn>
          </template>
          <v-card>
             <v-app-bar
     
      dark
      dense 
    >           <span class="headline">Items</span>
                   </v-app-bar>
            <v-card-text>
              <v-container class="my-10">
                <v-row>
                  <v-col cols="12" sm="3" md="3" class="mt-n8">
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.Gudang"
                      label="Gudang">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="6" class="mt-n8">
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.Nama"
                      label="Nama">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" sm="3" md="3" class="mt-n8">
                    <v-text-field
                      dense
                      outlined
                      clearable
                      v-model="editedItem.StockOnHand"
                      label="Stock On Hand">
                    </v-text-field>
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
                        @click="close">
                        <v-icon class="mr-1">mdi-close-circle</v-icon>Batal
                      </v-btn>
                      <v-btn
                        dark
                        color="blue darken-4"
                        @click="saveStok">
                        <v-icon class="mr-1">mdi-content-save</v-icon>Simpan
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        </v-toolbar>
        <ejs-grid 
                :dataSource="itemtabstok" height='200' width='100%'
                :toolbar='toolbarOptionsSelect'
                :allowReordering = true
                :editSettings='editSettings'
                :selectionSettings='selectionOptions'
                :groupSettings='groupSettings'
                :allowSorting='true'
                :allowMultiSorting='true'
                :allowFiltering='true'
                :filterSettings='filterOptions'
                :allowResizing='true'
                :allowPaging='true'
                :pageSettings='pageSettings'
                :commandClick="commandClick"
                >
                <e-columns>
                
                    <e-column 
                      :filter='filter'
                      fieldText=''
                      field='Gudang' 
                      headerText='Gudang' 
                      textAlign='Left'
                      width=160
                      >
                    </e-column>
                      <e-column
                      field='Nama'
                      headerText='Nama'
                      width=120
                      >
                    </e-column>
                    <e-column
                      field='StockOnHand'
                      headerText='Stock On Hand'
                      width=120
                      >
                    </e-column>
                  </e-columns>
                </ejs-grid>
        </v-card>
      </v-tab-item>
    </v-tabs-items>
                  </v-card>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
 
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="error" text @click="close">Batal</v-btn>
              <v-btn color="success" text @click="save">Simpan</v-btn>
            </v-card-actions>
          </v-card>

            </v-dialog>
      </v-toolbar>

            <div id="app">
                <ejs-grid 
                :dataSource="data"
                :toolbar='toolbarOptions'
            height="300"
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
            :commandClick="commandClick"
                >
                <e-columns>
                <e-column field="Commands" headerText="🔧" width="105" :commands="commands">
                    <div class="btn-group">
                              <button type="button" class="btn btn-default" (click)='prediemRowEdit($event)'>
                                <i class="fa fa-pencil"></i></button>
                              <button type="button" class="btn btn-default" (click)='prediemRowDelete($event)'>
                                <i class="fa fa-trash"></i></button>
                            </div>
                </e-column>
                    <e-column 
                      :filter='filter'
                      fieldText=''
                      field='Kode' 
                      headerText='Kode' 
                      textAlign='Left'
                      width=120
                      >
                    </e-column>

                      <e-column
                  
                      field='Nama'
                      headerText='Nama'
                      width=250
                      >
                    </e-column>
                    <!-- <ejs-datepicker field='tgl' headerText='Tanggal' width='150' id="datepicker" locale='id' ></ejs-datepicker> -->
                    

                    <e-column
                      :filter='filter'
                      field='Merk'  
                      headerText='Merk' 
                      width=140
                      >
                    </e-column>

                    <e-column
                      field='Kategori'
                      headerText='Kategori'
                      width=170
                      >
                    </e-column>

                    <e-column
                      field='PartNumber1'
                      headerText='Part Number 1'
                      textAlign='Left'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='PartNumber2'
                      headerText='Part Number 2'
                      textAlign='Left'
                      width=160
                      >
                    </e-column>

                    <e-column
                      field='Kendaraan'
                      headerText='Kendaraan'
                      textAlign='Left'
                      width=140
                      >
                    </e-column>

                    <e-column
                      field='KdSupplier'
                      headerText='Kode Supplier'
                      textAlign='Left'
                      width=130
                      >
                    </e-column>

                    <e-column
                      field='Dimensi'
                      headerText='Dimensi'
                      textAlign='Left'
                      width=160
                      >
                    </e-column>

                  <e-column
                    :filter='filter'
                    field='Aktif'
                    headerText='Aktif'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>

                  <e-column
                    :filter='filter'
                    field='Gudang'
                    headerText='Gudang'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>

                  <e-column
                    :filter='filter'
                    field='StokMin'
                    headerText='Stok Minimal'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>

                  <e-column
                    :filter='filter'
                    field='StokMaks'
                    headerText='Stok Maksimal'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>

                  <e-column
                    :filter='filter'
                    field='HargaBeli'
                    headerText='Harga Beli'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>

                  <e-column
                    :filter='filter'
                    field='HargaJual'
                    headerText='Harga Jual'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>
                  <e-column
                    :filter='filter'
                    field='StockOnHand'
                    headerText='Stok On Hand'
                    textAlign='Left'
                    width=160
                  >
                  </e-column>
                </e-columns>
                
              </ejs-grid>
            </div>
        </v-col>
 
</template>
<script>
import Vue from "vue";
import api from "@/axios/http";
import { DatePickerPlugin } from "@syncfusion/ej2-vue-calendars"
import { GridPlugin, Toolbar ,Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder } from "@syncfusion/ej2-vue-grids";
import { loadCldr,L10n, setCulture, setCurrencyCode } from '@syncfusion/ej2-base';
loadCldr(require('../cldr/id/currencies.json'),                 
        require('../cldr/id/numbers.json'),  
        require('../cldr/supplemental/numberingSystems.json'),
        require('../cldr/id/timeZoneNames.json'),
        require('../cldr/supplemental/weekData.json'),
        require('../cldr/id/ca-gregorian.json'));  
setCulture('id');
setCurrencyCode('IDR');

L10n.load({
    'id': {
       'datepicker': { placeholder: 'Tanggal', today: 'Hari ini' },
        'grid': {
          'Add': 'Tambahkan',
          'Delete': 'Hapus',
          'Cancel': 'Batal',
          'Search': 'Pencarian',
            'EmptyRecord': 'Record Kosong',
            'GroupDropArea': 'Drag Data ke sini untuk Grouping',
            'UnGroup': 'Klik di sini untuk memisahkan grup',
            'EmptyDataSourceError': 'DataSource tidak boleh kosong pada pemuatan pertama, karena kolom dari dataSource di kisi kolom Buat Otomatis',
            'Item': 'Item',
            'Items': 'Item'
        },
        'pager':{
            'currentPageInfo': '{0} dari {1} halaman',
            'totalItemsInfo': '({0} items)',
            'firstPageTooltip': 'Ke halaman pertama',
            'lastPageTooltip': 'Ke halaman terakhir',
            'nextPageTooltip': 'Ke halaman selanjutnya',
            'previousPageTooltip': 'Kembali ke halaman terakhir',
            'nextPagerTooltip': 'Ke pager berikutnya',
            'previousPagerTooltip': 'Ke halaman sebelumnya'
        }
    }
});

Vue.use(DatePickerPlugin);
Vue.use(GridPlugin);

export default {
  components: {
    },
  data() {
    return {
      HariIni: new Date().toISOString().substr(0,10),
      menutanggalhargabeli: false,
      menutanggalhargajual: false,
            tab:false,
            tab1:false,
            editedIndex: -1,

          editedItem: {
            Kode: "",
            Nama: "",
            Merk: "",
            Kategori: "",
            PartNumber1: "",
            PartNumber2: "",
            Kendaraan: "",
            KdSupplier: "",
            Dimensi: "",
            Aktif: "",
            Gudang: "",
            Memo: "",
            StokMin: "",
            StokMaks: "",
            Rasio: "",
            MataUang: "",
            StockOnHand: "",
            TanggalHargaJual: "",
            TanggalHargaBeli: "",
            HargaBeli: "",
            HargaJual: "",
            DiskonHargaBeli: ""
        },
        defaultItem: {
            Kode: "",
            Nama: "",
            Merk: "",
            Kategori: "",
            PartNumber1: "",
            PartNumber2: "",
            Kendaraan: "",
            KdSupplier: "",
            Dimensi: "",
            Aktif: "",
            Gudang: "",
            Memo: "",
            StokMin: "",
            StokMaks: "",
            Rasio: "",
            MataUang: "",
            StockOnHand: "",
            TanggalHargaJual: "",
            TanggalHargaBeli: "",
            HargaBeli: "",
            HargaJual: "",
            DiskonHargaBeli: ""
        },
        itemtabsatuan: [],
      itemtabstok: [],
      itemtabhargajual: [],
      itemtabhargabeli: [],
      
        dialog: false,
        dialogsatuan: false,
        dialoghargajual: false,
        dialoghargabeli: false,
        dialogstok: false,
        toolbarOptions: ['Search', 'Update', 'Cancel'],
        toolbarOptionsSelect: ['Search'],
        dataStateChange: false,
        token : localStorage.getItem('token'),
        data: [],

        commands: [
        {  buttonOption: { cssClass: 'e-flat Edit', iconCss: 'e-edit e-icons' } },
        { buttonOption: { cssClass: 'e-flat Delete', iconCss: 'e-delete e-icons' } },
        ],
      groupSettings: { allowReordering: true },
      selectionOptions: { type: 'Multiple' },
      pageSettings: {pageSizes: ['5','10','All']},
      filterOptions: { type: 'Menu' },
      filter: { type : 'CheckBox' },
      editSettings: { showDeleteConfirmDialog: true, allowEditing: false, allowAdding: true, allowDeleting: true, mode: 'Normal'},
      
       
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
    grid: [Page, Toolbar,Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder]
  },
  mounted() {
    this.getData()
  },
  watch: {
     dialog(val){
       val || this.close();
     },
   },
   computed: {
        formTitle(){
            return this.editedIndex === -1 ? "Tambah Barang" : "Edit Barang";
        }
   },
  methods: {
    save(){
            if(this.formTitle === "Tambah Barang"){
                this.TambahData()
                this.editedItem = this.defaultItem
            }else{
                this.UpdateData()
            }
            this.close()
        },
      saveSatuan(){
         this.itemtabsatuan = [this.editedItem]
         this.dialogsatuan = false
      },
       saveHargaJual(){
         this.itemtabhargajual = [this.editedItem]
         this.dialoghargajual = false
      },
       saveHargaBeli(){
         this.itemtabhargabeli = [this.editedItem]
         this.dialoghargabeli = false
      },
      saveStok(){
         this.itemtabstok = [this.editedItem]
         this.dialogstok = false
      },
    TambahData(){
            api.post('/barang?token='+this.token, {
            Kode: this.editedItem.Kode,
            Nama: this.editedItem.Nama,
            Merk: this.editedItem.Merk,
            Kategori: this.editedItem.Kategori,
            PartNumber1: this.editedItem.PartNumber1,
            PartNumber2: this.editedItem.PartNumber2,
            Kendaraan: this.editedItem.Kendaraan,
            KdSupplier: this.editedItem.KdSupplier,
            Dimensi: this.editedItem.Dimensi,
            Aktif: this.editedItem.Aktif,
            Gudang: this.editedItem.Gudang,
            Memo: this.editedItem.Memo,
            StokMin: this.editedItem.StokMin,
            StokMaks: this.editedItem.StokMaks,
            Rasio: this.editedItem.Rasio,
            MataUang: this.editedItem.MataUang,
            StockOnHand: this.editedItem.StockOnHand,
            TanggalHargaJual: this.editedItem.TanggalHargaJual,
            TanggalHargaBeli: this.editedItem.TanggalHargaBeli,
            HargaBeli: this.editedItem.HargaBeli,
            HargaJual: this.editedItem.HargaJual,
            DiskonHargaBeli: this.editedItem.DiskonHargaBeli

        })
        .then((res) => {
            this.Nama = ''
            this.Merk = ''
            this.Kategori=''
            this.PartNumber1=''
            this.PartNumber1=''
            this.Kendaraan=''
            this.KdSupplier=''
            this.Dimensi=''
            this.Aktif=''
            this.Gudang=''
            this.Memo=''
            this.StokMin=''
            this.StokMaks=''
            console.log(res)
            this.close()
            this.getData()
        })
        .catch((err) => {
            console.log(err)
        })
        },
        UpdateData(){
        api.put('/barang/' + this.editedItem.id +'?token='+this.token, {
            Kode: this.editedItem.Kode,
            Nama: this.editedItem.Nama,
            Merk: this.editedItem.Merk,
            Kategori: this.editedItem.Kategori,
            PartNumber1: this.editedItem.PartNumber1,
            PartNumber2: this.editedItem.PartNumber2,
            Kendaraan: this.editedItem.Kendaraan,
            KdSupplier: this.editedItem.KdSupplier,
            Dimensi: this.editedItem.Dimensi,
            Aktif: this.editedItem.Aktif,
            Gudang: this.editedItem.Gudang,
            Memo: this.editedItem.Memo,
            StokMin: this.editedItem.StokMin,
            StokMaks: this.editedItem.StokMaks,
            Rasio: this.editedItem.Rasio,
            MataUang: this.editedItem.MataUang,
            StockOnHand: this.editedItem.StockOnHand,
            TanggalHargaJual: this.editedItem.TanggalHargaJual,
            TanggalHargaBeli: this.editedItem.TanggalHargaBeli,
            HargaBeli: this.editedItem.HargaBeli,
            HargaJual: this.editedItem.HargaJual,
            DiskonHargaBeli: this.editedItem.DiskonHargaBeli
        })
        .then((res)=>{
            this.Nama = ''
            this.Merk = ''
            this.Kategori=''
            this.PartNumber1=''
            this.PartNumber1=''
            this.Kendaraan=''
            this.KdSupplier=''
            this.Dimensi=''
            this.Aktif=''
            this.Gudang=''
            this.Memo=''
            this.StokMin=''
            this.StokMaks=''
            console.log(res)
            this.close()
            this.getData()
        })
        .catch((err)=> {
            console.log(err)
        })
        },
        close() {
        this.dialog = false;
        this.editedItem = this.defaultItem
        this.editedItem = []
        this.editedIndex = -1
        this.itemtabsatuan = []
        this.itemtabhargabeli = []
        this.itemtabhargajual = []
        this.itemtabstok = []
        },
        commandClick: function(args) {
        if (args.target.classList.contains("custombutton")) {
            let data = JSON.stringify(args.rowData)
            console.log(data)
        } else if (args.target.classList.contains("Delete")) {
            var r = confirm("Yakin Hapus Data?");
            if (r == true) {
                api.delete('/barang/'+args.rowData.id+'?token='+this.token)
                .then((res)=> {
                    // this.item.splice(index, 1)
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
          this.dialog = true
          this.saveSatuan()
          this.saveHargaJual()
          this.saveHargaBeli()
          this.saveStok()
        }},
        // actionComplete(args) {
        // console.log(args)
        // },
        getData(){
            api.get('/barang?token='+this.token).then(
        res=>{
            //console.log(res)
            this.data = res.data
        },
        err => {
            console.log(err)
            this.$router.push('/')
            this.localStorage.removeItem('token')
        })},
  },
}
</script>

