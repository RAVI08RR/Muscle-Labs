<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Seed the default static content pages for Muscle Labs.
     */
    public function run(): void
    {
        $pages = [
            [
                'title'           => 'About Us',
                'slug'            => 'about-us',
                'body'            => '<p>Welcome to Muscle Labs — a UK-based supplier of research peptides for scientific research purposes only.</p>',
                'seo_title'       => 'About Us | Muscle Labs',
                'seo_description' => 'Learn about Muscle Labs, a UK-based research peptide supplier committed to purity, quality, and scientific integrity.',
                'is_active'       => true,
            ],
            [
                'title'           => 'Quality & COA',
                'slug'            => 'quality-coa',
                'body'            => '<p>All Muscle Labs products are independently tested and come with a Certificate of Analysis (COA). Download COAs from individual product pages.</p>',
                'seo_title'       => 'Quality & Certificate of Analysis | Muscle Labs',
                'seo_description' => 'Learn how Muscle Labs ensures purity and quality with independent testing and Certificates of Analysis for all products.',
                'is_active'       => true,
            ],
            [
                'title'           => 'Research & Learn',
                'slug'            => 'research-learn',
                'body'            => '<p>Research resources and educational information about peptides. All products sold by Muscle Labs are for research purposes only.</p>',
                'seo_title'       => 'Research & Learn | Muscle Labs',
                'seo_description' => 'Educational information and research resources about peptides from Muscle Labs.',
                'is_active'       => true,
            ],
            [
                'title'           => 'FAQ',
                'slug'            => 'faq',
                'body'            => '<p>Frequently asked questions about Muscle Labs products, ordering, and delivery.</p>',
                'seo_title'       => 'Frequently Asked Questions | Muscle Labs',
                'seo_description' => 'Answers to frequently asked questions about Muscle Labs research peptides, ordering, and delivery.',
                'is_active'       => true,
            ],
            [
                'title'           => 'Contact Us',
                'slug'            => 'contact',
                'body'            => '<p>Get in touch with the Muscle Labs team.</p>',
                'seo_title'       => 'Contact Us | Muscle Labs',
                'seo_description' => 'Contact the Muscle Labs team with any questions about our research peptide products.',
                'is_active'       => true,
            ],
            [
                'title'           => 'Terms & Conditions',
                'slug'            => 'terms-conditions',
                'body'            => '<p>Terms and Conditions for use of musclelabs.co.uk. Please read carefully before placing an order.</p>',
                'seo_title'       => 'Terms & Conditions | Muscle Labs',
                'seo_description' => 'Terms and Conditions for Muscle Labs. Read before purchasing.',
                'is_active'       => true,
            ],
            [
                'title'           => 'Privacy Policy',
                'slug'            => 'privacy-policy',
                'body'            => '<p>Our Privacy Policy describes how we collect, use, and protect your personal data in accordance with UK GDPR.</p>',
                'seo_title'       => 'Privacy Policy | Muscle Labs',
                'seo_description' => 'Privacy Policy for Muscle Labs — how we handle your personal data under UK GDPR.',
                'is_active'       => true,
            ],
            [
                'title'           => 'Cookie Policy',
                'slug'            => 'cookie-policy',
                'body'            => '<p>Information about how Muscle Labs uses cookies on our website.</p>',
                'seo_title'       => 'Cookie Policy | Muscle Labs',
                'seo_description' => 'Cookie policy for Muscle Labs explaining how we use cookies.',
                'is_active'       => true,
            ],
            [
                'title'           => 'Shipping Policy',
                'slug'            => 'shipping-policy',
                'body'            => '<p>Information about Muscle Labs shipping methods, delivery times, and costs.</p>',
                'seo_title'       => 'Shipping Policy | Muscle Labs',
                'seo_description' => 'Learn about Muscle Labs shipping options, delivery times and costs.',
                'is_active'       => true,
            ],
            [
                'title'           => 'Returns Policy',
                'slug'            => 'returns-policy',
                'body'            => '<p>Our returns and refund policy for Muscle Labs products. Please read before placing an order.</p>',
                'seo_title'       => 'Returns Policy | Muscle Labs',
                'seo_description' => 'Returns and refund policy for Muscle Labs research peptides.',
                'is_active'       => true,
            ],
            [
                'title'           => 'Research Disclaimer',
                'slug'            => 'research-disclaimer',
                'body'            => '<p><strong>IMPORTANT — FOR RESEARCH USE ONLY</strong></p><p>All products sold by Muscle Labs are intended strictly for scientific research purposes only. They are NOT for human consumption, NOT intended to diagnose, treat, cure, or prevent any disease or condition, and NOT approved by the MHRA or any other regulatory authority for use in humans or animals.</p><p>By accessing this website and purchasing any product, you confirm that you are 18 years of age or older, a qualified researcher or scientist, and that you understand and accept the above conditions.</p>',
                'seo_title'       => 'Research Disclaimer | Muscle Labs',
                'seo_description' => 'Important research use disclaimer for Muscle Labs peptide products.',
                'is_active'       => true,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }

        $this->command->info('Muscle Labs static pages seeded successfully (' . count($pages) . ' pages).');
    }
}
