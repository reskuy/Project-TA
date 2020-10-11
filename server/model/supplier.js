const Sequelize = require("sequelize");
const db = require("../db/index.js");

module.exports = db.sequelize.define(
  "supplier",
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
    badan_hukum: {
      type: Sequelize.STRING
    },
    alamat: {
      type: Sequelize.STRING
    },
    kota: {
      type: Sequelize.STRING
    },
    negara: {
      type: Sequelize.STRING
    },
    contact_person: {
      type: Sequelize.STRING
    },
    aktif: {
      type: Sequelize.STRING
    },
    kredit_limit: {
      type: Sequelize.STRING
    },
    lama_kredit: {
      type: Sequelize.STRING
    },
    npwp: {
        type: Sequelize.STRING
    },
    nppkp: {
        type: Sequelize.STRING
    }
  },
  {
    timestamps: false
  }
);