<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
    
    class AddTimeToExercisesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('exercises', function (Blueprint $table) {
                $table->time('time')->nullable()->after('kind'); // Adiciona a coluna 'time'
            });
        }
    
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('exercises', function (Blueprint $table) {
                $table->dropColumn('time'); // Remove a coluna 'time' se a migration for revertida
            });
        }
    }
    























