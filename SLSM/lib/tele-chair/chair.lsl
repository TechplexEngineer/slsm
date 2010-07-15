//TeleChair V2.5

list   places = [];
list   locs   = [];

key     agent;
key     avatar;
integer lines;
float   version = 2.5;
integer server_chan = 30;
integer chair_chan = 25;
integer rez_chan = 5;
string config = "config";
integer i =0;

string tpmenu = " \n Where would you like to go?";
string delmsg = "Return to this station to teleport to a new location.";
string sitText = "Sit to TP";
warp(vector pos)
{
    llWhisper(rez_chan, "new"); // new chair
    list rules;
    integer num = llRound(llVecDist(llGetPos(),pos)/10)+1;
    integer x;
    for(x=0; x<num; ++x) rules=(rules=[])+rules+[PRIM_POSITION,pos];
    llSetPrimitiveParams(rules);
}
del() //Remove self
{
    llSleep(.5);
    llUnSit(agent);
    llSay(0, delmsg);
    llSetTimerEvent(5);
}
updateConfig()
{
    if(llGetInventoryType(config) == 7)
        llGetNumberOfNotecardLines(config);
}

default
{
    on_rez(integer munber)
    {
        llWhisper(chair_chan, "removeself"); // removes other chairs
        updateConfig();
    }

    state_entry()
    {
        updateConfig();
        llListen(chair_chan, "", NULL_KEY,"");  //listen for menu
        llSetSitText(sitText);
        llSitTarget(<0.0,0.0,-0.6>, <0,-0.2,0,1>);
        llSetCameraEyeOffset(<-2, 0.0, 1>);
        // the camera is 2m behind and 1m above the object
        llSetCameraAtOffset(<2, 0.0, -1>);
        // and looks at a point that is 2m in front and 1m above the object
        llSetObjectName("Tele-Chair");
        llSetObjectDesc("By: Techplex Engineer V" + (string)version + " (Techplex Labs) BBI");
    }
    touch_start(integer total_number)
    {
        avatar = llDetectedKey(0);     // Toucher
        agent = llAvatarOnSitTarget(); // sitting on
        if(avatar == agent)
        {
            if (agent)// make sure sitting before diplaying menu
            {
                llDialog(agent,tpmenu, places, 25);
            }
            else
            {
                llSay(0, "You must be seated to travel");\
            }
        }
        else
        {
            llSay(0, "You must be seated to travel");\
        }
    }
    changed(integer change)
    {
        if(change == CHANGED_INVENTORY)
        {
            updateConfig();
        }
        if (change && CHANGED_LINK)
        {
            agent = llAvatarOnSitTarget(); // make sure sitting
            if (agent)
            {
                llDialog(agent,tpmenu, places, 25); // display menu
            }
            else
            {
                llUnSit(agent);
            }
        }
    }
    listen (integer channel,string name, key id, string message)
    {
        if (message == "removeself")
        {
            llDie();
        }

        // Pulls info from above no mofification necicary
        integer acb;
        for (acb =0; acb < llGetListLength(places); acb++)
        {
            if (message == llList2String(places, acb))
            {
                warp(llList2Vector(locs, acb));
                del();
            }
        }
    }
    timer()
    {
        llSetTimerEvent(0);
        //llOwnerSay("Delete");
        llDie();
    }
    dataserver(key queryid, string data)
    {
        //llOwnerSay(data);
        integer abc = (integer)data;
        string bcd =(string)abc;
        if(data == bcd)
        {
            lines = (integer)data;
            if( i < lines)
                llGetNotecardLine(config, i);
        }
        else
        {
            //llOwnerSay("data " + llGetSubString(data, -36, -1));
            places += llGetSubString(data, 0, llSubStringIndex(data, "|")-1);
            locs   += (vector)llGetSubString(data, llSubStringIndex(data, "|")+1, -38);
            i++;
            if( i < lines)
                llGetNotecardLine(config, i);
            else
                llSay(0, "Ready");
        }
    }
}
