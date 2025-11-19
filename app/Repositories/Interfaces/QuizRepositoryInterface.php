<?php


namespace App\Repositories\Interfaces;


interface QuizRepositoryInterface
{

    public function userQuestionsAndAnswers($quiz, $user_id, $type);
}
