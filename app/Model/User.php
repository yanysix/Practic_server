<?php
namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class User extends Model implements IdentityInterface
{
    use HasFactory;

    public $timestamps = false;

    // Указываем имя таблицы, если нужно
    protected $table = 'users';

    // Указываем, что первичный ключ — user_id
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'login',
        'password',
        'role',
        'avatar',
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            $user->password = md5($user->password);
            $user->save();
        });
    }

    // Выборка пользователя по первичному ключу
    public function findIdentity(int $id)
    {
        return self::where($this->primaryKey, $id)->first();
    }

    // Возврат первичного ключа
    public function getId(): int
    {
        return $this->{$this->primaryKey};
    }

    // Проверка логина и пароля
    public function attemptIdentity(array $credentials)
    {
        return self::where([
            'login' => $credentials['login'],
            'password' => md5($credentials['password'])
        ])->first();
    }
}
