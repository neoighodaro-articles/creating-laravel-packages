<?php
namespace Acme\PageReview\Models;

use Illuminate\Database\Eloquent\Model;
class Page extends Model
{
    protected $table = 'pages';
    protected $guarded = [];
    /**
     * A page can have many reviews
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}