import HomeController from './HomeController'
import Users from './Users'
import Perfis from './Perfis'

const Controllers = {
    HomeController: Object.assign(HomeController, HomeController),
    Users: Object.assign(Users, Users),
    Perfis: Object.assign(Perfis, Perfis),
}

export default Controllers