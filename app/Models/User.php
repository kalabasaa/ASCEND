<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $username
 * @property string|null $email
 * @property string $password
 * @property string $role
 * @property string|null $avatar_path
 * @property array|null $tags
 * @property int $current_streak
 * @property int $longest_streak
 * @property Carbon|null $last_checked_in_at
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property Carbon|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['username', 'email', 'password', 'role', 'avatar_path', 'tags'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'tags' => 'array',
            'last_checked_in_at' => 'date',
        ];
    }

    // Get the user's initials

    public function initials(): string
    {
        $initials = Str::initials($this->username, true);

        return Str::length($initials) > 1
            ? Str::substr($initials, 0, 1).Str::substr($initials, -1)
            : $initials;
    }

    public function member(): HasOne
    {
        return $this->hasOne(Member::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
