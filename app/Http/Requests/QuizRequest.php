<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Quiz;

use Illuminate\Http\Request;

use App\Models\QuizDomainValueAnswer;

class QuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
      $submitType = $request->input('submit');

      if(!$submitType) abort(403);

      $quiz = $this->route('quiz');

      if($quiz->timer){

        $values = [];

        $answers = [];

        foreach($quiz['domains'] as $domain){

          foreach($domain['values'] as $value){

            $values[] = $value['title'];

            $answers[$value['title']] = $value['answers_sum_answer'];

          }

        }

        $arr['type'] = 'required|in:' . implode(',', $values);

        $questions = Quiz::with(['domains' => function($query) use($request){

          $query->with(['values' => function($query) use($request){

            $query->with('questions')->where('title', $request->get('type'));

          }]);

        }])->where('name', $quiz->name)->first()->toArray();


      }else{

        $questions = Quiz::with('domains.values.questions')->where('name', $quiz->name)->first()->toArray();

      }

      $arr = [];

      foreach($questions['domains'] as $domain){

        foreach($domain['values'] as $key => $value){

            foreach($value['questions'] as $k => $question){

              $arr['answers['.$question['id'].']'] = $submitType == 'submit' ? 'required|integer|' : 'integer|';

              if($question['minPoints'] < $question['maxPoints']){

                $arr['answers['.$question['id'].']'] .= 'min:'.$question['minPoints'].'|max:'.$question['maxPoints'];

              }else{

                $arr['answers['.$question['id'].']'] .= 'max:'.$question['minPoints'].'|min:'.$question['maxPoints'];

              }

            }

         }

       }

       return $arr;

    }

    // public function storeQuiz($user_id){

    //   $data = $this->validated();

    //   foreach($data as $key => $value){

    //     QuizDomainValueAnswer::updateOrCreate(['user_id' => $user_id, 'quiz_domain_value_question_id' => $this->extractQuestionId($key)], ['answer' => $value]);

    //   }

    // }

    public function storeQuiz($user_id)
    {
        $data = $this->validated();

        // Prepare the data for upsert
        $upsertData = [];
        foreach ($data as $key => $value) {
            $upsertData[] = [
                'user_id' => $user_id,
                'quiz_domain_value_question_id' => $this->extractQuestionId($key),
                'answer' => $value,
                'updated_at' => now(), // Ensure timestamp fields are updated
            ];
        }

        // Use upsert to handle insert or update
        QuizDomainValueAnswer::upsert(
            $upsertData,
            ['user_id', 'quiz_domain_value_question_id'], // Columns for unique constraint
            ['answer', 'updated_at'] // Columns to update if duplicate
        );
    }


    private function extractQuestionId($item){

      return str_replace(['answers[',']'], ['', ''], $item);

    }

}
