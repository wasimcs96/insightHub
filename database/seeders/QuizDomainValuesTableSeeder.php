<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\QuizDomain;

use App\Models\QuizDomainValue;

use App\Models\Quiz;

class QuizDomainValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $masteryDomainId = QuizDomain::where("title", "Mastery")->first()->id;

      $qualityOfLifeDomainId = QuizDomain::where("title", "Quality of Life")->first()->id;

      $fellowshopDomainId = QuizDomain::where("title", "Fellowship")->first()->id;

      $creatingValueDomainId = QuizDomain::where("title", "Creating Value")->first()->id;

      $riasecGeneralDomainId = QuizDomain::where(["title" => "General", "quiz_id" => Quiz::where("name", "interest-riasec")->first()->id])->first()->id;

      $fiveFactorGeneralDomainId = QuizDomain::where(["title" => "General", "quiz_id" => Quiz::where("name", "five-factor")->first()->id])->first()->id;

      $ideasAndOpportunitiesDomainId = QuizDomain::where(["title" => "Ideas and Opportunities", "quiz_id" => Quiz::where("name", "employability")->first()->id])->first()->id;

      $resourcesDomainId = QuizDomain::where(["title" => "Resources", "quiz_id" => Quiz::where("name", "employability")->first()->id])->first()->id;

      $intoActionDomainId = QuizDomain::where(["title" => "Into Action", "quiz_id" => Quiz::where("name", "employability")->first()->id])->first()->id;

      $onetProfilerGeneralDomainId = QuizDomain::where(["title" => "General", "quiz_id" => Quiz::where("name", "onet-profiler")->first()->id])->first()->id;

      $cognitiveDomainId = QuizDomain::where(["title" => "Cognitive", "quiz_id" => Quiz::where("name", "21-century-skills")->first()->id])->first()->id;

      $interpersonalDomainId = QuizDomain::where(["title" => "Interpersonal", "quiz_id" => Quiz::where("name", "21-century-skills")->first()->id])->first()->id;

      $selfLeadershipDomainId = QuizDomain::where(["title" => "Self Leadership", "quiz_id" => Quiz::where("name", "21-century-skills")->first()->id])->first()->id;

      $digitalDomainId = QuizDomain::where(["title" => "Digital", "quiz_id" => Quiz::where("name", "21-century-skills")->first()->id])->first()->id;

      $englishGeneralDomainId = QuizDomain::where(["title" => "General", "quiz_id" => Quiz::where("name", "english-test")->first()->id])->first()->id;

      $data = [
        ["title" => "Intellectual stimulation", "order" => 0, "quiz_domain_id" => $masteryDomainId],
        ["title" => "Recognition", "order" => 1, "quiz_domain_id" => $masteryDomainId],
        ["title" => "Achievement", "order" => 2, "quiz_domain_id" => $masteryDomainId],
        ["title" => "Independence", "order" => 3, "quiz_domain_id" => $masteryDomainId],
        ["title" => "Variety", "order" => 4, "quiz_domain_id" => $qualityOfLifeDomainId],
        ["title" => "Security", "order" => 5, "quiz_domain_id" => $qualityOfLifeDomainId],
        ["title" => "Way of Life", "order" => 6, "quiz_domain_id" => $qualityOfLifeDomainId],
        ["title" => "Surroundings", "order" => 7, "quiz_domain_id" => $qualityOfLifeDomainId],
        ["title" => "Economic Return", "order" => 8, "quiz_domain_id" => $qualityOfLifeDomainId],
        ["title" => "Altruism", "order" => 9, "quiz_domain_id" => $fellowshopDomainId],
        ["title" => "Supervisory Relationship", "order" => 10, "quiz_domain_id" => $fellowshopDomainId],
        ["title" => "Associates", "order" => 11, "quiz_domain_id" => $fellowshopDomainId],
        ["title" => "Belonging", "order" => 12, "quiz_domain_id" => $fellowshopDomainId],
        ["title" => "Family", "order" => 13, "quiz_domain_id" => $fellowshopDomainId],
        ["title" => "Aesthetic", "order" => 14, "quiz_domain_id" => $creatingValueDomainId],
        ["title" => "Creativity", "order" => 15, "quiz_domain_id" => $creatingValueDomainId],
        ["title" => "Leadership", "order" => 16, "quiz_domain_id" => $creatingValueDomainId],
        ["title" => "Protecting the Planet", "order" => 17, "quiz_domain_id" => $creatingValueDomainId],

        ["title" => "Realistic", "order" => 1, "quiz_domain_id" => $riasecGeneralDomainId, 'color' => '#881336'],
        ["title" => "Investigative", "order" => 2, "quiz_domain_id" => $riasecGeneralDomainId, 'color' => '#197f17'],
        ["title" => "Artistic", "order" => 3, "quiz_domain_id" => $riasecGeneralDomainId, 'color' => '#bc4908'],
        ["title" => "Social", "order" => 4, "quiz_domain_id" => $riasecGeneralDomainId, 'color' => '#871212'],
        ["title" => "Enterprising", "order" => 5, "quiz_domain_id" => $riasecGeneralDomainId, 'color' => '#173e81'],
        ["title" => "Conventional", "order" => 6, "quiz_domain_id" => $riasecGeneralDomainId, 'color' => '#321780'],

        ["title" => "Emotional Stability", "order" => 1, "quiz_domain_id" => $fiveFactorGeneralDomainId, 'color' => '#F7D93C'],
        ["title" => "Extraversion", "order" => 2, "quiz_domain_id" => $fiveFactorGeneralDomainId, 'color' => '#F7D93C'],
        ["title" => "Openness to Experience", "order" => 3, "quiz_domain_id" => $fiveFactorGeneralDomainId, 'color' => '#F7D93C'],
        ["title" => "Agreeableness", "order" => 4, "quiz_domain_id" => $fiveFactorGeneralDomainId, 'color' => '#F7D93C'],
        ["title" => "Conscientiousness", "order" => 5, "quiz_domain_id" => $fiveFactorGeneralDomainId, 'color' => '#F7D93C'],

        ["title" => "Spotting Opportunities", "order" => 1, "quiz_domain_id" => $ideasAndOpportunitiesDomainId, 'color' => '#F7D93C'],
        ["title" => "Creativity", "order" => 2, "quiz_domain_id" => $ideasAndOpportunitiesDomainId, 'color' => '#F7D93C'],
        ["title" => "Valuing Ideas", "order" => 3, "quiz_domain_id" => $ideasAndOpportunitiesDomainId, 'color' => '#F7D93C'],
        ["title" => "Vision", "order" => 4, "quiz_domain_id" => $ideasAndOpportunitiesDomainId, 'color' => '#F7D93C'],
        ["title" => "Ethical and Sustainable Thinking", "order" => 5, "quiz_domain_id" => $ideasAndOpportunitiesDomainId, 'color' => '#F7D93C'],
        ["title" => "Self Awareness", "order" => 6, "quiz_domain_id" => $resourcesDomainId, 'color' => '#F7D93C'],
        ["title" => "Self Efficacy", "order" => 7, "quiz_domain_id" => $resourcesDomainId, 'color' => '#F7D93C'],
        ["title" => "Financial and Economic Literacy", "order" => 8, "quiz_domain_id" => $resourcesDomainId, 'color' => '#F7D93C'],
        ["title" => "Mobilising Others", "order" => 9, "quiz_domain_id" => $resourcesDomainId, 'color' => '#F7D93C'],
        ["title" => "Mobilising Resources", "order" => 10, "quiz_domain_id" => $resourcesDomainId, 'color' => '#F7D93C'],
        ["title" => "Motivation and Perseverance", "order" => 11, "quiz_domain_id" => $intoActionDomainId, 'color' => '#F7D93C'],
        ["title" => "Working with Others", "order" => 12, "quiz_domain_id" => $intoActionDomainId, 'color' => '#F7D93C'],
        ["title" => "Planning and Management", "order" => 13, "quiz_domain_id" => $intoActionDomainId, 'color' => '#F7D93C'],
        ["title" => "Learning Through Experience", "order" => 14, "quiz_domain_id" => $intoActionDomainId, 'color' => '#F7D93C'],
        ["title" => "Coping with Uncertainty Ambiguity and Risk", "order" => 15, "quiz_domain_id" => $intoActionDomainId, 'color' => '#F7D93C'],
        ["title" => "Taking the Initiative", "order" => 16, "quiz_domain_id" => $intoActionDomainId, 'color' => '#F7D93C'],

        ["title" => "Realistic", "order" => 1, "quiz_domain_id" => $onetProfilerGeneralDomainId, 'color' => '#CF3C53'],
        ["title" => "Investigative", "order" => 2, "quiz_domain_id" => $onetProfilerGeneralDomainId, 'color' => '#688BC3'],
        ["title" => "Artistic", "order" => 3, "quiz_domain_id" => $onetProfilerGeneralDomainId, 'color' => '#5BA670'],
        ["title" => "Social", "order" => 4, "quiz_domain_id" => $onetProfilerGeneralDomainId, 'color' => '#9A78A1'],
        ["title" => "Enterprising", "order" => 5, "quiz_domain_id" => $onetProfilerGeneralDomainId, 'color' => '#D5973D'],
        ["title" => "Conventional", "order" => 6, "quiz_domain_id" => $onetProfilerGeneralDomainId, 'color' => '#F7D93C'],

        ["title" => "Critical Thinking", "order" => 1, "quiz_domain_id" => $cognitiveDomainId, 'color' => '#F7D93C'],
        ["title" => "Planning and Ways of Working", "order" => 2, "quiz_domain_id" => $cognitiveDomainId, 'color' => '#F7D93C'],
        ["title" => "Communication", "order" => 3, "quiz_domain_id" => $cognitiveDomainId, 'color' => '#F7D93C'],
        ["title" => "Mental Flexibility", "order" => 4, "quiz_domain_id" => $cognitiveDomainId, 'color' => '#F7D93C'],
        ["title" => "Mobilising Systems", "order" => 5, "quiz_domain_id" => $interpersonalDomainId, 'color' => '#F7D93C'],
        ["title" => "Developing Relationships", "order" => 6, "quiz_domain_id" => $interpersonalDomainId, 'color' => '#F7D93C'],
        ["title" => "Effective Teamwork", "order" => 7, "quiz_domain_id" => $interpersonalDomainId, 'color' => '#F7D93C'],
        ["title" => "Coaching Others", "order" => 8, "quiz_domain_id" => $interpersonalDomainId, 'color' => '#F7D93C'],
        ["title" => "Self-Awareness", "order" => 9, "quiz_domain_id" => $selfLeadershipDomainId, 'color' => '#F7D93C'],
        ["title" => "Self-Management", "order" => 10, "quiz_domain_id" => $selfLeadershipDomainId, 'color' => '#F7D93C'],
        ["title" => "Entrepreneurship", "order" => 11, "quiz_domain_id" => $selfLeadershipDomainId, 'color' => '#F7D93C'],
        ["title" => "Goal Achievement", "order" => 12, "quiz_domain_id" => $selfLeadershipDomainId, 'color' => '#F7D93C'],
        ["title" => "Digital Fluency", "order" => 13, "quiz_domain_id" => $digitalDomainId, 'color' => '#F7D93C'],
        ["title" => "Software Use", "order" => 14, "quiz_domain_id" => $digitalDomainId, 'color' => '#F7D93C'],
        ["title" => "Software Development", "order" => 15, "quiz_domain_id" => $digitalDomainId, 'color' => '#F7D93C'],
        ["title" => "Understanding Digital Systems", "order" => 16, "quiz_domain_id" => $digitalDomainId, 'color' => '#F7D93C'],

        ["title" => "Grammar", "order" => 1, "quiz_domain_id" => $englishGeneralDomainId, 'color' => '#F7D93C'],
        ["title" => "Comprehension", "order" => 2, "quiz_domain_id" => $englishGeneralDomainId, 'color' => '#F7D93C'],
      ];

      foreach ($data as $value) {

        QuizDomainValue::updateOrCreate($value);

      }

    }
}
