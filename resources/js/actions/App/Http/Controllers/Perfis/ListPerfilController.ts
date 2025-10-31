import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Perfis\ListPerfilController::__invoke
* @see app/Http/Controllers/Perfis/ListPerfilController.php:19
* @route '/roles'
*/
const ListPerfilController = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListPerfilController.url(options),
    method: 'get',
})

ListPerfilController.definition = {
    methods: ["get","head"],
    url: '/roles',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Perfis\ListPerfilController::__invoke
* @see app/Http/Controllers/Perfis/ListPerfilController.php:19
* @route '/roles'
*/
ListPerfilController.url = (options?: RouteQueryOptions) => {
    return ListPerfilController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Perfis\ListPerfilController::__invoke
* @see app/Http/Controllers/Perfis/ListPerfilController.php:19
* @route '/roles'
*/
ListPerfilController.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListPerfilController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Perfis\ListPerfilController::__invoke
* @see app/Http/Controllers/Perfis/ListPerfilController.php:19
* @route '/roles'
*/
ListPerfilController.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: ListPerfilController.url(options),
    method: 'head',
})

export default ListPerfilController