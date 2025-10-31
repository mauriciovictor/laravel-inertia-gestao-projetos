import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Perfis\CreatePerfilController::__invoke
* @see app/Http/Controllers/Perfis/CreatePerfilController.php:11
* @route '/roles/create'
*/
const CreatePerfilController = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: CreatePerfilController.url(options),
    method: 'get',
})

CreatePerfilController.definition = {
    methods: ["get","head"],
    url: '/roles/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Perfis\CreatePerfilController::__invoke
* @see app/Http/Controllers/Perfis/CreatePerfilController.php:11
* @route '/roles/create'
*/
CreatePerfilController.url = (options?: RouteQueryOptions) => {
    return CreatePerfilController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Perfis\CreatePerfilController::__invoke
* @see app/Http/Controllers/Perfis/CreatePerfilController.php:11
* @route '/roles/create'
*/
CreatePerfilController.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: CreatePerfilController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Perfis\CreatePerfilController::__invoke
* @see app/Http/Controllers/Perfis/CreatePerfilController.php:11
* @route '/roles/create'
*/
CreatePerfilController.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: CreatePerfilController.url(options),
    method: 'head',
})

export default CreatePerfilController