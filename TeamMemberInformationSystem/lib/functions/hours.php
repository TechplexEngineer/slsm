<?php

function getCol($name)
{
    $r = 1;
    $c = 2;
    $cellVal = getCell($r, $c, 1);
    while ($cellVal != $name)
    {
        if (empty($cellVal))
        {
            return "error";
        }
        $c++;
        $cellVal = getCell($r, $c, 1);
        //echo $c;
    }
    return $c;
}

function getRow($name)
{
    $r=2;
    $c=1;
    $cellVal = getCell($r,$c,1);
    while ($cellVal != $name)
    {
        if (empty($cellVal))
        {
            return "error";
        }
        $r++;
        $cellVal = getCell($r, $c, 1);
        //echo $c;
    }
    return $r;
    
}

function getCell($r, $c, $sheet)
{
    include "vars.php";
    $baseurl = "http://spreadsheets.google.com/feeds/cells/";
    $spreadsheet = $ssid . "/";
    $sheetID = $sheet . "/";
    $vis = "public/";
    $proj = "basic/";
//$cell = "R3C2";
    $cell = "R" . $r . "C" . $c;

    $url = $baseurl . $spreadsheet . $sheetID . $vis . $proj . $cell . "";

    $xml = file_get_contents($url);

    //Sometimes the data is not xml formatted,
    //so lets try to remove the url, from the xml not formatted
    $urlLen = strlen($url);
    $xmlWOurl = substr($xml, $urlLen);

    //then find the Z (in the datestamp, assuming its always there)
    $posZ = strrpos($xmlWOurl, "Z");
    //then substr from z2end
    $data = substr($xmlWOurl, $posZ + 1);

    //if the result has more than ten characters then something went wrong
    if (strlen($data) > 10)
    {
        //Asuming we have xml 
        $datapos = strrpos($xml, "<content type='text'>");
        $datapos += 21;
        $datawj = substr($xml, $datapos);
        $endcont = strpos($datawj, "</content>");
        return substr($datawj, 0, $endcont);
    }
    else
        return $data;
}

function getHours($name, $sheet)
{
    $r = 1;
    $c = 2;
    $curCell = getCell("R" . $r . "C" . $c, $sheet);
    $count = 0;
    //echo $curCell;

    while ($count < 25)
    {
        //echo "'".$curCell. "' " .$name." ".$count." ".empty($curCell). "<br/>\n";
        $count++;
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

?>