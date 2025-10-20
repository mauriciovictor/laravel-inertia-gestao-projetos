import HomeController from './HomeController'
import UserController from './UserController'
import PerfilController from './PerfilController'

const Controllers = {
    HomeController: Object.assign(HomeController, HomeController),
    UserController: Object.assign(UserController, UserController),
    PerfilController: Object.assign(PerfilController, PerfilController),
}

export default Controllers