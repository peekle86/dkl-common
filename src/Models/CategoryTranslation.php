<?php

namespace DKL\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use GeneaLabs\LaravelModelCaching\CachedBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\CategoryTranslation
 *
 * @property-read mixed         $admin_url
 * @property-read Language|null $language
 * @property-read Category      $page
 * @method static Builder|CategoryTranslation any()
 * @method static Builder|CategoryTranslation newModelQuery()
 * @method static Builder|CategoryTranslation newQuery()
 * @method static Builder|CategoryTranslation query()
 * @method static Builder|CategoryTranslation title($title = '', $languageId = null)
 * @property int $id
 * @property int $category_id
 * @property int $language_id
 * @property string $slug
 * @property string        $title
 * @property Carbon|null   $created_at
 * @property Carbon|null   $updated_at
 * @method static Builder|CategoryTranslation whereCategoryId($value)
 * @method static Builder|CategoryTranslation whereCreatedAt($value)
 * @method static Builder|CategoryTranslation whereId($value)
 * @method static Builder|CategoryTranslation whereLanguageId($value)
 * @method static Builder|CategoryTranslation whereSlug($value)
 * @method static Builder|CategoryTranslation whereTitle($value)
 * @method static Builder|CategoryTranslation whereUpdatedAt($value)
 * @property-read Category $category
 * @property-read mixed    $url
 *
 */
class CategoryTranslation extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function language(): HasOne
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }

    public function scopeAny($query)
    {
        return $query;
    }

    public function scopeTitle($query, $title = '', $languageId = null)
    {
        $title = $title == '' ? '%' : '%'.$title.'%';

        return $query
            ->where('title', 'like', $title);
    }


    public static function filter($filter = [], $languageId = null)
    {
        $pageItem = self::any()->where('language_id', $languageId);
        if (isset($filter['title'])) {
            $title = $filter['title'] ?? '';
            $pageItem = $pageItem->title($title, $languageId);
        }

        return $pageItem;
    }
}
