<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title'             => 'Understanding BPC-157: Mechanisms of Action in Tendon & Ligament Research',
                'slug'              => 'understanding-bpc-157-mechanisms-of-action',
                'short_description' => 'An in-depth review of Body Protection Compound 157, exploring its role in VEGFR2 activation, cellular migration, and extracellular matrix remodeling.',
                'body'              => '<p>Body Protection Compound 157 (BPC-157) is a synthetic 15-amino-acid peptide derived from human gastric juice protein. In vitro and animal laboratory models consistently demonstrate its remarkable influence on soft tissue regeneration.</p><h2>Angiogenesis & VEGFR2 Signal Activation</h2><p>Researchers have identified that BPC-157 promotes early growth response 1 (EGR-1) gene activation and VEGFR2 phosphorylation, promoting localized capillary formation essential for nutrient delivery to avascular tendon tissues.</p><h2>Reconstitution and Reagent Stability</h2><p>When handling BPC-157 in laboratory protocols, lyophilized powder must be stored at -20°C prior to reconstitution with sterile 0.9% Bacteriostatic Water.</p>',
                'published_at'      => now()->subDays(5),
                'published'         => true,
                'seo_title'         => 'BPC-157 Mechanism of Action & Research Guide',
                'seo_description'   => 'Comprehensive scientific breakdown of BPC-157 peptide pathways, VEGFR2 interaction, and laboratory storage protocols.',
            ],
            [
                'title'             => 'GLP-1 vs Dual GIP/GLP-1 Receptor Agonists: Comparative Research Analysis',
                'slug'              => 'glp-1-vs-dual-gip-glp-1-agonists-research',
                'short_description' => 'Comparing single GLP-1 agonists (Semaglutide) with dual GIP/GLP-1 agonists (Tirzepatide) across receptor activation, glycemic response, and metabolic rate markers.',
                'body'              => '<p>In recent metabolic research, peptide agonists targeting incretin hormone pathways have transformed experimental approaches to insulin signaling and adipose tissue regulation.</p><h2>Receptor Selectivity</h2><p>Semaglutide exhibits selective affinity for the GLP-1 receptor, whereas Tirzepatide functions as an imbalanced dual agonist with potent affinity for both GIP and GLP-1 receptors.</p>',
                'published_at'      => now()->subDays(12),
                'published'         => true,
                'seo_title'         => 'Semaglutide vs Tirzepatide Peptide Comparison',
                'seo_description'   => 'In-depth analysis comparing GLP-1 and dual GIP/GLP-1 peptide mechanisms in metabolic research models.',
            ],
            [
                'title'             => 'Best Practices for Peptides Storage and Reconstitution in Laboratory Settings',
                'slug'              => 'best-practices-peptide-storage-reconstitution',
                'short_description' => 'Essential guidelines for maintaining peptide integrity, avoiding freeze-thaw degradation, and choosing proper Bacteriostatic Water diluents.',
                'body'              => '<p>Lyophilized peptides require strict temperature control and sterile reconstitution protocols to prevent peptide bond cleavage and oxidation.</p><h2>Storage Temperature Guidelines</h2><ul><li><strong>Unreconstituted Lyophilized Powder:</strong> -20°C to -80°C for long-term stability (up to 24 months).</li><li><strong>Reconstituted Liquid Solution:</strong> 2°C to 8°C (refrigerated), protected from UV light.</li></ul>',
                'published_at'      => now()->subDays(20),
                'published'         => true,
                'seo_title'         => 'Peptide Storage & Reconstitution Protocol Guide',
                'seo_description'   => 'Standard operating procedures for reconstituting lyophilized research peptides and preventing chemical degradation.',
            ],
        ];

        foreach ($articles as $a) {
            Article::firstOrCreate(
                ['slug' => $a['slug']],
                $a
            );
        }

        $this->command->info('Research blog articles seeded successfully.');
    }
}
