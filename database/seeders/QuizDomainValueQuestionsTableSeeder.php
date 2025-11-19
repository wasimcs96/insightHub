<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Quiz;

use App\Models\QuizDomain;

use App\Models\QuizDomainValue;

use App\Models\QuizDomainValueQuestion;

class QuizDomainValueQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $onetProfilerGeneralDomainId = QuizDomain::where(["title" => "General", "quiz_id" => Quiz::where("name", "onet-profiler")->first()->id])->first()->id;

        $cognitiveDomainId = QuizDomain::where(["title" => "Cognitive", "quiz_id" => Quiz::where("name", "21-century-skills")->first()->id])->first()->id;

        $interpersonalDomainId = QuizDomain::where(["title" => "Interpersonal", "quiz_id" => Quiz::where("name", "21-century-skills")->first()->id])->first()->id;

        $selfLeadershipDomainId = QuizDomain::where(["title" => "Self Leadership", "quiz_id" => Quiz::where("name", "21-century-skills")->first()->id])->first()->id;

        $digitalDomainId = QuizDomain::where(["title" => "Digital", "quiz_id" => Quiz::where("name", "21-century-skills")->first()->id])->first()->id;

        $englishGeneralDomainId = QuizDomain::where(["title" => "General", "quiz_id" => Quiz::where("name", "english-test")->first()->id])->first()->id;

        $data = [
          ["title" => "To have opportunities for problem solving", "quiz_domain_value_id" => QuizDomainValue::where("title", "Intellectual stimulation")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 1],
          ["title" => "To be intellectually stimulated", "quiz_domain_value_id" => QuizDomainValue::where("title", "Intellectual stimulation")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 2],
          ["title" => "To have opportuntities to learn new things", "quiz_domain_value_id" => QuizDomainValue::where("title", "Intellectual stimulation")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 3],

          ["title" => "To gain recognition in my work", "quiz_domain_value_id" => QuizDomainValue::where("title", "Recognition")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 4],
          ["title" => "To know that others consider my work important", "quiz_domain_value_id" => QuizDomainValue::where("title", "Recognition")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 5],
          ["title" => "That others look up to me for my contribution", "quiz_domain_value_id" => QuizDomainValue::where("title", "Recognition")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 6],

          ["title" => "To experience the satisfaction of accomplishing tasks", "quiz_domain_value_id" => QuizDomainValue::where("title", "Achievement")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 7],
          ["title" => "To know by the results that I have done a good job", "quiz_domain_value_id" => QuizDomainValue::where("title", "Achievement")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 8],
          ["title" => "To see the result of my efforts", "quiz_domain_value_id" => QuizDomainValue::where("title", "Achievement")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 9],

          ["title" => "To be free to manage my own workload", "quiz_domain_value_id" => QuizDomainValue::where("title", "Independence")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 10],
          ["title" => "To have choice about the way that I approach tasks", "quiz_domain_value_id" => QuizDomainValue::where("title", "Independence")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 11],
          ["title" => "To set up my own business", "quiz_domain_value_id" => QuizDomainValue::where("title", "Independence")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 12],

          ["title" => "To be involved in work with a high level of change", "quiz_domain_value_id" => QuizDomainValue::where("title", "Variety")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 13],
          ["title" => "To have a role that requires a range of skills", "quiz_domain_value_id" => QuizDomainValue::where("title", "Variety")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 14],
          ["title" => "To have variety in my work", "quiz_domain_value_id" => QuizDomainValue::where("title", "Variety")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 15],

          ["title" => "To have a job that is secure", "quiz_domain_value_id" => QuizDomainValue::where("title", "Security")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 16],
          ["title" => "To build skills that will make me highly employable", "quiz_domain_value_id" => QuizDomainValue::where("title", "Security")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 17],
          ["title" => "To work in a company that is loyal to its employees", "quiz_domain_value_id" => QuizDomainValue::where("title", "Security")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 18],

          ["title" => "To have opportunities to achieve my potential", "quiz_domain_value_id" => QuizDomainValue::where("title", "Way of Life")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 19],
          ["title" => "To have a good quality of life outside of work", "quiz_domain_value_id" => QuizDomainValue::where("title", "Way of Life")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 20],
          ["title" => "To experience personal fulfillment in my life", "quiz_domain_value_id" => QuizDomainValue::where("title", "Way of Life")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 21],

          ["title" => "To choose where my work is done", "quiz_domain_value_id" => QuizDomainValue::where("title", "Surroundings")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 22],
          ["title" => "To work in an environment that I like", "quiz_domain_value_id" => QuizDomainValue::where("title", "Surroundings")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 23],
          ["title" => "To have a workspace that suits me.", "quiz_domain_value_id" => QuizDomainValue::where("title", "Surroundings")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 24],

          ["title" => "To have pay increases that keep up with the cost of living", "quiz_domain_value_id" => QuizDomainValue::where("title", "Economic Return")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 25],
          ["title" => "To have a salary which enables me to have a good standard of living", "quiz_domain_value_id" => QuizDomainValue::where("title", "Economic Return")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 26],
          ["title" => "To have potential to increase my salary", "quiz_domain_value_id" => QuizDomainValue::where("title", "Economic Return")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 27],

          ["title" => "To have opportunities to help others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Altruism")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 28],
          ["title" => "To feel that I have contributed positively through helping others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Altruism")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 29],
          ["title" => "To contribute to the welfare of others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Altruism")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 30],

          ["title" => "To have a positive relationship with my line manager", "quiz_domain_value_id" => QuizDomainValue::where("title", "Supervisory Relationship")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 31],
          ["title" => "To have a line manager who is fair and approachable", "quiz_domain_value_id" => QuizDomainValue::where("title", "Supervisory Relationship")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 32],
          ["title" => "To have a line manager who values my contribution", "quiz_domain_value_id" => QuizDomainValue::where("title", "Supervisory Relationship")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 33],

          ["title" => "To experience a sense of belonging to a team", "quiz_domain_value_id" => QuizDomainValue::where("title", "Associates")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 34],
          ["title" => "To have opportunities to interact with my colleagues regularly", "quiz_domain_value_id" => QuizDomainValue::where("title", "Associates")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 35],
          ["title" => "To have friendships in my workplace", "quiz_domain_value_id" => QuizDomainValue::where("title", "Associates")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 36],

          ["title" => "To work for an organisation that values diversity", "quiz_domain_value_id" => QuizDomainValue::where("title", "Belonging")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 37],
          ["title" => "To work for an organisation that values every individual", "quiz_domain_value_id" => QuizDomainValue::where("title", "Belonging")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 38],
          ["title" => "To work for an organisaiton that contributes to the community", "quiz_domain_value_id" => QuizDomainValue::where("title", "Belonging")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 39],

          ["title" => "To have work that my family would be proud of", "quiz_domain_value_id" => QuizDomainValue::where("title", "Family")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 40],
          ["title" => "To have a career that my family would approve of", "quiz_domain_value_id" => QuizDomainValue::where("title", "Family")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 41],
          ["title" => "To have a job that brings benefits to my family as well as myself", "quiz_domain_value_id" => QuizDomainValue::where("title", "Family")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 42],

          ["title" => "To be able to design or create beautiful environments", "quiz_domain_value_id" => QuizDomainValue::where("title", "Aesthetic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 43],
          ["title" => "To ensure that the outcome of my work adds beauty to the world", "quiz_domain_value_id" => QuizDomainValue::where("title", "Aesthetic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 44],
          ["title" => "To design beautiful products", "quiz_domain_value_id" => QuizDomainValue::where("title", "Aesthetic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 45],

          ["title" => "To take a creative approach to problem solving and innovation", "quiz_domain_value_id" => QuizDomainValue::where("title", "Creativity")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 46],
          ["title" => "To create something new", "quiz_domain_value_id" => QuizDomainValue::where("title", "Creativity")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 47],
          ["title" => "To contribute new ideas", "quiz_domain_value_id" => QuizDomainValue::where("title", "Creativity")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 48],

          ["title" => "To lead people and teams", "quiz_domain_value_id" => QuizDomainValue::where("title", "Leadership")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 49],
          ["title" => "To have opportunities to use my leadership abilities", "quiz_domain_value_id" => QuizDomainValue::where("title", "Leadership")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 50],
          ["title" => "To develop strategies and plan the work of others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Leadership")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 51],

          ["title" => "To work for an organisation that values sustainability", "quiz_domain_value_id" => QuizDomainValue::where("title", "Protecting the Planet")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 52],
          ["title" => "To work for an organisation that values the wellbeing of its employees", "quiz_domain_value_id" => QuizDomainValue::where("title", "Protecting the Planet")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 53],
          ["title" => "To positively contribute to the protection of the planet", "quiz_domain_value_id" => QuizDomainValue::where("title", "Protecting the Planet")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 54],


          ["title" => "building or construction", "quiz_domain_value_id" => QuizDomainValue::where("title", "Realistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 1],
          ["title" => "working with tools", "quiz_domain_value_id" => QuizDomainValue::where("title", "Realistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 2],
          ["title" => "operating or repairing machinery", "quiz_domain_value_id" => QuizDomainValue::where("title", "Realistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 13],
          ["title" => "outdoor tasks such as gardening", "quiz_domain_value_id" => QuizDomainValue::where("title", "Realistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 14],
          ["title" => "using technology and digital devices", "quiz_domain_value_id" => QuizDomainValue::where("title", "Realistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 25],
          ["title" => "putting do-it-yourself furniture together", "quiz_domain_value_id" => QuizDomainValue::where("title", "Realistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 26],
          ["title" => "organising my surroundings", "quiz_domain_value_id" => QuizDomainValue::where("title", "Realistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 37],
          ["title" => "vehicle maintenance", "quiz_domain_value_id" => QuizDomainValue::where("title", "Realistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 38],
          ["title" => "repairing applicances", "quiz_domain_value_id" => QuizDomainValue::where("title", "Realistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 49],
          ["title" => "cooking or crafting products", "quiz_domain_value_id" => QuizDomainValue::where("title", "Realistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 50],

          ["title" => "researching new medicines or medical products", "quiz_domain_value_id" => QuizDomainValue::where("title", "Investigative")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 3],
          ["title" => "researching ways to improve the environment", "quiz_domain_value_id" => QuizDomainValue::where("title", "Investigative")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 4],
          ["title" => "performing chemical experiments", "quiz_domain_value_id" => QuizDomainValue::where("title", "Investigative")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 15],
          ["title" => "researching a topic I am working on", "quiz_domain_value_id" => QuizDomainValue::where("title", "Investigative")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 16],
          ["title" => "finding out how things work", "quiz_domain_value_id" => QuizDomainValue::where("title", "Investigative")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 27],
          ["title" => "learning new things", "quiz_domain_value_id" => QuizDomainValue::where("title", "Investigative")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 28],
          ["title" => "experimenting or innovating", "quiz_domain_value_id" => QuizDomainValue::where("title", "Investigative")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 39],
          ["title" => "software coding (or artifical intelligence)", "quiz_domain_value_id" => QuizDomainValue::where("title", "Investigative")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 40],
          ["title" => "researching economic solutions to global problems", "quiz_domain_value_id" => QuizDomainValue::where("title", "Investigative")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 51],
          ["title" => "investigating Climate Change solutions", "quiz_domain_value_id" => QuizDomainValue::where("title", "Investigative")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 52],

          ["title" => "expressing myself creatively e.g. writing content for social media", "quiz_domain_value_id" => QuizDomainValue::where("title", "Artistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 5],
          ["title" => "performing arts", "quiz_domain_value_id" => QuizDomainValue::where("title", "Artistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 6],
          ["title" => "composing or arranging music", "quiz_domain_value_id" => QuizDomainValue::where("title", "Artistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 17],
          ["title" => "engaging in art e.g. music, dance, dramatic performance", "quiz_domain_value_id" => QuizDomainValue::where("title", "Artistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 18],
          ["title" => "creating movie visual/special effects", "quiz_domain_value_id" => QuizDomainValue::where("title", "Artistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 29],
          ["title" => "taking part in creative productions such a plays, performance, art shows", "quiz_domain_value_id" => QuizDomainValue::where("title", "Artistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 30],
          ["title" => "doing creative work that gives me personal satisfaction", "quiz_domain_value_id" => QuizDomainValue::where("title", "Artistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 41],
          ["title" => "graphic design", "quiz_domain_value_id" => QuizDomainValue::where("title", "Artistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 42],
          ["title" => "media production such as photography, design, writing", "quiz_domain_value_id" => QuizDomainValue::where("title", "Artistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 53],
          ["title" => "writing poetry, short stories, or drama scripts", "quiz_domain_value_id" => QuizDomainValue::where("title", "Artistic")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 54],

          ["title" => "helping others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Social")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 7],
          ["title" => "giving advice and guidance", "quiz_domain_value_id" => QuizDomainValue::where("title", "Social")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 8],
          ["title" => "improving others' emotional wellbeing", "quiz_domain_value_id" => QuizDomainValue::where("title", "Social")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 19],
          ["title" => "connecting with other people around me", "quiz_domain_value_id" => QuizDomainValue::where("title", "Social")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 20],
          ["title" => "improving others' physical wellbeing", "quiz_domain_value_id" => QuizDomainValue::where("title", "Social")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 31],
          ["title" => "working with other people in a team", "quiz_domain_value_id" => QuizDomainValue::where("title", "Social")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 32],
          ["title" => "representing people's rights", "quiz_domain_value_id" => QuizDomainValue::where("title", "Social")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 43],
          ["title" => "coaching children or adults", "quiz_domain_value_id" => QuizDomainValue::where("title", "Social")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 44],
          ["title" => "working with children or young people", "quiz_domain_value_id" => QuizDomainValue::where("title", "Social")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 55],
          ["title" => "teaching others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Social")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 56],

          ["title" => "leading other people", "quiz_domain_value_id" => QuizDomainValue::where("title", "Enterprising")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 9],
          ["title" => "selling goods", "quiz_domain_value_id" => QuizDomainValue::where("title", "Enterprising")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 10],
          ["title" => "designing new products", "quiz_domain_value_id" => QuizDomainValue::where("title", "Enterprising")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 21],
          ["title" => "finding innovative solutions to problems", "quiz_domain_value_id" => QuizDomainValue::where("title", "Enterprising")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 22],
          ["title" => "leading a team", "quiz_domain_value_id" => QuizDomainValue::where("title", "Enterprising")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 33],
          ["title" => "starting up my own business", "quiz_domain_value_id" => QuizDomainValue::where("title", "Enterprising")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 34],
          ["title" => "influencing how others think", "quiz_domain_value_id" => QuizDomainValue::where("title", "Enterprising")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 45],
          ["title" => "promoting new products or services", "quiz_domain_value_id" => QuizDomainValue::where("title", "Enterprising")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 46],
          ["title" => "having time to work something out for myself", "quiz_domain_value_id" => QuizDomainValue::where("title", "Enterprising")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 57],
          ["title" => "communicating new ideas", "quiz_domain_value_id" => QuizDomainValue::where("title", "Enterprising")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 58],

          ["title" => "organising data e.g. working with spreadsheets", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conventional")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 11],
          ["title" => "tasks with clear instructions and known outcomes", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conventional")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 12],
          ["title" => "being well-organised", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conventional")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 23],
          ["title" => "working with numbers", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conventional")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 23],
          ["title" => "administrative tasks", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conventional")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 35],
          ["title" => "a regular daily routine", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conventional")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 36],
          ["title" => "working with details in a task", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conventional")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 47],
          ["title" => "keeping financial accounts", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conventional")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 48],
          ["title" => "financial planning and budgeting", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conventional")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 59],
          ["title" => "logical processes and procedures", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conventional")->first()->id, "minPoints" => 0, "maxPoints" => 4, "order" => 60],


          ["title" => "Worry about things", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 1],
          ["title" => "Make friends easily", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 2],
          ["title" => "Have a vivid imagination", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 3],
          ["title" => "Trust others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 4],
          ["title" => "Complete tasks successfully", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 5],

          ["title" => "Get angry easily", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 6],
          ["title" => "Love large parties", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 7],
          ["title" => "Believe in the importance of art", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 8],
          ["title" => "Use others for my own ends", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 9],
          ["title" => "Like to tidy up", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 10],

          ["title" => "Often feel blue", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 11],
          ["title" => "Take charge", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 12],
          ["title" => "Experience my emotions intensely", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 13],
          ["title" => "Love to help others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 14],
          ["title" => "Keep my promises", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 15],

          ["title" => "Find it difficult to approach others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 16],
          ["title" => "Am always busy", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 17],
          ["title" => "Prefer variety to routine", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 18],
          ["title" => "Love a good fight", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 19],
          ["title" => "Work hard", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 20],

          ["title" => "Go on binges", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 21],
          ["title" => "Love excitement", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 22],
          ["title" => "Love to read challenging material", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 23],
          ["title" => "Believe that I am better than others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 24],
          ["title" => "Am always prepared", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 25],

          ["title" => "Panic easily", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 26],
          ["title" => "Radiate joy", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 27],
          ["title" => "Tend to vote for liberal political candidates", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 28],
          ["title" => "Sympathize with the homeless", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 29],
          ["title" => "Jump into things without thinking", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 30],

          ["title" => "Fear for the worst", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 31],
          ["title" => "Feel comfortable around people", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 32],
          ["title" => "Enjoy wild flights of fantasy", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 33],
          ["title" => "Believe that others have good intentions", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 34],
          ["title" => "Excel in what I do", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 35],

          ["title" => "Get irritated easily", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 36],
          ["title" => "Talk to a lot of different people at parties", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 37],
          ["title" => "See beauty in things that others might not notice", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 38],
          ["title" => "Cheat to get ahead", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 39],
          ["title" => "Often forget to put things back in their proper place", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 40],

          ["title" => "Dislike myself", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 41],
          ["title" => "Try to lead others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 42],
          ["title" => "Feel others' emotions", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 43],
          ["title" => "Am concerned about others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 44],
          ["title" => "Tell the truth", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 45],

          ["title" => "Am afraid to draw attention to myself", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 46],
          ["title" => "Am always on the go", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 47],
          ["title" => "Prefer to stick with things that I know", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 48],
          ["title" => "Yell at people", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 49],
          ["title" => "Do more than what's expected of me", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 50],

          ["title" => "Rarely overindulge", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 51],
          ["title" => "Seek adventure", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 52],
          ["title" => "Avoid philosophical discussions", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 53],
          ["title" => "Think highly of myself", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 54],
          ["title" => "Carry out my plans", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 55],

          ["title" => "Become overwhelmed by events", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 56],
          ["title" => "Have a lot of fun", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 57],
          ["title" => "Believe that there is no absolute right and wrong", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 58],
          ["title" => "Feel sympathy for those who are worse off than myself", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 59],
          ["title" => "Make rash decisions", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 60],

          ["title" => "Am afraid of many things", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 61],
          ["title" => "Avoid contacts with others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 62],
          ["title" => "Love to daydream", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 63],
          ["title" => "Trust what people say", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 64],
          ["title" => "Handle tasks smoothly", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 65],

          ["title" => "Lose my temper", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 66],
          ["title" => "Prefer to be alone", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 67],
          ["title" => "Do not like poetry", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 68],
          ["title" => "Take advantage of others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 69],
          ["title" => "Leave a mess in my room", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 70],

          ["title" => "Am often down in the dumps", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 71],
          ["title" => "Take control of things", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 72],
          ["title" => "Rarely notice my emotional reactions", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 73],
          ["title" => "Am indifferent to the feelings of others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 74],
          ["title" => "Break rules", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 75],

          ["title" => "Only feel comfortable with friends", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 76],
          ["title" => "Do a lot in my spare time", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 77],
          ["title" => "Dislike changes", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 78],
          ["title" => "Insult people", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 79],
          ["title" => "Do just enough work to get by", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 80],

          ["title" => "Easily resist temptations", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 81],
          ["title" => "Enjoy being reckless", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 82],
          ["title" => "Have difficulty understanding abstract ideas", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 83],
          ["title" => "Have a high opinion of myself", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 84],
          ["title" => "Waste my time", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 85],

          ["title" => "Feel that I'm unable to deal with things", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 86],
          ["title" => "Love life", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 87],
          ["title" => "Tend to vote for conservative political candidates", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 88],
          ["title" => "Am not interested in other people's problems", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 89],
          ["title" => "Rush into things", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 90],

          ["title" => "Get stressed out easily", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 91],
          ["title" => "Keep others at a distance", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 92],
          ["title" => "Like to get lost in thought", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 93],
          ["title" => "Distrust people", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 94],
          ["title" => "Know how to get things done", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 95],

          ["title" => "Am not easily annoyed", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 96],
          ["title" => "Avoid crowds", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 97],
          ["title" => "Do not enjoy going to art museums", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 98],
          ["title" => "Obstruct others' plans", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 99],
          ["title" => "Leave my belongings around", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 100],

          ["title" => "Feel comfortable with myself", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 101],
          ["title" => "Wait for others to lead the way", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 102],
          ["title" => "Don't understand people who get emotional", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 103],
          ["title" => "Take no time for others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 104],
          ["title" => "Break my promises", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 105],

          ["title" => "Am not bothered by difficult social situations", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 106],
          ["title" => "Like to take it easy", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 107],
          ["title" => "Am attached to conventional ways", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 108],
          ["title" => "Get back at others", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 109],
          ["title" => "Put little time and effort into my work", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 110],

          ["title" => "Am able to control my cravings", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 111],
          ["title" => "Act wild and crazy", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 112],
          ["title" => "Am not interested in theoretical discussions", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 113],
          ["title" => "Boast about my virtues", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 114],
          ["title" => "Have difficulty starting tasks", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 115],

          ["title" => "Remain calm under pressure", "quiz_domain_value_id" => QuizDomainValue::where("title", "Emotional Stability")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 116],
          ["title" => "Look at the bright side of life", "quiz_domain_value_id" => QuizDomainValue::where("title", "Extraversion")->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 117],
          ["title" => "Believe that we should be tough on crime", "quiz_domain_value_id" => QuizDomainValue::where("title", "Openness to Experience")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 118],
          ["title" => "Try not to think about the needy", "quiz_domain_value_id" => QuizDomainValue::where("title", "Agreeableness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 119],
          ["title" => "Act without thinking", "quiz_domain_value_id" => QuizDomainValue::where("title", "Conscientiousness")->first()->id, "minPoints" => 5, "maxPoints" => 1, "order" => 120],


          ["title" => "I know how to identify opportunities that can help solve problems at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Spotting Opportunities", "quiz_domain_id" => QuizDomain::where("title", "Ideas and Opportunities")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 1],
          ["title" => "I believe I can bring value to others through my work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Spotting Opportunities", "quiz_domain_id" => QuizDomain::where("title", "Ideas and Opportunities")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 2],
          ["title" => "In the past I have been able to use my existing knowledge to create opportunities that benefited my performance at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Spotting Opportunities", "quiz_domain_id" => QuizDomain::where("title", "Ideas and Opportunities")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 3],
          ["title" => "I am good at brain storming to generate new ideas", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Creativity", "quiz_domain_id" => QuizDomain::where("title", "Ideas and Opportunities")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 4],
          ["title" => "I can find ways to meet challenges that arise in my work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Creativity", "quiz_domain_id" => QuizDomain::where("title", "Ideas and Opportunities")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 5],
          ["title" => "In the past I have been able to convince people to get involved in my projects in school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Creativity", "quiz_domain_id" => QuizDomain::where("title", "Ideas and Opportunities")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 6],
          ["title" => "I am able to list down the different types of value that a single idea can have", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Valuing Ideas", "quiz_domain_id" => QuizDomain::where("title", "Ideas and Opportunities")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 7],
          ["title" => "I can find examples of valuable ideas that solve problems faced in school or work settings", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Valuing Ideas", "quiz_domain_id" => QuizDomain::where("title", "Ideas and Opportunities")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 8],
          ["title" => "in the past, I have used my ideas to solve existing problems I face at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Valuing Ideas", "quiz_domain_id" => QuizDomain::where("title", "Ideas and Opportunities")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 9],
          ["title" => "I am able to build a vision of the future that is inspiring to others", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Vision", "quiz_domain_id" => QuizDomain::where("title", "Ideas and Opportunities")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 10],
          ["title" => "I can visualise the future I want to live in", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Vision", "quiz_domain_id" => QuizDomain::where("title", "Ideas and Opportunities")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 11],
          ["title" => "I know what decisions to make to achieve the future I have envisioned", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Vision", "quiz_domain_id" => QuizDomain::where("title", "Ideas and Opportunities")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 12],
          ["title" => "My behaviour at work is guided by my own ethical standards", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Ethical and Sustainable Thinking", "quiz_domain_id" => QuizDomain::where("title", "Ideas and Opportunities")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 13],
          ["title" => "I know why integrity and ethical behaviour is important at work or school", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Ethical and Sustainable Thinking", "quiz_domain_id" => QuizDomain::where("title", "Ideas and Opportunities")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 14],
          ["title" => "I take responsibility for promoting ethical work practices in my school or workplace", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Ethical and Sustainable Thinking", "quiz_domain_id" => QuizDomain::where("title", "Ideas and Opportunities")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 15],
          ["title" => "I know I can do well and what I cannot do well", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Self Awareness", "quiz_domain_id" => QuizDomain::where("title", "Resources")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 16],
          ["title" => "People have told me that I am good at delivering presentations at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Self Awareness", "quiz_domain_id" => QuizDomain::where("title", "Resources")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 17],
          ["title" => "I examine the pros and cons of different options to make decisions that reflect my preferences in the course of completing my work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Self Awareness", "quiz_domain_id" => QuizDomain::where("title", "Resources")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 18],
          ["title" => "I believe I can carry out work successfully at school or my workplace", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Self Efficacy", "quiz_domain_id" => QuizDomain::where("title", "Resources")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 19],
          ["title" => "I am not afraid to make mistakes when trying a new activity or skill at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Self Efficacy", "quiz_domain_id" => QuizDomain::where("title", "Resources")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 20],
          ["title" => "I believe in my ability to carry out plans in my school or workplace despite barriers and challenges that arise", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Self Efficacy", "quiz_domain_id" => QuizDomain::where("title", "Resources")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 21],
          ["title" => "I know how to develop a budget for a project at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Financial and Economic Literacy", "quiz_domain_id" => QuizDomain::where("title", "Resources")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 22],
          ["title" => "I am able to improve my ideas by evaluating their costs and benefits", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Financial and Economic Literacy", "quiz_domain_id" => QuizDomain::where("title", "Resources")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 23],
          ["title" => "I am able to develop financial plans for a project at school or work that will continue even if I leave", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Financial and Economic Literacy", "quiz_domain_id" => QuizDomain::where("title", "Resources")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 24],
          ["title" => "I encourage others to contribute to improving my school or workplace", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Mobilising Others", "quiz_domain_id" => QuizDomain::where("title", "Resources")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 25],
          ["title" => "I am able to motivate and inspire people to support my projects at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Mobilising Others", "quiz_domain_id" => QuizDomain::where("title", "Resources")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 26],
          ["title" => "In the past, I have been able to assemble  group of people with different skills to compensate individual weaknesses in order to complete a task", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Mobilising Others", "quiz_domain_id" => QuizDomain::where("title", "Resources")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 27],
          ["title" => "I make plans based on the resources I have and the resources I can gather in the course of completing my work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Mobilising Resources", "quiz_domain_id" => QuizDomain::where("title", "Resources")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 28],
          ["title" => "I am able to find sponsors and manage a budget for a project successfully at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Mobilising Resources", "quiz_domain_id" => QuizDomain::where("title", "Resources")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 29],
          ["title" => "I am able to identify resources that I can use in overcoming challenges at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Mobilising Resources", "quiz_domain_id" => QuizDomain::where("title", "Resources")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 30],
          ["title" => "I am not afraid of having to work hard to achieve my goals at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Motivation and Perseverance", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 31],
          ["title" => "I stay motivated and work to overcome challenges in the effort of reaching my goals at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Motivation and Perseverance", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 32],
          ["title" => "I use my strengths to make progress at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Motivation and Perseverance", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 33],
          ["title" => "People have told me that I am a good team player at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Working with Others", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 31],
          ["title" => "I am able to form teams and networks of talent according to the needs of the project I am working on", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Working with Others", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 32],
          ["title" => "I am confident in my ability to work with diverse individuals and groups in achieving a common goal at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Working with Others", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 33],
          ["title" => "I develop plans which define priorities and list achievable milestones for projects at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Planning and Management", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 34],
          ["title" => "Before beginning a project at school or work, I set goals I want to achieve", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Planning and Management", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 35],
          ["title" => "I am able to create plans that will maximise the value of ideas I encounter at school or at work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Planning and Management", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 36],
          ["title" => "I find ways to improve myself by reflecting on what I have learnt from projects at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Learning Through Experience", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 37],
          ["title" => "I reflect on what went well and mistakes made after finishing a project to learn from experience", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Learning Through Experience", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 38],
          ["title" => "I can identifywhat I have learnt from working on projects at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Learning Through Experience", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 39],
          ["title" => "I use my best judgment and available information to make decisions when a situation at school or work is ambiguous or uncertain", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Coping with Uncertainty Ambiguity and Risk", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 40],
          ["title" => "I am able to adapt my plans when circumstances change in the course of completing my work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Coping with Uncertainty Ambiguity and Risk", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 41],
          ["title" => "I have a clear idea of my goals and targets at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Coping with Uncertainty Ambiguity and Risk", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 42],
          ["title" => "In the past I have been the one who initiated action to make improvements at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Taking the Initiative", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 43],
          ["title" => "I want to take responsibility in meeting challenges at work or school", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Taking the Initiative", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 44],
          ["title" => "In the past, I have effectively used different types of resources to achieve my goals at school or work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Taking the Initiative", "quiz_domain_id" => QuizDomain::where("title", "Into Action")->first()->id])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 45],


          ["title" => "I can use logical thinking to solve problems", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Critical Thinking", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 1],
          ["title" => "I am aware of unconscious biases in my thinking and how they can impact problem solving", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Critical Thinking", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 2],
          ["title" => "I can obtain relevant information to help me solve problems", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Critical Thinking", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 3],
          ["title" => "I can weigh up the advantages and disadvantages of a decision or course of action", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Critical Thinking", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 4],

          ["title" => "I am good at planning my time effectively to get the most important work completed", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Planning and Ways of Working", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 5],
          ["title" => "I can prioritise my work so that I get the most important work completed first", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Planning and Ways of Working", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 6],
          ["title" => "When starting a project, I can create a plan to ensure that I stay on track", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Planning and Ways of Working", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 7],
          ["title" => "I can switch tasks if required", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Planning and Ways of Working", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 8],

          ["title" => "I am confident about speaking in public", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Communication", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 9],
          ["title" => "When starting a new piece of work, I can ask the right questions so that I have all the information that I need", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Communication", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 10],
          ["title" => "I can understand key messages and communicate them to others in ways that they can easily understand", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Communication", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 11],
          ["title" => "I am good at listening and understanding the views of others", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Communication", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 12],

          ["title" => "I can use my creativity and imagination to help me solve problems or come up with new ideas", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Mental Flexibility", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 13],
          ["title" => "I can use learning from one area and apply it to another area for positive results", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Mental Flexibility", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 14],
          ["title" => "I can easily adapt to change", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Mental Flexibility", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 15],
          ["title" => "I can see a situation from many perspectives and am open to new learning", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Mental Flexibility", "quiz_domain_id" => $cognitiveDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 16],

          ["title" => "I can role model positive behaviour to others", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Mobilising Systems", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 17],
          ["title" => "I can negotiate with others so that everyone feels that they have gained a positive result", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Mobilising Systems", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 18],
          ["title" => "I can create an inspiring vision around a project or idea to build motivation and engagement in others", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Mobilising Systems", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 19],
          ["title" => "I can gain the information required to understand how organisations work and what is required of me", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Mobilising Systems", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 20],

          ["title" => "I have empathy for others and can put myself in their position to understand their point of view", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Developing Relationships", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 21],
          ["title" => "I can build trusting relationship with others by being open, honest and supportive", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Developing Relationships", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 22],
          ["title" => "I can demonstrate humility in my interactions with others", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Developing Relationships", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 23],
          ["title" => "I am sociable and can easily build relationships with other students, work colleagues or clients", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Developing Relationships", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 24],

          ["title" => "When working in a group I ensure that others feel included and their views are heard", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Effective Teamwork", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 25],
          ["title" => "I get to know people as individuals and understand what motivates them", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Effective Teamwork", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 26],
          ["title" => "I am good at supporting others to resolve conflicts", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Effective Teamwork", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 27],
          ["title" => "I am comfortable working with a diverse group of people towards a common goal", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Effective Teamwork", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 28],

          ["title" => "I can help others think about what they want to achieve", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Coaching Others", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 29],
          ["title" => "I am good at empowering others by helping them focus on their strengths", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Coaching Others", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 30],
          ["title" => "I can help others set goals for themselves", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Coaching Others", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 31],
          ["title" => "I can facilitate others to develop skills and knowledge", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Coaching Others", "quiz_domain_id" => $interpersonalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 32],

          ["title" => "I can understand my emotions and how the impact me", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Self-Awareness", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 33],
          ["title" => "I know what triggers my emotional responses", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Self-Awareness", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 34],
          ["title" => "I can calm myself down when feeling stressed", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Self-Awareness", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 35],
          ["title" => "I know my strengths and how to maximise them", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Self-Awareness", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 36],

          ["title" => "I can look after my physical and psychological wellbeing", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Self-Management", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 37],
          ["title" => "I know how to motivate myself so that I make progress towards my goals", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Self-Management", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 38],
          ["title" => "I am confident in my abilities to make progress towards my goals", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Self-Management", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 39],
          ["title" => "I have integrity and adhering to my core values is important to me", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Self-Management", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 40],

          ["title" => "I have the courage to take appropriate risks when developing a new idea or product", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Entrepreneurship", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 41],
          ["title" => "I am comfortable with change and can come up with innovative solutions", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Entrepreneurship", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 42],
          ["title" => "I am not afraid to do things differently if the old ways are no longer working", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Entrepreneurship", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 43],
          ["title" => "I have energy, passion, positivity and optimism in my approach to my work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Entrepreneurship", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 44],

          ["title" => "I can set my own goals and take responsibility for their achievement", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Goal Achievement", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 45],
          ["title" => "I persevere and make progress towards important goals despite facing challenges", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Goal Achievement", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 46],
          ["title" => "I can keep working towards important goals in periods of uncertainty", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Goal Achievement", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 47],
          ["title" => "I am always learning and developing my skills", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Goal Achievement", "quiz_domain_id" => $selfLeadershipDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 48],

          ["title" => "I can find, evaluate, utilise, share, and create content using information technologies and the Internet.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Digital Fluency", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 49],
          ["title" => "I can collaborate with other and complete work using digital devices and technology", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Digital Fluency", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 50],
          ["title" => "I can use technology to gather information, learn new things and develop new skills", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Digital Fluency", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 51],
          ["title" => "I understand the importance of managing myself professionally and ethically via online and digital mediums", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Digital Fluency", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 52],

          ["title" => "I can adapt to using new software in my work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Software Use", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 53],
          ["title" => "I can understand how new software can integrate with established ways of working", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Software Use", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 54],
          ["title" => "I am open to learning how to use new software in my work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Software Use", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 55],
          ["title" => "I am confident in learning how to use new software and digital systems", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Software Use", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 56],

          ["title" => "I can develop new digital systems to enhance work practices", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Software Development", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 57],
          ["title" => "I have the ability to read and understand computer code in digital systems", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Software Development", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 58],
          ["title" => "I have the ability to create and adapt computer code", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Software Development", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 59],
          ["title" => "I can create digital programmes to solve problems or automate tasks", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Software Development", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 60],

          ["title" => "I understand how to use Cybersecurity programmes", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Understanding Digital Systems", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 61],
          ["title" => "I understand how to streamline operations or systems using digital platforms or solutions (Tech Translation and Enablement) ", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Understanding Digital Systems", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 62],
          ["title" => "I understand Smart systems and how to use them", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Understanding Digital Systems", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 63],
          ["title" => "I understand how to use digital data to gain insights in my field of work", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Understanding Digital Systems", "quiz_domain_id" => $digitalDomainId])->first()->id, "minPoints" => 1, "maxPoints" => 5, "order" => 64],


          ["title" => "My new job is _____ interesting than my previous one.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["very" => 0, "more" => 1, "much" => 0, "not" => 0], "order" => 1],
          ["title" => "The _____ new CEO has a lot of good ideas.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["company" => 0, "companies" => 0, "company's" => 1, "companie's" => 0], "order" => 2],
          ["title" => "There are _____ many emails in my inbox!", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["some" => 0, "enough" => 0, "any" => 0, "too" => 1], "order" => 3],
          ["title" => "Everyone _____ carefully to presentation when I arrived.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["was listening" => 1, "were listening" => 0, "did listen" => 0, "listen" => 0], "order" => 4],
          ["title" => "What did you do before you joined this company?", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["I work in IT." => 0, "I working in IT." => 0, "I worked in IT." => 1, "I been work in IT." => 0], "order" => 5],
          ["title" => "She _____ learning English when she was in elementary school.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["started" => 1, "start" => 0, "was start" => 0, "has started" => 0], "order" => 6],
          ["title" => "When did you take your English test?", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["I was take it two months ago." => 0, "I was taken it two months ago." => 0, "I took it two months ago." => 1, "I take it two months ago." => 0], "order" => 7],
          ["title" => "Make sure you revise, the questions in the test _____ be more difficult than last year.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["must" => 0, "have to" => 0, "could" => 1, "ought" => 0], "order" => 8],
          ["title" => "If I _____ studied harder, I _____ ______ got a better result in my test.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["was, will have" => 0, "had, would have" => 1, "has, would have" => 0, "had, will have" => 0], "order" => 9],
          ["title" => "My English has improved _____ reading books and newspapers.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["due" => 0, "as a result of" => 1, "beacuse" => 0, "consequently" => 0], "order" => 10],
          ["title" => "Technology ______ ______ greatly over the last 5 years.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["has improved" => 1, "had improved" => 0, "did improve" => 0, "did improved" => 0], "order" => 11],
          ["title" => "You _____ change your password regularly to be safe.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["could" => 0, "might" => 0, "would" => 0, "should" => 1], "order" => 12],
          ["title" => "If we _____ _____ remote working, many people _____ _____ unemployed.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["had had, will be" => 0, "could have, would have" => 0, "wouldn't  have, could be" => 0, "hadn't had, would be" => 1], "order" => 13],
          ["title" => "He _____ _____ _____ several times in his career before he _____.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["has been promoted, retired" => 0, "had been promoted, retired" => 1, "has been promoted, retire" => 0, "had been promoted, retire" => 0], "order" => 14],
          ["title" => "Social media platforms _____ _____ by most people on a daily basis.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["were use" => 0, "are use" => 0, "were used" => 0, "are used" => 1], "order" => 15],
          ["title" => "Climate change has impacted the area in _____ I live.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["that" => 0, "where" => 0, "which" => 1, "whom" => 0], "order" => 16],
          ["title" => "When I was younger, not many people _____ recycle their rubbish.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["would" => 1, "did" => 0, "had" => 0, "was" => 0], "order" => 17],
          ["title" => "There is a danger that some animal species will _____ _____ .", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["die off" => 0, "die out" => 1, "die by" => 0, "die from" => 0], "order" => 18],
          ["title" => "If only people _____ _____ more attention to climate change before we _____ this critical point.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["had paid, reach" => 0, "had paid, reaching" => 0, "was paid, reached" => 0, "had paid, reached" => 1], "order" => 19],
          ["title" => "Future generations _____ _____ _____ with the impact of climate change for decades.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Grammar", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 1, "options" => ["would be dealing" => 0, "need be dealing" => 0, "have to dealing" => 0, "will be dealing" => 1], "order" => 20],

          ["title" => "According to The Cambridge Encyclopaedia of the English Language the global population in the 1600s was 6,000,000.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Comprehension", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 2, "options" => ["The statement above is true." => 0, "The above statement is false." => 2, "The statement above is not given in the text. " => 0], "order" => 21],
          ["title" => "The number of people speaking English increased significantly in the 350 years between 1600 and 1950 because of the British empire.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Comprehension", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 3, "options" => ["The statement above is true." => 0, "The above statement is false." => 0, "The statement above is not given in the text. " => 3], "order" => 22],
          ["title" => "There are more people learning English than those who speak it as their main language.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Comprehension", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 2, "options" => ["The statement above is true." => 2, "The above statement is false." => 0, "The statement above is not given in the text. " => 0], "order" => 23],
          ["title" => "According to the text, the best employers in the world pay higher salaries to applicants who are competent in English or attend the best universities in the world.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Comprehension", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 3, "options" => ["The statement above is true." => 0, "The above statement is false." => 3, "The statement above is not given in the text. " => 0], "order" => 24],
          ["title" => "Michelle Connolly attributes the rise in importance of English to the rise in popularity of American movies.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Comprehension", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 2, "options" => ["The statement above is true." => 0, "The above statement is false." => 2, "The statement above is not given in the text. " => 0], "order" => 25],
          ["title" => "Michelle Connolly is unhappy about the prolific nature of American culture in the modern world.", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Comprehension", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 3, "options" => ["The statement above is true." => 0, "The above statement is false." => 0, "The statement above is not given in the text. " => 3], "order" => 26],
          ["title" => "David Crystal describes the English language as a ‘hybrid’ because:", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Comprehension", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 2, "options" => ["It is dynamic and evolving." => 0, "It borrows words from other languages." => 2, "It is flexible and relevant in the modern world." => 0], "order" => 27],
          ["title" => "Alison Chan’s advice to anyone looking for a job in the global workplace is to :", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Comprehension", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 3, "options" => ["Be fluent in English" => 0, "Be multi-skilled" => 3, "Be competitive" => 0, "Make sure English is one of your strongest skills" => 0, "All of the above" => 0], "order" => 28],
          ["title" => "How many official languages does the UN have?", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Comprehension", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 5, "options" => [4 => 0, 5 => 0, 6 => 5, 8 => 0, 12 => 0], "order" => 29],
          ["title" => "According to the text, English has become a truly global language because:", "quiz_domain_value_id" => QuizDomainValue::where(["title" => "Comprehension", "quiz_domain_id" => $englishGeneralDomainId])->first()->id, "minPoints" => 0, "maxPoints" => 5, "options" => ["The best universities in the world teach in English" => 0, "The world’s top 100 employers only recruit people who are fluent in English, multi-skilled and graduates from the best universities" => 0, "English is a dynamic, evolving, hybrid language" => 0, "Around a third of the world's population can communicate in English and it increases employability in the global job market" => 5, "All of the above" => 0], "order" => 30],
        ];
        foreach ($data as $value) {

          QuizDomainValueQuestion::updateOrCreate($value);

        }
    }
}
