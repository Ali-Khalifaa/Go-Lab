<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static whereHas(string $string, \Closure $param)
 */
class Subcategory extends Model
{
    protected $fillable = [
        'name','name_en','is_hidden',
    ];
    public function companys()
    {
        return $this->belongsToMany('App\Company');
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function hasCompany($companyId)
    {
        // return $this->companys->pluck('id')->toArray();
        return in_array($companyId, $this->companys->pluck('id')->toArray());
    }

    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }
}
