<?php

namespace Modules\OpenAI\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('contents')->delete();

        DB::table('contents')->insert(array (
            0 =>
            array (
                'id' => 2,
                'parent_id' => NULL,
                'user_id' => 2,
                'use_case_id' => 3,
                'title' => 'A story about how hard work can change your fate',
                'slug' => 'a-story-about-how-hard-work-can-change-your-fate',
                'promt' => 'Please generate a story about A story about how hard work can change your fate. the story must be realstic and get attention to reader.',
                'content' => '

                Once upon a time, there was a young boy named Joe who had to help his family financially. Joe had a tough life as he did not have enough money to support his family and had to do odd jobs in order to make ends meet.

                One day, Joe heard about a job opportunity at a local warehouse and decided to apply. He was determined that he could do whatever was required and made sure to be the last person on the interview list.

                When his turn came, the boss asked Joe why he came so late. Joe replied with honesty, saying “Sir, I’m here so late because this is my one chance of becoming somebody in this world. I don’t want to miss it ”. After hearing this, the Boss hired him on the spot without even asking any questions.

                Joe worked really hard and overtime at the warehouse, doing whatever it took to help his family. At first, Joe was treated badly by other workers as they did not consider him serious enough but with hard work and determination, he gained their respect. Over time, Joe was promoted to supervisor and eventually became one of the most valuable employees at the warehouse.

                Now, Joe is able to support his family and lives a comfortable life. Whenever people asked him how he achieved success, he always answered with the same wise words: “Hard work can change your fate”.

                The moral of this story is that hard work and dedication can help you to reach great heights if you don\'t give up on your dreams.',
                'tokens' => 361,
                'words' => 266,
                'characters' => 1430,
                'model' => 'text-davinci-003',
                'language' => 'English',
                'tone' => 0.0,
                'creativity_label' => 1.0,
            ),
            1 =>
            array (
                'id' => 7,
                'parent_id' => NULL,
                'user_id' => 2,
                'use_case_id' => 2,
                'title' => 'Hello Ms Maya,Story about single old girl',
                'slug' => 'hello-ms-mayastory-about-single-old-girl',
                'promt' => 'Please generate a blog post idea with the title of Hello Ms Maya that would be engaging, informative, and interesting for a general audience. The blog post should be approximately 1000 words long and should focus on Story about single old girl topic.',
                'content' => '

                Hello Ms. Maya: A Story About A Single Older Woman

                We’ve all heard the phrase “diamond in the rough,” and never is it more apt than when referring to Ms. Maya, a single older woman shortly out of a relationship of many years. Despite her difficult situation, and at times overwhelming pain and heartache, Ms. Maya perseveres through it all, defeating the odds at every turn.

                Ms. Maya is an 82-year-old woman born in the Philippines to an aristocratic family. She has lived a life of privilege and came to America when she married her husband of 57 years, a successful businessman with whom she raised three children.

                The loss of her partner marks a period of deep reflection for Ms. Maya after decades of giving so much to her family without taking any time for herself. After considering many options, she decided to move into a small condo in a town 65 miles away from where her children, all spread across the United States, live.

                Living alone does not seem to worry Ms. Maya too much as she is surrounded by family yet has enough independence to do what she wants when she wants to do it, like taking a dip in the pool on sunny afternoons or cooking up her favorite Filipino dishes to share with friends and neighbors over meals. She is always quick to offer advice, always saying “treat others how you want to be treated” and “act with respect for yourself and others” no matter the circumstances or how she may feel about them at the moment.

                Her sense of adventure seems ever-growing; whether it be trying new hobbies or starting a dog walking business, taking a business course or joining a yoga class, there’s nothing that scares her away from embracing opportunities presented to her. Ms. Maya continues to stay in touch with her family regularly and relishes any time spent with them during the few occasions when they are able to congregate together at holidays or special occasions.

                Ms. Maya is an immense example of what a strong willed woman can do when faced with seemingly insurmountable obstacles that life may throw at them. Her resilience and fortitude to face life head on with grace is something that everyone can learn from. It is because of inspiring individuals like Ms. Maya that we are ever motivated to be better versions of ourselves.

                Ms. Maya continues',
                'tokens' => 562,
                'words' => 402,
                'characters' => 2313,
                'model' => 'text-davinci-003',
                'language' => 'English',
                'tone' => 0.0,
                'creativity_label' => 1.0,
            ),
            2 =>
            array (
                'id' => 10,
                'parent_id' => NULL,
                'user_id' => 2,
                'use_case_id' => 12,
                'title' => 'Scented candles,Women, Girls,Benefits of burning scented candles in your home!',
                'slug' => 'scented-candleswomen-girlsbenefits-of-burning-scen',
                'promt' => 'Please write a product description for Scented candles. The product should be described in a way that highlights its unique features, benefits, and the target audience is Women, Girls. the product description must include Benefits of burning scented candles in your home!',
                'content' => '

                Scented Candles: Aromatic Bliss for Women and Girls!

                Are you looking for something to add a little extra flare to your home? Look no further than scented candles! These delightful candles come in a variety of delightful scents, perfect for any occasion. Whether you’re looking to create a romantic atmosphere or just want to add a little extra ambience to your home, scented candles are the perfect choice.

                Scented candles are a great way to add a touch of luxury and relaxation to any home. They come in a range of sizes and styles, so you can find the perfect candle to fit your space. Whether you’re looking for something small and subtle, or something more grand and luxurious, scented candles can be tailored to fit your needs.

                Not only do scented candles look great, but they also provide some amazing benefits. Burning scented candles can help reduce stress and anxiety, as well as improve your mood. The pleasant aromas can help you relax and unwind after a long day. Plus, the combination of light and scent can create a calming atmosphere that’s perfect for winding down at night.

                So if you’re looking for something special to add to your home, look no further than scented candles! They’re perfect for women and girls of all ages, offering a touch of luxury and relaxation that’s sure to make any home feel more inviting. So why not give them a try today?',
                'tokens' => 377,
                'words' => 246,
                'characters' => 1384,
                'model' => 'text-davinci-003',
                'language' => 'English',
                'tone' => 0.0,
                'creativity_label' => 0.5,
            ),
            3 =>
            array (
                'id' => 11,
                'parent_id' => NULL,
                'user_id' => 2,
                'use_case_id' => 15,
                'title' => 'Almost 8 months,JAVA, Operating System, Java Script, React Js, Laravel, PHP, HTML, Python, CSS, JQuery,Bsc in Computer Science & Engineering',
                'slug' => 'almost-8-monthsjava-operating-system-java-script-r',
                'promt' => 'Please write a brief bio for yourself that highlights your experience at Almost 8 months, skills of JAVA, Operating System, Java Script, React Js, Laravel, PHP, HTML, Python, CSS, JQuery, and accomplishments. Your bio should be written in the third person and be no longer than 900 words. Include information about your education and degree of Bsc in Computer Science & Engineering, and other relevant details that would make you stand out to potential employers or clients',
                'content' => ', Professional and Joyful

                David Smith is a highly motivated and dedicated Computer Science & Engineering graduate, with 8 months of extensive experience the field. He is an Expert in JAVA, Operating System, Java Script, React Js, Laravel, PHP, HTML, Python, CSS and JQuery and have gained professional expertise in these technologies.

                Having completed his Bsc in Computer Science & Engineering from Harvard University’s School of Engineering with a focus in Software Development & Design, he has gained the academic ability to work on different areas relevant to computer science.

                David’s hands on experience in software development and debugging solidifies his proficiency in developing customized software applications. He has also demonstrated expertise in Web Development and has built projects using HTML/CSS/Javascript/Jquery/PHP/Laravel/React JS. His background in Java allows him to develop feature-rich and robust applications from scratch. In addition his skills in OS provide him with theoretical as well as practical knowledge of system administrating servers.

                He is currently working as a web developer for an IT firm and has built several web Applications from start to finish for the company. He is currently part of an ongoing project with the local government, to develop an Application which would track land records and titles online for every property in town. His contributions include aligning Database architecture with the front end development activities.

                David is truly driven by his passion for creating and designing full stack applications which he believes make the world a better place. In the past few years he has been working with different organisations devoted to creating social awareness messages through technology and he’s looking forward to implementing them by working with key professionals in larger organisations

                He continues to keep himself updated on the latest technologies, programming practices and coding standards through online courses and educational seminars. David also continuously upskill himself by participating in global coding challenges which further enhance his skillset. He is an active participant in hackathons worldwide, which help him challenge himself while honing his professional game.

                In summary, David offers a wealth of technical expertise combined with a sincere dedication towards quality work that enables him to deliver high caliber results within challenging timelines. He is willing to continue developing himself further as a professional engineer, leaving no stones unturned in obtaining advanced knowledge and experience in this ever-changing industry.',
                'tokens' => 594,
                'words' => 392,
                'characters' => 2651,
                'model' => 'text-davinci-003',
                'language' => 'English',
                'tone' => 0.0,
                'creativity_label' => 1.0,
            ),
            4 =>
            array (
                'id' => 12,
                'parent_id' => NULL,
                'user_id' => 2,
                'use_case_id' => 18,
                'title' => 'About Juice bar,Fresh Fruits, Coffee, Boba Tea, Jelly ',
                'slug' => 'about-juice-barfresh-fruits-coffee-boba-tea-jelly',
                'promt' => 'Please generate at least 15 business idea. The business idea should focus on About Juice bar and the content must include Fresh Fruits, Coffee, Boba Tea, Jelly ',
                'content' => '

                1. Fresh Juice Bar: A juice bar that specializes in freshly squeezed juices, smoothies, and shakes made from fresh fruits.

                2. Coffee and Juice Bar: A combination coffee and juice bar that offers a variety of coffee and juice drinks, as well as snacks.

                3. Boba Tea Bar: A boba tea bar that specializes in bubble tea drinks made with fresh fruits, tapioca pearls, and sweetened milk.

                4. Fruit Ice Cream Bar: An ice cream bar that specializes in creating unique ice cream flavors made with fresh fruits.

                5. Fruit Smoothie Bar: A smoothie bar that specializes in creating unique smoothies made with fresh fruits.

                6. Fruit-Flavored Coffee Bar: A coffee bar that specializes in creating unique coffee drinks flavored with fresh fruits.

                7. Fruit-Infused Tea Bar: A tea bar that specializes in creating unique tea drinks infused with fresh fruits.

                8. Juice and Yogurt Bar: A combination juice and yogurt bar that offers a variety of juice and yogurt drinks, as well as snacks.

                9. Frozen Fruit Bar: A frozen fruit bar that specializes in creating unique frozen fruit drinks made with fresh fruits.

                10. Fruit-Flavored Milkshake Bar: A milkshake bar that specializes in creating unique milkshake flavors made with fresh fruits.

                11. Fruit-Flavored Slushie Bar: A slushie bar that specializes in creating unique slushie flavors made with fresh fruits.

                12. Fruit-Flavored Jelly Bar: A jelly bar that specializes in creating unique jelly flavors made with fresh fruits.

                13. Fruit-Flavored Sorbet Bar: A sorbet bar that specializes in creating unique sorbet flavors made with fresh fruits.

                14. Fruit-Flavored Bubble Tea Bar: A bubble tea bar that specializes in creating unique bubble tea flavors made with fresh fruits.

                15. Fruit-Flavored Shaved Ice Bar: A shaved ice bar that specializes in creating unique shaved ice flavors made with fresh fruits.',
                'tokens' => 485,
                'words' => 284,
                'characters' => 1856,
                'model' => 'text-davinci-003',
                'language' => 'English',
                'tone' => 0.0,
                'creativity_label' => 0.5,
            ),
            5 =>
            array (
                'id' => 13,
                'parent_id' => NULL,
                'user_id' => 2,
                'use_case_id' => 24,
                'title' => 'Junior Backend Developer,PHP, AJAX, JS, JQuery, Laravel, React, Python, C++, C, JAVA, Operating System',
                'slug' => 'junior-backend-developerphp-ajax-js-jquery-laravel',
                'promt' => 'Please generate a cover letter for a candidate applying for a Junior Backend Developer position. The candidate id expert in PHP, AJAX, JS, JQuery, Laravel, React, Python, C++, C, JAVA, Operating System , and is looking for an opportunity to improve',
                'content' => '

                Dear [Hiring Manager],

                I am excited to apply for the position of Junior Backend Developer at [Company Name]. As an experienced developer, I am confident that I can take on this role and make an immediate contribution to your team.

                I have a strong background in developing web applications with technologies such as PHP, AJAX, JS, JQuery, Laravel, React, Python, C++, C, and JAVA. I am proficient with databases and operating systems and can work independently and in a team environment. I have a great eye for detail, so all of my work is produced to the highest standards.

                I am passionate about technology and keeping up with the latest developments. Your organization attracts me because of its commitment to using the latest technology to keep up with the demands of today’s fast-paced digital environment. This is consistent with my own enthusiasm for staying ahead of the curve and producing software solutions which enable organizations to flourish.

                I believe my skills and passion for technology make me an ideal candidate for the job. I am looking forward to having an opportunity to discuss this position during an interview and how I can use my skills to improve your team.

                Thank you for taking the time to consider my application.

                Sincerely,
                [Name]',
                'tokens' => 343,
                'words' => 212,
                'characters' => 1270,
                'model' => 'text-davinci-003',
                'language' => 'English',
                'tone' => 0.0,
                'creativity_label' => 1.0,
            ),
            6 =>
            array (
                'id' => 15,
                'parent_id' => NULL,
                'user_id' => 2,
                'use_case_id' => 27,
                'title' => 'MOI certificate. Instead of IELTS, can I use MOI for higher study..',
                'slug' => 'moi-certificate-instead-of-ielts-can-i-use-moi-for',
                'promt' => 'Please generate at least 10 questions and answers related to MOI certificate. Instead of IELTS, can I use MOI for higher study... and the answers should be accurate, well-researched, and supported by credible sources',
                'content' => '.

                Q1: What is an MOI Certificate?
                A1: MOI Certificate stands for “Ministry of Interior” Certificate. It is an attestation that proves the authenticity of your educational or professional qualifications for those seeking to study or work abroad, issued by Saudi Arabia\'s Ministry of Interior.

                Q2: How do I apply for an MOI Certificate?
                A2: In order to obtain an MOI certificate, you must first apply by completing an online application form with the Ministry of Interior (MOI) e- government website. Then, you must fill in all the relevant required fields, including contact information and details about the certificate, before submitting your application to the Ministry of Interior.

                Q3: What documents do I need for an MOI Certificate?
                A3: The documents required to apply for an MOI Certificate include a valid passport copy, a valid ID card copy, a valid birth certificate, appointment confirmation voucher or letter from the institute or college and a copy of your graduation certificate or diploma. Additionally, if you are applying for a work-related certificate, you must provide a letter from your current employer.

                Q4: How long does it take to process an MOI Certificate?
                A4: It usually takes three to five working days for the Ministry of Interior to process an MOI Certificate. However, this processing time may differ depending on the complexity of your application and other factors.

                Q5: Who can use an MOI Certificate?
                A5: An MOI Certificate can be used by anyone who needs to verify their educational or professional qualifications in order to study or work abroad.

                Q6: What is the validity period for an MOI Certificate?
                A6: The validity period for an MOI Certificate typically ranges from three months to one year depending on the specific institution or country regulations.

                Q7: Is there a fee for obtaining an MOI Certificate?
                A7: Yes, there is a fee associated with obtaining an MOI Certificate. The fee is determined by the specific institution where you are submitting your application.

                Q8: Can I use MOI instead of IELTS for higher study?
                A8: Yes, depending on the country regulations and specific institutions requirements, it is possible to use MOI instead of IELTS for higher study. However, it is best to consult',
                'tokens' => 563,
                'words' => 366,
                'characters' => 2260,
                'model' => 'text-davinci-003',
                'language' => 'English',
                'tone' => 0.0,
                'creativity_label' => 1.0,
            ),
            7 =>
            array (
                'id' => 17,
                'parent_id' => NULL,
                'user_id' => 2,
                'use_case_id' => 34,
                'title' => 'Vlog about travel in Bali,Sea beach, Food, Paracycling, Plane, Atmosphere ',
                'slug' => 'vlog-about-travel-in-balisea-beach-food-paracyclin',
                'promt' => 'Please generate a video description. The video title about Vlog about travel in Bali. The video description should be attention-grabbing, informative, and persuasive, and should include Sea beach, Food, Paracycling, Plane, Atmosphere  keywords and phrases.',
                'content' => '

                This video is a must-see for any traveler looking to explore the beautiful beaches, delicious food, and amazing atmosphere of Bali! Join me as I vlog my travels around this vibrant island paradise. From heading out on a Paracycling adventure to lunching on some of the best seafood around, this is the video you need to get your Bali travel planning started! Let me take you on a journey through some of the best sights, experiences, and food in Bali, starting with a breathtaking aerial view from the plane. So come join me on my journey and let\'s explore the amazing atmosphere of Bali together!',
                'tokens' => 198,
                'words' => 105,
                'characters' => 599,
                'model' => 'text-davinci-003',
                'language' => 'English',
                'tone' => 0.0,
                'creativity_label' => 1.0,
            ),
            8 =>
            array (
                'id' => 18,
                'parent_id' => NULL,
                'user_id' => 2,
                'use_case_id' => 28,
                'title' => 'AI, Python, Django, Fast API,Basic knowledge ',
                'slug' => 'ai-python-django-fast-apibasic-knowledge',
                'promt' => 'Please generate 10 interview questions about AI, Python, Django, Fast API. The question must include Basic knowledge . The questions should be challenging enough to assess the candidate\'s skills, knowledge',
                'content' => ' but professional.

                1. What is the main difference between artificial intelligence and machine learning?
                2. Describe an experience with Python that you found challenging.
                3. What is the purpose of ORM (Object Relational Mapping) in Django?
                4. In developing a web application with Django, what steps do you take to ensure that security is maintained?
                5. How would you implement an AI-based decision system within a Python application?
                6. How do you manage conflicted versions for Python libraries and packages?
                7. What is the purpose of a view in Django?
                8. Describe an API endpoint you have implemented and the challenges faced while designing it.
                9. What is the difference between REST APIs and GraphQL APIs?
                10. What strategies have you used when optimizing a codebase written in Python?',
                'tokens' => 224,
                'words' => 119,
                'characters' => 789,
                'model' => 'text-davinci-003',
                'language' => 'English',
                'tone' => 0.0,
                'creativity_label' => 1.0,
            ),
            9 =>
            array (
                'id' => 22,
                'parent_id' => NULL,
                'user_id' => 2,
                'use_case_id' => 16,
                'title' => 'Leave Application,Sick due to food poisoning, Admitted in Hospital',
                'slug' => 'leave-applicationsick-due-to-food-poisoning-admitt',
                'promt' => 'Please write an email and the title of email must be Leave Application. The email should be described in a way that highlights its unique features, benefits, and the keyword should be in Sick due to food poisoning, Admitted in Hospital . ',
                'content' => '.

                Subject: Leave Application - Sick due to food poisoning, Admitted in Hospital

                Dear [Name],

                I am writing to request a leave of absence from work due to unfortunate circumstances. I was recently admitted to the hospital after suffering from food poisoning. The doctors have advised me to take a few days off from work so that I can recover fully.

                I understand that this may be an inconvenience to the team, and I apologize for any disruption this may cause. I am confident that I will be able to resume my duties soon and will make up for the lost time.

                I am attaching the doctor\'s report for your reference and would be grateful if you could approve my leave application.

                Thank you for your understanding and I look forward to hearing from you soon.

                Sincerely,
                [Your Name]',
                'tokens' => 241,
                'words' => 138,
                'characters' => 786,
                'model' => 'text-davinci-003',
                'language' => 'English',
                'tone' => 0.0,
                'creativity_label' => 0.5,
            ),
            10 =>
            array (
                'id' => 23,
                'parent_id' => NULL,
                'user_id' => 2,
                'use_case_id' => 25,
                'title' => 'Senior Backend Developer ,3+',
                'slug' => 'senior-backend-developer-3',
                'promt' => 'Please generate a job description for the position of Senior Backend Developer . This is for 3+ yeras of experience.  The job description should be detailed and accurate, and should include information about the company, the responsibilities and requirements of the position, and the qualifications and skills required for the role. Please also include any relevant information about the compensation and benefits package, as well as any opportunities for growth and advancement within the company',
                'content' => ' but professional

                Job Description:

                We are looking for an experienced Senior Backend Developer to join our team and help the company reach its goals.

                Our company is a leading provider of cloud-solutions and environment-friendly services for the global sector. We strongly value innovation, collaboration, and team spirit -- no matter which programming languages or platforms you use. Our mission is to create customer-focused solutions that strive toward true sustainability.

                As our Senior Backend Developer, you will join our team in developing the backend of high-availability applications that help customers make good use of their cloud resources. You will orchestrate complex tasks with tools you understand and create innovative solutions with lovable UI/UX experiences. You must have 3+ years of professional backend development experience and be a pragmatic problem solver.

                Additionally, you will:

                - Collaborate with frontend and full stack developers in creating and integrating reliable backend services
                - Design algorithms for efficient storage and scalability of databases
                - Monitor and solve scalability issues, developing optimizations and bug fixes
                - Work with different technologies such as JSON Payloads, SOAP, REST, SQL querying and NoSQL
                - Coordinate with client teams to ensure perfection in design and trouble-free deployment
                - Research upcoming server side technologies


                To be successful, you must have the following qualifications/skills:

                - Bachelor\'s degree in Computer Science or related field
                - 3+ years of experience with server side development
                - Experience designing distributed databases
                - Knowledge of developing API\'s
                - Good understanding of server security issues and relevant industry best practices
                - Proficiency in multiple programming languages like NodeJS/PHP/Python, etc.
                - HTML5/CSS3/Javascript proficiency preferred

                Compensation & Benefits:

                - Compensation for this role will be competitive to industry standards relating to the role’s experience level
                - Group health insurance coverage
                - Generous paid vacation plan
                - Professional training opportunities – both locally and abroad
                - Opportunities for career progression with consistent performance

                If this opportunity excites you and you wish to take your career to the next level, send your resume to our Team! We look forward to your application!',
                'tokens' => 572,
                'words' => 342,
                'characters' => 2393,
                'model' => 'text-davinci-003',
                'language' => 'English',
                'tone' => 0.0,
                'creativity_label' => 1.0,
            ),
        ));


    }
}
