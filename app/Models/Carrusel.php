<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Carrusel
 *
 * @property $id
 * @property $Description
 * @property $Urlfoto
 * @property $link
 * @property $orden
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Carrusel extends Model
{
    
    static $rules = [
		'Description' => 'required',
		'Urlfoto' => 'required',
		'link' => 'required',
		'orden' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Description','Urlfoto','link','orden'];



}
