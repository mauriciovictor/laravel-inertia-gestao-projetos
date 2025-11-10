import ListProjectsController from './ListProjectsController'
import CreateProjectController from './CreateProjectController'
import StoreProjectController from './StoreProjectController'
import EditProjectController from './EditProjectController'
import UpdateProjectController from './UpdateProjectController'
import DeleteProjectController from './DeleteProjectController'

const Projects = {
    ListProjectsController: Object.assign(ListProjectsController, ListProjectsController),
    CreateProjectController: Object.assign(CreateProjectController, CreateProjectController),
    StoreProjectController: Object.assign(StoreProjectController, StoreProjectController),
    EditProjectController: Object.assign(EditProjectController, EditProjectController),
    UpdateProjectController: Object.assign(UpdateProjectController, UpdateProjectController),
    DeleteProjectController: Object.assign(DeleteProjectController, DeleteProjectController),
}

export default Projects