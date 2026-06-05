<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<UserFactory> */
    use HasFactory;

    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'usertype',  
        'loyalty_points',
        'total_spent',
        'allergenes', 
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'allergenes'        => 'array',
        ];
    }
    

// Dans $fillable, ajoute : 'loyalty_points', 'total_spent'

public function orders()  { return $this->hasMany(\App\Models\Order::class); }
public function reviews() { return $this->hasMany(\App\Models\Review::class); }

/* Badge de fidélité */
public function getLoyaltyBadgeAttribute(): string
{
    return match(true) {
        $this->loyalty_points >= 500 => 'Gold',
        $this->loyalty_points >= 200 => 'Silver',
        $this->loyalty_points >= 50  => 'Bronze',
        default                      => 'Nouveau',
    };
}

public function getLoyaltyColorAttribute(): string
{
    return match($this->loyalty_badge) {
        'Gold'   => '#f59e0b',
        'Silver' => '#9ca3af',
        'Bronze' => '#b45309',
        default  => '#6b7280',
    };
}

/* Points pour atteindre le prochain niveau */
public function getNextLevelPointsAttribute(): int
{
    return match(true) {
        $this->loyalty_points < 50  => 50,
        $this->loyalty_points < 200 => 200,
        $this->loyalty_points < 500 => 500,
        default                     => 500,
    };
}
public function hasAllergyWith(Food $food): bool
{
    $userAllergenes = $this->allergenes ?? [];
    $foodIngredients = array_map('strtolower', $food->ingredients ?? []);

    foreach ($userAllergenes as $allergen) {
        if (in_array(strtolower($allergen), $foodIngredients)) {
            return true;
        }
    }
    return false;
}
}
