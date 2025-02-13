<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
         protected $table = 'alertSubtypes';

    protected $primaryKey = 'alertTypeName';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['alertTypeName', 'name', 'spanishName', 'valencianName'];

    public function type()
    {
        return $this->belongsTo(AlertType::class, 'alertTypeName', 'name');
    }
        */
        Schema::create('alertSubtypes', function (Blueprint $table) {
            $table->id();
            $table->string('alertTypeName');
            $table->foreign('alertTypeName')->references('name')->on('alertTypes');
            $table->string('name');
            $table->string('spanishName');
            $table->string('valencianName');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alertSubtypes');
    }
};
