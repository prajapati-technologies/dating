<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('profiles', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('user_id')->unique();

        // Basic Profile
        $table->string('gender')->nullable();
        $table->integer('age')->nullable();
        $table->string('city')->nullable();
        $table->text('bio')->nullable();
        $table->string('profile_photo')->nullable();

        // Advanced Profile Fields (Filter Type 1 + 2)
        $table->string('relationship_status')->nullable();   // Single, Married, etc.
        $table->string('looking_for')->nullable();           // Friendship, Dating, Marriage
        $table->string('sexual_orientation')->nullable();    // Straight, Gay, Lesbian, Bi
        $table->string('height')->nullable();                // 5'10 / 178 cm
        $table->string('weight')->nullable();                // 60kg etc.

        // Interests / Lifestyle
        $table->text('interests')->nullable();               // Sports, Travel, Food…
        $table->string('drink')->nullable();                 // Yes/No/Socially
        $table->string('smoke')->nullable();                 // Yes/No/Sometimes
        $table->string('education')->nullable();             // College, School, Masters
        $table->string('profession')->nullable();            // Job Role

        // Religion / Caste / Culture
        $table->string('religion')->nullable();
        $table->string('caste')->nullable();

        // Personal Preferences
        $table->string('marital_status')->nullable();
        $table->string('children')->nullable();              // No / Yes / Want in future

        // Filters
        $table->integer('min_age_pref')->nullable();
        $table->integer('max_age_pref')->nullable();
        $table->string('preferred_city')->nullable();
        $table->string('preferred_gender')->nullable();

        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
