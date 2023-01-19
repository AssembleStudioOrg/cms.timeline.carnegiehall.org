<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTables extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('authors', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->softDeletes();
      $table->timestamps();
      $table->boolean('published')->default(false);
      $table->string('first_name', 200)->nullable();
      $table->string('last_name', 200)->nullable();
      $table->mediumText('short_bio')->nullable();
      $table->mediumText('bio')->nullable();
      $table->string('external_link', 200)->nullable();
      $table->unsignedInteger('position');
    });

    Schema::create('featured_stories', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->unsignedInteger('position');
      $table->unsignedBigInteger('site_setting_id')->index('featured_stories_site_setting_id_foreign');
      $table->unsignedInteger('story_id');

      $table->index(['story_id', 'site_setting_id'], 'idx_site_setting_id_story_id_wlaR1');
    });

    Schema::create('genre_author', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->unsignedBigInteger('author_id')->index('genre_author_author_id_foreign');
      $table->unsignedInteger('genre_id')->index('genre_author_genre_id_foreign');
      $table->unsignedInteger('position');
    });

    Schema::create('genre_cross_genre', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->unsignedInteger('position');
      $table->unsignedInteger('genre_id')->index('genre_cross_genre_genre_id_foreign');
      $table->unsignedInteger('cross_influence_id');

      $table->index(['cross_influence_id', 'genre_id'], 'idx_genres_cross_genres_CnfLE');
    });

    Schema::create('genre_cross_influenced', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->unsignedInteger('position');
      $table->unsignedInteger('genre_id')->index('genre_cross_influenced_genre_id_foreign');
      $table->unsignedInteger('cross_influenced_id');

      $table->index(['cross_influenced_id', 'genre_id'], 'idx_genres_cross_unfluenced_Mm4DQ');
    });

    Schema::create('genre_genre', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->unsignedInteger('position');
      $table->unsignedInteger('genre_id')->index('genre_genre_genre_id_foreign');
      $table->unsignedInteger('influence_id');

      $table->index(['influence_id', 'genre_id'], 'idx_genres_genres_EqxDy');
    });

    Schema::create('genre_influenced', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->unsignedInteger('position');
      $table->unsignedInteger('genre_id')->index('genre_influenced_genre_id_foreign');
      $table->unsignedInteger('influenced_id');

      $table->index(['influenced_id', 'genre_id'], 'idx_genres_unfluenced_Hvbh7');
    });

    Schema::create('genre_instrument', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->unsignedInteger('position');
      $table->unsignedInteger('genre_id')->index('genre_instrument_genre_id_foreign');
      $table->unsignedInteger('instrument_id');

      $table->index(['instrument_id', 'genre_id'], 'idx_genre_instrument_Mx3P0');
    });

    Schema::create('genre_musical_feature', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->unsignedInteger('position');
      $table->unsignedInteger('genre_id')->index('genre_musical_feature_genre_id_foreign');
      $table->unsignedInteger('musical_feature_id');

      $table->index(['musical_feature_id', 'genre_id'], 'idx_genre_musical_feature_839HL');
    });

    Schema::create('genre_notable_performer', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->unsignedInteger('position');
      $table->unsignedInteger('genre_id')->index('genre_notable_performer_genre_id_foreign');
      $table->unsignedInteger('notable_performer_id');

      $table->index(['notable_performer_id', 'genre_id'], 'idx_genre_notable_performer_P9iVp');
    });

    Schema::create('genre_slugs', function (Blueprint $table) {
      $table->increments('id');
      $table->softDeletes();
      $table->timestamps();
      $table->string('slug');
      $table->string('locale', 7)->index();
      $table->boolean('active');
      $table->unsignedInteger('genre_id')->index('fk_genre_slugs_genre_id');
    });

    Schema::create('genre_song', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->unsignedInteger('position');
      $table->unsignedInteger('genre_id')->index('genre_song_genre_id_foreign');
      $table->unsignedInteger('song_id');

      $table->index(['song_id', 'genre_id'], 'idx_genre_song_mgY3K');
    });

    Schema::create('genre_story', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->unsignedInteger('position');
      $table->unsignedInteger('genre_id')->index('genre_story_genre_id_foreign');
      $table->unsignedInteger('story_id');

      $table->index(['story_id', 'genre_id'], 'idx_genre_story_LPtX7');
    });

    Schema::create('genre_theme', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->unsignedInteger('position');
      $table->unsignedInteger('genre_id')->index('genre_theme_genre_id_foreign');
      $table->unsignedInteger('theme_id');

      $table->index(['theme_id', 'genre_id'], 'idx_genre_theme_7O58h');
    });

    Schema::create('genres', function (Blueprint $table) {
      $table->increments('id');
      $table->softDeletes();
      $table->timestamps();
      $table->boolean('published')->default(false);
      $table->string('name', 200)->nullable();
      $table->string('tradition', 200)->nullable();
      $table->integer('year_start')->nullable();
      $table->integer('year_finish')->nullable();
      $table->string('display_date')->nullable();
      $table->string('seo_title')->nullable();
      $table->string('seo_description')->nullable();
      $table->string('hero_credit')->nullable();
      $table->string('hero_caption')->nullable();
      $table->string('hero_credit_link')->nullable();
      $table->unsignedInteger('song_id')->nullable()->index('genres_song_id_foreign');
      $table->string('citation', 200)->nullable();
      $table->unsignedBigInteger('author_id')->nullable()->index('genres_author_id_foreign');
    });

    Schema::create('global_footers', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->softDeletes();
      $table->timestamps();
      $table->boolean('published')->default(false);
      $table->string('title', 200)->nullable();
      $table->text('description')->nullable();
      $table->mediumText('blurb')->nullable();
      $table->mediumText('footnote')->nullable();
      $table->string('legal_name', 200)->nullable();
    });

    Schema::create('instruments', function (Blueprint $table) {
      $table->increments('id');
      $table->softDeletes();
      $table->timestamps();
      $table->boolean('published')->default(false);
      $table->string('title', 200)->nullable();
    });

    Schema::create('musical_features', function (Blueprint $table) {
      $table->increments('id');
      $table->softDeletes();
      $table->timestamps();
      $table->boolean('published')->default(false);
      $table->string('title', 200)->nullable();
    });

    Schema::create('notable_performers', function (Blueprint $table) {
      $table->increments('id');
      $table->softDeletes();
      $table->timestamps();
      $table->boolean('published')->default(false);
      $table->string('name', 200)->nullable();
      $table->string('attribution')->nullable();
      $table->string('hero_image_attribution')->nullable();
    });

    Schema::create('site_settings', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->softDeletes();
      $table->timestamps();
      $table->boolean('published')->default(false);
      $table->string('title', 200)->nullable();
      $table->string('site_name', 100)->nullable();
      $table->string('site_title', 100)->nullable();
      $table->string('seo_stories_title', 100)->nullable();
      $table->string('seo_stories_description', 200)->nullable();
      $table->string('seo_genres_title', 100)->nullable();
      $table->string('seo_genres_description', 200)->nullable();
      $table->unsignedInteger('song_id')->nullable()->index('site_settings_song_id_foreign');
      $table->mediumText('stories_index_heading')->nullable();
      $table->text('404_heading')->nullable();
      $table->text('404_cta_message')->nullable();
      $table->text('404_cta_relative_link')->nullable();
      $table->string('seo_timeline_title', 100)->nullable();
      $table->string('seo_timeline_description', 200)->nullable();
    });

    Schema::create('songs', function (Blueprint $table) {
      $table->increments('id');
      $table->softDeletes();
      $table->timestamps();
      $table->boolean('published')->default(false);
      $table->string('title')->nullable();
      $table->string('mp4_sound')->nullable();
      $table->string('mp4_video')->nullable();
      $table->unsignedInteger('notable_performer_id')->nullable()->index('songs_notable_performer_id_foreign');
      $table->string('apple_music_song_id')->nullable();
    });

    Schema::create('stories', function (Blueprint $table) {
      $table->increments('id');
      $table->softDeletes();
      $table->timestamps();
      $table->boolean('published')->default(false);
      $table->string('title')->nullable();
      $table->integer('year_start')->nullable();
      $table->integer('year_finish')->nullable();
      $table->string('seo_title')->nullable();
      $table->string('seo_description')->nullable();
      $table->unsignedInteger('position')->nullable();
      $table->unsignedInteger('song_id')->nullable()->index('stories_song_id_foreign');
      $table->unsignedInteger('author_id')->nullable();
      $table->string('color', 80)->nullable();
      $table->string('citation', 200)->nullable();
      $table->string('hero_image_attribution')->nullable();
    });

    Schema::create('story_author', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->unsignedBigInteger('author_id')->index('story_author_author_id_foreign');
      $table->unsignedInteger('story_id')->index('story_author_story_id_foreign');
      $table->unsignedInteger('position');
    });

    Schema::create('story_slugs', function (Blueprint $table) {
      $table->increments('id');
      $table->softDeletes();
      $table->timestamps();
      $table->string('slug');
      $table->string('locale', 7)->index();
      $table->boolean('active');
      $table->unsignedInteger('story_id')->index('fk_story_slugs_story_id');
    });

    Schema::create('themes', function (Blueprint $table) {
      $table->increments('id');
      $table->softDeletes();
      $table->timestamps();
      $table->boolean('published')->default(false);
      $table->string('title', 200)->nullable();
    });

    Schema::table('featured_stories', function (Blueprint $table) {
      $table->foreign(['site_setting_id'])->references(['id'])->on('site_settings')->onUpdate('NO ACTION')->onDelete('CASCADE');
      $table->foreign(['story_id'])->references(['id'])->on('stories')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });

    Schema::table('genre_author', function (Blueprint $table) {
      $table->foreign(['author_id'])->references(['id'])->on('authors')->onUpdate('NO ACTION')->onDelete('CASCADE');
      $table->foreign(['genre_id'])->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });

    Schema::table('genre_cross_genre', function (Blueprint $table) {
      $table->foreign(['cross_influence_id'])->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
      $table->foreign(['genre_id'])->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });

    Schema::table('genre_cross_influenced', function (Blueprint $table) {
      $table->foreign(['cross_influenced_id'])->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
      $table->foreign(['genre_id'])->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });

    Schema::table('genre_genre', function (Blueprint $table) {
      $table->foreign(['genre_id'])->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
      $table->foreign(['influence_id'])->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });

    Schema::table('genre_influenced', function (Blueprint $table) {
      $table->foreign(['genre_id'])->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
      $table->foreign(['influenced_id'])->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });

    Schema::table('genre_instrument', function (Blueprint $table) {
      $table->foreign(['genre_id'])->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
      $table->foreign(['instrument_id'])->references(['id'])->on('instruments')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });

    Schema::table('genre_musical_feature', function (Blueprint $table) {
      $table->foreign(['genre_id'])->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
      $table->foreign(['musical_feature_id'])->references(['id'])->on('musical_features')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });

    Schema::table('genre_notable_performer', function (Blueprint $table) {
      $table->foreign(['genre_id'])->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
      $table->foreign(['notable_performer_id'])->references(['id'])->on('notable_performers')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });

    Schema::table('genre_slugs', function (Blueprint $table) {
      $table->foreign(['genre_id'], 'fk_genre_slugs_genre_id')->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });

    Schema::table('genre_song', function (Blueprint $table) {
      $table->foreign(['genre_id'])->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
      $table->foreign(['song_id'])->references(['id'])->on('songs')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });

    Schema::table('genre_story', function (Blueprint $table) {
      $table->foreign(['genre_id'])->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
      $table->foreign(['story_id'])->references(['id'])->on('stories')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });

    Schema::table('genre_theme', function (Blueprint $table) {
      $table->foreign(['genre_id'])->references(['id'])->on('genres')->onUpdate('NO ACTION')->onDelete('CASCADE');
      $table->foreign(['theme_id'])->references(['id'])->on('themes')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });

    Schema::table('genres', function (Blueprint $table) {
      $table->foreign(['author_id'])->references(['id'])->on('authors')->onUpdate('NO ACTION')->onDelete('CASCADE');
      $table->foreign(['song_id'])->references(['id'])->on('songs')->onUpdate('NO ACTION')->onDelete('NO ACTION');
    });

    Schema::table('site_settings', function (Blueprint $table) {
      $table->foreign(['song_id'])->references(['id'])->on('songs')->onUpdate('NO ACTION')->onDelete('NO ACTION');
    });

    Schema::table('songs', function (Blueprint $table) {
      $table->foreign(['notable_performer_id'])->references(['id'])->on('notable_performers')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });

    Schema::table('stories', function (Blueprint $table) {
      $table->foreign(['song_id'])->references(['id'])->on('songs')->onUpdate('NO ACTION')->onDelete('NO ACTION');
    });

    Schema::table('story_author', function (Blueprint $table) {
      $table->foreign(['author_id'])->references(['id'])->on('authors')->onUpdate('NO ACTION')->onDelete('CASCADE');
      $table->foreign(['story_id'])->references(['id'])->on('stories')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });

    Schema::table('story_slugs', function (Blueprint $table) {
      $table->foreign(['story_id'], 'fk_story_slugs_story_id')->references(['id'])->on('stories')->onUpdate('NO ACTION')->onDelete('CASCADE');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('story_slugs', function (Blueprint $table) {
      $table->dropForeign('fk_story_slugs_story_id');
    });

    Schema::table('story_author', function (Blueprint $table) {
      $table->dropForeign('story_author_author_id_foreign');
      $table->dropForeign('story_author_story_id_foreign');
    });

    Schema::table('stories', function (Blueprint $table) {
      $table->dropForeign('stories_song_id_foreign');
    });

    Schema::table('songs', function (Blueprint $table) {
      $table->dropForeign('songs_notable_performer_id_foreign');
    });

    Schema::table('site_settings', function (Blueprint $table) {
      $table->dropForeign('site_settings_song_id_foreign');
    });

    Schema::table('genres', function (Blueprint $table) {
      $table->dropForeign('genres_author_id_foreign');
      $table->dropForeign('genres_song_id_foreign');
    });

    Schema::table('genre_theme', function (Blueprint $table) {
      $table->dropForeign('genre_theme_genre_id_foreign');
      $table->dropForeign('genre_theme_theme_id_foreign');
    });

    Schema::table('genre_story', function (Blueprint $table) {
      $table->dropForeign('genre_story_genre_id_foreign');
      $table->dropForeign('genre_story_story_id_foreign');
    });

    Schema::table('genre_song', function (Blueprint $table) {
      $table->dropForeign('genre_song_genre_id_foreign');
      $table->dropForeign('genre_song_song_id_foreign');
    });

    Schema::table('genre_slugs', function (Blueprint $table) {
      $table->dropForeign('fk_genre_slugs_genre_id');
    });

    Schema::table('genre_notable_performer', function (Blueprint $table) {
      $table->dropForeign('genre_notable_performer_genre_id_foreign');
      $table->dropForeign('genre_notable_performer_notable_performer_id_foreign');
    });

    Schema::table('genre_musical_feature', function (Blueprint $table) {
      $table->dropForeign('genre_musical_feature_genre_id_foreign');
      $table->dropForeign('genre_musical_feature_musical_feature_id_foreign');
    });

    Schema::table('genre_instrument', function (Blueprint $table) {
      $table->dropForeign('genre_instrument_genre_id_foreign');
      $table->dropForeign('genre_instrument_instrument_id_foreign');
    });

    Schema::table('genre_influenced', function (Blueprint $table) {
      $table->dropForeign('genre_influenced_genre_id_foreign');
      $table->dropForeign('genre_influenced_influenced_id_foreign');
    });

    Schema::table('genre_genre', function (Blueprint $table) {
      $table->dropForeign('genre_genre_genre_id_foreign');
      $table->dropForeign('genre_genre_influence_id_foreign');
    });

    Schema::table('genre_cross_influenced', function (Blueprint $table) {
      $table->dropForeign('genre_cross_influenced_cross_influenced_id_foreign');
      $table->dropForeign('genre_cross_influenced_genre_id_foreign');
    });

    Schema::table('genre_cross_genre', function (Blueprint $table) {
      $table->dropForeign('genre_cross_genre_cross_influence_id_foreign');
      $table->dropForeign('genre_cross_genre_genre_id_foreign');
    });

    Schema::table('genre_author', function (Blueprint $table) {
      $table->dropForeign('genre_author_author_id_foreign');
      $table->dropForeign('genre_author_genre_id_foreign');
    });

    Schema::table('featured_stories', function (Blueprint $table) {
      $table->dropForeign('featured_stories_site_setting_id_foreign');
      $table->dropForeign('featured_stories_story_id_foreign');
    });

    Schema::dropIfExists('themes');

    Schema::dropIfExists('story_slugs');

    Schema::dropIfExists('story_author');

    Schema::dropIfExists('stories');

    Schema::dropIfExists('songs');

    Schema::dropIfExists('site_settings');

    Schema::dropIfExists('notable_performers');

    Schema::dropIfExists('musical_features');

    Schema::dropIfExists('instruments');

    Schema::dropIfExists('global_footers');

    Schema::dropIfExists('genres');

    Schema::dropIfExists('genre_theme');

    Schema::dropIfExists('genre_story');

    Schema::dropIfExists('genre_song');

    Schema::dropIfExists('genre_slugs');

    Schema::dropIfExists('genre_notable_performer');

    Schema::dropIfExists('genre_musical_feature');

    Schema::dropIfExists('genre_instrument');

    Schema::dropIfExists('genre_influenced');

    Schema::dropIfExists('genre_genre');

    Schema::dropIfExists('genre_cross_influenced');

    Schema::dropIfExists('genre_cross_genre');

    Schema::dropIfExists('genre_author');

    Schema::dropIfExists('featured_stories');

    Schema::dropIfExists('authors');
  }
}
