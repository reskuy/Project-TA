const Sequelize = require("sequelize");
const db = {};
//new Sequelize("nama db", "user", "password")
const sequelize = new Sequelize("bk5bo7n7v57hq0muaki5", "ue2fakms9zipqwjv", "wBzOClGEH3efVupyJVPO", {
  host: "bk5bo7n7v57hq0muaki5-mysql.services.clever-cloud.com",
  port: "3306",
  dialect: "mysql",
  operatorsAliases: 1,

  pool: {
    max: 5,
    min: 0,
    acquire: 30000,
    idle: 10000
  }
});

db.sequelize = sequelize;
db.Sequelize = Sequelize;

module.exports = db;