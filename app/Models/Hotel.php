<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Hotel extends Model
{
    use HasFactory;

    const SORT = [
        'asc_title' => 'Name A-Z',
        'desc_title' => 'Name Z-A',
        'asc_price' => 'Price 0-9',
        'desc_price' => 'Price 9-0',
        'asc_length' => 'Length 0-9',
        'desc_length' => 'Length 9-0'
    ];

    public function hotelsCountry()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }


    public function deletePhoto()
    {
        $fileName = $this->photo;
        if (file_exists(public_path().$fileName)) {
            unlink(public_path().$fileName);
        }
        $this->photo = null;
        $this->save();
    }
}
