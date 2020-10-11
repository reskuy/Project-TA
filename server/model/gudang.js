const Sequelize = require("sequelize");
const db = require("../db/index.js");

module.exports = db.sequelize.define(
  "gudang",
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
    alamat: {
      type: Sequelize.STRING
    },
    kota: {
      type: Sequelize.STRING
    },
    memo: {
      type: Sequelize.STRING
    },
  },
  {
    timestamps: false
  }
);