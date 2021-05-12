<?php

namespace App\Models;

use \App\Support\Cropper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'genre',
        'document',
        'document_secondary',
        'document_secondary_complement',
        'date_of_birth',
        'place_of_birth',
        'civil_status',
        'cover',
        'occupation',
        'income',
        'company_work',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'state',
        'city',
        'telephone',
        'cell',
        'type_of_communion',
        'spouse_name',
        'spouse_genre',
        'spouse_document',
        'spouse_document_secondary',
        'spouse_document_secondary_complement',
        'spouse_date_of_birth',
        'spouse_place_of_birth',
        'spouse_occupation',
        'spouse_income',
        'spouse_company_work',
        'lessor',
        'lessee',
        'admin',
        'client'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    use Notifiable;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function companies()
    {
        return $this->hasMany(Company::class,'user_id','id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class,'user_id','id');
    }

    public function setLessorAttribute($value)
    {
        $this->attributes['lessor'] = ($value === true || $value === 'on' ) ? 1 : 0;
    }

    public function getUrlCoverAttribute($value)
    {
        if (!!$this->cover) {
            $url_cover = Storage::url(Cropper::thumb($this->cover,300,300));
        }else {
            $url_cover = url('backend/assets/images/avatar.jpg');
        }
        return  $url_cover;
    }

    public function scopeLessors($query)
    {
        return $query->where('lessor',true);
    }
    public function scopeLessees($query)
    {
        return $query->where('lessee',true);
    }

    public function setLesseeAttribute($value)
    {
        $this->attributes['lessee'] = ($value === true || $value === 'on' ) ? 1 : 0;
    }

    public function setDocumentAttribute($value)
    {
        $this->attributes['document'] = onlyNumber($value);
    }

    public function getDocumentAttribute($value)
    {
        return $this->attributes['document'] = mask(onlyNumber($value),'###.###.###-##');
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = fixStringDate($value);
    }

    public function getDateOfBirthAttribute($value)
    {
        return $this->attributes['date_of_birth'] = fixStringDate($value, 'br');
    }

    public function setIncomeAttribute($value)
    {
        $this->attributes['income'] = fixStringToDouble($value);
    }
    public function getIncomeAttribute($value)
    {
        return $this->attributes['income'] = fixStringToDouble($value, 'br');
    }

    public function setZipcodeAttribute($value)
    {
        $this->attributes['zipcode'] = onlyNumber($value);
    }

    public function setTelephoneAttribute($value)
    {
        $this->attributes['telephone'] = onlyNumber($value);
    }

    public function setCellAttribute($value)
    {
        $this->attributes['cell'] = onlyNumber($value);
    }

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = $value ? bcrypt($value) : null;
        }
    }


    public function setSpouseDocumentAttribute($value)
    {
        $this->attributes['spouse_document'] = onlyNumber($value);
    }

    public function getSpouseDocumentAttribute($value)
    {
        return $this->attributes['spouse_document'] = onlyNumber($value, 'br');
    }

    public function setSpouseDateOfBirthAttribute($value)
    {
        $this->attributes['spouse_date_of_birth'] = fixStringDate($value);
    }

    public function getSpouseDateOfBirthAttribute($value)
    {
        return $this->attributes['spouse_date_of_birth'] = fixStringDate($value,'br');
    }

    public function setSpouseIncomeAttribute($value)
    {
        $this->attributes['spouse_income'] = fixStringToDouble($value);
    }
    public function getSpouseIncomeAttribute($value)
    {
        return $this->attributes['spouse_income'] = fixStringToDouble($value,'br');
    }

    public function setAdminAttribute($value)
    {
        $this->attributes['admin'] = ($value === true || $value === 'on' ) ? 1 : 0;
    }

    public function setClientAttribute($value)
    {
        $this->attributes['client'] = ($value === true || $value === 'on' ) ? 1 : 0;
    }
}
