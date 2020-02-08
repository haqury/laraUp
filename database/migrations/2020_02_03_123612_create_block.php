<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'blocks',
            function (Blueprint $table) {
                $table->bigIncrements('id')->comment('ID');
                $table->string('name')->unique()->comment('уникальное название блока');
                $table->string('page')->comment('страница|ключ списка блоков');
                $table->text('blade')->comment('шаблон блока');
                $table->float('cache')->comment('включить кэширование');
                $table->float('ajax')->comment('выводить пост забпросом');
                $table->float('active')->comment('активность');
                $table->string('weight')->comment('вес блока');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocks');
    }
}
