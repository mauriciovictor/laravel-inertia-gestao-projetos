<?php

namespace App\Repositories\Eloquent;

use App\DTOs\UserData;
use App\Enums\FilterTypeEnum;
use App\Repositories\Eloquent\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\AbstractPaginator;

class UserRepository
{
    public function __construct(private User $model)
    {
    }

    public function create(UserData $userData): User
    {
        $user = $this->model->create([
            'name' => $userData->name,
            'email' => $userData->email,
            'role_id' => $userData->role_id,
            'password' => $userData->password?->toHash(),
        ]);

        return $user;
    }

    public function update($id, UserData $userData)
    {
        $data = [
            'name' => $userData->name,
            'email' => $userData->email,
            'role_id' => $userData->role_id,
        ];

        if ($userData->password) {
            $data['password'] = $userData->password->toHash();
        }

        $this->model->find($id)->update($data);

        return $this->model->find($id);
    }

    public function delete(int $user_id): ?bool
    {
        return $this->model->find($user_id)->delete();
    }


    public function allPaged(array $fieldsFilters, array $filterValues, array $fielSortValues, string $search = '', int $page = 1, int $per_page = 5, array $appends): AbstractPaginator
    {
        $userQuery = User::query()->with('role');

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
                if ($key === 'role_name') {
                    $query->whereHas('role', function ($query) use ($operator, $operatorValue) {
                        $query->where('name', $operator, $operatorValue);
                    });
                } else {
                    $query->where($key, $operator, $operatorValue);
                }
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
                $query->orWhere('email', 'like', "%{$search}%");
            }
        });

        return $this;
    }

    function findCountByRole(int $role_id)
    {
        return $this->model->where('role_id', $role_id)->count();
    }
}
