import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Users\CreateUserController::__invoke
* @see app/Http/Controllers/Users/CreateUserController.php:18
* @route '/users/create'
*/
const CreateUserController = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: CreateUserController.url(options),
    method: 'get',
})

CreateUserController.definition = {
    methods: ["get","head"],
    url: '/users/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Users\CreateUserController::__invoke
* @see app/Http/Controllers/Users/CreateUserController.php:18
* @route '/users/create'
*/
CreateUserController.url = (options?: RouteQueryOptions) => {
    return CreateUserController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Users\CreateUserController::__invoke
* @see app/Http/Controllers/Users/CreateUserController.php:18
* @route '/users/create'
*/
CreateUserController.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: CreateUserController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Users\CreateUserController::__invoke
* @see app/Http/Controllers/Users/CreateUserController.php:18
* @route '/users/create'
*/
CreateUserController.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: CreateUserController.url(options),
    method: 'head',
})

export default CreateUserController