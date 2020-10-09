const Sequelize = require("sequelize");
const db = require("../db/index.js");

module.exports = db.sequelize.define(
  "pelanggan",
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
    kode_pos: {
      type: Sequelize.STRING
    },
    negara: {
      type: Sequelize.STRING
    },
    telp: {
      type: Sequelize.STRING
    },
    fax: {
      type: Sequelize.STRING
    },
    email: {
      type: Sequelize.STRING
    },
    contact_person: {
        type: Sequelize.STRING
    },
    sales_person: {
        type: Sequelize.STRING
    },
    group_pelanggan: {
        type: Sequelize.STRING
    }
  },
  {
    timestamps: false
  }
);