<?php

function getHours($name, $sheet)
{
    $r = 1;
    $c = 2;
    $curCell = getCell("R" . $r . "C" . $c, $sheet);
    $count = 0;
    //echo $curCell;

    while ($count < 25 )
    {
        //echo "'".$curCell. "' " .$name." ".$count." ".empty($curCell). "<br/>\n";
        $count ++;
        if ($curCell === $name)
        {
            return getCell("R" . "3" . "C" . $c, $sheet); //This is the value of the cell

        } else
        {
            $c++;
            $curCell = getCell("R" . $r . "C" . $c, $sheet);
        }
    }
    return "not found";
}

function getCell($cell, $sheet)
{
    $baseurl = "https://spreadsheets.google.com/feeds/cells/";
    $spreadsheet = "0AnhvV5acDaAvdDRvVmk1bi02WmJBeUtBak5xMmFTNEE/";
    $sheetID = $sheet . "/";
    $vis = "public/";
    $proj = "basic/";
//$cell = "R3C2";

    $url = $baseurl . $spreadsheet . $sheetID . $vis . $proj . $cell . "";
//echo $final ."\n <br/>";
    //echo $url;
    $xml = file_get_contents($url);

//echo $xml;
//remove the url
    $urlLen = strlen($url);
    $xmlWOurl = substr($xml, $urlLen);

//then find the Z
    $posZ = strrpos($xmlWOurl, "Z");
//then substr from z2end
    $data = substr($xmlWOurl, $posZ + 1);
    
    if(strlen($data) > 10) //if the result has more than ten characters then sommits wrong
    {
        $datapos = strrpos($xml,"<content type='text'>");
        $datapos += 21;
        $datawj = substr($xml, $datapos);
        $endcont = strpos($datawj,"</content>");
        return substr($datawj, 0,$endcont);
    }
    else
        return $data;
}

//https://spreadsheets.google.com/feeds/cells/0AnhvV5acDaAvdDRvVmk1bi02WmJBeUtBak5xMmFTNEE/1/private/basic/R3C2

//<?xml version='1.0' encoding='UTF-8'>
//<entry xmlns='http://www.w3.org/2005/Atom' xmlns:gs='http://schemas.google.com/spreadsheets/2006' xmlns:batch='http://schemas.google.com/gdata/batch'>
//    <id>https://spreadsheets.google.com/feeds/cells/0AnhvV5acDaAvdDRvVmk1bi02WmJBeUtBak5xMmFTNEE/1/private/basic/R3C2</id>
//    <updated>2010-08-22T03:40:26.060Z</updated>
//    <category scheme='http://schemas.google.com/spreadsheets/2006' term='http://schemas.google.com/spreadsheets/2006#cell'/>
//    <title type='text'>B3</title>
//    <content type='text'>Testing</content>
//    <link rel='self' type='application/atom+xml' href='https://spreadsheets.google.com/feeds/cells/0AnhvV5acDaAvdDRvVmk1bi02WmJBeUtBak5xMmFTNEE/1/private/basic/R3C2'/>
//</entry>
//
////find title tag
///sub begin title to end
//find next title tag
//<content type='text'>
?>