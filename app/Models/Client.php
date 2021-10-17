<?php

namespace App\Models;

use App\Models\Property;
use App\Models\Transaction;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = ['name', 'phone', 'email', 'address'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
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
     * transactions
     *
     * @return void
     */
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
    
    /**
     * properties
     *
     * @return void
     */
    public function properties() {
        return $this->hasMany(Property::class);
    }
}
