import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\CreateProjectController::__invoke
* @see app/Http/Controllers/Projects/CreateProjectController.php:11
* @route '/projects/create'
*/
const CreateProjectController = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: CreateProjectController.url(options),
    method: 'get',
})

CreateProjectController.definition = {
    methods: ["get","head"],
    url: '/projects/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Projects\CreateProjectController::__invoke
* @see app/Http/Controllers/Projects/CreateProjectController.php:11
* @route '/projects/create'
*/
CreateProjectController.url = (options?: RouteQueryOptions) => {
    return CreateProjectController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\CreateProjectController::__invoke
* @see app/Http/Controllers/Projects/CreateProjectController.php:11
* @route '/projects/create'
*/
CreateProjectController.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: CreateProjectController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Projects\CreateProjectController::__invoke
* @see app/Http/Controllers/Projects/CreateProjectController.php:11
* @route '/projects/create'
*/
CreateProjectController.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: CreateProjectController.url(options),
    method: 'head',
})

export default CreateProjectController