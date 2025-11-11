import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\Cards\ListByProjectController::__invoke
* @see app/Http/Controllers/Projects/Cards/ListByProjectController.php:16
* @route '/projects/{project}/cards'
*/
const ListByProjectController = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListByProjectController.url(args, options),
    method: 'get',
})

ListByProjectController.definition = {
    methods: ["get","head"],
    url: '/projects/{project}/cards',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Projects\Cards\ListByProjectController::__invoke
* @see app/Http/Controllers/Projects/Cards/ListByProjectController.php:16
* @route '/projects/{project}/cards'
*/
ListByProjectController.url = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return ListByProjectController.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\ListByProjectController::__invoke
* @see app/Http/Controllers/Projects/Cards/ListByProjectController.php:16
* @route '/projects/{project}/cards'
*/
ListByProjectController.get = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListByProjectController.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Projects\Cards\ListByProjectController::__invoke
* @see app/Http/Controllers/Projects/Cards/ListByProjectController.php:16
* @route '/projects/{project}/cards'
*/
ListByProjectController.head = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: ListByProjectController.url(args, options),
    method: 'head',
})

export default ListByProjectController