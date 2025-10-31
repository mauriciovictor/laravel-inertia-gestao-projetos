import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Users\StoreUserController::__invoke
* @see app/Http/Controllers/Users/StoreUserController.php:17
* @route '/users'
*/
const StoreUserController = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: StoreUserController.url(options),
    method: 'post',
})

StoreUserController.definition = {
    methods: ["post"],
    url: '/users',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Users\StoreUserController::__invoke
* @see app/Http/Controllers/Users/StoreUserController.php:17
* @route '/users'
*/
StoreUserController.url = (options?: RouteQueryOptions) => {
    return StoreUserController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Users\StoreUserController::__invoke
* @see app/Http/Controllers/Users/StoreUserController.php:17
* @route '/users'
*/
StoreUserController.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: StoreUserController.url(options),
    method: 'post',
})

export default StoreUserController