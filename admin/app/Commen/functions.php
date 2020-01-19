<?php

function api_response($content, $code = 200, $data = [])
{
    $arr = [];
    $arr['message'] = $content;
    $arr['status_code'] = $code;
    $data ? $arr['data'] = $data : [];

    return response()->json($arr);
}

