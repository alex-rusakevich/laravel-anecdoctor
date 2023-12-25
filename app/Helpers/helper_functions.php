<?php

use ConsoleTVs\Profanity\Facades\Profanity;

/**
 * Get website's content as a string
 * 
 * @param string $url website's URL
 * 
 * @return string website's fetched body
 */
function curlToStr(string $url): string
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as a string

    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);
    return $response;
}

/**
 * Output a string to console _immediately_
 * Outputs `expression`.
 *
 * @param string $expression The expression to be output. Non-string values will be coerced to strings, even when the `strict_types` directive is enabled.
 * @param string $endl Line's end, defaults to `\n`
 * 
 * @return int Returns `1`, always.
 */
function consolePut(string $expression, string $endl = "\n"): int
{
    $print_result = print($expression . $endl);
    flush();

    return $print_result;
}

/**
 * Check if some text has curse/profane words
 * 
 * @param string $str text to check
 * 
 * @return bool does the text have curse words
 */
function hasCurse(string $str): bool
{
    return (count(Profanity::blocker($str)->badWords()) != 0);
}
