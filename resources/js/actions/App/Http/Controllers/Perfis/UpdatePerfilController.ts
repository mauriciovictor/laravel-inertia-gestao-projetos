import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Perfis\UpdatePerfilController::__invoke
* @see app/Http/Controllers/Perfis/UpdatePerfilController.php:17
* @route '/roles/{role}'
*/
const UpdatePerfilController = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: UpdatePerfilController.url(args, options),
    method: 'put',
})

UpdatePerfilController.definition = {
    methods: ["put"],
    url: '/roles/{role}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Perfis\UpdatePerfilController::__invoke
* @see app/Http/Controllers/Perfis/UpdatePerfilController.php:17
* @route '/roles/{role}'
*/
UpdatePerfilController.url = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { role: args }
    }

    if (Array.isArray(args)) {
        args = {
            role: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        role: args.role,
    }

    return UpdatePerfilController.definition.url
            .replace('{role}', parsedArgs.role.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Perfis\UpdatePerfilController::__invoke
* @see app/Http/Controllers/Perfis/UpdatePerfilController.php:17
* @route '/roles/{role}'
*/
UpdatePerfilController.put = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: UpdatePerfilController.url(args, options),
    method: 'put',
})

export default UpdatePerfilController