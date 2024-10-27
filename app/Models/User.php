<?php
namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Archive;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'subscription_name',
        'paypal_subscription_id',
        'subscription_end_date',
        'subscription_status'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'subscription_end_date' => 'datetime'
    ];

    // Relation to Archives. User can have multiple archives
    public function archives()
    {
        return $this->hasMany(Archive::class);
    }

    /**
     * Update the subscription status of the user
     */
    public function updateSubscriptionStatus($status, $expire_date)
    {
        $this->subscription_name = $status;
        $this->expire_date = $expire_date;
        $this->save();
    }

    /**
     * Delete the user and all related archives
     */
    public function deleteAccount(): bool
    {
        DB::beginTransaction();

        try {
            // Löschen aller zugehörigen Archive
            $this->archives()->delete();

            // Cache-Eintrag vergessen
            Cache::forget("session_user_{$this->id}");

            // Benutzer löschen
            parent::delete();

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
