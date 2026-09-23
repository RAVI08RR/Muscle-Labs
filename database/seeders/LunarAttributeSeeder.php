<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Lunar\Models\Attribute;
use Lunar\Models\AttributeGroup;
use Lunar\Models\Language;

class LunarAttributeSeeder extends Seeder
{
    /**
     * Register custom product attributes used by Muscle Labs.
     * These extend Lunar's built-in attribute system.
     */
    public function run(): void
    {
        // Ensure default language exists
        $language = Language::first();

        if (! $language) {
            $language = Language::create([
                'code'    => 'en',
                'name'    => 'English',
                'default' => true,
            ]);
        }

        // ── Create or find the Muscle Labs attribute group ──
        $group = AttributeGroup::firstOrCreate(
            ['handle' => 'muscle_labs_product'],
            [
                'name'       => collect(['en' => 'Muscle Labs Product Info']),
                'handle'     => 'muscle_labs_product',
                'position'   => 3,
                'attributable_type' => \Lunar\Models\Product::class,
            ]
        );

        // ── Define custom attributes ──
        $attributes = [
            [
                'name'        => collect(['en' => 'Strength / Size']),
                'handle'      => 'strength_size',
                'section'     => 'main',
                'type'        => \Lunar\FieldTypes\Text::class,
                'required'    => false,
                'searchable'  => true,
                'filterable'  => true,
                'position'    => 1,
            ],
            [
                'name'        => collect(['en' => 'Purity']),
                'handle'      => 'purity',
                'section'     => 'main',
                'type'        => \Lunar\FieldTypes\Text::class,
                'required'    => false,
                'searchable'  => false,
                'filterable'  => false,
                'position'    => 2,
            ],
            [
                'name'        => collect(['en' => 'Research Information']),
                'handle'      => 'research_info',
                'section'     => 'main',
                'type'        => \Lunar\FieldTypes\TranslatedText::class,
                'required'    => false,
                'searchable'  => false,
                'filterable'  => false,
                'position'    => 3,
            ],
            [
                'name'        => collect(['en' => 'Storage & Handling']),
                'handle'      => 'storage_handling',
                'section'     => 'main',
                'type'        => \Lunar\FieldTypes\TranslatedText::class,
                'required'    => false,
                'searchable'  => false,
                'filterable'  => false,
                'position'    => 4,
            ],
            [
                'name'        => collect(['en' => 'Short Description']),
                'handle'      => 'short_description',
                'section'     => 'main',
                'type'        => \Lunar\FieldTypes\Text::class,
                'required'    => false,
                'searchable'  => true,
                'filterable'  => false,
                'position'    => 5,
            ],
            [
                'name'        => collect(['en' => 'SEO Title']),
                'handle'      => 'seo_title',
                'section'     => 'seo',
                'type'        => \Lunar\FieldTypes\Text::class,
                'required'    => false,
                'searchable'  => false,
                'filterable'  => false,
                'position'    => 6,
            ],
            [
                'name'        => collect(['en' => 'SEO Description']),
                'handle'      => 'seo_description',
                'section'     => 'seo',
                'type'        => \Lunar\FieldTypes\Text::class,
                'required'    => false,
                'searchable'  => false,
                'filterable'  => false,
                'position'    => 7,
            ],
            [
                'name'        => collect(['en' => 'Image Alt Text']),
                'handle'      => 'alt_text',
                'section'     => 'main',
                'type'        => \Lunar\FieldTypes\Text::class,
                'required'    => false,
                'searchable'  => false,
                'filterable'  => false,
                'position'    => 8,
            ],
        ];

        foreach ($attributes as $attributeData) {
            $attr = Attribute::firstOrCreate(
                ['handle' => $attributeData['handle'], 'attribute_type' => \Lunar\Models\Product::class],
                array_merge($attributeData, [
                    'attribute_group_id' => $group->id,
                    'attribute_type'     => \Lunar\Models\Product::class,
                    'configuration'      => [],
                    'system'             => false,
                ])
            );
        }

        $this->command->info('Muscle Labs product attributes seeded successfully.');
    }
}
