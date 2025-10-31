import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Perfis\DeletePerfilController::__invoke
* @see app/Http/Controllers/Perfis/DeletePerfilController.php:16
* @route '/roles/{role}'
*/
const DeletePerfilController = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: DeletePerfilController.url(args, options),
    method: 'delete',
})

DeletePerfilController.definition = {
    methods: ["delete"],
    url: '/roles/{role}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Perfis\DeletePerfilController::__invoke
* @see app/Http/Controllers/Perfis/DeletePerfilController.php:16
* @route '/roles/{role}'
*/
DeletePerfilController.url = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return DeletePerfilController.definition.url
            .replace('{role}', parsedArgs.role.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Perfis\DeletePerfilController::__invoke
* @see app/Http/Controllers/Perfis/DeletePerfilController.php:16
* @route '/roles/{role}'
*/
DeletePerfilController.delete = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: DeletePerfilController.url(args, options),
    method: 'delete',
})

export default DeletePerfilController