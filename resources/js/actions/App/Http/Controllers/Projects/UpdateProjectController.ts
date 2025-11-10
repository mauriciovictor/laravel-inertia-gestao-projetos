import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\UpdateProjectController::__invoke
* @see app/Http/Controllers/Projects/UpdateProjectController.php:14
* @route '/projects/{project}'
*/
const UpdateProjectController = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: UpdateProjectController.url(args, options),
    method: 'put',
})

UpdateProjectController.definition = {
    methods: ["put"],
    url: '/projects/{project}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Projects\UpdateProjectController::__invoke
* @see app/Http/Controllers/Projects/UpdateProjectController.php:14
* @route '/projects/{project}'
*/
UpdateProjectController.url = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return UpdateProjectController.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\UpdateProjectController::__invoke
* @see app/Http/Controllers/Projects/UpdateProjectController.php:14
* @route '/projects/{project}'
*/
UpdateProjectController.put = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: UpdateProjectController.url(args, options),
    method: 'put',
})

export default UpdateProjectController