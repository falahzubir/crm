<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $q = Question::create([
            'title' => 'Aware or not about Emzi?',
            'type' => 'feedback',
            'slug' => 'aware_or_not_about_emzi',
            'input_type' => 'radio',
            'is_predefined' => true,
            'order' => 1,
        ]);
        $q->inputValues()->createMany([
            ['key' => 'yes', 'description' => 'Yes', 'order' => 1],
            ['key' => 'no', 'description' => 'No', 'order' => 2],
        ]);

        $q = Question::create([
            'title' => 'How did you know about Emzi?',
            'type' => 'feedback',
            'slug' => 'how_did_you_know_about_emzi',
            'input_type' => 'checkbox',
            'is_predefined' => true,
            'order' => 2,
        ]);

        $q->inputValues()->createMany([
            ['key' => 'social_media', 'description' => 'Social Media', 'order' => 1],
            ['key' => 'friends', 'description' => 'Friends', 'order' => 2],
            ['key' => 'website', 'description' => 'Website', 'order' => 3],
        ]);

        $q = Question::create([
            'title' => 'First Product Purchased from EMZI?',
            'type' => 'feedback',
            'slug' => 'first_product_purchased_from_emzi',
            'input_type' => 'text',
            'is_predefined' => false,
            'order' => 3,
        ]);

        $q = Question::create([
            'title' => 'Reason for Buying Emzi Products?',
            'type' => 'feedback',
            'slug' => 'reason_for_buying_emzi_products',
            'input_type' => 'text',
            'is_predefined' => false,
            'order' => 4,
        ]);

        $q = Question::create([
            'title' => 'Why Support Emzi Products?',
            'type' => 'feedback',
            'slug' => 'why_support_emzi_products',
            'input_type' => 'text',
            'is_predefined' => false,
            'order' => 5,
        ]);

        $q = Question::create([
            'title' => 'Frequency of Purchase?',
            'type' => 'feedback',
            'slug' => 'frequency_of_purchase',
            'input_type' => 'number',
            'is_predefined' => false,
            'order' => 6,
        ]);

        $q = Question::create([
            'title' => 'What Products Does Emzi Have?',
            'type' => 'feedback',
            'slug' => 'what_products_does_emzi_have',
            'input_type' => 'text',
            'is_predefined' => false,
            'order' => 7,
        ]);

        $q = Question::create([
            'title' => 'Do you know Emzi has its own factory?',
            'type' => 'feedback',
            'slug' => 'do_you_know_emzi_has_its_own_factory',
            'input_type' => 'radio',
            'is_predefined' => true,
            'order' => 8,
        ]);

        $q->inputValues()->createMany([
            ['key' => 'yes', 'description' => 'Yes', 'order' => 1],
            ['key' => 'no', 'description' => 'No', 'order' => 2],
        ]);

        $q = Question::create([
            'title' => 'Do you know Emzi has a laboratory at the university?',
            'type' => 'feedback',
            'slug' => 'do_you_know_emzi_has_a_laboratory_at_the_university',
            'input_type' => 'radio',
            'is_predefined' => true,
            'order' => 9,
        ]);

        $q->inputValues()->createMany([
            ['key' => 'yes', 'description' => 'Yes', 'order' => 1],
            ['key' => 'no', 'description' => 'No', 'order' => 2],
        ]);

        $q = Question::create([
            'title' => 'Are Emzi Products Effective?',
            'type' => 'feedback',
            'slug' => 'are_emzi_products_effective',
            'input_type' => 'radio',
            'is_predefined' => true,
            'order' => 10,
        ]);

        $q->inputValues()->createMany([
            ['key' => 'yes_highly_effective', 'description' => 'Yes, Highly Effective', 'order' => 1],
            ['key' => 'less_effective', 'description' => 'Less Effective', 'order' => 2],
            ['key' => 'not_effective', 'description' => 'Not Effective', 'order' => 3],
        ]);

        $q = Question::create([
            'title' => 'Delivery Service',
            'type' => 'service',
            'slug' => 'delivery_service',
            'input_type' => 'star',
            'is_predefined' => true,
            'order' => 1,
        ]);

        $q = Question::create([
            'title' => 'Customer Service',
            'type' => 'service',
            'slug' => 'customer_service',
            'input_type' => 'star',
            'is_predefined' => true,
            'order' => 2,
        ]);

        $q = Question::create([
            'title' => 'Product Quality',
            'type' => 'service',
            'slug' => 'product_quality',
            'input_type' => 'star',
            'is_predefined' => true,
            'order' => 3,
        ]);

        $q = Question::create([
            'title' => 'Product Quantity',
            'type' => 'service',
            'slug' => 'product_quantity',
            'input_type' => 'star',
            'is_predefined' => true,
            'order' => 4,
        ]);


    }
}
