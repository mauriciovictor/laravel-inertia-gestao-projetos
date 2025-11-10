import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\DeleteProjectController::__invoke
* @see app/Http/Controllers/Projects/DeleteProjectController.php:13
* @route '/projects/{project}'
*/
const DeleteProjectController = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: DeleteProjectController.url(args, options),
    method: 'delete',
})

DeleteProjectController.definition = {
    methods: ["delete"],
    url: '/projects/{project}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Projects\DeleteProjectController::__invoke
* @see app/Http/Controllers/Projects/DeleteProjectController.php:13
* @route '/projects/{project}'
*/
DeleteProjectController.url = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { project: args }
    }

    if (Array.isArray(args)) {
        args = {
            project: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        project: args.project,
    }

    return DeleteProjectController.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\DeleteProjectController::__invoke
* @see app/Http/Controllers/Projects/DeleteProjectController.php:13
* @route '/projects/{project}'
*/
DeleteProjectController.delete = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: DeleteProjectController.url(args, options),
    method: 'delete',
})

export default DeleteProjectController