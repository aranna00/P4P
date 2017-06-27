<?php
    
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    class AlterAttributeGroupTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('attribute_groups', function (Blueprint $table) {
                $table->enum("type", ["checkbox", "radio", "slider", "range"])->after("description");
            });
        }
        
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('attribute_group', function (Blueprint $table) {
                $table->dropColumn("type");
            });
        }
    }
