<?php

namespace Tests\Unit;

use Faker\Factory;
use Illuminate\Database\Eloquent\Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class BreakupperTest extends TestCase
{
    /** @test */
    function text_will_break_up()
    {
        $faker = Factory::create();
        $text = $faker->paragraph(250, false);
        $break = 555;
        $return = [];
        $x = 0;

        while($x <= strlen($text)) {
            $return[] = substr($text,$x,$break);
            $x+= $break;
        }
        dd($return);
    }
}