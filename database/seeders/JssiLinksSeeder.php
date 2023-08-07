<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JssiLinksSeeder extends Seeder
{
    private static int $queue = 1;

    private array $titles = [
        'Issues', 'Articles',
        'Authors', 'Institutions',
        'Keywords', 'Countries',
        'Funders',
        'Publisher & International Partners', 'Aims & Scope of Research',
        'ISSN', 'Events',
        'International Editorial Board', 'Instructions for Authors',
        'Publication Ethics & Malpractice Statement', 'Editorial Correspondence',
        'Abstracting & Indexing', 'CrossMark Policy Page'
    ];

    private array $classes = [
        'issues', 'articles',
        'authors', 'institutions',
        'keywords', 'countries',
        'funders',
        'publishers-international-partners', 'aims-scope-of-research',
        'issn', 'events',
        'international-editorial-board', 'instructions-for-authors',
        'publication-ethics-malpractice-statement', 'editorial-correspondence',
        'abstracting-indexing', 'crossmark-policy-page'
    ];

    private array $links = [
        '/issues', '/articles',
        '/authors', '/institutions',
        '/keywords', '/countries',
        '/funders',
        '/publisher-and-international-partners', '/aims-scope-of-research',
        '/issn', '/events',
        '/international-editorial-board', '/instructions-for-authors',
        '/publication-ethics-and-malpractice-statement', '/editorial-correspondence',
        '/abstracting-indexing', '/crossmark-policy-page'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 17; $i++) {
            $i === 7 && self::$queue = 1;

            DB::table('jssi_links')->insert([
                'menu_id' => $i < 7 ? 1 : 2,
                'title' => $this->titles[$i],
                'class' => $this->classes[$i],
                'link' => $this->links[$i],
                'visible' => true,
                'queue' => self::$queue,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            self::$queue++;
        }
    }
}
