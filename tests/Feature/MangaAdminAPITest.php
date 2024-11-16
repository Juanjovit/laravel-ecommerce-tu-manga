<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class MangaAdminAPITest extends TestCase
{

    use RefreshDatabase;

    protected bool $seed = true;

  
    public function withUser(): self
    {
        $user = new User();
        $user->user_id = 1;
 
        return $this->actingAs($user);
    }

    public function test_unauthenticated_root_mangas_path_returns_all_mangas_returns_401()
    {
        $response = $this->getJson('/api/mangas');

        $response->assertStatus(401);
    }

    public function test_root_mangas_path_returns_all_mangas(): void
    {
        $response = $this->withUser()->getJson('/api/mangas');

        $response
            ->assertStatus(200)
            ->assertJsonCount(16, 'data')
            ->assertJsonStructure([
                'status',
                'data' => [
                    '*' => [
                        'id',
                        'serie_fk',
                        'title',
                        'en_alternative_title',
                        'es_alternative_title',
                        'synopsis',
                        'price',
                        'release_date',
                        'cover',
                        'cover_description',
                        'created_at',
                        'updated_at',
                    ],
                ]
            ])
            ->assertJsonPath('status', 0);
    }


    public function test_requesting_a_manga_by_its_id_returns_the_manga()
    {
        $id = 1;
        $response = $this->withUser()->getJson('/api/mangas/' . $id);


        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->where('status', 0)
                    ->where('data.id', $id)
                    ->where('data.title', 'Boku no Hero Academia 01')
                    ->whereAllType([
                        'data.id' => 'integer',
                        'data.en_alternative_title' => 'string',
                        'data.es_alternative_title' => 'string',
                        'data.title' => 'string',
                        'data.price' => 'integer|double',
                        'data.release_date' => 'string',
                        'data.synopsis' => 'string',
                        'data.cover' => 'string|null',
                        'data.cover_description' => 'string|null',
                        'data.created_at' => 'string',
                        'data.updated_at' => 'string',
                        'data.deleted_at' => 'string|null',
                    ])
            );
    }

    public function test_requesting_a_manga_by_an_id_that_doesnt_exists_returns_404()
    {
        $response = $this->withUser()->getJson('/api/mangas/50');

        $response->assertStatus(404);
    }


    public function test_can_create_a_manga_by_using_a_post_request_and_data()
    {
        $postData = [
                'serie_fk' => 1,
                'title' => 'Boku no Hero Academia 10',
                'en_alternative_title' => 'My Hero Academia 10',
                'es_alternative_title' => 'Mi Academia de Heroes 10',
                'synopsis' => 'Las personas no nacen igual. El protagonista de esta historia es uno de esos casos raros que nacen sin superpoderes, pero esto no le impedirá perseguir su sueño: ser un gran héroe como el legendario All-Might. Para convertirse en el héroe que quiere ser, se apuntará a una de las academias de héroes más prestigiosas del país: Yueiko. Con la ayuda de su ídolo, All-Might, ¿podrá convertirse en un verdadero héroe?',
                'price' => 105000,
                'release_date' => '2001-12-21',
        ];

        $response = $this->withUser()->postJson('/api/mangas', $postData);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->where('status', 0)
                    ->where('data.id', 17)
            );

    
        $response = $this->getJson('/api/mangas/17');

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->where('status', 0)
                    ->where('data.id', 17)
                    ->where('data.serie_fk', 1)
                    ->where('data.title', $postData['title'])
                    ->where('data.en_alternative_title', $postData['en_alternative_title'])
                    ->where('data.es_alternative_title', $postData['es_alternative_title'])
                    ->where('data.synopsis', $postData['synopsis'])
                    ->where('data.price', $postData['price'])
                    ->where('data.cover', null)
                    ->etc()
            );
    }
}
