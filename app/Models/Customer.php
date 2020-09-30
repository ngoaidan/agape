<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use QCod\ImageUp\HasImageUploads;

class Customer extends Authenticatable
{
    use Notifiable, HasApiTokens;
    use HasImageUploads;

    protected $fillable = [
        'name', 'enterprise_id', 'identity_number', 'password', 'uid', 'sex', 'birth', 'matp'
    ];

//    protected $guarded = ['phone_number'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'uid'
    ];

    // all the images fields for model
    protected static $imageFields = [
        'avatar' => [
            // width to resize image after upload
            'width' => 300,
            // height to resize image after upload
            'height' => 300,
            // set true to crop image with the given width/height and you can also pass arr [x,y] coordinate for crop.
            'crop' => true,
            // what disk you want to upload, default config('imageup.upload_disk')
            'disk' => 'public',
            // a folder path on the above disk, default config('imageup.upload_directory')
            'path' => 'avatars',
            // placeholder image if image field is empty
            'placeholder' => '/users/default.png',
            // validation rules when uploading image
            'rules' => 'image|max:10000'
        ]
    ];

    function enterprise(){
        return $this->belongsTo(Enterprise::class);
    }

    function orders(){
        return $this->hasMany(Order::class);
    }

    function loans(){
        return $this->hasMany(Loan::class);
    }

    function province(){
        return $this->belongsTo(Province::class, 'matp');
    }

}
