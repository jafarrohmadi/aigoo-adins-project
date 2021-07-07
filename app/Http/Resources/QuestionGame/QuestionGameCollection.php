<?php

namespace App\Http\Resources\QuestionGame;

use App\Models\QuizChoice;
use App\Models\QuizComplete;
use App\Models\QuizMatch;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionGameCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $quizChoiceTake = $quizCompleteTake = $quizMatchTake = 3;

        $randomOneQuiz = rand(1,3);

        if($randomOneQuiz == 1)
        {
            $quizChoiceTake++;
        }

        if($randomOneQuiz == 2)
        {
            $quizCompleteTake++;
        }

        if($randomOneQuiz == 3)
        {
            $quizMatchTake++;
        }

        return [
            'status'  => true,
            'message' => 'Success',
            'data' => [
                'choose' => QuestionsChoicesResource::collection(QuizChoice::where('category',$request->category)->inRandomOrder()->limit($quizChoiceTake)->get()),
                'complete' => QuestionCompleteResource::collection(QuizComplete::where('category',$request->category)->inRandomOrder()->limit($quizCompleteTake)->get()),
                'matching' => QuestionMatchResource::collection(QuizMatch::where('category',$request->category)->inRandomOrder()->limit($quizMatchTake)->get())
            ]
        ];
    }

}
