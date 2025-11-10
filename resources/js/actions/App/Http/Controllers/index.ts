import HomeController from './HomeController'
import Users from './Users'
import Perfis from './Perfis'
import Projects from './Projects'

const Controllers = {
    HomeController: Object.assign(HomeController, HomeController),
    Users: Object.assign(Users, Users),
    Perfis: Object.assign(Perfis, Perfis),
    Projects: Object.assign(Projects, Projects),
}

export default Controllers