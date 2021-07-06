<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('me')) {

    function me()
    {
        return Auth::user();
    }
}

if (! function_exists('cut_sentence')) {

    function cut_sentence($data)
    {
        return str_word_count($data) > 15 ? substr($data,0,80)."..." : $data;
    }
}

if (! function_exists('msg_success')) {
    /**
     * Flash success message.
     *
     * @param  string  $message
     * @return void
     */
    function msg_success($message)
    {
        session()->flash('flash', ['message' => $message, 'level' => 'success']);
    }
}

if (! function_exists('msg_error')) {
    /**
     * Flash error message.
     *
     * @param  string  $message
     * @return void
     */
    function msg_error($message)
    {
        session()->flash('flash', ['message' => $message, 'level' => 'danger']);
    }
}
