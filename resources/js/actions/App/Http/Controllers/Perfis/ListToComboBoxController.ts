import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Perfis\ListToComboBoxController::__invoke
* @see app/Http/Controllers/Perfis/ListToComboBoxController.php:15
* @route '/roles/open-combo-box'
*/
const ListToComboBoxController = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListToComboBoxController.url(options),
    method: 'get',
})

ListToComboBoxController.definition = {
    methods: ["get","head"],
    url: '/roles/open-combo-box',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Perfis\ListToComboBoxController::__invoke
* @see app/Http/Controllers/Perfis/ListToComboBoxController.php:15
* @route '/roles/open-combo-box'
*/
ListToComboBoxController.url = (options?: RouteQueryOptions) => {
    return ListToComboBoxController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Perfis\ListToComboBoxController::__invoke
* @see app/Http/Controllers/Perfis/ListToComboBoxController.php:15
* @route '/roles/open-combo-box'
*/
ListToComboBoxController.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListToComboBoxController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Perfis\ListToComboBoxController::__invoke
* @see app/Http/Controllers/Perfis/ListToComboBoxController.php:15
* @route '/roles/open-combo-box'
*/
ListToComboBoxController.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: ListToComboBoxController.url(options),
    method: 'head',
})

export default ListToComboBoxController