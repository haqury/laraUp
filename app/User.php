<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var array роли пользователя
     */
    protected $roles = [];
    /**
     * @var array спиок ролей
     */
    protected $allRoles = [];

    /**
     * проверяет принадлежность к роли
     * @param array $role
     */
    public function hasRole($roles)
    {
        if (empty($roles)) {
            return true;
        }
        $this->setAllRoles();
        if (empty($this->roles) || empty($this->allRoles)) {
            $this->setRoles();
        }
        $roles = is_array($roles) ? $roles : explode(',', str_replace(' ', '', $roles));
        return !empty(array_intersect($roles, $this->roles));
    }

    /**
     * Cохраняет роли для пользователя
     * @return bool
     */
    public function setRoles()
    {
        $allRoles = new role();
        $this->allRoles = $allRoles->all()->keyBy('id');
        $rolesLink = new users_role_link();
        $rolesLink->where('user_id', $this->id);
        foreach ($rolesLink->get()->keyBy('id') as $link) {
            $userRoles[] = ($this->allRoles[$link['role_id']])->name;
        }
        $this->roles = !empty($rolesLink->get())
            ? array_merge($userRoles, ['user'])
            : ['user'];
        return true;
    }

    /**
     * Сохраняет список ролей
     * @return bool
     */
    public function setAllRoles()
    {
        if (empty($this->allRoles)) {
            $this->allRoles = role::all();
        }
        return true;
    }

    public function checkAccess($roles)
    {
        if (empty($this->hasRole($roles))) {
            return false;
        }
        return true;
    }
}
