import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Perfis\StorePerfilController::__invoke
* @see app/Http/Controllers/Perfis/StorePerfilController.php:17
* @route '/roles'
*/
const StorePerfilController = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: StorePerfilController.url(options),
    method: 'post',
})

StorePerfilController.definition = {
    methods: ["post"],
    url: '/roles',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Perfis\StorePerfilController::__invoke
* @see app/Http/Controllers/Perfis/StorePerfilController.php:17
* @route '/roles'
*/
StorePerfilController.url = (options?: RouteQueryOptions) => {
    return StorePerfilController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Perfis\StorePerfilController::__invoke
* @see app/Http/Controllers/Perfis/StorePerfilController.php:17
* @route '/roles'
*/
StorePerfilController.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: StorePerfilController.url(options),
    method: 'post',
})

export default StorePerfilController