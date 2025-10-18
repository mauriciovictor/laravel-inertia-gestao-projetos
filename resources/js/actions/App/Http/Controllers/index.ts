import HomeController from './HomeController'
import UserController from './UserController'

const Controllers = {
    HomeController: Object.assign(HomeController, HomeController),
    UserController: Object.assign(UserController, UserController),
}

export default Controllers