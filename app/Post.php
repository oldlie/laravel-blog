<?php

namespace App;

use App\Services\Markdowner;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $dates = ['published_at'];

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tag_pivot');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        //$this->setUniqueSlug($value, '');
    }

    /**
     * Recursive routine to set a unique slug
     *
     * @param string $title
     * @param mixed $extra
    protected function setSlug($title, $extra)
    {
        //$slug = str_slug($title.'-'.$extra);
        //$slug = replaceall

        if (static::whereSlug($slug)->exists()) {
            $this->setSlug($title, $extra + 1);
            return;
        }

        $this->attributes['slug'] = $slug;
    }
     * */

    /**
     * Set the HTML content automatically when the raw content is set
     *
     * @param string $value
     */
    public function setContentRawAttribute($value)
    {
        $markdown = new Markdowner();

        $this->attributes['content_raw'] = $value;
        $this->attributes['content_html'] = $markdown->toHTML($value);
    }

    /**
     * Sync tag relation adding new tags as needed
     *
     * @param array $tags
     */
    public function syncTags(array $tags)
    {
        Tag::addNeededTags($tags);

        if (count($tags)) {
            $this->tags()->sync(
                Tag::whereIn('tag', $tags)->lists('id')->all()
            );
            return;
        }

        $this->tags()->detach();
    }
}
