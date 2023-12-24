<?php

/**
 * Get website's content as a string
 * 
 * @param string $url website's URL
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
 * @return int Returns `1`, always.
 */
function consolePut(string $expression): int
{
    $print_result = print($expression);
    flush();

    return $print_result;
}
