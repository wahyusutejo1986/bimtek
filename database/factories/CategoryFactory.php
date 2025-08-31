<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $businessCategories = [
            'Digital Transformation',
            'Business Intelligence',
            'Enterprise Security',
            'Project Management',
            'Financial Planning',
            'Human Resources',
            'Operations Management',
            'Strategic Planning',
            'Technology Solutions',
            'Risk Management',
            'Customer Relations',
            'Quality Assurance',
            'Compliance & Governance',
            'Innovation & R&D',
            'Supply Chain Management'
        ];

        $businessColors = [
            '#1E40AF', // Professional Blue
            '#059669', // Enterprise Green
            '#7C2D12', // Executive Brown
            '#4338CA', // Corporate Indigo
            '#B91C1C', // Alert Red
            '#0891B2', // Business Cyan
            '#7C3AED', // Strategic Purple
            '#DC2626', // Critical Red
            '#0D9488', // Success Teal
            '#1F2937', // Professional Gray
            '#6366F1', // Modern Indigo
            '#059669', // Growth Green
            '#DC2626', // Priority Red
            '#0284C7', // Trust Blue
            '#7C2D12'  // Stability Brown
        ];

        return [
            'title' => $this->faker->randomElement($businessCategories),
            'color' => $this->faker->randomElement($businessColors),
        ];
    }
}
