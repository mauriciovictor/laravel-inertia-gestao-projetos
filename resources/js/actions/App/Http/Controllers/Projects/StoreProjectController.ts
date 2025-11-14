import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\StoreProjectController::__invoke
* @see app/Http/Controllers/Projects/StoreProjectController.php:15
* @route '/projects'
*/
const StoreProjectController = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: StoreProjectController.url(options),
    method: 'post',
})

StoreProjectController.definition = {
    methods: ["post"],
    url: '/projects',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Projects\StoreProjectController::__invoke
* @see app/Http/Controllers/Projects/StoreProjectController.php:15
* @route '/projects'
*/
StoreProjectController.url = (options?: RouteQueryOptions) => {
    return StoreProjectController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\StoreProjectController::__invoke
* @see app/Http/Controllers/Projects/StoreProjectController.php:15
* @route '/projects'
*/
StoreProjectController.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: StoreProjectController.url(options),
    method: 'post',
})

export default StoreProjectController