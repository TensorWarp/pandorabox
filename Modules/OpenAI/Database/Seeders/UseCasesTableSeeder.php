<?php

namespace Modules\OpenAI\Database\Seeders;


use Illuminate\Database\Seeder;

class UseCasesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('use_cases')->delete();
        
        \DB::table('use_cases')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Blog Ideas & Outlines',
                'description' => 'Brainstorm new blog posts topics that will engage readers and rank well on Google.',
                'slug' => 'blog-ideas-outlines',
                'prompt' => 'What are some great blog ideas and outline about: [[blog_idea]].',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Blog Post Writing',
                'description' => 'Write engaging introduction and section paragraphs for your blog.',
                'slug' => 'blog-post-writing',
                'prompt' => 'Please generate a blog post idea with the title of [[title]] that would be engaging, informative, and interesting for a general audience. The blog post should be approximately 1000 words long and should focus on [[topic]] topic.',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Story Writing',
                'description' => 'Write deliciously creative stories to engage your readers.',
                'slug' => 'story-writing',
                'prompt' => 'Please generate a story about [[story]]. the story must be realstic and get attention to reader.',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Google Ad Copy',
            'description' => 'High-quality pairs (Title & Description) of Google ad copy to drive more traffic.',
                'slug' => 'google-ad-copy',
                'prompt' => 'Please generate 15 set of Google Ads for a [[foofle_ad]]. The ads should be should highlight the key features, benefits, and unique selling points of the product or service',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Facebook Ad Copy',
                'description' => 'Create high-performing Facebook Ads to generate more leads.',
                'slug' => 'facebook-ad-copy',
                'prompt' => 'Please generate social media ads for [[facebook_ad]] and the the target audience is new generaton.',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Keyword Generator',
                'description' => 'Come up with related keywords, key phrases, and questions using AI writing assistant.',
                'slug' => 'keyword-generator',
                'prompt' => 'Please generate keyword about [[keyword_generator]] and the keyword should be real life content.',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Keyword Extractor',
                'description' => 'The ultimate SEO tool you\'ll need to research keywords that rank.',
                'slug' => 'keyword-extractor',
                'prompt' => 'Extract the top 10 keywords from the following text: [[keyword_extractor]].',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'SEO Meta Title & Details',
                'description' => 'Write SEO optimized title tags and meta descriptions that will rank well on Google.',
                'slug' => 'seo-meta-title-details',
                'prompt' => 'Write strong meta description for a page about [[seo_meta]]',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Marketing Copy & Strategies',
                'description' => 'Brainstorm different angles to add vibrancy to your marketing.',
                'slug' => 'marketing-copy-strategies',
                'prompt' => 'Write an article about marketing strategies for [[marketing_stratigy]] businesses. Include information on what marketing is, why it is important, and some effective marketing strategies that businesses can use',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Landing Page & Website Copy',
                'description' => 'Generate creative and persuasive copies for sections of your websites.',
                'slug' => 'landing-page-website-copy',
                'prompt' => 'Generate landing page content for a new product launch.The target audience [[audience]] and The product is a [[page]]. The landing page should highlight the features and benefits of the product, and encourage visitors to sign up for more information or make a purchase',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Amazon Product Outlines',
                'description' => 'Create product titles & descriptions according to Amazon’s guidelines. Grab your shopper\'s attention with branded ads.',
                'slug' => 'amazon-product-outlines',
                'prompt' => 'Please write a product description for [[product_name]]. The product should be described in a way that highlights its unique features, benefits, and the keyword should be in [[keyword]] . The tone of the description should be engaging and persuasive, with an emphasis on converting potential customers into buyers',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Product Description',
                'description' => 'Craft epic product descriptions to increase conversion for your eCommerce store.',
                'slug' => 'product-description',
                'prompt' => 'Please write a product description for [[product_name]]. The product should be described in a way that highlights its unique features, benefits, and the target audience is [[audience]]. the product description must include [[description]]',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Product Reviews & Responders',
                'description' => 'Write well detailed product reviews and thoughtful responses to customers.',
                'slug' => 'product-reviews-responders',
                'prompt' => 'Create 5 creative customer reviews for a product [[product_name]]. Product description is [[product_description]]',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'LinkedIn Profile Copy',
                'description' => 'A blend of creativity and professionalism to enrich your profile that captures attention.',
                'slug' => 'linkedin-profile-copy',
                'prompt' => 'Create a LinkedIn profile for a [[profession]]. Include a summary, education, and skills section. professional experince with [[experience]] years of experience Use [[skils]] relevant to the industry and position',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Personal Bio',
                'description' => 'Describe yourself effectively in a few words. Perfect to use while creating online profiles.',
                'slug' => 'personal-bio',
                'prompt' => 'Please write a brief bio for yourself that highlights your experience at [[experience]], skills of [[skils]], and accomplishments. Your bio should be written in the third person and be no longer than 900 words. Include information about your education and degree of [[education]], and other relevant details that would make you stand out to potential employers or clients',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Email Writing',
                'description' => 'Create professional emails for marketing, sales, engagement, & more in seconds.',
                'slug' => 'email-writing',
                'prompt' => 'Please write an email and the title of email must be [[title]]. The email should be described in a way that highlights its unique features, benefits, and the keyword should be in [[content]] . ',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Call to Action',
                'description' => 'Come up with creative and high converting CTAs for your ads, posts, landing pages, and more.',
                'slug' => 'call-to-action',
                'prompt' => 'Generate a call-to-action that is attention-grabbing and compelling for a [[content]]. The call-to-action should encourage the reader to take immediate action and include a sense of urgency',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Business Ideas & Strategies',
                'description' => 'Confused what business you should start or how to boost profit? Brainstorm here.',
                'slug' => 'business-ideas-strategies',
                'prompt' => 'Please generate at least 15 business idea. The business idea should focus on [[business_idea]] and the content must include [[keyword]]',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Brand Name',
                'description' => 'Give your new launches the perfect name without brainstorming in no time.',
                'slug' => 'brand-name',
                'prompt' => 'Please generate at least 10 brand name that would be suitable for a [[brand_name]] company. The brand should be memorable, catchy, and easy to pronounce. Please ensure that the brand name is unique and has not been registered or trademarked by any other company. The traget audinece is [[audience]] please provide a short description of why you think the brand name is a good fit for the company',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Tagline & Headline',
                'description' => 'Generate creative and catchy taglines and headlines for your profile, product, website, articles, and much more.',
                'slug' => 'tagline-headline',
                'prompt' => 'Generate 10 attention-grabbing headlines about [[headline]].',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Content Improver',
                'description' => 'Content writing assistant to simplify your writing and make it mistake-free. Best Grammarly alternative.',
                'slug' => 'content-improver',
                'prompt' => 'Please improve the [[improve]] text and correct any grammar mistakes',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Content Rephrase',
                'description' => 'Discover different ways to write the same thing. New words, new styles.',
                'slug' => 'content-rephrase',
                'prompt' => 'Please rephrase the [[rephrase]] text and correct any grammar mistakes',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Text Summarizer',
                'description' => 'This is hands down the best way to summarize any piece of content.',
                'slug' => 'text-summarizer',
                'prompt' => 'Please summarize the [[summarize]] text and correct any grammar mistakes',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Cover Letter',
                'description' => 'Create convincing resume and cover letter for job applications to stand.',
                'slug' => 'cv-resume-cover-letter',
                'prompt' => 'Please generate a cover letter for a candidate applying for a [[cover_letter]] position. The candidate id expert in [[skill]] , and is looking for an opportunity to improve',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Job Description',
                'description' => 'Create engaging job descriptions for any position to attract the best candidates.',
                'slug' => 'job-description',
                'prompt' => 'Please generate a job description for the position of [[job_description]]. This is for [[experience]] yeras of experience.  The job description should be detailed and accurate, and should include information about the company, the responsibilities and requirements of the position, and the qualifications and skills required for the role. Please also include any relevant information about the compensation and benefits package, as well as any opportunities for growth and advancement within the company',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Company Description',
                'description' => 'Sharp bios and communication to describe your company to the right people.',
                'slug' => 'company-description',
                'prompt' => 'Please generate a comapny description. The name of the company is [[company_name]]. This company works with [[company_task]]  The description should be detailed and accurate, and should include information about the company, the responsibilities, Please also include opportunities for growth and advancement within the company',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Questions & Answers',
                'description' => 'Come up with questions & answers for Quora, company knowledge base, and more.',
                'slug' => 'questions-answers',
                'prompt' => 'Please generate at least 10 questions and answers related to [[question_answer]]. and the answers should be accurate, well-researched, and supported by credible sources',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Interview Questions',
                'description' => 'Prepare thoughtful and interesting interview questions for any job, podcast, or show.',
                'slug' => 'interview-questions',
                'prompt' => 'Please generate 10 interview questions about [[interview_question]]. The question must include [[interview_question_content]]. The questions should be challenging enough to assess the candidate\'s skills, knowledge',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'AIDA Framework',
                'description' => 'Break down your content into Attention, Interest, Desire, Action.',
                'slug' => 'aida-framework',
                'prompt' => 'Write a persuasive marketing article on [[aida_content]]using the AIDA model. The article should grab the reader\'s Attention, build Interest by highlighting the features and benefits of the product, create Desire by emphasizing its unique selling proposition, and end with a strong Call-to-Action to encourage the reader to make a purchase.',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'PAS Framework',
                'description' => 'Specify the Pain points, find out how to Agitate & provide a Solution.',
                'slug' => 'pas-framework',
            'prompt' => 'Write a persuasive piece about the [[pas_content]] using the PAS (Problem-Agitate-Solution) model. Start by identifying a common problem that people face, and then agitate the problem by describing the negative consequences of not having a smartphone. Finally, present the solution by highlighting the specific ways in which smartphones can help solve the problem and improve people\'s lives',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Explain it to a Child',
                'description' => 'Rephrase text to a lower grade level make it more simple to understand and easier to read.',
                'slug' => 'explain-it-to-a-child',
                'prompt' => 'Please provide a simplified explanation of the following topic for a child and the topic is : [[child_content]]',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'SMS & Notifications',
                'description' => 'Generate creative and catchy notifications for your business that brings customers back.',
                'slug' => 'sms-notifications',
                'prompt' => 'Write a notification message to inform customers about [[notification]]. The notification must contain [[notification_content]] and will be available for a limited time only. Make sure to highlight the benefits of the discount and encourage customers to take advantage of it',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Tweet Generator',
                'description' => 'Generate tweets and threads using AI, that are relevant and on-trend.',
                'slug' => 'tweet-generator',
                'prompt' => 'Write a tweet about [[tweet]]. Make sure the tweet is relevent and relevent to current trend and must contenet 250 words with hash tags.',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Video Scripts',
                'description' => 'Create script outlines for your videos and tell a story.',
                'slug' => 'video-scripts',
                'prompt' => 'Please generate a video description. The video title about [[video_title]]. The video description should be attention-grabbing, informative, and persuasive, and should include [[video_content]] keywords and phrases.',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'YouTube Descriptions',
                'description' => 'Generate engaging titles and description for your youtube videos to get more views & subscribers.',
                'slug' => 'youtube-descriptions',
                'prompt' => 'Please generate a youtube video description. The video title about [[youtube_video_title]]. The youtube video description should be attention-grabbing, informative, and persuasive, and should include [[youtube_video_content]] keywords and phrases.',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'YouTube Ideas & Outlines',
                'description' => 'Let\'s take your vision ahead. Plan your YouTube journey with structured outlines.',
                'slug' => 'youtube-ideas-outlines',
                'prompt' => 'Write 15 youtube video ideas about [[youtube_video_idea]]',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Poetry',
                'description' => 'Write fun and creative poetry for outstanding impressions.',
                'slug' => 'poetry',
                'prompt' => 'Write a poem about [[poetry]], using rich and vivid imagery to capture the reader\'s imagination',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Ask Any Question',
                'description' => 'No need for search engines for the information you’re looking for.',
                'slug' => 'ask-any-question',
                'prompt' => 'Please give me the details answer about [[question]] this. The answer should be specific.',
                'creator_type' => 'admin',
                'creator_id' => 1,
                'status' => 'active',
            ),
        ));
        
        
    }
}