<?php

namespace App\Repositories\Eloquent;

use App\Enums\FilterTypeEnum;
use App\Repositories\Eloquent\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\AbstractPaginator;
use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function findById(int $id): \Spatie\Permission\Contracts\Role|Role
    {
        return Role::with('permissions')->where('id', $id)->first();
    }

    public function create(string $name): \Spatie\Permission\Contracts\Role|Role
    {
        return Role::create(['name' => $name]);
    }

    public function assyncPermissions(int $id, array $permissions): \Spatie\Permission\Contracts\Role|Role
    {
        return Role::findById($id)->syncPermissions($permissions);
    }

    public function update(int $id, $name): \Spatie\Permission\Contracts\Role|Role
    {
        Role::findById($id)->update(['name' => $name]);
        return Role::findById($id);
    }

    public function delete(int $id): ?bool
    {
        return Role::findById($id)->delete();
    }

    public function all(): mixed
    {
        return Role::all();
    }

    public function allPaged(array $fieldsFilters, array $filterValues, array $fielSortValues, string $search = '', int $page = 1, int $per_page = 5, array $appends): LengthAwarePaginator
    {
        $userQuery = Role::query();

        $this
            ->applyFilters($userQuery, $fieldsFilters, $filterValues)
            ->applySearch($userQuery, $search)
            ->applyOrder($userQuery, $fielSortValues);

        return $userQuery
            ->paginate(perPage: $per_page, page: $page)
            ->appends($appends);
    }

    public function applyFilters(Builder &$query, array $fieldsFilters, array $filterValues): self
    {
        foreach ($filterValues as $key => $filter) {
            if (in_array($key, $fieldsFilters)) {
                $filterType = FilterTypeEnum::tryFrom($filter['match'] ?? '');
                $operator = $filterType->getOperator();
                $operatorValue = $filterType->getOperatorValue($filter['value']);
                $query->where($key, $operator, $operatorValue);
            }
        }

        return $this;
    }

    public function applyOrder(Builder &$query, array $fieldSortValues): self
    {
        if ($fieldSortValues['field'] && $fieldSortValues['order']) {
            $query->orderBy($fieldSortValues['field'], $fieldSortValues['order']);
        } else {
            $query->orderBy('name', 'desc');
        }

        return $this;
    }

    public function applySearch(Builder &$query, string $search): self
    {
        $query->where(function ($query) use ($search) {
            if (!empty($search)) {
                $query->where('name', 'like', "%{$search}%");
            }
        });

        return $this;
    }
}
