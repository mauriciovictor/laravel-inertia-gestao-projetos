import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Perfis\EditPerfilController::__invoke
* @see app/Http/Controllers/Perfis/EditPerfilController.php:19
* @route '/roles/{role}'
*/
const EditPerfilController = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: EditPerfilController.url(args, options),
    method: 'get',
})

EditPerfilController.definition = {
    methods: ["get","head"],
    url: '/roles/{role}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Perfis\EditPerfilController::__invoke
* @see app/Http/Controllers/Perfis/EditPerfilController.php:19
* @route '/roles/{role}'
*/
EditPerfilController.url = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return EditPerfilController.definition.url
            .replace('{role}', parsedArgs.role.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Perfis\EditPerfilController::__invoke
* @see app/Http/Controllers/Perfis/EditPerfilController.php:19
* @route '/roles/{role}'
*/
EditPerfilController.get = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: EditPerfilController.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Perfis\EditPerfilController::__invoke
* @see app/Http/Controllers/Perfis/EditPerfilController.php:19
* @route '/roles/{role}'
*/
EditPerfilController.head = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: EditPerfilController.url(args, options),
    method: 'head',
})

export default EditPerfilController