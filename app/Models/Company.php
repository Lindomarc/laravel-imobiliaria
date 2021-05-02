<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Company extends Model
    {
        use HasFactory;

        protected $fillable = [
            'sale',
            'rent',
            'user_id',
            'social_name',
            'alias_name',
            'document_company',
            'document_company_secondary',
            'zipcode',
            'street',
            'number',
            'complement',
            'neighborhood',
            'state',
            'city'
        ];

        public function owner()
        {
            return $this->hasOne(User::class,'id','user_id');
        }

        public function setDocumentCompanyAttribute($value)
        {
            $this->attributes['document_company'] = onlyNumber($value);
        }
        public function getDocumentCompanyAttribute($value)
        {
            return mask($value, '##.###.###/####-##');
        }

    }
