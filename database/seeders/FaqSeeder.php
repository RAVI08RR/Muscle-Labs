<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            // Products
            [
                'question'   => 'What are research peptides?',
                'answer'     => 'Research peptides are short chains of amino acids used in scientific research to study biological processes. They are sold strictly for laboratory research purposes and are not intended for human consumption.',
                'category'   => 'Products',
                'sort_order' => 1,
            ],
            [
                'question'   => 'What does COA mean?',
                'answer'     => 'COA stands for Certificate of Analysis. It is a document from an accredited independent laboratory that verifies the purity and composition of our products. You can download the COA for any product from its product page.',
                'category'   => 'Products',
                'sort_order' => 2,
            ],
            [
                'question'   => 'What purity levels are your products?',
                'answer'     => 'All Muscle Labs products are tested to a minimum of 99% purity by HPLC. Exact purity is stated on each product\'s Certificate of Analysis.',
                'category'   => 'Products',
                'sort_order' => 3,
            ],
            [
                'question'   => 'How should I store peptides?',
                'answer'     => 'Peptides should be stored in a cool, dry place away from direct light. For long-term storage, keep lyophilised peptides at -20°C in a sealed container. Refer to the storage information on each product page.',
                'category'   => 'Products',
                'sort_order' => 4,
            ],
            // Ordering
            [
                'question'   => 'Do I need to create an account to order?',
                'answer'     => 'No, you can check out as a guest. However, creating an account lets you track orders, save addresses, and view your order history.',
                'category'   => 'Ordering',
                'sort_order' => 1,
            ],
            [
                'question'   => 'What payment methods do you accept?',
                'answer'     => 'We accept all major credit and debit cards via Stripe. All payments are processed securely — your card details are never stored on our servers.',
                'category'   => 'Ordering',
                'sort_order' => 2,
            ],
            [
                'question'   => 'Can I get a discount for bulk orders?',
                'answer'     => 'Yes. Our tiered pricing automatically applies discounts when you order 2 or more units of the same product. The discount is shown on the product page as you adjust the quantity.',
                'category'   => 'Ordering',
                'sort_order' => 3,
            ],
            // Shipping
            [
                'question'   => 'How fast is delivery?',
                'answer'     => 'Orders are dispatched via Royal Mail. Standard delivery typically takes 2–3 working days within the UK. You will receive a tracking number once your order is dispatched.',
                'category'   => 'Shipping',
                'sort_order' => 1,
            ],
            [
                'question'   => 'Do you ship internationally?',
                'answer'     => 'Currently we ship within the UK only. International shipping may be available in future — please check back or sign up to our newsletter.',
                'category'   => 'Shipping',
                'sort_order' => 2,
            ],
            [
                'question'   => 'How do I track my order?',
                'answer'     => 'Once your order is dispatched you will receive an email with your Royal Mail tracking number. You can also track your order on our Order Tracking page using your order number and email address.',
                'category'   => 'Shipping',
                'sort_order' => 3,
            ],
            // Legal
            [
                'question'   => 'Are your products legal in the UK?',
                'answer'     => 'Yes. Research peptides are legal to purchase in the UK for legitimate scientific research purposes. They must not be used for human consumption and are not licensed medicines.',
                'category'   => 'Legal',
                'sort_order' => 1,
            ],
            [
                'question'   => 'Who can purchase from Muscle Labs?',
                'answer'     => 'Customers must be 18 years of age or older. Our products are intended for qualified researchers and scientists only. By purchasing, you confirm that you understand and accept our research-use disclaimer.',
                'category'   => 'Legal',
                'sort_order' => 2,
            ],
        ];

        foreach ($faqs as $faqData) {
            Faq::updateOrCreate(
                ['question' => $faqData['question']],
                $faqData + ['is_active' => true]
            );
        }

        $this->command->info('FAQs seeded successfully (' . count($faqs) . ' FAQs).');
    }
}
