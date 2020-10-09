let express = require('express')

let bodyParser = require('body-parser')

let barang = require('./router/barang')
let gudang = require('./router/gudang')
let supplier = require('./router/supplier')
let pelanggan = require('./router/pelanggan')
let cors = require('cors')

let port = 3000

let app = express()
app.use(cors())

app.use(bodyParser.json())
app.use(bodyParser.urlencoded({ extended: false }))

app.use('/api', barang, gudang, supplier, pelanggan)

app.listen(port, function() {
  console.log('Server started on port ' + port)
})