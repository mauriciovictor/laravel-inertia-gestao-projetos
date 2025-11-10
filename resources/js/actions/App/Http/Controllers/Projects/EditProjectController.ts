import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\EditProjectController::__invoke
* @see app/Http/Controllers/Projects/EditProjectController.php:15
* @route '/projects/{project}'
*/
const EditProjectController = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: EditProjectController.url(args, options),
    method: 'get',
})

EditProjectController.definition = {
    methods: ["get","head"],
    url: '/projects/{project}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Projects\EditProjectController::__invoke
* @see app/Http/Controllers/Projects/EditProjectController.php:15
* @route '/projects/{project}'
*/
EditProjectController.url = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return EditProjectController.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\EditProjectController::__invoke
* @see app/Http/Controllers/Projects/EditProjectController.php:15
* @route '/projects/{project}'
*/
EditProjectController.get = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: EditProjectController.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Projects\EditProjectController::__invoke
* @see app/Http/Controllers/Projects/EditProjectController.php:15
* @route '/projects/{project}'
*/
EditProjectController.head = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: EditProjectController.url(args, options),
    method: 'head',
})

export default EditProjectController