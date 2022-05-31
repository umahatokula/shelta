<?php

namespace App\Models;

use App\Models\User;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory, HasSlug, Notifiable;

    protected $fillable = ['name', 'phone', 'email', 'dob', 'gender_id'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['sname', 'onames'])
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = trim(str_replace(' ', '', $value));
    }

    /**
     * Ensure phone number has country code.
     *
     * @return bool
     */
    public function getPhoneAttribute($value)
    {
        $phone = $value;

        if (strlen($value) == 11) {
            $phone = '+234'.substr($value, 1);
        }

        if (strlen($value) == 10) {
            $phone = '+234'.$value;
        }

        return $phone;
    }

    /**
     * properties
     *
     * @return void
     */
    public function state() {
        return $this->hasOne(User::class);
    }
}
