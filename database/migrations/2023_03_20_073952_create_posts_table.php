<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('users');
            $table->string('title');
            $table->string('slug');
            $table->longText('body');
            $table->dateTime('published_at');
            $table->timestamps();
        });

        if (config('database.default') === 'mysql') {
            DB::statement('CREATE FULLTEXT INDEX posts_fulltext_index ON posts(title, body) WITH PARSER ngram');
        }

        if (config('database.default') === 'sqlite') {
            throw new \Exception('This lesson does not support SQLite.');
        }

        if (config('database.default') === 'pgsql') {
            DB::statement('ALTER TABLE posts ADD COLUMN searchable TSVECTOR');
            DB::statement('CREATE INDEX posts_searchable_gin ON posts USING GIN(searchable)');
            DB::statement("CREATE TRIGGER posts_searchable_update BEFORE INSERT OR UPDATE ON posts FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('searchable', 'pg_catalog.english', 'title', 'body')");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
