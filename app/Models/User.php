<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;


/**
 * App\Models\User
 *
 * @property int $user_id
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserId($value)
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property int $user_role
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserRole($value)
 * @mixin \Eloquent
 */
class User extends BaseUser
{
    use Notifiable;

    protected $primaryKey = "user_id";

    protected $hidden = ['password', 'remember_token'];

    protected $fillable = ['email', 'password'];


    public static function validationRules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',        
        ];
    }

    public static function validationRulesPassword(): array
    {
        return [
            'password' => 'required',
            'confirmPassword' => 'required|same:password',        
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'email.required' => 'Es necesario ingresar el email',
            'password.required' => 'Es necesario ingresar una contraseña',
            'confirmPassword.same' => 'Las contraseñas no coinciden',

        ];
    }

    public static function validationMessagesPassword(): array
    {
        return [
            'password.required' => 'Es necesario ingresar una contraseña',
            'confirmPassword.required' => 'Es necesario ingresar una contraseña',
            'confirmPassword.same' => 'Las contraseñas no coinciden',
        ];
    }

}
