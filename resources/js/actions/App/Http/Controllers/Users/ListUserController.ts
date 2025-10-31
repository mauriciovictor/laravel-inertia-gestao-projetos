import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Users\ListUserController::__invoke
* @see app/Http/Controllers/Users/ListUserController.php:19
* @route '/users'
*/
const ListUserController = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListUserController.url(options),
    method: 'get',
})

ListUserController.definition = {
    methods: ["get","head"],
    url: '/users',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Users\ListUserController::__invoke
* @see app/Http/Controllers/Users/ListUserController.php:19
* @route '/users'
*/
ListUserController.url = (options?: RouteQueryOptions) => {
    return ListUserController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Users\ListUserController::__invoke
* @see app/Http/Controllers/Users/ListUserController.php:19
* @route '/users'
*/
ListUserController.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListUserController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Users\ListUserController::__invoke
* @see app/Http/Controllers/Users/ListUserController.php:19
* @route '/users'
*/
ListUserController.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: ListUserController.url(options),
    method: 'head',
})

export default ListUserController