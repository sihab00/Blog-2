<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\PostCreated;
use App\Events\PostUpdated;
use App\Events\PostDeleted;

class Post extends Model
{
	 protected $fillable = [
        'user_id','category_id','title', 'content', 'thumbnail_path','status'
    ];
    protected $dispatchesEvents = [
            'created'=> PostCreated::class,
            'updated'=> PostUpdated::class,
            'deleted'=> PostDeleted::class,
    ];





    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
