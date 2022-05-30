<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Profile extends Model
{
    use HasFactory;
    use LogsActivity;

    protected static $recordEvents = [];
    protected static $logName = 'system';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        // 'middle_name',
        'last_name',
        /*'prefix',
        'suffix',*/
        'address',
        'country',
        'company_name',
        /*'company_division',
        'company_function',
        'email_secondary',
        'avatar',*/ // use profile_photo_path in users table
        'mobile_phone',
        /*'work_phone',
        'linkedin_url',
        'social_urls',
        'mobile_cc',
        'work_cc'*/
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
