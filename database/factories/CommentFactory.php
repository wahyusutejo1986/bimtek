<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $businessComments = [
            'Excellent analysis of market trends and strategic implications for enterprise growth.',
            'This implementation strategy aligns perfectly with our operational objectives and KPIs.',
            'Outstanding insights into cost optimization and process efficiency improvements.',
            'The ROI projections demonstrate compelling value for stakeholder consideration.',
            'These best practices provide actionable guidance for our digital transformation initiative.',
            'Comprehensive risk assessment framework that addresses critical business requirements.',
            'Strategic approach to technology adoption with clear performance metrics and deliverables.',
            'This methodology offers significant potential for enhancing organizational productivity.',
            'Well-structured analysis of industry benchmarks and competitive positioning strategies.',
            'The compliance framework outlined here meets regulatory standards and governance requirements.',
            'Innovative solutions that drive sustainable growth and operational excellence.',
            'Data-driven recommendations that support evidence-based decision making processes.',
            'This approach to change management facilitates smooth implementation and user adoption.',
            'Robust security protocols that ensure enterprise-level protection and risk mitigation.',
            'Scalable architecture design that accommodates future growth and expansion requirements.',
            'Customer-centric strategies that enhance service delivery and satisfaction metrics.',
            'Financial modeling demonstrates strong business case with measurable returns on investment.',
            'Cross-functional collaboration framework that improves team efficiency and project outcomes.',
            'Quality assurance processes that maintain high standards and continuous improvement.',
            'Resource allocation strategy that optimizes budget utilization and cost management.',
            'Performance monitoring system provides real-time visibility into operational metrics.',
            'This vendor evaluation criteria ensures strategic partnership alignment with business goals.',
            'Comprehensive training program that supports professional development and skill enhancement.',
            'The governance structure establishes clear accountability and decision-making protocols.',
            'Market research insights that inform strategic planning and competitive positioning.',
            'Technology roadmap provides clear direction for infrastructure modernization initiatives.',
            'Supply chain optimization delivers cost savings and improved operational efficiency.',
            'Customer feedback integration enhances product development and service improvement.',
            'Regulatory compliance strategy addresses legal requirements and industry standards.',
            'Leadership development framework builds organizational capability and succession planning.'
        ];

        return [
            'comment' => $this->faker->randomElement($businessComments),
            'author_id' => $this->faker->numberBetween(1, 100),
            'post_id' => $this->faker->numberBetween(1, 1500),
        ];
    }
}
