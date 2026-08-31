<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Category;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

        $categories = Category::all();

        foreach ($categories as $category) {

            $name = $category->name;

            if (is_array($name)) {
                $nameEn = trim($name['en'] ?? '');
                $nameAr = trim($name['ar'] ?? '');
            } else {
                $nameEn = trim($name);
                $nameAr = trim($name);
            }

            $slug = Str::slug($nameEn);

            if (empty($slug)) {
                $slug = Str::slug($nameAr);
            }

            if (empty($slug)) {
                $slug = 'category-' . $category->id;
            }

            $originalSlug = $slug;
            $counter = 1;

            while (
            Category::where('slug', $slug)
                ->where('id', '!=', $category->id)
                ->exists()
            ) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $category->slug = $slug;
            $category->save();
        }

        Schema::table('categories', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
