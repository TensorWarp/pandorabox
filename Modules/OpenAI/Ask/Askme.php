<?php

namespace Modules\OpenAI\Ask;

class Askme
{

    /**
     * Use Case
     *
     * @param string|null $useCase
     * @param string|null $question
     * @param string|null $jobSkills
     * @param string|null $keyword
     * @return array
     */
    public static function useCase($useCase = null, $question = null, $jobSkills = null, $keyword = null)
    {
       return $useCases = [
            'Blog-Idea' => "Blog Idea & Outline About your desired keyword",
            'Question-Answer' => "Question and answer About your desired keyword",
        ];

        return array_key_exists($useCase,$useCases) ? $useCases[$useCase] : null;
    }

    /**
     * Use Case Demo
     *
     * @param string|null $useCase
     * @return bool
     */
    public static function useCaseDemo($useCase = null) {
        $useCases = [];
        $useCases['interview-question'] = [
            "id" => 11,
            "description" => "At Pandorabox, you can hire the best freelance software developers to get your project done on time and within budget. We offer a wide range of services like web development, mobile app development, UI design, bug fixing and quality assurance.",
            "slug" => "business-idea",
            "formData" => array(
                "type" => ['Interview Question about?' => 'Write Interview Question', 'Role' => 'Web developer','Year of experience' => 'Year of experience',],
            ),
            "promt" => "Please generate 15 interview questions about #. The question must include #. The questions should be challenging enough to assess the candidate's skills, knowledge.",
        ];
        $useCases['blog-title'] = [
            "id" => 2,
            "description" => "At Pandorabox, you can hire the best freelance software developers to get your project done on time and within budget. We offer a wide range of services like web development, mobile app development, UI design, bug fixing and quality assurance.",
            "slug" => "blog-idea",
            "formData" => array(
                ['label' => 'What is your blog idea about ?', 'placeholder' => 'Write Blog Idea', 'type' => 'text', 'required' => 'required', 'max-length' => 150],
            ),
            "promt" => "What are some great blog ideas and outline about: #.",
        ];
        $useCases['blog-meta-data'] = [
            "id" => 3,
            "description" => "At Pandorabox, you can hire the best freelance software developers to get your project done on time and within budget. We offer a wide range of services like web development, mobile app development, UI design, bug fixing and quality assurance.",
            "slug" => "blog-writing",
            "formData" => array(
                "type" => ['What is your blog write about ?' => 'Write Blog writing'],
            ),
            "promt" => "Please generate a blog post idea that would be engaging, informative, and interesting for a general audience. The blog post should be approximately 1000 words long and should focus on # topic.",
        ];

         $useCases['Question-Answer'] = [
            "id" => 8,
            "description" => "At Pandorabox, you can hire the best freelance software developers to get your project done on time and within budget. We offer a wide range of services like web development, mobile app development, UI design, bug fixing and quality assurance.",
            "slug" => "question-answer",
            "formData" => array(
                ['label' => 'What is your Questions about ?', 'placeholder' => 'Questions about', 'type' => 'textarea', 'required' => 'required', 'max-length' => 350],
                ['label' => 'Questions Difficulty ?', 'placeholder' => 'Questions Difficulty', 'type' => 'text', 'required' => 'required', 'max-length' => 150],
                ['label' => 'Year of experience ?', 'placeholder' => 'Year of experience', 'type' => 'text', 'required' => ''],
            ),
            "promt" => "Please generate at least 25 questions and answers related to #. and the answers should be accurate, well-researched, and supported by credible sources",
        ];

        $useCases['job-description'] = [
            "id" => 1,
            "description" => "At Pandorabox, you can hire the best freelance software developers to get your project done on time and within budget. We offer a wide range of services like web development, mobile app development, UI design, bug fixing and quality assurance.",
            "slug" => "magic-command",
            "formData" => array(
                "type" => ['Job Description About' => 'Job Description'],
            ),
            "promt" => "Please generate a job description for the position of #. This is for # yeras of experience.  The job description should be detailed and accurate, and should include information about the company, the responsibilities and requirements of the position, and the qualifications and skills required for the role. Please also include any relevant information about the compensation and benefits package, as well as any opportunities for growth and advancement within the company",
        ];

          return array_key_exists($useCase,$useCases) ? $useCases[$useCase] : null;
    }
}
