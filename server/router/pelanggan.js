var express = require('express')
var router = express.Router()
const Task = require('../model/pelanggan')

// Get All pelanggan
router.get('/pelanggan', (req, res,) => {
  Task.findAll()
    .then(pelanggan => {
      res.json(pelanggan)
    })
    .catch(err => {
      res.send('error: ' + err)
    })
})

router.post('/pelanggan', (req, res,) => {
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

router.delete('/pelanggan/:id', (req, res,) => {
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
router.put('/pelanggan/:id', (req, res,) => {
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