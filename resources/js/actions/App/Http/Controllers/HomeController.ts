import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\HomeController::__invoke
* @see app/Http/Controllers/HomeController.php:9
* @route '/home'
*/
const HomeController = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: HomeController.url(options),
    method: 'get',
})

HomeController.definition = {
    methods: ["get","head"],
    url: '/home',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\HomeController::__invoke
* @see app/Http/Controllers/HomeController.php:9
* @route '/home'
*/
HomeController.url = (options?: RouteQueryOptions) => {
    return HomeController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\HomeController::__invoke
* @see app/Http/Controllers/HomeController.php:9
* @route '/home'
*/
HomeController.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: HomeController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\HomeController::__invoke
* @see app/Http/Controllers/HomeController.php:9
* @route '/home'
*/
HomeController.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: HomeController.url(options),
    method: 'head',
})

export default HomeController