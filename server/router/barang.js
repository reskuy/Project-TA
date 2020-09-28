var express = require('express')
var router = express.Router()
const Task = require('../model/barang')

// Get All Barang
router.get('/Barang', (req, res,) => {
  Task.findAll()
    .then(Barang => {
      res.json(Barang)
    })
    .catch(err => {
      res.send('error: ' + err)
    })
})

router.post('/barang', (req, res,) => {
  if (!req.body.kode) {
    res.status(400)
    res.json({
      error: 'Bad Data'
    })
  } else {
    Task.create(req.body)
      .then(() => {
        res.send('Berhasil Ditambahkan!')
      })
      .catch(err => {
        res.send('error: ' + err)
      })
  }
})

router.delete('/barang/:id', (req, res,) => {
  Task.destroy({
    where: {
      id: req.params.id
    }
  })
    .then(() => {
      res.send('Berhasil Dihapus!')
    })
    .catch(err => {
      res.send('error: ' + err)
    })
})

// Update Task
router.put('/task/:id', (req, res,) => {
  if (!req.body.task_name) {
    res.status(400)
    res.json({
      error: 'Bad Data'
    })
  } else {
    Task.update(
      { task_name: req.body.task_name },
      { where: { id: req.params.id } }
    )
      .then(() => {
        res.send('Berhasil DiUpdate!')
      })
      // eslint-disable-next-line no-undef
      .error(err => handleError(err))
  }
})

module.exports = router