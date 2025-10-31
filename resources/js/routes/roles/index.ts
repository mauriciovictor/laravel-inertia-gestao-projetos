import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../wayfinder'
/**
* @see \App\Http\Controllers\Perfis\ListPerfilController::__invoke
* @see app/Http/Controllers/Perfis/ListPerfilController.php:19
* @route '/roles'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/roles',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Perfis\ListPerfilController::__invoke
* @see app/Http/Controllers/Perfis/ListPerfilController.php:19
* @route '/roles'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Perfis\ListPerfilController::__invoke
* @see app/Http/Controllers/Perfis/ListPerfilController.php:19
* @route '/roles'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Perfis\ListPerfilController::__invoke
* @see app/Http/Controllers/Perfis/ListPerfilController.php:19
* @route '/roles'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Perfis\CreatePerfilController::__invoke
* @see app/Http/Controllers/Perfis/CreatePerfilController.php:11
* @route '/roles/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/roles/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Perfis\CreatePerfilController::__invoke
* @see app/Http/Controllers/Perfis/CreatePerfilController.php:11
* @route '/roles/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Perfis\CreatePerfilController::__invoke
* @see app/Http/Controllers/Perfis/CreatePerfilController.php:11
* @route '/roles/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Perfis\CreatePerfilController::__invoke
* @see app/Http/Controllers/Perfis/CreatePerfilController.php:11
* @route '/roles/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Perfis\EditPerfilController::__invoke
* @see app/Http/Controllers/Perfis/EditPerfilController.php:19
* @route '/roles/{role}'
*/
export const edit = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/roles/{role}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Perfis\EditPerfilController::__invoke
* @see app/Http/Controllers/Perfis/EditPerfilController.php:19
* @route '/roles/{role}'
*/
edit.url = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return edit.definition.url
            .replace('{role}', parsedArgs.role.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Perfis\EditPerfilController::__invoke
* @see app/Http/Controllers/Perfis/EditPerfilController.php:19
* @route '/roles/{role}'
*/
edit.get = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Perfis\EditPerfilController::__invoke
* @see app/Http/Controllers/Perfis/EditPerfilController.php:19
* @route '/roles/{role}'
*/
edit.head = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Perfis\DeletePerfilController::__invoke
* @see app/Http/Controllers/Perfis/DeletePerfilController.php:16
* @route '/roles/{role}'
*/
export const destroy = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/roles/{role}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Perfis\DeletePerfilController::__invoke
* @see app/Http/Controllers/Perfis/DeletePerfilController.php:16
* @route '/roles/{role}'
*/
destroy.url = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return destroy.definition.url
            .replace('{role}', parsedArgs.role.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Perfis\DeletePerfilController::__invoke
* @see app/Http/Controllers/Perfis/DeletePerfilController.php:16
* @route '/roles/{role}'
*/
destroy.delete = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\Perfis\StorePerfilController::__invoke
* @see app/Http/Controllers/Perfis/StorePerfilController.php:17
* @route '/roles'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/roles',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Perfis\StorePerfilController::__invoke
* @see app/Http/Controllers/Perfis/StorePerfilController.php:17
* @route '/roles'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Perfis\StorePerfilController::__invoke
* @see app/Http/Controllers/Perfis/StorePerfilController.php:17
* @route '/roles'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Perfis\UpdatePerfilController::__invoke
* @see app/Http/Controllers/Perfis/UpdatePerfilController.php:17
* @route '/roles/{role}'
*/
export const update = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/roles/{role}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Perfis\UpdatePerfilController::__invoke
* @see app/Http/Controllers/Perfis/UpdatePerfilController.php:17
* @route '/roles/{role}'
*/
update.url = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return update.definition.url
            .replace('{role}', parsedArgs.role.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Perfis\UpdatePerfilController::__invoke
* @see app/Http/Controllers/Perfis/UpdatePerfilController.php:17
* @route '/roles/{role}'
*/
update.put = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\Perfis\ListToComboBoxController::__invoke
* @see app/Http/Controllers/Perfis/ListToComboBoxController.php:15
* @route '/roles/open-combo-box'
*/
export const openComboBox = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: openComboBox.url(options),
    method: 'get',
})

openComboBox.definition = {
    methods: ["get","head"],
    url: '/roles/open-combo-box',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Perfis\ListToComboBoxController::__invoke
* @see app/Http/Controllers/Perfis/ListToComboBoxController.php:15
* @route '/roles/open-combo-box'
*/
openComboBox.url = (options?: RouteQueryOptions) => {
    return openComboBox.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Perfis\ListToComboBoxController::__invoke
* @see app/Http/Controllers/Perfis/ListToComboBoxController.php:15
* @route '/roles/open-combo-box'
*/
openComboBox.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: openComboBox.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Perfis\ListToComboBoxController::__invoke
* @see app/Http/Controllers/Perfis/ListToComboBoxController.php:15
* @route '/roles/open-combo-box'
*/
openComboBox.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: openComboBox.url(options),
    method: 'head',
})

const roles = {
    index: Object.assign(index, index),
    create: Object.assign(create, create),
    edit: Object.assign(edit, edit),
    destroy: Object.assign(destroy, destroy),
    store: Object.assign(store, store),
    update: Object.assign(update, update),
    openComboBox: Object.assign(openComboBox, openComboBox),
}

export default roles