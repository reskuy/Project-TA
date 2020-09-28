const Sequelize = require("sequelize");
const db = require("../db/index.js");

module.exports = db.sequelize.define(
  "barang",
  {
    id: {
      type: Sequelize.INTEGER,
      primaryKey: true,
      autoIncrement: true
    },
    kode: {
      type: Sequelize.STRING
    },
    nama: {
      type: Sequelize.STRING
    },
    merk: {
      type: Sequelize.STRING
    },
    kategori: {
      type: Sequelize.STRING
    },
    partnumber1: {
      type: Sequelize.STRING
    },
    partnumber2: {
      type: Sequelize.STRING
    },
    kendaraan: {
      type: Sequelize.STRING
    },
    kd_suplier: {
      type: Sequelize.STRING
    },
    dimensi: {
      type: Sequelize.STRING
    },
    aktif: {
      type: Sequelize.STRING
    }
  },
  {
    timestamps: false
  }
);