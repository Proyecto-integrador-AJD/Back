<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTypeCall extends Model
{
    use HasFactory;

    protected $table = 'subtypecall';

    protected $fillable = [
        'name',
        'spanishName',
        'valencianName',
        'typecall_id',
    ];

    public function typecall()
    {
        return $this->belongsTo(TypeCall::class, 'typecall_id');
    }
}
?>