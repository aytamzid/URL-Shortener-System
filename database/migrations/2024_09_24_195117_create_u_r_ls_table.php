<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('u_r_l_s', function (Blueprint $table) {
            $table->id();
            $table->text('long_url');
            $table->string('shorten_url')->unique();
            $table->foreignIdFor(User::class);
            $table->unsignedBigInteger('total_clicked')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('u_r_l_s');
    }
};
