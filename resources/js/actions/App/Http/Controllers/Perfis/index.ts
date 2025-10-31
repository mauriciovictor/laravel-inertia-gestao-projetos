import ListPerfilController from './ListPerfilController'
import CreatePerfilController from './CreatePerfilController'
import EditPerfilController from './EditPerfilController'
import DeletePerfilController from './DeletePerfilController'
import StorePerfilController from './StorePerfilController'
import UpdatePerfilController from './UpdatePerfilController'
import ListToComboBoxController from './ListToComboBoxController'

const Perfis = {
    ListPerfilController: Object.assign(ListPerfilController, ListPerfilController),
    CreatePerfilController: Object.assign(CreatePerfilController, CreatePerfilController),
    EditPerfilController: Object.assign(EditPerfilController, EditPerfilController),
    DeletePerfilController: Object.assign(DeletePerfilController, DeletePerfilController),
    StorePerfilController: Object.assign(StorePerfilController, StorePerfilController),
    UpdatePerfilController: Object.assign(UpdatePerfilController, UpdatePerfilController),
    ListToComboBoxController: Object.assign(ListToComboBoxController, ListToComboBoxController),
}

export default Perfis