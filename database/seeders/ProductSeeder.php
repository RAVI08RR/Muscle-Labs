<?php

namespace Database\Seeders;

use App\Models\ProductCoa;
use Illuminate\Database\Seeder;
use Lunar\FieldTypes\Text;
use Lunar\FieldTypes\TranslatedText;
use Lunar\Models\Channel;
use Lunar\Models\Collection;
use Lunar\Models\CollectionGroup;
use Lunar\Models\Currency;
use Lunar\Models\CustomerGroup;
use Lunar\Models\Price;
use Lunar\Models\Product;
use Lunar\Models\ProductType;
use Lunar\Models\ProductVariant;
use Lunar\Models\TaxClass;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure Currency GBP
        $currency = Currency::firstOrCreate(
            ['code' => 'GBP'],
            [
                'name'           => 'British Pound',
                'code'           => 'GBP',
                'decimal_places' => 2,
                'exchange_rate'  => 1.0000,
                'default'        => true,
                'enabled'        => true,
            ]
        );

        // 2. Ensure Channel default
        $channel = Channel::firstOrCreate(
            ['handle' => 'storefront'],
            [
                'name'    => 'Storefront',
                'handle'  => 'storefront',
                'default' => true,
                'url'     => config('app.url'),
            ]
        );

        // 3. Ensure TaxClass zero/standard & TaxZone
        $taxClass = TaxClass::firstOrCreate(
            ['name' => 'Standard Rate'],
            ['default' => true]
        );

        $taxZone = \Lunar\Models\TaxZone::firstOrCreate(
            ['name' => 'Default Tax Zone'],
            ['name' => 'Default Tax Zone', 'zone_type' => 'country', 'price_display' => 'tax_exclusive', 'default' => true, 'active' => true]
        );

        $taxRate = \Lunar\Models\TaxRate::firstOrCreate(
            ['name' => 'Standard Tax Rate'],
            ['name' => 'Standard Tax Rate', 'tax_zone_id' => $taxZone->id, 'priority' => 1]
        );

        \Lunar\Models\TaxRateAmount::firstOrCreate(
            ['tax_rate_id' => $taxRate->id, 'tax_class_id' => $taxClass->id],
            ['tax_rate_id' => $taxRate->id, 'tax_class_id' => $taxClass->id, 'percentage' => 0.00]
        );

        // 4. Ensure CustomerGroup
        $customerGroup = CustomerGroup::firstOrCreate(
            ['handle' => 'default'],
            ['name' => 'Default', 'handle' => 'default', 'default' => true]
        );

        // 5. Ensure ProductType
        $productType = ProductType::firstOrCreate(
            ['name' => 'Research Peptide'],
            ['name' => 'Research Peptide']
        );

        // 6. Collection Group & Categories
        $collectionGroup = CollectionGroup::firstOrCreate(
            ['handle' => 'categories'],
            ['name' => 'Categories', 'handle' => 'categories']
        );

        $categoriesData = [
            ['name' => 'Healing & Recovery', 'slug' => 'healing-recovery', 'desc' => 'Research peptides for tissue repair, cellular regeneration, and recovery studies.'],
            ['name' => 'Metabolic & Weight Management', 'slug' => 'metabolic-weight', 'desc' => 'GLP-1 receptor agonists and metabolic research peptides.'],
            ['name' => 'GH Secretagogues', 'slug' => 'gh-secretagogues', 'desc' => 'Growth hormone releasing peptides for endocrine research.'],
            ['name' => 'Cosmetic & Anti-Aging', 'slug' => 'cosmetic-anti-aging', 'desc' => 'Peptides studied for skin elasticity, pigmentation, and cellular longevity.'],
        ];

        $collections = [];
        foreach ($categoriesData as $cat) {
            $col = Collection::where('collection_group_id', $collectionGroup->id)
                ->whereHas('urls', fn ($q) => $q->where('slug', $cat['slug']))
                ->first();

            if (! $col) {
                $col = new Collection();
                $col->collection_group_id = $collectionGroup->id;
                $col->attribute_data = collect([
                    'name' => new Text($cat['name']),
                    'description' => new Text($cat['desc']),
                ]);
                $col->save();

                $col->urls()->create([
                    'slug' => $cat['slug'],
                    'default' => true,
                    'language_id' => 1,
                ]);
            }

            $collections[$cat['slug']] = $col;
        }

        // 7. Products List
        $productsData = [
            [
                'name' => 'BPC-157 5mg',
                'sku'  => 'ML-BPC157-5MG',
                'slug' => 'bpc-157-5mg',
                'category' => 'healing-recovery',
                'price' => 2999, // £29.99
                'tier_3' => 2699, // £26.99 (3+)
                'tier_5' => 2399, // £23.99 (5+)
                'purity' => '99.4%',
                'strength' => '5mg Lyophilized Powder',
                'description' => 'Body Protection Compound 157 (BPC-157) is a pentadecapeptide composed of 15 amino acids. Premium high-purity research grade for laboratory analysis only.',
                'research' => 'Extensively studied for soft tissue healing, tendon-to-bone repair, and gastrointestinal mucosal integrity in research models.',
                'storage' => 'Store lyophilized vial at -20°C. Reconstitute with Bacteriostatic Water and keep refrigerated (2-8°C). Use within 30 days of reconstitution.',
            ],
            [
                'name' => 'TB-500 5mg (Thymosin Beta-4)',
                'sku'  => 'ML-TB500-5MG',
                'slug' => 'tb-500-5mg',
                'category' => 'healing-recovery',
                'price' => 3499, // £34.99
                'tier_3' => 3199,
                'tier_5' => 2799,
                'purity' => '99.2%',
                'strength' => '5mg Lyophilized Powder',
                'description' => 'TB-500 is a synthetic version of the naturally occurring peptide Thymosin Beta-4. Promotes cell migration and actin sequestration in laboratory research.',
                'research' => 'Investigated for cardiac repair, muscle cell migration, dermal wound healing, and anti-inflammatory pathways.',
                'storage' => 'Store lyophilized powder dry at -20°C. Reconstituted solution stable up to 28 days refrigerated.',
            ],
            [
                'name' => 'Semaglutide 5mg',
                'sku'  => 'ML-SEMA-5MG',
                'slug' => 'semaglutide-5mg',
                'category' => 'metabolic-weight',
                'price' => 5999, // £59.99
                'tier_3' => 5399,
                'tier_5' => 4799,
                'purity' => '99.6%',
                'strength' => '5mg Lyophilized Powder',
                'description' => 'Semaglutide is a GLP-1 receptor agonist peptide engineered for high metabolic stability. Highest purity research reagent.',
                'research' => 'Studied for insulin secretion modulation, gastric emptying rate kinetics, and central appetite signal transduction.',
                'storage' => 'Keep frozen at -20°C prior to reconstitution. Reconstituted peptide remains active at 4°C for 21 days.',
            ],
            [
                'name' => 'Tirzepatide 10mg',
                'sku'  => 'ML-TIRZ-10MG',
                'slug' => 'tirzepatide-10mg',
                'category' => 'metabolic-weight',
                'price' => 8999, // £89.99
                'tier_3' => 8099,
                'tier_5' => 7199,
                'purity' => '99.5%',
                'strength' => '10mg Lyophilized Powder',
                'description' => 'Dual GIP and GLP-1 receptor agonist peptide for advanced metabolic pathway research.',
                'research' => 'Dual receptor action evaluated for synergistic metabolic rate changes and pancreatic beta-cell response kinetics.',
                'storage' => 'Store vacuum-sealed vial at -20°C. Protect from light.',
            ],
            [
                'name' => 'CJC-1295 (No DAC) + Ipamorelin (5mg / 5mg Blend)',
                'sku'  => 'ML-CJC-IPA-10MG',
                'slug' => 'cjc-1295-ipamorelin-blend',
                'category' => 'gh-secretagogues',
                'price' => 4999, // £49.99
                'tier_3' => 4499,
                'tier_5' => 3999,
                'purity' => '99.3%',
                'strength' => '5mg CJC + 5mg Ipamorelin Blend',
                'description' => 'Synergistic growth hormone secretagogue combination blending GHRH analog CJC-1295 No DAC with GHRP ghrelin receptor agonist Ipamorelin.',
                'research' => 'Studied for pulse amplitude elevation of growth hormone without elevating cortisol or prolactin levels.',
                'storage' => 'Store below -18°C. Reconstitute with 2ml BAC water.',
            ],
            [
                'name' => 'NAD+ 500mg',
                'sku'  => 'ML-NAD-500MG',
                'slug' => 'nad-plus-500mg',
                'category' => 'cosmetic-anti-aging',
                'price' => 3999, // £39.99
                'tier_3' => 3599,
                'tier_5' => 3199,
                'purity' => '99.8%',
                'strength' => '500mg Lyophilized Coenzyme Powder',
                'description' => 'Nicotinamide Adenine Dinucleotide (NAD+) coenzyme essential for mitochondrial energy production and sirtuin activation.',
                'research' => 'Investigated in cellular senescence, DNA repair mechanisms (PARP activation), and mitochondrial respiration assays.',
                'storage' => 'Desiccate and store at -20°C. Highly hygroscopic powder.',
            ],
            [
                'name' => 'GHK-Cu 50mg (Copper Peptide)',
                'sku'  => 'ML-GHKCU-50MG',
                'slug' => 'ghk-cu-50mg',
                'category' => 'cosmetic-anti-aging',
                'price' => 3299, // £32.99
                'tier_3' => 2999,
                'tier_5' => 2599,
                'purity' => '99.1%',
                'strength' => '50mg Lyophilized Powder',
                'description' => 'Glycyl-L-histidyl-L-lysine copper complex (GHK-Cu). Renowned naturally occurring tripeptide for dermal remodeling research.',
                'research' => 'Evaluated for collagen synthesis upregulation, glycosaminoglycan stimulation, and tissue antioxidant gene expression.',
                'storage' => 'Store at 4°C or -20°C in dark ambient conditions.',
            ],
            [
                'name' => 'Melanotan II 10mg',
                'sku'  => 'ML-MT2-10MG',
                'slug' => 'melanotan-ii-10mg',
                'category' => 'cosmetic-anti-aging',
                'price' => 2799, // £27.99
                'tier_3' => 2499,
                'tier_5' => 2199,
                'purity' => '99.4%',
                'strength' => '10mg Lyophilized Powder',
                'description' => 'Synthetic analog of alpha-melanocyte stimulating hormone (alpha-MSH).',
                'research' => 'Melanocortin receptor binding affinity assays and melanogenesis signaling pathways.',
                'storage' => 'Store lyophilized vial below -18°C.',
            ],
        ];

        foreach ($productsData as $p) {
            $product = Product::whereHas('urls', fn ($q) => $q->where('slug', $p['slug']))->first();

            if (! $product) {
                $product = new Product();
                $product->product_type_id = $productType->id;
                $product->status = 'published';
                $product->brand_id = null;
                $product->attribute_data = collect([
                    'name'              => new Text($p['name']),
                    'description'       => new Text($p['description']),
                    'strength_size'     => new Text($p['strength']),
                    'purity'            => new Text($p['purity']),
                    'research_info'     => new Text($p['research']),
                    'storage_handling'  => new Text($p['storage']),
                    'short_description' => new Text(substr($p['description'], 0, 120) . '...'),
                ]);
                $product->save();

                // Set URL slug
                $product->urls()->create([
                    'slug'        => $p['slug'],
                    'default'     => true,
                    'language_id' => 1,
                ]);
            }

            // Link to category collection
            if (isset($collections[$p['category']])) {
                $product->collections()->syncWithoutDetaching([$collections[$p['category']]->id]);
            }

            // Create product variant
            $variant = ProductVariant::firstOrCreate(
                ['product_id' => $product->id, 'sku' => $p['sku']],
                [
                    'product_id'   => $product->id,
                    'tax_class_id' => $taxClass->id,
                    'sku'          => $p['sku'],
                    'unit_quantity'=> 1,
                    'purchasable'   => 'always',
                    'stock'        => 500,
                    'backorder'    => 0,
                    'shippable'    => true,
                ]
            );

            // Base price (1 unit)
            Price::firstOrCreate(
                [
                    'priceable_type' => $variant->getMorphClass(),
                    'priceable_id'   => $variant->id,
                    'currency_id'    => $currency->id,
                    'min_quantity'   => 1,
                ],
                [
                    'priceable_type' => $variant->getMorphClass(),
                    'priceable_id'   => $variant->id,
                    'currency_id'    => $currency->id,
                    'min_quantity'   => 1,
                    'price'          => $p['price'],
                ]
            );

            // Tiered price 3+ units
            Price::firstOrCreate(
                [
                    'priceable_type' => $variant->getMorphClass(),
                    'priceable_id'   => $variant->id,
                    'currency_id'    => $currency->id,
                    'min_quantity'   => 3,
                ],
                [
                    'priceable_type' => $variant->getMorphClass(),
                    'priceable_id'   => $variant->id,
                    'currency_id'    => $currency->id,
                    'min_quantity'   => 3,
                    'price'          => $p['tier_3'],
                ]
            );

            // Tiered price 5+ units
            Price::firstOrCreate(
                [
                    'priceable_type' => $variant->getMorphClass(),
                    'priceable_id'   => $variant->id,
                    'currency_id'    => $currency->id,
                    'min_quantity'   => 5,
                ],
                [
                    'priceable_type' => $variant->getMorphClass(),
                    'priceable_id'   => $variant->id,
                    'currency_id'    => $currency->id,
                    'min_quantity'   => 5,
                    'price'          => $p['tier_5'],
                ]
            );

            // Sample Product COA
            ProductCoa::firstOrCreate(
                ['product_id' => $product->id],
                [
                    'product_id'   => $product->id,
                    'batch_number' => 'ML-2026-B' . str_pad((string)rand(100, 999), 3, '0', STR_PAD_LEFT),
                    'test_date'    => now()->subDays(rand(10, 60))->format('Y-m-d'),
                ]
            );

            // Attach to storefront channel and default customer group
            $product->channels()->syncWithoutDetaching([
                $channel->id => ['enabled' => true, 'starts_at' => now()->subDay()]
            ]);
            $product->customerGroups()->syncWithoutDetaching([
                $customerGroup->id => ['enabled' => true, 'purchasable' => true, 'starts_at' => now()->subDay()]
            ]);
        }

        $this->command->info('Muscle Labs research peptides, collections, prices, and COAs seeded successfully.');
    }
}
