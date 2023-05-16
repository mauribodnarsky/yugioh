<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Validator;
class Card extends Model
{
    use HasFactory;
    protected $table='cards';
    protected $with = ['typeCard','subtypeCard'];

    protected $fillable = [
        'name',
        'code',
        'first_series',
        'atk',
        'def',
        'stars',
        'description',
        'price',
        'image',
        'id_type_card',
        'id_subtype_card',
     
    ];
    protected $rules = [
        'code'=>'string|nullable',
        'first_series'=>'boolean|nullable',
        'name' => 'string|required',
        'atk' => 'numeric|required',
        'def' => 'numeric|required',
        'stars' => 'numeric|required',
        'description' => 'string',
        'price' => 'numeric|required',
        'image' => 'string|nullable',
        'id_type_card' => 'required|exists:types_cards,id',
        'id_subtype_card' => 'required|exists:sub_types_cards,id',
    ];
    public function create($data)
    {
  
        $validator = Validator::make($data, $this->rules);

        if ($validator->fails()) {
            return $validator->errors();
        }
        $result=static::query()->create($data);

        return $result;
    }


    public function getOne($id)
    {
        return $this->find($id);
    }
 
    public function typeCard()
    {
        return $this->belongsTo(TypeCard::class,'id_type_card');
    }
    
    public function subtypeCard()
    {
        return $this->belongsTo(SubtypeCard::class,'id_subtype_card');
    }
}
