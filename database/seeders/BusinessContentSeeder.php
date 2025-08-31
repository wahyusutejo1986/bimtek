<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Video;

class BusinessContentSeeder extends Seeder
{
    /**
     * Seed the application's database with realistic business content.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        DB::table('post_tag')->truncate();
        Comment::truncate();
        Image::truncate();
        Video::truncate();
        Post::truncate();
        Tag::truncate();
        Category::truncate();
        
        // Keep existing users but create additional business users for comprehensive dataset
        User::factory(100)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create business categories with specific professional categories
        $businessCategories = [
            ['title' => 'Digital Transformation', 'color' => '#1E40AF'],
            ['title' => 'Business Intelligence', 'color' => '#059669'],
            ['title' => 'Enterprise Security', 'color' => '#DC2626'],
            ['title' => 'Project Management', 'color' => '#7C3AED'],
            ['title' => 'Financial Planning', 'color' => '#0891B2'],
            ['title' => 'Human Resources', 'color' => '#059669'],
            ['title' => 'Operations Management', 'color' => '#6366F1'],
            ['title' => 'Strategic Planning', 'color' => '#7C2D12'],
            ['title' => 'Technology Solutions', 'color' => '#0284C7'],
            ['title' => 'Risk Management', 'color' => '#B91C1C']
        ];

        foreach ($businessCategories as $category) {
            Category::create($category);
        }

        // Create business tags
        $businessTags = [
            'Enterprise', 'Strategy', 'Analytics', 'ROI', 'KPI', 'Productivity', 'Innovation',
            'Growth', 'Performance', 'Security', 'Compliance', 'Leadership', 'Digital',
            'Cloud', 'Infrastructure', 'Automation', 'Optimization', 'Scalability',
            'Business Intelligence', 'Cost Reduction', 'Customer Success', 'Team Collaboration',
            'Risk Assessment', 'Operational Excellence', 'Strategic Planning', 'Best Practices',
            'Continuous Improvement', 'Process Management', 'Quality Assurance', 'Monitoring'
        ];

        foreach ($businessTags as $tag) {
            Tag::create(['title' => $tag]);
        }

        // Create realistic business posts
        $businessPosts = [
            [
                'title' => 'Enterprise Digital Transformation: A Strategic Roadmap for 2025',
                'content' => 'Organizations across industries are accelerating their digital transformation initiatives to remain competitive in an increasingly digital marketplace. Our comprehensive analysis of successful transformation programs reveals key strategies for technology adoption, change management, and ROI optimization. This roadmap provides actionable insights for executive leadership teams planning major digital initiatives.',
                'category_id' => 1,
                'author_id' => 1
            ],
            [
                'title' => 'Business Intelligence Analytics: Driving Data-Driven Decision Making',
                'content' => 'Modern enterprises require sophisticated analytics capabilities to extract actionable insights from complex data sets. Our business intelligence platform provides real-time reporting, predictive analytics, and performance dashboards that enable stakeholders to make informed strategic decisions. Implementation of these tools has demonstrated significant improvements in operational efficiency and competitive positioning.',
                'category_id' => 2,
                'author_id' => 2
            ],
            [
                'title' => 'Cybersecurity Framework Implementation for Enterprise Organizations',
                'content' => 'Enterprise-level security requires comprehensive frameworks that address evolving threat landscapes and regulatory compliance requirements. Our security assessment methodology incorporates industry best practices, risk evaluation protocols, and incident response procedures. Organizations implementing these frameworks report improved security posture and reduced vulnerability exposure.',
                'category_id' => 3,
                'author_id' => 3
            ],
            [
                'title' => 'Agile Project Management: Optimizing Team Performance and Delivery',
                'content' => 'Agile methodologies continue to demonstrate superior project outcomes compared to traditional waterfall approaches. Our analysis of cross-functional team performance reveals critical success factors including stakeholder engagement, iterative development cycles, and continuous feedback integration. These practices enable organizations to deliver high-quality solutions while maintaining flexibility and responsiveness to changing requirements.',
                'category_id' => 4,
                'author_id' => 4
            ],
            [
                'title' => 'Financial Planning and Budget Optimization for Sustainable Growth',
                'content' => 'Strategic financial planning requires comprehensive analysis of revenue projections, cost structures, and investment opportunities. Our budget optimization framework incorporates scenario modeling, risk assessment, and performance tracking to ensure sustainable growth trajectories. Organizations utilizing these methodologies achieve improved financial performance and enhanced stakeholder confidence.',
                'category_id' => 5,
                'author_id' => 5
            ],
            [
                'title' => 'Human Resources Management: Building High-Performance Teams',
                'content' => 'Effective talent management strategies are essential for organizational success in competitive markets. Our HR framework encompasses recruitment optimization, performance management systems, and professional development programs. These initiatives contribute to improved employee engagement, retention rates, and overall organizational capability.',
                'category_id' => 6,
                'author_id' => 6
            ],
            [
                'title' => 'Operations Excellence: Process Optimization and Quality Management',
                'content' => 'Operational excellence requires systematic approaches to process improvement, quality assurance, and efficiency optimization. Our methodology incorporates lean principles, continuous improvement frameworks, and performance monitoring systems. Implementation of these practices results in cost reduction, quality enhancement, and improved customer satisfaction metrics.',
                'category_id' => 7,
                'author_id' => 7
            ],
            [
                'title' => 'Strategic Planning Framework for Long-Term Business Success',
                'content' => 'Long-term strategic success requires comprehensive planning frameworks that address market dynamics, competitive positioning, and organizational capabilities. Our strategic planning methodology incorporates market analysis, scenario planning, and stakeholder alignment processes. Organizations implementing these frameworks demonstrate improved market performance and sustainable competitive advantages.',
                'category_id' => 8,
                'author_id' => 8
            ],
            [
                'title' => 'Cloud Infrastructure Migration: Best Practices and Implementation',
                'content' => 'Cloud migration initiatives require careful planning, risk assessment, and phased implementation strategies. Our migration framework addresses architecture design, data security, and performance optimization requirements. Organizations completing successful migrations report improved scalability, cost efficiency, and operational flexibility.',
                'category_id' => 9,
                'author_id' => 9
            ],
            [
                'title' => 'Enterprise Risk Management: Comprehensive Assessment and Mitigation',
                'content' => 'Effective risk management requires systematic identification, assessment, and mitigation of business risks across all operational areas. Our risk management framework incorporates industry standards, regulatory requirements, and best practice methodologies. Implementation of comprehensive risk programs enables organizations to protect assets, ensure compliance, and maintain business continuity.',
                'category_id' => 10,
                'author_id' => 10
            ]
        ];

        foreach ($businessPosts as $post) {
            Post::create($post);
        }

        // Generate additional posts using factories
        Post::factory(90)->create();

        // Generate business comments
        Comment::factory(500)->create();

        // Generate images and videos
        Image::factory(200)->create();
        Video::factory(50)->create();

        // Create post-tag relationships
        for ($i = 1; $i <= 100; $i++) {
            DB::table('post_tag')->insertOrIgnore([
                'post_id' => $i,
                'tag_id' => mt_rand(1, 30),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            // Add secondary tags for some posts
            if (mt_rand(1, 10) <= 7) {
                DB::table('post_tag')->insertOrIgnore([
                    'post_id' => $i,
                    'tag_id' => mt_rand(1, 30),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        $this->command->info('Business content seeded successfully!');
    }
}
