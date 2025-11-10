import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\ListProjectsController::__invoke
* @see app/Http/Controllers/Projects/ListProjectsController.php:15
* @route '/projects'
*/
const ListProjectsController = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListProjectsController.url(options),
    method: 'get',
})

ListProjectsController.definition = {
    methods: ["get","head"],
    url: '/projects',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Projects\ListProjectsController::__invoke
* @see app/Http/Controllers/Projects/ListProjectsController.php:15
* @route '/projects'
*/
ListProjectsController.url = (options?: RouteQueryOptions) => {
    return ListProjectsController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\ListProjectsController::__invoke
* @see app/Http/Controllers/Projects/ListProjectsController.php:15
* @route '/projects'
*/
ListProjectsController.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListProjectsController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Projects\ListProjectsController::__invoke
* @see app/Http/Controllers/Projects/ListProjectsController.php:15
* @route '/projects'
*/
ListProjectsController.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: ListProjectsController.url(options),
    method: 'head',
})

export default ListProjectsController