<?php

namespace Database\Factories;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resource>
 */
class ResourceFactory extends Factory
{
    protected $model = Resource::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $resources = [
            [
                'title'       => 'Laravel Documentation',
                'url'         => 'https://laravel.com/docs',
                'category'    => 'Backend',
                'description' => 'The official Laravel PHP framework documentation. Covers routing, Eloquent ORM, Blade templates, queues, and more.',
                'tags'        => ['laravel', 'php', 'backend', 'framework'],
            ],
            [
                'title'       => 'Supabase Dashboard',
                'url'         => 'https://supabase.com',
                'category'    => 'Backend',
                'description' => 'Open source Firebase alternative with a Postgres database, Authentication, instant APIs, Edge Functions, and Realtime subscriptions.',
                'tags'        => ['supabase', 'postgres', 'database', 'baas'],
            ],
            [
                'title'       => 'Tailwind CSS',
                'url'         => 'https://tailwindcss.com',
                'category'    => 'Frontend',
                'description' => 'A utility-first CSS framework packed with classes that can be composed to build any design, directly in your markup.',
                'tags'        => ['tailwind', 'css', 'frontend', 'utility'],
            ],
            [
                'title'       => 'daisyUI Components',
                'url'         => 'https://daisyui.com',
                'category'    => 'Design',
                'description' => 'The most popular Tailwind CSS component library. Free, open-source, and packed with beautiful UI components.',
                'tags'        => ['daisyui', 'components', 'tailwind', 'ui'],
            ],
            [
                'title'       => 'Lucide Icons',
                'url'         => 'https://lucide.dev',
                'category'    => 'Design',
                'description' => 'Beautiful and consistent open-source icon library. A community-maintained fork of Feather Icons.',
                'tags'        => ['icons', 'svg', 'design', 'open-source'],
            ],
            [
                'title'       => 'Vercel Platform',
                'url'         => 'https://vercel.com',
                'category'    => 'DevOps',
                'description' => 'Develop, preview, and ship. The leading platform for frontend frameworks and static sites, with edge functions and analytics.',
                'tags'        => ['vercel', 'deploy', 'hosting', 'serverless'],
            ],
            [
                'title'       => 'React Documentation',
                'url'         => 'https://react.dev',
                'category'    => 'Frontend',
                'description' => 'The library for web and native user interfaces. Learn React fundamentals including components, hooks, and concurrent features.',
                'tags'        => ['react', 'javascript', 'frontend', 'ui'],
            ],
            [
                'title'       => 'OpenAI API Reference',
                'url'         => 'https://platform.openai.com/docs',
                'category'    => 'AI',
                'description' => 'Integrate GPT-4, DALL·E, Whisper, and more into your applications with the OpenAI API. Complete reference and guides.',
                'tags'        => ['openai', 'gpt', 'ai', 'api'],
            ],
            [
                'title'       => 'Docker Documentation',
                'url'         => 'https://docs.docker.com',
                'category'    => 'DevOps',
                'description' => 'Learn how to build, share, and run containerized applications. Covers Docker Engine, Compose, and Swarm.',
                'tags'        => ['docker', 'containers', 'devops', 'deployment'],
            ],
            [
                'title'       => 'Figma Design Tool',
                'url'         => 'https://figma.com',
                'category'    => 'Design',
                'description' => 'Collaborative interface design tool used by teams worldwide. Design, prototype, and hand off — all in the browser.',
                'tags'        => ['figma', 'design', 'prototyping', 'ui-ux'],
            ],
            [
                'title'       => 'Next.js by Vercel',
                'url'         => 'https://nextjs.org',
                'category'    => 'Frontend',
                'description' => 'The React framework for the web. Server-side rendering, static generation, API routes, and edge middleware built in.',
                'tags'        => ['nextjs', 'react', 'ssr', 'framework'],
            ],
            [
                'title'       => 'Hugging Face Models',
                'url'         => 'https://huggingface.co',
                'category'    => 'AI',
                'description' => 'The AI community building the future. Discover, share, and deploy machine learning models, datasets, and demos.',
                'tags'        => ['huggingface', 'ml', 'models', 'ai'],
            ],
        ];

        $resource = fake()->unique()->randomElement($resources);

        return [
            'user_id'     => \App\Models\User::first()->id ?? \App\Models\User::factory(),
            'title'       => $resource['title'],
            'url'         => $resource['url'],
            'category'    => $resource['category'],
            'description' => $resource['description'],
            'tags'        => $resource['tags'],
            'is_favorite' => fake()->boolean(35),
        ];
    }
}
