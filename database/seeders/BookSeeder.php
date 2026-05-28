<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Romance' => Genre::firstOrCreate(['name' => 'Romance']),
            'Ficção' => Genre::firstOrCreate(['name' => 'Ficção']),
            'Fantasia' => Genre::firstOrCreate(['name' => 'Fantasia']),
        ];

        $books = [
            [
                'title' => 'Dom Casmurro',
                'author' => 'Machado de Assis',
                'genre_id' => $genres['Romance']->id,
                'published_year' => '1899',
                'description' => 'Um clássico da literatura brasileira narrado por Bentinho.',
            ],
            [
                'title' => 'Capitães da Areia',
                'author' => 'Jorge Amado',
                'genre_id' => $genres['Ficção']->id,
                'published_year' => '1937',
                'description' => 'Romance sobre um grupo de meninos de rua em Salvador.',
            ],
            [
                'title' => 'Vidas Secas',
                'author' => 'Graciliano Ramos',
                'genre_id' => $genres['Romance']->id,
                'published_year' => '1938',
                'description' => 'A trajetória de uma família sertaneja enfrentando a seca.',
            ],
            [
                'title' => 'O Alquimista',
                'author' => 'Paulo Coelho',
                'genre_id' => $genres['Fantasia']->id,
                'published_year' => '1988',
                'description' => 'Uma jornada em busca de sonhos e descobertas pessoais.',
            ],
            [
                'title' => 'Torto Arado',
                'author' => 'Itamar Vieira Junior',
                'genre_id' => $genres['Romance']->id,
                'published_year' => '2019',
                'description' => 'História sobre família, terra e resistência no sertão baiano.',
            ],
        ];

        foreach ($books as $book) {
            $book['cover'] = $this->createDummyCover();

            Book::updateOrCreate(
                ['title' => $book['title'], 'author' => $book['author']],
                $book
            );
        }
    }

    private function createDummyCover(): string
    {
        $filename = Str::random(40).'.jpg';
        $path = Storage::disk('public')->path($filename);

        $image = imagecreatetruecolor(400, 600);
        $background = imagecolorallocate($image, fake()->numberBetween(40, 180), fake()->numberBetween(40, 180), fake()->numberBetween(40, 180));
        $textColor = imagecolorallocate($image, 255, 255, 255);

        imagefilledrectangle($image, 0, 0, 400, 600, $background);
        imagestring($image, 5, 150, 285, 'Book Cover', $textColor);
        imagejpeg($image, $path, 90);

        return $filename;
    }
}
