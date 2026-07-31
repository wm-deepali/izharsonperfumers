<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('country_code', 6)->default('+91')->after('mobile_number');
            $table->timestamp('mobile_verified_at')->nullable()->after('country_code');
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['country_code', 'mobile_verified_at']);
        });
    }
};