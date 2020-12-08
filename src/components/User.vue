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
             User
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
              Tambah
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
                  <v-row>
                        <v-col cols="18" sm="10" md="6">
                            <v-text-field v-model="editedItem.nama_lengkap" label="Nama Lengkap" :rules="rules"></v-text-field>
                        </v-col>
                        <v-col cols="18" sm="10" md="6">
                            <v-text-field v-model="editedItem.telepon" type="number" label="Telepon" :rules="rules"></v-text-field>
                        </v-col>
                        <v-col cols="12s" sm="10" md="6">
                            <v-textarea v-model="editedItem.alamat" label="Alamat" hint="Isi Alamat" :rules="rules"></v-textarea>
                        </v-col>
                        <v-col cols="18" sm="10" md="6">
                            <v-switch v-model="editedItem.aktif" color="blue darken-4" true-value="Aktif" false-value="tidak" label=" Aktif "></v-switch>
                        </v-col>
                        
                        <v-col cols="18" sm="10" md="6">
                            <v-text-field v-model="editedItem.email" type="email" label="Email" :rules="rules"></v-text-field>
                        </v-col>
                        <v-col cols="18" sm="10" md="6">
                            <v-text-field v-model="editedItem.password" type="password" label="Password" :rules="rules"></v-text-field>
                        </v-col>
                        
                        <v-col cols="18" sm="10" md="6">
                          <v-select
                          v-model="editedItem.jabatan"
                          :rules="rules"
                          :items="['HRD', 'IT', 'Mekanik', 'Teknisi']"
                          label="Jabatan*"
                          required
                          ></v-select>
                      </v-col>
                      <v-col cols="18" sm="10" md="6">
                          <v-select
                          :items="['Laki - Laki', 'Perempuan']"
                          label="Jenis Kelamin*"
                          v-model="editedItem.jenis_kelamin"
                          :rules="rules"
                          ></v-select>
                      </v-col>
                      <v-col cols="18" sm="10" md="6">
                        <v-menu
                          v-model="tanggal_mulai_kerja"
                          :close-on-content-click="false"
                          :nudge-right="40"
                          transition="scale-transition"
                          offset-y
                          min-width="290px"
                        >
                          <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                              v-model="editedItem.tanggal_mulai_kerja"
                              label="Tanggal Mulai Kerja"
                              prepend-icon="mdi-calendar"
                              readonly
                              v-bind="attrs"
                              v-on="on"
                            ></v-text-field>
                          </template>
                          <v-date-picker
                            v-model="editedItem.tanggal_mulai_kerja"
                            @input="tanggal_mulai_kerja = false"
                          ></v-date-picker>
                        </v-menu>
                      </v-col>
                      <v-col cols="18" sm="10" md="6">
                        <v-menu
                          v-model="tanggal_berhenti_kerja"
                          :close-on-content-click="false"
                          :nudge-right="40"
                          transition="scale-transition"
                          offset-y
                          min-width="290px"
                        >
                          <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                              v-model="editedItem.tanggal_berhenti_kerja"
                              label="Tanggal Berhenti Kerja"
                              prepend-icon="mdi-calendar"
                              readonly
                              v-bind="attrs"
                              v-on="on"
                            ></v-text-field>
                          </template>
                          <v-date-picker
                            v-model="editedItem.tanggal_berhenti_kerja"
                            @input="tanggal_berhenti_kerja = false"
                          ></v-date-picker>
                        </v-menu>
                      </v-col>
                      <v-col cols="18" sm="10" md="6">
                        <v-menu
                          v-model="tanggal_lahir"
                          :close-on-content-click="false"
                          :nudge-right="40"
                          transition="scale-transition"
                          offset-y
                          min-width="290px"
                        >
                          <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                              v-model="editedItem.tanggal_lahir"
                              label="Tanggal Lahir"
                              prepend-icon="mdi-calendar"
                              readonly
                              v-bind="attrs"
                              v-on="on"
                            ></v-text-field>
                          </template>
                          <v-date-picker
                            v-model="editedItem.tanggal_lahir"
                            @input="tanggal_lahir = false"
                          ></v-date-picker>
                        </v-menu>
                      </v-col>
                      <v-col cols="18" sm="10" md="6">
                          <v-text-field v-model="editedItem.keterangan" label="Keterangan" :rules="rules"></v-text-field>
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
                field='nama_lengkap'
                headerText='Nama Lengkap'
                textAlign='Left'
                width=180
                ></e-column>

                <e-column
                :filter='filter'
                field='alamat'
                headerText='Alamat'
                width=180
                ></e-column>

                <e-column
                :filter='filter'
                field='telepon'
                headerText='Telepon'
                width=180
                ></e-column>

                <e-column
                :filter='filter'
                field='email'
                headerText='Email '
                width=250
                ></e-column>

                <e-column
                :filter='filter'
                field='jabatan'
                headerText='Jabatan '
                width=250
                ></e-column>

                <e-column
                :filter='filter'
                field='aktif'
                headerText='Aktif'
                width=180
                ></e-column>

                <e-column
                :filter='filter'
                field='jenis_kelamin'
                headerText='Jenis Kelamin'
                width=180
                ></e-column>


                <e-column
                :filter='filter'
                field='tanggal_lahir'
                headerText='Tanggal Lahir'
                width=180
                ></e-column>

                <e-column
                :filter='filter'
                field='tanggal_mulai_kerja'
                headerText='Tanggal Mulai Kerja'
                width=180
                ></e-column>

                <e-column
                :filter='filter'
                field='tanggal_berhenti_kerja'
                headerText='Tanggal Lahir'
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
        </v-col>
 
</template>
<script>
import Vue from "vue";
import api from "@/axios/http";
import { DatePickerPlugin } from "@syncfusion/ej2-vue-calendars"
import { GridPlugin, Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder } from "@syncfusion/ej2-vue-grids";
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
      
      date: new Date().toISOString().substr(0, 10),
      menu: false,
      modal: false,
      tanggal_mulai_kerja: false,
      tanggal_berhenti_kerja: false,
      tanggal_lahir: false,
            tab:false,
            tab1:false,
            editedIndex: -1,
      editedItem: {
            nama_lengkap: "",
            telepon: "",
            alamat: "",
            email: "",
            password: "",
            aktif: "",
            jabatan: "",
            jenis_kelamin: "",
            tanggal_mulai_kerja: new Date().toISOString().substr(0, 10),
            tanggal_berhenti_kerja: new Date().toISOString().substr(0, 10),
            tanggal_lahir: new Date().toISOString().substr(0, 10),
            // tanggal_mulai_kerja: "",
            // tanggal_berhenti_kerja: "",
            // tanggal_lahir: "",
            keterangan: "",
        },
        defaultItem: {
            nama_lengkap: "",
            telepon: "",
            alamat: "",
            email: "",
            password: "",
            aktif: "",
            jabatan: "",
            jenis_kelamin: "",
            tanggal_mulai_kerja: "",
            tanggal_berhenti_kerja: "",
            tanggal_lahir: "",
            keterangan: "",
        },
        itemtabsatuan: [],
      rules: [
            value => !!value || 'Required.',
            value => (value && value.length >= 1) || '',
        ],
      itemtabstok: [],
      // headertabstok: [
      //   {
      //     text: 'COA',
      //     align: 'start',
      //     sortable: false,
      //     value: 'coa',
      //   },
      //   { text: 'Nama', value: 'nama' },
      //   { text: 'Stock On Hand', value: 'stockonhand' },
      // ],
        dialog: false,
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
    grid: [Page, Aggregate, Resize, Filter, Sort, Group, Edit, CommandColumn, Reorder]
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
            return this.editedIndex === -1 ? "Tambah User" : "Edit User";
        }
   },
  methods: {
    save(){
            if(this.formTitle === "Tambah User"){
                this.TambahData()
            }else{
                this.UpdateData()
            }
            this.close()
            
        },
    TambahData(){
            api.post('/user?token='+this.token, {
            nama_lengkap: this.editedItem.nama_lengkap,
            telepon: this.editedItem.telepon,
            alamat: this.editedItem.alamat,
            email: this.editedItem.email,
            jabatan: this.editedItem.jabatan,
            jenis_kelamin: this.editedItem.jenis_kelamin,
            aktif: this.editedItem.aktif,
            password: this.editedItem.password,
            tanggal_lahir: this.editedItem.tanggal_lahir,
            tanggal_mulai_kerja: this.editedItem.tanggal_mulai_kerja,
            tanggal_berhenti_kerja: this.editedItem.tanggal_berhenti_kerja,
            keterangan: this.editedItem.keterangan,
        })
        .then((res) => {
            this.nama_lengkap = ''
            this.telepon = ''
            this.alamat = ''
            this.email = ''
            this.jabatan = ''
            this.jenis_kelamin = ''
            this.aktif = ''
            this.password = ''
            this.tanggal_lahir = ''
            this.tanggal_mulai_kerja = ''
            this.tanggal_berhenti_kerja = ''
            this.keterangan = ''
            console.log(res)
            this.close()
            this.getData()
        })
        .catch((err) => {
            console.log(err)
        })
        },
        UpdateData(){
         api.put('/user/' + this.editedItem.id +'?token='+this.token, {
            nama_lengkap: this.editedItem.nama_lengkap,
            telepon: this.editedItem.telepon,
            alamat: this.editedItem.alamat,
            email: this.editedItem.email,
            password: this.editedItem.password,
            jabatan: this.editedItem.jabatan,
            jenis_kelamin: this.editedItem.jenis_kelamin,
            aktif: this.editedItem.aktif,
            tanggal_lahir: this.editedItem.tanggal_lahir,
            tanggal_mulai_kerja: this.editedItem.tanggal_mulai_kerja,
            tanggal_berhenti_kerja: this.editedItem.tanggal_berhenti_kerja,
            keterangan: this.editedItem.keterangan,
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

        close() {
        this.dialog = false;
        this.editedItem = this.defaultItem
        this.editedIndex = -1
        },
        commandClick: function(args) {
        if (args.target.classList.contains("custombutton")) {
            let data = JSON.stringify(args.rowData)
            console.log(data)
        } else if (args.target.classList.contains("Delete")) {
            var r = confirm("Yakin Hapus Data?");
            if (r == true) {
                api.delete('/user/'+args.rowData.id+'?token='+this.token)
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
        }},

        actionComplete(args) {
        console.log(args)
    },
        getData(){
            api.get('/user?token='+this.token).then(
        res=>{
            console.log(res)
            this.data = res.data
        },
        err => {
            console.log(err)
            // this.$router.push('/')
            // this.localStorage.removeItem('token')
        })},
  },
}
</script>

