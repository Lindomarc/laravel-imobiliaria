<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function ownerCompany()
    {
        return $this->hasOne(Company::class, 'id', 'owner_company_id');
    }

    public function acquirer()
    {
        return $this->hasOne(User::class, 'id', 'acquirer_id');
    }

    public function acquirerCompany()
    {
        return $this->hasOne(Company::class, 'id', 'acquirer_company_id');
    }

    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'property_id');
    }

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
        return fixDouble($value, 'br');
    }

    public function setStartAtAttribute($value)
    {
        $this->attributes['start_at'] = fixStringDate($value);
    }

    public function getStartAtAttribute($value)
    {
        return fixStringDate($value, 'br');
    }

    public function getTermsAttribute()
    {
        // Finalidade [Venda/Locação]
        if ($this->sale) {
            $parameters = [
                'purpouse' => 'VENDA',
                'part' => 'VENDEDOR',
                'part_opposite' => 'COMPRADOR',
            ];
        } else {
            $parameters = [
                'purpouse' => 'LOCAÇÃO',
                'part' => 'LOCADOR',
                'part_opposite' => 'LOCATÁRIO',
            ];
        }
        //$parameters = [];
        $parameters['purpose'] = !!$this->sale ? 'VENDA' : 'LOCAÇÃO';
        $parameters['part'] = !!$this->sale ? 'VENDEDOR' : 'LOCADOR';
        // owner
        $terms = ["<p style='text-align: center'>{$this->id} - CONTRATO DE {$parameters['purpose']} DE IMÓVEL</p>"];


        // OWNER
        if (!!$this->owner_company_id) { // Se tem empresa

            if (!empty($this->owner_spouse)) { // E tem conjuge
                $terms[] = "<p><b>1. {$parameters['part']}: {$this->ownerCompany->social_name}</b>, inscrito sob C. N. P. J. nº {$this->ownerCompany->document_company} e I. E. nº {$this->ownerCompany->document_company_secondary} exercendo suas atividades no endereço {$this->ownerCompany->street}, nº {$this->ownerCompany->number}, {$this->ownerCompany->complement}, {$this->ownerCompany->neighborhood}, {$this->ownerCompany->city}/{$this->ownerCompany->state}, CEP {$this->ownerCompany->zipcode} tendo como responsável legal {$this->owner->name}, natural de {$this->owner->place_of_birth}, {$this->owner->civil_status}, {$this->owner->occupation}, portador da cédula de identidade R. G. nº {$this->owner->document_secondary} {$this->owner->document_secondary_complement}, e inscrição no C. P. F. nº {$this->owner->document}, e cônjuge {$this->owner->spouse_name}, natural de {$this->owner->spouse_place_of_birth}, {$this->owner->spouse_occupation}, portador da cédula de identidade R. G. nº {$this->owner->spouse_document_secondary} {$this->owner->spouse_document_secondary_complement}, e inscrição no C. P. F. nº {$this->owner->spouse_document}, residentes e domiciliados à {$this->owner->street}, nº {$this->owner->number}, {$this->owner->complement}, {$this->owner->neighborhood}, {$this->owner->city}/{$this->owner->state}, CEP {$this->owner->zipcode}.</p>";
            } else { // E não tem conjuge
                $terms[] = "<p><b>1. {$parameters['part']}: {$this->ownerCompany->social_name}</b>, inscrito sob C. N. P. J. nº {$this->ownerCompany->document_company} e I. E. nº {$this->ownerCompany->document_company_secondary} exercendo suas atividades no endereço {$this->ownerCompany->street}, nº {$this->ownerCompany->number}, {$this->ownerCompany->complement}, {$this->ownerCompany->neighborhood}, {$this->ownerCompany->city}/{$this->ownerCompany->state}, CEP {$this->ownerCompany->zipcode} tendo como responsável legal {$this->owner->name}, natural de {$this->owner->place_of_birth}, {$this->owner->civil_status}, {$this->owner->occupation}, portador da cédula de identidade R. G. nº {$this->owner->document_secondary} {$this->owner->document_secondary_complement}, e inscrição no C. P. F. nº {$this->owner->document}, residente e domiciliado à {$this->owner->street}, nº {$this->owner->number}, {$this->owner->complement}, {$this->owner->neighborhood}, {$this->owner->city}/{$this->owner->state}, CEP {$this->owner->zipcode}.</p>";
            }
        } else { // Se não tem empresa

            if (!empty($this->owner_spouse)) { // E tem conjuge
                $terms[] = "<p><b>1. {$parameters['part']}: {$this->owner->name}</b>, natural de {$this->owner->place_of_birth}, {$this->owner->civil_status}, {$this->owner->occupation}, portador da cédula de identidade R. G. nº {$this->owner->document_secondary} {$this->owner->document_secondary_complement}, e inscrição no C. P. F. nº {$this->owner->document}, e cônjuge {$this->owner->spouse_name}, natural de {$this->owner->spouse_place_of_birth}, {$this->owner->spouse_occupation}, portador da cédula de identidade R. G. nº {$this->owner->spouse_document_secondary} {$this->owner->spouse_document_secondary_complement}, e inscrição no C. P. F. nº {$this->owner->spouse_document}, residentes e domiciliados à {$this->owner->street}, nº {$this->owner->number}, {$this->owner->complement}, {$this->owner->neighborhood}, {$this->owner->city}/{$this->owner->state}, CEP {$this->owner->zipcode}.</p>";
            } else { // E não tem conjuge
                $terms[] = "<p><b>1. {$parameters['part']}: {$this->owner->name}</b>, natural de {$this->owner->place_of_birth}, {$this->owner->civil_status}, {$this->owner->occupation}, portador da cédula de identidade R. G. nº {$this->owner->document_secondary} {$this->owner->document_secondary_complement}, e inscrição no C. P. F. nº {$this->owner->document}, residente e domiciliado à {$this->owner->street}, nº {$this->owner->number}, {$this->owner->complement}, {$this->owner->neighborhood}, {$this->owner->city}/{$this->owner->state}, CEP {$this->owner->zipcode}.</p>";
            }
        }

        // ACQUIRER
        // Se tem empresa
        if (!!$this->acquirer_company_id) { // Se tem empresa

            if (!empty($this->acquirer_spouse)) { // E tem conjuge
                $terms[] = "<p><b>2. {$parameters['part_opposite']}: {$this->acquirerCompany->social_name}</b>, inscrito sob C. N. P. J. nº {$this->acquirerCompany->document_company} e I. E. nº {$this->acquirerCompany->document_company_secondary} exercendo suas atividades no endereço {$this->acquirerCompany->street}, nº {$this->acquirerCompany->number}, {$this->acquirerCompany->complement}, {$this->acquirerCompany->neighborhood}, {$this->acquirerCompany->city}/{$this->acquirerCompany->state}, CEP {$this->acquirerCompany->zipcode} tendo como responsável legal {$this->acquirer->name}, natural de {$this->acquirer->place_of_birth}, {$this->acquirer->civil_status}, {$this->acquirer->occupation}, portador da cédula de identidade R. G. nº {$this->acquirer->document_secondary} {$this->acquirer->document_secondary_complement}, e inscrição no C. P. F. nº {$this->acquirer->document}, e cônjuge {$this->acquirer->spouse_name}, natural de {$this->acquirer->spouse_place_of_birth}, {$this->acquirer->spouse_occupation}, portador da cédula de identidade R. G. nº {$this->acquirer->spouse_document_secondary} {$this->acquirer->spouse_document_secondary_complement}, e inscrição no C. P. F. nº {$this->acquirer->spouse_document}, residentes e domiciliados à {$this->acquirer->street}, nº {$this->acquirer->number}, {$this->acquirer->complement}, {$this->acquirer->neighborhood}, {$this->acquirer->city}/{$this->acquirer->state}, CEP {$this->acquirer->zipcode}.</p>";
            } else { // E não tem conjuge
                $terms[] = "<p><b>2. {$parameters['part_opposite']}: {$this->acquirerCompany->social_name}</b>, inscrito sob C. N. P. J. nº {$this->acquirerCompany->document_company} e I. E. nº {$this->acquirerCompany->document_company_secondary} exercendo suas atividades no endereço {$this->acquirerCompany->street}, nº {$this->acquirerCompany->number}, {$this->acquirerCompany->complement}, {$this->acquirerCompany->neighborhood}, {$this->acquirerCompany->city}/{$this->acquirerCompany->state}, CEP {$this->acquirerCompany->zipcode} tendo como responsável legal {$this->acquirer->name}, natural de {$this->acquirer->place_of_birth}, {$this->acquirer->civil_status}, {$this->acquirer->occupation}, portador da cédula de identidade R. G. nº {$this->acquirer->document_secondary} {$this->acquirer->document_secondary_complement}, e inscrição no C. P. F. nº {$this->acquirer->document}, residente e domiciliado à {$this->acquirer->street}, nº {$this->acquirer->number}, {$this->acquirer->complement}, {$this->acquirer->neighborhood}, {$this->acquirer->city}/{$this->acquirer->state}, CEP {$this->acquirer->zipcode}.</p>";
            }
        } else { // Se não tem empresa

            if (!empty($this->acquirer_spouse)) { // E tem conjuge
                $terms[] = "<p><b>2. {$parameters['part_opposite']}: {$this->acquirer->name}</b>, natural de {$this->acquirer->place_of_birth}, {$this->acquirer->civil_status}, {$this->acquirer->occupation}, portador da cédula de identidade R. G. nº {$this->acquirer->document_secondary} {$this->acquirer->document_secondary_complement}, e inscrição no C. P. F. nº {$this->acquirer->document}, e cônjuge {$this->acquirer->spouse_name}, natural de {$this->acquirer->spouse_place_of_birth}, {$this->acquirer->spouse_occupation}, portador da cédula de identidade R. G. nº {$this->acquirer->spouse_document_secondary} {$this->acquirer->spouse_document_secondary_complement}, e inscrição no C. P. F. nº {$this->acquirer->spouse_document}, residentes e domiciliados à {$this->acquirer->street}, nº {$this->acquirer->number}, {$this->acquirer->complement}, {$this->acquirer->neighborhood}, {$this->acquirer->city}/{$this->acquirer->state}, CEP {$this->acquirer->zipcode}.</p>";
            } else { // E não tem conjuge
                $terms[] = "<p><b>2. {$parameters['part_opposite']}: {$this->acquirer->name}</b>, natural de {$this->acquirer->place_of_birth}, {$this->acquirer->civil_status}, {$this->acquirer->occupation}, portador da cédula de identidade R. G. nº {$this->acquirer->document_secondary} {$this->acquirer->document_secondary_complement}, e inscrição no C. P. F. nº {$this->acquirer->document}, residente e domiciliado à {$this->acquirer->street}, nº {$this->acquirer->number}, {$this->acquirer->complement}, {$this->acquirer->neighborhood}, {$this->acquirer->city}/{$this->acquirer->state}, CEP {$this->acquirer->zipcode}.</p>";
            }
        }


        $terms[] = "<p style='font-style: italic; font-size: 0.875em;'>A falsidade dessa declaração configura crime previsto no Código Penal Brasileiro, e passível de apuração na forma da Lei.</p>";

        $terms[] = "<p><b>5. IMÓVEL:</b> {$this->property->category}, {$this->property->type}, localizada no endereço {$this->property->street}, nº {$this->property->number}, {$this->property->complement}, {$this->property->neighborhood}, {$this->property->city}/{$this->property->state}, CEP {$this->property->zipcode}</p>";

        $terms[] = "<p><b>6. PERÍODO:</b> {$this->deadline} meses</p>";

        $terms[] = "<p><b>7. VIGÊNCIA:</b> O presente contrato tem como data de início {$this->start_at} e o término exatamente após a quantidade de meses descrito no item 6 deste.</p>";

        $terms[] = "<p><b>8. VENCIMENTO:</b> Fica estipulado o vencimento no dia {$this->due_date} do mês posterior ao do início de vigência do presente contrato.</p>";

        $terms[] = "<p>Florianópolis, " . date('d/m/Y') . ".</p>";

        $terms[] = "<table width='100%' style='margin-top: 50px;'>
                           <tr>
                                <td>_________________________</td>
                                " . ($this->owner_spouse ? "<td>_________________________</td>" : "") . "
                           </tr>
                           <tr>
                                <td>{$parameters['part']}: {$this->owner->name}</td>
                                " . ($this->owner_spouse ? "<td>Conjuge: {$this->owner->spouse_name}</td>" : "") . "
                           </tr>
                           <tr>
                                <td>Documento: {$this->owner->document}</td>
                                " . ($this->owner_spouse ? "<td>Documento: {$this->owner->spouse_document}</td>" : "") . "
                           </tr>

                    </table>";


        $terms[] = "<table width='100%' style='margin-top: 50px;'>
                           <tr>
                                <td>_________________________</td>
                                " . ($this->acquirer_spouse ? "<td>_________________________</td>" : "") . "
                           </tr>
                           <tr>
                                <td>{$parameters['part_opposite']}: {$this->acquirer->name}</td>
                                " . ($this->acquirer_spouse ? "<td>Conjuge: {$this->acquirer->spouse_name}</td>" : "") . "
                           </tr>
                           <tr>
                                <td>Documento: {$this->acquirer->document}</td>
                                " . ($this->acquirer_spouse ? "<td>Documento: {$this->acquirer->spouse_document}</td>" : "") . "
                           </tr>

                    </table>";

        $terms[] = "<table width='100%' style='margin-top: 50px; border: none;'>
                           <tr>
                                <td>_________________________</td>
                                <td>_________________________</td>
                           </tr>
                           <tr>
                                <td>1ª Testemunha: </td>
                                <td>2ª Testemunha: </td>
                           </tr>
                           <tr>
                                <td>Documento: </td>
                                <td>Documento: </td>
                           </tr>

                    </table>";
        return implode('', $terms);
    }
}
