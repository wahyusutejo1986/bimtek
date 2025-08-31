<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $businessTags = [
            'Enterprise',
            'Strategy',
            'Analytics',
            'Optimization',
            'ROI',
            'KPI',
            'Productivity',
            'Efficiency',
            'Innovation',
            'Growth',
            'Performance',
            'Quality',
            'Security',
            'Compliance',
            'Governance',
            'Leadership',
            'Management',
            'Process',
            'Workflow',
            'Automation',
            'Digital',
            'Technology',
            'Cloud',
            'Infrastructure',
            'Platform',
            'Integration',
            'Scalability',
            'Reliability',
            'Monitoring',
            'Reporting',
            'Business Intelligence',
            'Data Analysis',
            'Cost Reduction',
            'Revenue Growth',
            'Customer Success',
            'Team Collaboration',
            'Project Delivery',
            'Risk Assessment',
            'Best Practices',
            'Industry Standards',
            'Continuous Improvement',
            'Operational Excellence',
            'Strategic Planning',
            'Resource Management',
            'Performance Metrics',
            'Business Process',
            'Enterprise Solutions',
            'Professional Services',
            'Consulting',
            'Implementation'
        ];

        return [
            'title' => $this->faker->randomElement($businessTags),
        ];
    }
}
