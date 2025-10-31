import ListUserController from './ListUserController'
import CreateUserController from './CreateUserController'
import EditUserController from './EditUserController'
import DeleteUserController from './DeleteUserController'
import StoreUserController from './StoreUserController'
import UpdateUserController from './UpdateUserController'

const Users = {
    ListUserController: Object.assign(ListUserController, ListUserController),
    CreateUserController: Object.assign(CreateUserController, CreateUserController),
    EditUserController: Object.assign(EditUserController, EditUserController),
    DeleteUserController: Object.assign(DeleteUserController, DeleteUserController),
    StoreUserController: Object.assign(StoreUserController, StoreUserController),
    UpdateUserController: Object.assign(UpdateUserController, UpdateUserController),
}

export default Users