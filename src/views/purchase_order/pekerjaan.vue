<template>
  <v-data-table
    :headers="headers"
    :items="gudang"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>Pekerjaan</v-toolbar-title>
        <v-divider
          class="mx-2"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
         
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="14"  md="6">
                      <v-text-field outlined dense
                        v-model="editedItem.jenis_pekerjaan" 
                        label="Jenis Pekerjaan">
                      </v-text-field>
                    </v-col>

        
                

                  

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.keterangan" 
                      label="Keterangan" required>
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.jumlah" 
                      label="jumlah">
                    </v-text-field>
                  </v-col>

                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.rasio" 
                      label="Rasio">
                    </v-text-field>
                  </v-col>
                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.harga" 
                      label="Harga">
                    </v-text-field>
                  </v-col>
                  <v-col cols="14"  md="6">
                    <v-text-field outlined dense
                      v-model="editedItem.diskon" 
                      label="Diskon">
                    </v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="headline">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="initialize"
      >
        Reset
      </v-btn>
    </template>
    <template v-slot:[`item.apply`]>
      <v-checkbox 
      small
      class="mr-2"
      ></v-checkbox>

    </template>
  </v-data-table>
</template>
<script>
  export default {
    data: () => ({
      dialog: false,
      dialogDelete: false,
      headers: [
        {
           text: 'Jenis Pekerjaan',
          align: 'start',
          value: 'jenis_pekerjaan',
          
        },
        { text: 'Keterangan', value: 'keterangan', align:'left'},
        {text: 'Jumlah', value:'jumlah', align:'left'},
        { text: 'Rasio', value: 'rasio', align:'left' },
        { text: 'Harga', value: 'harga', align:'left' },
        { text: 'Diskon(%)', value: 'diskon' , align:'left'},
        { text: 'SubTotal', value: 'subtotal' , align:'left'},
       
      ],
      gudang: [],
      item: [],
      editedIndex: -1,
      editedItem: {
        jenis_pekerjaan: '',
        keterangan: '',
        merk: '',
        jumlah: '',
        rasio:'',
        harga: '',
        diskon: '',
        subtotal: '',
        
        
      },
      defaultItem: {
        jenis_pekerjaan: '',
        keterangan: '',
        merk: '',
        jumlah: '',
        rasio:'',
        harga: '',
        diskon: '',
        subtotal: '',
        
        
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Barang' : 'Edit Barang'
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
            jenis_pekerjaan: 'FENDER DEPAN KANAN',
        keterangan: 'K+C',
        
        jumlah: '1',
        rasio:'1',
        harga: '500.000,00',
        diskon: '0.00',
        subtotal: '500.000,00',
        
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