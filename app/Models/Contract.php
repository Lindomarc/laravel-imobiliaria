<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Session;
use function Symfony\Component\Translation\t;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale',
        'rent',
        'owner_id',
        'owner_spouse',
        'owner_company_id',
        'acquirer_id',
        'acquirer_spouse',
        'acquirer_company_id',
        'property_id',
        'sale_price',
        'rent_price',
        'price',
        'tribute',
        'condominium',
        'due_date',
        'dateline',
        'start_at',
        'status'
    ];

    public function setSaleAttribute($value)
    {
         if (!!$value) {
            $this->attributes['sale'] = true;
            $this->attributes['rent'] = false;
         }
    }

    public function getSaleAttribute($value)
    {
        return $value;
    }

    public function setRentAttribute($value)
    {
         if (!!$value) {
            $this->attributes['sale'] = false;
            $this->attributes['rent'] = true;
         }
    }

    public function getRentAttribute($value)
    {
        return $value;
    }

    public function setOwnerSpouseAttribute($value)
    {
        $this->attributes['owner_spouse'] = !!$value;
    }

    public function setAcquirerSpouseAttribute($value)
    {
        $this->attributes['acquirer_spouse'] = !!$value;
    }

    public function setSalePriceAttribute($value)
    {
        $this->attributes['price'] = fixDouble($value);
    }

    public function getSalePriceAttribute($value)
    {
        return fixDouble($value,'br');
    }
    public function setRentPriceAttribute($value)
    {
        $this->attributes['price'] = fixDouble($value);
    }
    public function getRentPriceAttribute($value)
    {
        return fixDouble($value,'br');
    }
    public function setTributeAttribute($value)
    {
        $this->attributes['tribute'] = fixDouble($value);
    }
    public function getTributeAttribute($value)
    {
        return fixDouble($value,'br');
    }
    public function setCondominiumAttribute($value)
    {
        $this->attributes['condominium'] = fixDouble($value);
    }
    public function getCondominiumAttribute($value)
    {
        return fixDouble($value,'br');
    }
    public function setStartAtAttribute($value)
    {
        $this->attributes['start_at'] = fixStringDate($value);
    }
    public function getStartAtAttribute($value)
    {
        return fixStringDate($value,'br');
    }
}
