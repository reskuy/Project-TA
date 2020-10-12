var express = require("express");

var bodyParser = require("body-parser");

let barang = require('./router/barang')
let gudang = require('./router/gudang')
let supplier = require('./router/supplier')
let pelanggan = require('./router/pelanggan')
let cors = require('cors')

var port = process.env.PORT || 3000;

var app = express();
app.use(cors());

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

app.use('/api', barang, gudang, supplier, pelanggan)

app.listen(port, function () {
  console.log("Server started on port " + port);
});
