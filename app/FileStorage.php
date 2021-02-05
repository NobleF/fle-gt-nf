<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileStorage extends Model
{
    protected $fillable = [
        'name',
        'file_path',
        'uuid',
    ];
    /**
     * @var mixed
     */
    private $user_id;
    /**
     * @var mixed|string
     */
    private $file_path;
    /**
     * @var mixed|string
     */
    private $name;
}
