integer time_diff;
updateTime()
{
    llHTTPRequest("http://techwizworld.net/SLSM_TE_3/phpTime.php?cmd=time&slt=" + (string)llGetUnixTime(), [], "");
llOwnerSay("Tome Updated");
}
default
{
    state_entry()
    {
        llSetText("Time Server \n Touch me to update time difference now", <1,.5,.25>,1);
        updateTime();
        llSetTimerEvent(7200);
    }

    touch_start(integer total_number)
    {
        llSay(0, "Touched.");
    }
    timer()
    {
        updateTime();
    }
}
