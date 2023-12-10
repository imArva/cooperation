// DECLARE EXPRESSJS
const express = require('express')
const app = express()
const http = require('http')
const server = http.createServer(app)
const cors = require('cors')

app.use(cors({
  origin: 'http://localhost:3000'
}))

// DECLARE SOCKET.IO & CONFIGURATION
const socketIo = require('socket.io')
const io = socketIo(server)

// DATABASE CONFIG
const database = require('./database')

// REPOSITORIES
const repos = require('./repositories.js')
const repositories = repos(database)

// CONTROLLERS
const controllers = require('./controllers.js')
const { notificationController } = controllers(repositories)

// MAINKAN WEBSOCKET DISINI
io.on('connection', async (socket) => {

    socket.on('publishNotification', async (data) => {
        try {
            const result = await notificationController(data)
            io.emit('newNotification', result)
        } catch(error) {
            console.log({error})
            io.emit('error', error)
        }
    })

})

// TESTING
// console.log(notificationController("OK"))
// console.log(repositories)
// console.log(io)

// RUNNING SERVER
server.listen(3000, () => {
    console.log('Server is running on port 3000')
})