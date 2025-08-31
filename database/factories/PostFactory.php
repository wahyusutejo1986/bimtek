<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $businessTitles = [
            'Streamlining Digital Transformation in Modern Enterprises',
            'Best Practices for Cloud Migration and Infrastructure Optimization',
            'Enhancing Team Collaboration Through Advanced Workflow Management',
            'Data-Driven Decision Making: Analytics That Drive Results',
            'Cybersecurity Frameworks for Enterprise-Level Protection',
            'Scaling Business Operations: Lessons from Industry Leaders',
            'ROI Optimization Strategies for Technology Investments',
            'Building Resilient Business Continuity Plans',
            'Customer Experience Excellence in Digital Age',
            'Implementing AI Solutions for Business Process Automation',
            'Financial Planning and Budget Allocation for Growth',
            'Remote Work Management: Tools and Best Practices',
            'Supply Chain Optimization in Global Markets',
            'Sustainable Business Practices and ESG Compliance',
            'Leadership Development in Rapidly Changing Markets',
            'Digital Marketing Strategies for B2B Success',
            'Quality Assurance and Performance Monitoring Systems',
            'Vendor Management and Strategic Partnership Development',
            'Regulatory Compliance in Highly Regulated Industries',
            'Innovation Management and R&D Investment Strategies'
        ];

        $businessContent = [
            'In today\'s competitive landscape, organizations must leverage advanced technologies and strategic frameworks to maintain operational excellence. Our comprehensive analysis reveals key insights into market trends, performance metrics, and growth opportunities that drive sustainable business success.',
            'Recent studies demonstrate that companies implementing integrated business management platforms experience significant improvements in productivity, cost reduction, and stakeholder satisfaction. These findings highlight the importance of strategic technology adoption in modern enterprise environments.',
            'Through careful evaluation of industry best practices and performance benchmarks, we have identified critical success factors that enable organizations to achieve their strategic objectives. This research provides actionable recommendations for business leaders and decision-makers.',
            'Market analysis indicates substantial growth opportunities for enterprises that embrace digital transformation initiatives. Our methodology incorporates comprehensive data collection, statistical modeling, and strategic planning frameworks to deliver measurable business outcomes.',
            'Effective risk management and compliance strategies are essential components of sustainable business operations. Organizations that implement robust governance frameworks demonstrate superior performance across key operational and financial metrics.',
            'Cross-functional collaboration and stakeholder engagement are fundamental drivers of organizational success. Our research highlights proven strategies for optimizing team performance, communication effectiveness, and project delivery capabilities.',
            'Investment in technology infrastructure and human capital development yields significant returns for forward-thinking organizations. Comprehensive analysis of cost-benefit scenarios provides clear guidance for strategic resource allocation and budget planning.',
            'Continuous improvement methodologies and performance optimization frameworks enable enterprises to maintain competitive advantages in dynamic market conditions. These approaches support long-term growth and operational sustainability.',
            'Customer relationship management and service excellence initiatives contribute directly to revenue growth and market share expansion. Strategic implementation of CRM platforms and support systems enhances customer retention and satisfaction metrics.',
            'Data governance and information security protocols are critical requirements for enterprise-level operations. Organizations must implement comprehensive security frameworks to protect sensitive information and maintain regulatory compliance standards.'
        ];

        return [
            'title' => $this->faker->randomElement($businessTitles),
            'content' => $this->faker->randomElement($businessContent),
            'author_id' => $this->faker->numberBetween(1, 100),
            'category_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
