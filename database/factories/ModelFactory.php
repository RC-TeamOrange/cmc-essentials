<?php

use CmcEssentials\Http\Requests;
use CmcEssentials\TeachingUnit;
use CmcEssentials\StudyMaterial;
use CmcEssentials\Quiz;
use CmcEssentials\Question;
use CmcEssentials\Answer;
use CmcEssentials\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(TeachingUnit::class, function (Faker\Generator $faker) {
    return [
        'slug' => 'teaching-unit-test-slug',
        'level' => 1,
        'title' => 'Test teaching unit title',
        'description' => 'Test teaching unit description.',
        'duration' => 60,
    ];
});

$factory->define(StudyMaterial::class, function (Faker\Generator $faker) {
    return [
        'level' => 1,
        'order' => 1,
        'title' => 'Test study material title',
        'description' => 'Test study material description.',
        'teaching_unit_id' => function () {
            return factory(TeachingUnit::class)->create()->id;
        }
    ];
});

$factory->define(Quiz::class, function (Faker\Generator $faker) {
    return [
        'level' => 1,
        'slug' => 'quiz-test-slug',
        'title' => 'Test study material title',
        'teaching_unit_id' => function () {
            return factory(TeachingUnit::class)->create()->id;
        }
    ];
});

$factory->define(Question::class, function (Faker\Generator $faker) {
    return [
        'content' => 1,
        'quiz_id' => function () {
            return factory(Quiz::class)->create()->id;
        }
    ];
});

$factory->define(Answer::class, function (Faker\Generator $faker) {
    return [
        'content' => 1,
        'rank'    => 1,
        'correct' => 1,
        'question_id' => function () {
            return factory(Question::class)->create()->id;
        }
    ];
});