import ChangeItemPriorityController from './ChangeItemPriorityController'
import ChangeCardItemController from './ChangeCardItemController'
import CreateCardItemController from './CreateCardItemController'
import UpdateItemController from './UpdateItemController'
import DeleteCardItemController from './DeleteCardItemController'

const Items = {
    ChangeItemPriorityController: Object.assign(ChangeItemPriorityController, ChangeItemPriorityController),
    ChangeCardItemController: Object.assign(ChangeCardItemController, ChangeCardItemController),
    CreateCardItemController: Object.assign(CreateCardItemController, CreateCardItemController),
    UpdateItemController: Object.assign(UpdateItemController, UpdateItemController),
    DeleteCardItemController: Object.assign(DeleteCardItemController, DeleteCardItemController),
}

export default Items