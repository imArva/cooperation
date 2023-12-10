const notificationController = require('./controllers/notificationController')

const controllers = (repositories) => {
    return {
        notificationController: notificationController.bind(null, repositories)
    }
}

module.exports = controllers