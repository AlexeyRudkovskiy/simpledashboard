<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 11.08.18
 * Time: 16:53
 */

namespace ARudkovskiy\Admin\Models;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}