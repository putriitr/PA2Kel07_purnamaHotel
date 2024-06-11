<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('admin_id');  // Tambahkan admin_id
            $table->unsignedBigInteger('created_by');  // Tambahkan created_by
            $table->unsignedBigInteger('updated_by');  // Tambahkan updated_by
            $table->string('image', 300);
            $table->timestamps();

            // Definisi foreign key
            $table->foreign('category_id')->references('id')->on('announcementcategories')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');  // Asumsi tabel admins
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('cascade');  // Asumsi tabel admins
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('cascade');  // Asumsi tabel users
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements');
    }
};
