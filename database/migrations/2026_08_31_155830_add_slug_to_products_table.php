<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
        });


        $products = Product::all();

        foreach ($products as $product) {

            $name = $product->name;

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
                $slug = 'product-' . $product->id;
            }
            $originalSlug = $slug;
            $counter = 1;

            while (
            Product::where('slug', $slug)
                ->where('id', '!=', $product->id)
                ->exists()
            ) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $product->slug = $slug;
            $product->save();
        }

        Schema::table('products', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
