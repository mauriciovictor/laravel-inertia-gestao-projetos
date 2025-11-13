import CreateCardItemController from './CreateCardItemController'
import ChangeCardItemController from './ChangeCardItemController'
import ChangeItemPriorityController from './ChangeItemPriorityController'
import DeleteCardItemController from './DeleteCardItemController'

const Items = {
    CreateCardItemController: Object.assign(CreateCardItemController, CreateCardItemController),
    ChangeCardItemController: Object.assign(ChangeCardItemController, ChangeCardItemController),
    ChangeItemPriorityController: Object.assign(ChangeItemPriorityController, ChangeItemPriorityController),
    DeleteCardItemController: Object.assign(DeleteCardItemController, DeleteCardItemController),
}

export default Items