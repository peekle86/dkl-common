<?php

namespace DKL\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\ContactMessage
 *
 * @property int                             $id
 * @property int|null                        $user_id
 * @property string                          $name
 * @property string                          $email
 * @property string                          $phone
 * @property string                          $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ContactMessage newModelQuery()
 * @method static Builder|ContactMessage newQuery()
 * @method static Builder|ContactMessage query()
 * @method static Builder|ContactMessage whereCreatedAt($value)
 * @method static Builder|ContactMessage whereEmail($value)
 * @method static Builder|ContactMessage whereId($value)
 * @method static Builder|ContactMessage whereMessage($value)
 * @method static Builder|ContactMessage whereName($value)
 * @method static Builder|ContactMessage wherePhone($value)
 * @method static Builder|ContactMessage whereUpdatedAt($value)
 * @method static Builder|ContactMessage whereUserId($value)
 * @method static Builder|ContactMessage any()
 * @method static Builder|ContactMessage emailFilter($email = '')
 * @method static Builder|ContactMessage nameFilter($name = '')
 * @property-read mixed $admin_url
 * @property int $domain_id
 * @method static Builder|ContactMessage whereDomainId($value)
 */
class ContactMessage extends Model
{
    use HasFactory;

    public function scopeAny($query)
    {
        return $query;
    }

    public function scopeNameFilter($query, $name = '')
    {
        $name = $name == '' ? '%' : '%'.$name.'%';

        return $query
            ->where('name', 'like', $name);
    }

    public function scopeEmailFilter($query, $email = '')
    {
        $email = $email == '' ? '%' : '%'.$email.'%';

        return $query
            ->where('email', 'like', $email);
    }

    public static function filter($filter = [])
    {
        $pageItem = self::any();
        if (isset($filter['name'])) {
            $filterTerm = $filter['name'] ?? '';
            $pageItem = $pageItem->nameFilter($filterTerm);
        }
        if (isset($filter['email'])) {
            $filterTerm = $filter['email'] ?? '';
            $pageItem = $pageItem->emailFilter($filterTerm);
        }

        return $pageItem;
    }
}
