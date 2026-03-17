<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSolicitanteAndMakeBeneficiarioNullableOnAracaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aracaos', function (Blueprint $table) {
            $table->string('solicitante')->nullable()->after('beneficiario_id');
            $table->unsignedBigInteger('beneficiario_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aracaos', function (Blueprint $table) {
            $table->dropColumn('solicitante');
            $table->unsignedBigInteger('beneficiario_id')->nullable(false)->change();
        });
    }
}
