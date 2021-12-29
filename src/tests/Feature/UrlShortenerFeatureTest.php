<?php

use \Laravel\Lumen\Testing\DatabaseMigrations;
use App\UrlShortener\Infrastructure\Interface\IRepository;

class UrlShortenerFeatureTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_get_url_shortener_validation_error()
    {
        $response = $this->call('POST', '/url-shortener', ['url' => null]);

        $response->assertJsonValidationErrors('url', $responseKey = null);
    }

    /** @test */
    public function can_create_url_shortener_sucessfully()
    {
        $response = $this->call('POST', '/url-shortener', ['url' => 'https://google.com']);

        $this->assertEquals(200, $response->status());
    }

    /** @test */
    public function can_create_one_record_only_for_the_same_original_url()
    {
        $this->call('POST', '/url-shortener', ['url' => 'https://google.com']);

        $this->call('POST', '/url-shortener', ['url' => 'https://google.com']);

        //get all records
        $repository = app()->make(IRepository::class);

        $data = $repository->getAll();

        $this->assertCount(1, $data);
    }

    /** @test */
    public function can_get_all_records()
    {
        $this->call('POST', '/url-shortener', ['url' => 'https://google.com']);

        $this->call('POST', '/url-shortener', ['url' => 'https://facebook.com']);

        //get all records
        $repository = app()->make(IRepository::class);

        $data = $repository->getAll();

        $this->assertCount(2, $data);
    }
}
