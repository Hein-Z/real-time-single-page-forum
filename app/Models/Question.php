<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'body', 'category_id', 'user_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select(array('id', 'name'));
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->select(array('id', 'name'));
    }

    public function getPathAttribute()
    {
        return 'api/question/' . $this->slug;
    }
    public static function boot()
    {
        parent::boot();
        $question = new Question();
        static::creating(function ($question) {
            $question->slug = $question->generateSlug($question->title);
        });
    }

    /**
     * Set the Slug attribute and add counter if not unique.
     * This function will check if the current model's slug is unique and update
     * if with a counter at the end of the slug (such as -2) if there already exists.
     * For example, if we're saving a page called "About us" with the slug
     * "about-us", but for some reason you already have a page with the slug
     * "about-us" this new page would then be set to have the slug
     * "about-us-2" instead.
     *
     * @param any $value This is the value passed to this setting function.
     *
     * @return void
     */
    public function generateSlug($value)
    {
        $slug = Str::slug($value);
        $model = get_class($this);
        $attribute = 'slug';
        $default = 'full_name'; // which attribute from the model to pull if no slug set

        $empty = $model::all()->where($attribute, $slug)->except($this->id)->isEmpty();

        if ($slug == null || empty($slug)) {
            $slug = Str::slug($this->$default);
        }
        if (!$empty) {
            $current = explode('-', $slug);
            $countStart = 1;
            if (is_numeric(end($current))) {
                $countStart = end($current);
                $slug = implode("-", array_splice($current, 0, -1));
            }
            $tempSlug = $slug . '-' . $countStart;
            for ($i = $countStart; !$model::all()->where($attribute, $tempSlug)->except($this->id)->isEmpty(); $i++) {
                $tempSlug = $slug . '-' . $i;
            }
            $slug = $tempSlug;
        }


        return $slug;
    }
}
