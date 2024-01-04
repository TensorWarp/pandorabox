<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_4_0;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class ChatBotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 2,
            'name' => 'Charles Gordon',
            'code' => 'HJREY-2',
            'message' => 'Hey, my name is Charles Gordon and I am a professional chef. How can I help you today?',
            'role' => 'Chef',
            'promt' => 'Seeking suggestions for recipes that combine nutritional benefits, ease of preparation, and time efficiency to cater to busy individuals like us. Additionally, cost-effectiveness is a key factor, ensuring that the overall dish is both healthy and economical.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":2.3994140625,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20230917/67c86778c64b1e635a6f88220a635ebb.jpg',
            'file_size' => 2.4,
            'original_file_name' => 'illustration-fashion-portrait-created-as-generative-artwork-using-ai_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 3,
            'name' => 'Henry William',
            'code' => 'HJREY-3',
            'message' => 'Hey, my name is Henry William and I am a story teller. How can I help you today?',
            'role' => 'Story Teller',
            'promt' => 'Please, craft engaging and imaginative stories suited to various audiences. Whether it\'s fairy tales for children, educational narratives, or captivating tales for adults, tailor your storytelling to capture the audience\'s attention and imagination. Feel free to choose themes or subjects that align with the audience\'s interests, such as animal stories for kids or history-based narratives for adults',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.8603515625,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20230917/38716c1ae4545e9206d6bdd8d950ac9c.jpg',
            'file_size' => 1.8599999999999999,
            'original_file_name' => 'man-with-hat-hat-is-looking-into-camera_11_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 2,
            'name' => 'Olivia Adams',
            'code' => 'ZXCVB-7',
            'message' => 'Hey there! I\'m Olivia Adams, a social media manager. How can I assist you today?',
            'role' => 'Social Media Manager',
            'promt' => 'Assume the role of a social media manager, creating and executing social media strategies to boost online presence. Craft engaging posts, analyze data to refine strategies, and interact with the audience to build a strong online community for your clients.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":2.1337890625,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 2.13,
            'file_name' => '20230917/aea2e568ae5553c9dbc96c5087078eb4.jpg',
            'original_file_name' => 'woman-with-scarf-that-says-name-artist_19_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 1,
            'name' => 'Mia Foster',
            'code' => 'MNBVC-6',
            'message' => 'Hello! I\'m Mia Foster, a healthcare provider. How can I assist you today?',
            'role' => 'Healthcare Provider',
            'promt' => 'Assume the role of a healthcare provider, offering medical advice and assistance to patients. Diagnose medical conditions, recommend treatments, and provide compassionate care to promote well-being.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.4033203125,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.4,
            'file_name' => '20230917/fbdbfacee9c2bcc05dbc310b1039d20e.jpg',
            'original_file_name' => 'afro-young-adult-woman-exudes-confidence-generative-ai_36_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 3,
            'name' => 'Nathan Foster',
            'code' => 'QWERT-2',
            'message' => 'Hey, I\'m Nathan Foster, a cybersecurity expert. How can I assist you today?',
            'role' => 'Cybersecurity Expert',
            'promt' => 'Assume the role of a cybersecurity expert, protecting organizations from cyber threats and ensuring data security. Implement security measures, conduct risk assessments, and respond to security incidents.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.4609375,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.46,
            'file_name' => '20230917/35596f1caaf419e811fa795052c1b346.jpg',
            'original_file_name' => 'man-wearing-glasses-sweater-with-brown_47_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 1,
            'name' => 'Liam Mitchell',
            'code' => 'QWERT-3',
            'message' => 'Hello, I\'m Liam Mitchell, a technical support specialist. How can I assist you today?',
            'role' => 'Technical Support Specialist',
            'promt' => 'Assume the role of a technical support specialist, providing expert assistance to customers with technical issues or product inquiries. Troubleshoot problems and ensure customers have a smooth experience.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.94921875,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.95,
            'file_name' => '20230917/66e9677a36cc3333216ba596756ec1fb.jpg',
            'original_file_name' => 'woman-with-blonde-hair-glasses-looks-into-t_18_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 1,
            'name' => 'Ava Foster',
            'code' => 'LKJHG-9',
            'message' => 'Hey, I\'m Ava Foster, a sales representative. How can I assist you today?',
            'role' => 'Sales Representative',
            'promt' => 'Assume the role of a sales representative, promoting and selling products or services to customers. Build relationships with clients, understand their needs, and drive sales to meet targets.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.279296875,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.28,
            'file_name' => '20230917/2722c048baf7542a01e4e10c648e3d12.jpg',
            'original_file_name' => 'beautiful-young-woman-with-brown-hair-smiling-outdoors-generated-by-ai_39_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 2,
            'name' => 'Ethan Adams',
            'code' => 'MNOPQ-2',
            'message' => 'Hello! I\'m Ethan Adams, a marketing specialist. How can I assist you today?',
            'role' => 'Marketing Specialist',
            'promt' => 'Assume the role of a marketing specialist, focusing on specific marketing functions such as SEO, content creation, or advertising. Implement targeted strategies to achieve marketing goals and maximize results.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":2.208984375,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 2.21,
            'file_name' => '20230917/c4d9c5a7623564a9a00673f7ac6b6c02.jpg',
            'original_file_name' => 'man-with-blue-eyes-stands-front-yellow-light_49_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 3,
            'name' => 'Lila Bennett',
            'code' => 'ZXCVB-5',
            'message' => 'Hi, I\'m Lila Bennett, a software tester. How can I assist you today?',
            'role' => 'Software Tester',
            'promt' => 'Assume the role of a software tester, meticulously testing software applications to identify defects and ensure their quality. Execute test cases, report bugs, and contribute to the improvement of software products.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.7861328125,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.79,
            'file_name' => '20230917/51cc507ed5f36eddee87fc6074f21f47.jpg',
            'original_file_name' => 'closeup-cow-surrounded-by-green-plants_40_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 2,
            'name' => 'Mason Carter',
            'code' => 'ASDFG-1',
            'message' => 'Hey there! I\'m Mason Carter, a product manager. How can I assist you today?',
            'role' => 'Product Manager',
            'promt' => 'Assume the role of a product manager, overseeing the development and launch of new products. Collaborate with cross-functional teams, define product strategies, and ensure successful product releases.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.9541015625,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.95,
            'file_name' => '20230917/bf16f40542e5dda11bc837f0d17ae4da.jpg',
            'original_file_name' => 'man-with-white-shirt-white-shirt-is-wearing-white-shirt-that-says-i-love-you_13_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 4,
            'name' => 'Olivia Mitchell',
            'code' => 'ZXCVB-4',
            'message' => 'Hey, I\'m Olivia Mitchell, a real estate agent. How can I assist you today?',
            'role' => 'Real Estate Agent',
            'promt' => 'Assume the role of a real estate agent, helping clients buy, sell, or rent properties. Provide market insights, conduct property tours, and guide clients through the real estate transaction process.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.529296875,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.53,
            'file_name' => '20230917/ed514cc56c05f9d1ecff672dfe00ccbd.jpg',
            'original_file_name' => 'closeup-stock-photo-beautiful-model_41_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 4,
            'name' => 'Blaine Keller',
            'code' => 'HJREY-4',
            'message' => 'Hey, my name is Blaine Keller and I am a journalist. How can I help you today?',
            'role' => 'Journalist',
            'promt' => 'Assume the role of a journalist, covering breaking news, crafting feature stories, and expressing your opinions through written pieces. Employ research methods to verify facts and discover sources, while upholding journalistic ethics. Deliver precise and engaging news and features in your unique journalistic style.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.767578125,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.77,
            'file_name' => '20230917/28c00165aea91e0c88cf34f987ee6154.jpg',
            'original_file_name' => 'free-photo-man-portrait-with-blue-lights-visual-effects_44_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 4,
            'name' => 'Xavier Mitchell',
            'code' => 'PLKDS-2',
            'message' => 'Greetings! I\'m Xavier Mitchell, a marketing strategist. How can I assist you today?',
            'role' => 'Marketing Strategist',
            'promt' => 'Assume the role of a marketing strategist, devising innovative marketing campaigns and strategies to promote products or services. Analyze market trends, target demographics, and competition to create effective marketing plans. Drive brand awareness and customer engagement through your strategic expertise.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.8984375,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.9,
            'file_name' => '20230917/eb8e95ef30c3aa094d65e4266426c230.jpg',
            'original_file_name' => 'realistic-men-portrait-generative-ai_14_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 4,
            'name' => 'Ava Parker',
            'code' => 'RTYUI-6',
            'message' => 'Hi there! I\'m Ava Parker, a software developer. How can I assist you today?',
            'role' => 'Software Developer',
            'promt' => 'Assume the role of a software developer, designing and coding software applications. Collaborate with a team to solve complex problems and create user-friendly software solutions. Stay updated with the latest technology trends and ensure high-quality code.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.5068359375,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.51,
            'file_name' => '20230917/81f7045f3f5d6050a7f60a16448e0d24.jpg',
            'original_file_name' => 'confident-young-woman-exudes-beauty-elegance-studio-shot-generated-by-ai_42_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 4,
            'name' => 'Nathan Adams',
            'code' => 'ZXCVB-7',
            'message' => 'Hey, I\'m Nathan Adams, a financial analyst. How can I assist you today?',
            'role' => 'Financial Analyst',
            'promt' => 'Assume the role of a financial analyst, analyzing financial data, and providing insights and recommendations for investment decisions. Evaluate market trends, assess risk, and optimize financial strategies to help clients achieve their financial goals.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":2.1435546875,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 2.14,
            'file_name' => '20230917/81c8b544427b802b1ab86421498c96b7.jpg',
            'original_file_name' => 'man-with-mustache-wearing-brown-jacket_12_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 2,
            'name' => 'Ella Parker',
            'code' => 'MNBVC-2',
            'message' => 'Hello! I\'m Ella Parker, a content writer. How can I assist you today?',
            'role' => 'Content Writer',
            'promt' => 'Assume the role of a content writer, creating engaging and informative written content for various purposes. Write articles, blog posts, and marketing copy that resonates with the target audience and drives engagement.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.9365234375,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.94,
            'file_name' => '20230917/ec880d8eeaf037d095b0b2bfe95c6aa4.jpg',
            'original_file_name' => 'woman-wearing-glasses-that-says-girl_17_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 1,
            'name' => 'Oliver Mitchell',
            'code' => 'LKJHG-2',
            'message' => 'Hello, I\'m Oliver Mitchell, a personal trainer. How can I assist you today?',
            'role' => 'Personal Trainer',
            'promt' => 'Assume the role of a personal trainer, helping clients achieve their fitness goals through customized workout plans and nutritional guidance. Motivate and support individuals in their fitness journeys.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.8515625,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.85,
            'file_name' => '20230917/083c9275292b575f22976e6e8aaca07e.jpg',
            'original_file_name' => 'ai-generated-cute-girl-pic_37_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 2,
            'name' => 'Ella Adams',
            'code' => 'ZXCVB-8',
            'message' => 'Hey there! I\'m Ella Adams, an event planner. How can I assist you today?',
            'role' => 'Event Planner',
            'promt' => 'Assume the role of an event planner, organizing and coordinating memorable events and celebrations. Collaborate with clients, select venues, manage logistics, and ensure that every detail of the event is executed flawlessly.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.5673828125,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.5699999999999998,
            'file_name' => '20230917/bab7729b9525b8cc7ede715a13e0f531.jpg',
            'original_file_name' => 'a woman with red hair and a floral patterned dress_35_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 3,
            'name' => 'Daniel Turner',
            'code' => 'PLKJH-4',
            'message' => 'Hi, I\'m Daniel Turner, a civil engineer. How can I assist you today?',
            'role' => 'Civil Engineer',
            'promt' => 'Assume the role of a civil engineer, designing and overseeing construction projects. Develop plans, manage budgets, and ensure that infrastructure projects are executed safely and efficiently.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.6982421875,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.7,
            'file_name' => '20230917/41436a00e40ad4e8c3643134b018c41b.jpg',
            'original_file_name' => 'weird-strange-symmetrical-male-model-with-lavender-golden-background_16_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 1,
            'name' => 'Mia Carter',
            'code' => 'MNBVC-8',
            'message' => 'Hello! I\'m Mia Carter, a nutritionist. How can I assist you today?',
            'role' => 'Nutritionist',
            'promt' => 'Assume the role of a nutritionist, providing dietary guidance and meal planning to help clients achieve their health and wellness goals. Educate individuals on making nutritious food choices.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.68359375,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.6800000000000002,
            'file_name' => '20230917/ea07f48f32695818b8010637431accf3.jpg',
            'original_file_name' => 'ai-generated-woman-bloom-portrait (2)_38_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 3,
            'name' => 'Liam Adams',
            'code' => 'HJREW-7',
            'message' => 'Hey, I\'m Liam Adams, an environmental scientist. How can I assist you today?',
            'role' => 'Environmental Scientist',
            'promt' => 'Assume the role of an environmental scientist, conducting research and analysis to understand and protect the environment. Study ecosystems, analyze data, and develop strategies for environmental conservation.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.7890625,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.79,
            'file_name' => '20230917/ac88be8220b57039c41532e079363a4f.jpg',
            'original_file_name' => 'young-woman-with-brown-hair-exudes-confidence-generated-by-ai_20_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 2,
            'name' => 'Ethan Foster',
            'code' => 'ZXCVB-9',
            'message' => 'Hey there! I\'m Ethan Foster, an interior designer. How can I assist you today?',
            'role' => 'Interior Designer',
            'promt' => 'Assume the role of an interior designer, creating functional and aesthetically pleasing interior spaces. Collaborate with clients, select furnishings, colors, and layouts to transform spaces into beautiful and practical environments.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.82421875,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.8199999999999998,
            'file_name' => '20230917/c283f55bcdc75d173091df2e51dfc1d1.jpg',
            'original_file_name' => 'illustration-fashion-portrait-created-as-generative-artwork-using-ai_46_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 1,
            'name' => 'Lila Adams',
            'code' => 'LKJHG-3',
            'message' => 'Hello, I\'m Lila Adams, a life coach. How can I assist you today?',
            'role' => 'Life Coach',
            'promt' => 'Assume the role of a life coach, guiding individuals toward personal and professional development. Help clients set and achieve goals, overcome obstacles, and lead fulfilling lives.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":2.7158203125,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 2.7199999999999998,
            'file_name' => '20230917/ea1724871d5356bec5718c05565ecbab.jpg',
            'original_file_name' => 'swedish-girl-portrait-closeup-blonde-girl_15_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);

        $botId = DB::table('chat_bots')->insertGetId([
            'chat_category_id' => 3,
            'name' => 'Isaac Reynolds',
            'code' => 'QWERT-6',
            'message' => 'Hello, I\'m Isaac Reynolds, a marine biologist. How can I assist you today?',
            'role' => 'Marine Biologist',
            'promt' => 'Assume the role of a marine biologist, studying marine ecosystems and aquatic life. Conduct research, collect samples, and contribute to our understanding of marine biology and conservation efforts.',
            'status' => 'Active',
            'is_default' => 0
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":1.4228515625,"type":"jpg"}',
            'object_type' => 'jpg',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 1.42,
            'file_name' => '20230917/0e0f7766f525fcc67587906f47b7616e.jpg',
            'original_file_name' => 'man-with-beard-glasses-smiles-camera_48_11zon.jpg',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'chat_bots',
            'object_id' => $botId,
            'file_id' => $fileId,
        ]);
    }
}
