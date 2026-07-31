<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('otp_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('identifier', 20); // mobile number, no country code
            $table->string('otp_code', 10);
            $table->enum('purpose', ['register', 'login']);
            $table->unsignedTinyInteger('attempts')->default(0);
            $table->timestamp('expires_at');
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->index(['identifier', 'purpose']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('otp_verifications');
    }
};