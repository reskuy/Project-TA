<template>
  <v-data-table
  dense
    :headers="headers"
    :items="gudang"
    sort-by="kode"
    class="elevation-1"
    
    >

    <template v-slot:top>
      <v-toolbar flat color="white">

        <v-toolbar-title>Estimasi</v-toolbar-title>

          <v-divider
            class="mx-6"
            inset
            vertical
          ></v-divider>

        <v-toolbar-title>Tabel Estimasi Terakhir</v-toolbar-title>

          <v-spacer></v-spacer>
          <v-dialog
              v-model="dialog2"
              max-width="1200px"
              >
               <template v-slot:activator="{ on, additem }">
                 <v-col sm="2" cols="12">
                  <v-btn
                    color="primary"
                    dark
                    class="mb-2"
                    v-bind="additem"
                    v-on="on">
                    Tampilkan Semua WO
                  </v-btn>
                 </v-col>
                </template>

                  <v-col cols="12">
                    
                   <v-card>
                 <ItemsPurchaseOrder/>
                  </v-card>
                  </v-col>
                  
</v-dialog>
            <v-dialog
              v-model="dialog"
              max-width="1200px"
              >
                
                <template v-slot:activator="{ on, additem }">
                  <v-btn
                    color="primary"
                    dark
                    class="mb-2"
                    v-bind="additem"
                    v-on="on">
                    Tambahkan Estimasi Terakhir
                  </v-btn>
                </template>

          <v-card>
                   <v-toolbar
      color="primary"
      dark
      flat
    >           <span class="headline">{{ formTitle }}</span>
                   </v-toolbar>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="14"  md="6">
                      <v-text-field outlined dense
                        v-model="editedItem.kd_nota" 
                        label="Kode Nota">
                      </v-text-field>
                    </v-col>

                  <v-col cols="14"  md="2">
                   <v-menu
        v-model="menu_tanggal1"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field outlined dense
            v-model="editedItem.tanggalan"
            label="Tanggal"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
        locale="id"
          v-model="editedItem.tanggalan"
          @input="menu_tanggal1 = false"
        ></v-date-picker>
      </v-menu>
                  </v-col>

                  <v-col cols="14"  md="2">
                    <v-menu
        v-model="menu_tanggal2"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field outlined dense
            v-model="editedItem.tgl_estimasi"
            label="Tanggal Estimasi"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
        locale="id"
          :min="tanggal"
          v-model="editedItem.tgl_estimasi"
          @input="menu_tanggal2 = false"
        ></v-date-picker>
    
      </v-menu>
                  </v-col>

                  <v-col cols="14"  md="2">
                    <v-text-field outlined dense
                      v-model="editedItem.kurs" 
                      label="Kurs">
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-combobox
                     v-model="editedItem.nm_pelanggan"
                      :items="nama_pelanggan"
                       label="pelanggan"
                       outlined
                        dense
                    ></v-combobox>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.odometer" 
                      label="Odo Meter" required>
                    </v-text-field>
                  </v-col>
                    <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.refrensi" 
                      label="Refrensi">
                    </v-text-field>
                  </v-col>


                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.payment_term" 
                      label="Payment Term">
                    </v-text-field>
                  </v-col>

                  

        <v-col cols="14"  md="6">
         <v-combobox
          v-model="editedItem.matauang"
          :items="matauang"
          label="Mata uang"
          outlined
          dense
        ></v-combobox>
                  </v-col>
                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.nomor_polisi" 
                      label="Nomor Polisi">
                    </v-text-field>
                  </v-col>
                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.nomor_mesin" 
                      label="Nomor Mesin">
                    </v-text-field>
                  </v-col>
                  

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.nomor_wo" 
                      label="Nomor WO">
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.nomor_rangka" 
                      label="Nomor Rangka">
                    </v-text-field>
                  </v-col>

                  
                  <v-col cols="14"  md="6">
                    <v-switch 
                      v-model="GudangSwitchAktif" 
                      color="primary" 
                      label=" Aktif">
                    </v-switch>
                  </v-col>
                  <v-col cols="14"  md="6">
                
                
                    
                  </v-col>
                  

                  <v-col cols="12" >
                    
                 <v-card>
                 <ItemsPurchaseOrder/>
                  
                 </v-card>
                 </v-col>
                  <v-col cols="12" >
                 <v-card>
                 <pekerjaan/>
                  </v-card>
                  </v-col>
                    <v-col cols="12" >
                    
                 <v-card>
                 <coba/>
                  
                 </v-card>
                 </v-col>
                  
                  <v-col
                  md="4"
                  offset-md="8">
                      
                  <v-card
                  class="pa-2">
          
       
                    <v-col cols="12"  >
                    <v-text-field outlined dense
                      v-model="editedItem.dpp" 
                      label="DPP">
                    </v-text-field>
                  </v-col><v-spacer></v-spacer>
                   <v-col cols="12"  >
                    <v-text-field outlined dense
                      v-model="editedItem.ppn" 
                      label="PPn">
                    </v-text-field>
                  </v-col>
                   
                    <v-col cols="12"  >
                    <v-text-field outlined dense 
                      v-model="editedItem.ppnpersen" 
                      label="PPnPersen"
                      >
                    </v-text-field>
                  </v-col><v-spacer></v-spacer>
                    <v-col cols="12"  >
                    <v-text-field outlined dense
                      v-model="editedItem.totalbayar" 
                      label="Total Bayar">
                    </v-text-field>
                  </v-col><v-spacer></v-spacer>
                  <v-col cols="12">
                    <v-text-field outlined dense
                      v-model="editedItem.onrisk" 
                      label="On Risk">
                    </v-text-field>
                  </v-col>
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
    </template>

<template v-slot:[`item.apply`]>
      <v-checkbox 
      small
      class="mr-2"
      ></v-checkbox>

    </template>

    <template v-slot:[`item.aksi`]= "{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)">
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)">
        mdi-delete
      </v-icon>

    </template>
    
 
    </v-data-table>
</template>
<script>
import ItemsPurchaseOrder from '@/views/purchase_order/items'
import pekerjaan from '@/views/purchase_order/pekerjaan'
import coba from '@/views/purchase_order/coba'
  export default {
    components: {
      ItemsPurchaseOrder,
      pekerjaan,
      coba,
    },
    data: () => ({
        tanggal: new Date().toISOString().substr(0, 10),
      dialog: false,
      dialog2: false,
      closeDelete: false,
      deleteItemConfirm: false,
      menu_tanggal1: false,
      menu_tanggal2: false,
      nama_pelanggan: [
          
        ],

      matauang: [
          'IDR',
          'US Dollar',
        ],

      GudangSwitchAktif: ['✓'],
      headers: [
        {
          text: 'Kode Nota',
          align: 'left',
          value: 'kd_nota',
        },
        { text: 'Tanggal', value: 'tanggalan' ,align: 'left',width:'150'},
        { text: 'Tanggal Estmasi', value: 'tgl_estimasi' ,align: 'left',width:'150'},
        { text: 'Nama Pelanggan', value: 'nm_pelanggan',align: 'left' ,width:'150'},
        { text: 'Nama Pemilik', value: 'nm_pemilik' ,align: 'left',width:'150'},
        { text: 'Jenis Work Order', value: 'jenis_wo' ,align: 'left',width:'150'},
        { text: 'Lokasi', value: 'lokasi' ,align: 'left',width:'150'},
        { text: 'Nomor Rangka', value: 'nomor_rangka',align: 'left',width:'150' },
        { text: 'Nomor Polisi', value: 'nomor_polisi',align: 'left' ,width:'150'},
        { text: 'Nomor Mesin', value: 'nomor_mesin',align: 'left',width:'150' },
        { text: 'Odometer', value: 'odometer',align: 'left',width:'150' },
        { text: 'Status', value: 'status',align: 'left',width:'150' },
        { text: 'Keterangan Status', value: 'ketstatus',align: 'left',width:'150' },
        { text: 'Keterangan', value: 'keterangan',align: 'left' ,width:'150'},
        { text: 'Saran', value: 'saran',width:'150' },
        { text: 'Payment Term', value: 'payterm' ,align: 'left',width:'150'},
        { text: 'Total', value: 'total',align: 'left' ,width:'150'},
        { text: 'Diskon', value: 'diskon' ,align: 'left',width:'150'},
        { text: 'DPP', value: 'dpp' ,align: 'left'},
        { text: 'PPn', value: 'ppn',align: 'left' },
        { text: 'PPn Persen', value: 'ppnpersen',align: 'left' ,width:'150'},
        { text: 'PPN Persen Manual', value: 'ppnpersenmanual',align: 'left' ,width:'160px'},
        { text: 'Total Bayar', value: 'totalbayar',align: 'left',width:'150' },
        { text: 'Terbayar', value: 'terbayar',align: 'left',width:'150' },
        { text: 'On Risk', value: 'onrisk',align: 'left' ,width:'150'},
        { text: 'Sisa Bayar', value: 'sisabayar',align: 'left',width:'150' },
        { text: 'Terbayar On Risk', value: 'terbayaronrisk',align: 'left',width:'150px' },
        { text: 'Sisa Bayar On Risk', value: 'sisabayaronrisk',align: 'left',width:'170' },
        { text: 'Mata Uang', value: 'matauang',align: 'left' ,width:'150'},
        { text: 'Kurs', value: 'kurs' ,align: 'left',width:'150'},
        { text: 'Referensi', value: 'referensi',align: 'left',width:'150' },
        { text: 'Jumlah Cetak', value: 'jumlahcetak',align: 'left',width:'150' },
        { text: 'Nomor WO', value: 'nomor_wo' ,align: 'left',width:'150'},
        { text: 'Nomor Invoice', value: 'nomor_invoice',align: 'left',width:'150' },
        { text: 'Tanggal Invoice', value: 'tanggalinvoice',align: 'left',width:'150' },
        { text: 'Write Off', value: 'apply',align: 'left',width:'150' },       
        { text: 'Diubah Oleh', value: 'editedby',align: 'left' ,width:'150'}, 
        { text: 'Aksi', value: 'aksi', sortable: false ,align: 'left',width:'150'},
      ],
      gudang: [],
      item: [],
      editedIndex: -1,
      editedItem: {
        kd_nota: '',
        tanggalan: '',
        nm_pelanggan: '',
        nm_pemilik:'',
        tgl_estimasi: '',
        referensi: '',
        nomor_rangka: '',
        nomor_polisi: '',
        nomor_wo: '',
        nomor_mesin:'',
        ppn:'',
        dpp:'',
        ppnpersen:'10%',
        totalbayar:'',
        onrisk:'',
        matauang: 'Rupiah',
        kurs: '1.00',
        payment_term: '',
        apply: '',
        dibuat_tgl: ''
      },
      defaultItem: {
        kd_nota: '',
        tanggalan: '',
        nm_pelanggan: '',
        tgl_estimasi: '',
        referensi: '',
        nomor_rangka: '',
        nomor_polisi: '',
        nomor_wo: '',
        nomor_mesin:'',
        ppn:'',
        dpp:'',
        ppnpersen:'10%',
        totalbayar:'',
        onrisk:'',
        apply: '',
        matauang: 'Rupiah',
        kurs: '1.00',
        payment_term: '',
        dibuat_tgl: ''
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Estimasi Terakhir' : 'Edit Estimasi Terakhir'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    created () {
      this.initialize()
    },
    

    methods: {
      initialize () {
        this.gudang = [
          {
            kd_nota:'0101/ES/2001/000001',
            tanggalan:'02/01/2020',
            tgl_estimasi:'02/01/2020',
            nm_pelanggan:'Childe',
            nm_pemilik:'Aether',
            jenis_wo:'CAR',
            lokasi:'HO',
            nomor_rangka : '-',
            nomor_mesin : 'MC64578',
            nomor_polisi :'KT222DB',
            odometer:'0',
            payment_term:'0',
            total:'20.000.000',
            diskon:'0.00',
            dpp:'400.000,00',
            ppn:'40.000',
            ppnpersen:'10.00',
            ppnpersenmanual:'10.00',
            totalbayar:'20.400.000',
            terbayar:'0.00',
            onrisk:'300.000,00',
            sisabayar:'20.100.000,00',
            terbayaronrisk:'0.00',
            sisabayaronrisk:'0.00',
            matauang:'IDR',
            kurs:'1.00',
            referensi : '',
            jumlahcetak:'2',
            nomor_wo : '0101/WO/2001/000082',
            editedby:'0101/Frin'
            
          },
        ]
      },
  
      editItem (item) {
        this.editedIndex = this.gudang.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.gudang.indexOf(item)
        confirm('Anda Yakin Menghapus Gudang ini?') && this.gudang.splice(index, 1)
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.gudang[this.editedIndex], this.editedItem)
        } else {
          this.gudang.push(this.editedItem)
        }
        this.close()
      },
    },
  }
</script>