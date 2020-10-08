var express = require('express')

var bodyParser = require('body-parser')

var barang = require('./router/barang')
var gudang = require('./router/gudang')
var cors = require('cors')

var port = 3000

var app = express()
app.use(cors())

app.use(bodyParser.json())
app.use(bodyParser.urlencoded({ extended: false }))

app.use('/api', barang, gudang)

app.listen(port, function() {
  console.log('Server started on port ' + port)
})