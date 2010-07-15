//Newest 9/29/09
list dest = [];


string inv = "Tele-Chair";
string config = "config";
list buttons = ["Chairs", "Rezzers", "Config"];

integer server_chan = 30;
integer chair_chan = 25;
integer rez_chan = 5;

list places;
list locs;
list keys;
list all;
integer x;
integer i = 0;
integer qid;
integer lines;

updateServerConfig()
{
    if(llGetInventoryType(config) == 7)
        llGetNumberOfNotecardLines(config);
}

default
{
    state_entry()
    {
        updateServerConfig();
        llListen(server_chan, "", NULL_KEY,"");  //menu
        //llRegionSay(5, "key");
    }
    touch_start(integer num)
    {
        if (llDetectedKey(0) == llGetOwner())
        {
            llDialog(llGetOwner(), "Update what?", buttons, server_chan);
        }
    }
    listen(integer channel, string name, key id, string msg)
    {
        if(msg == "Chairs")
        {
            if(llGetInventoryType(inv) == INVENTORY_OBJECT)
            {
                llSetText("Updating System Please Wait...",<1,.5,0>, 1);
                llRegionSay(rez_chan, "removeChair");
                llSleep(.5);
                for(x = 0; x < llGetListLength(dest); x++)
                {
                    llGiveInventory(llList2Key(dest, x), inv);
                }
                llRemoveInventory(inv);
            }
            else
            {
                llOwnerSay("Please Load Inventory");
            }
            llSleep(5);
            llSetText("",<1,.5,0>, 0);
        }
        if(msg == "Rezzers")
        {
            if(llGetInventoryType("Rezzer") == INVENTORY_SCRIPT)
            {
                llSetText("Updating System Please Wait...",<1,.5,0>, 1);
                llRegionSay(rez_chan, "removeScript");
                llSleep(.5);
                for(x = 0; x < llGetListLength(dest); x++)
                {
                    llRemoteLoadScriptPin(llList2Key(dest, x), "Rezzer", 8324, TRUE, 42);
                }
                //llRemoveInventory("Rezzer");
            }
            else
            {
                llOwnerSay("Please Load Inventory");
            }
            llSleep(5);
            llSetText("",<1,.5,0>, 0);
        }
        if(msg == "Config")
        {
            if(llGetInventoryType(config) == INVENTORY_NOTECARD)
            {
                llSetText("Updating System Please Wait...",<1,.5,0>, 1);
                llRegionSay(rez_chan, "removeConfig");
                llSleep(.5);
                for(x = 0; x < llGetListLength(dest); x++)
                {
                    llGiveInventory(llList2Key(dest, x), config);
                }
                //llRemoveInventory(inv);
            }
            else
            {
                llOwnerSay("Please Load Config");
            }
            llSleep(5);
            llSetText("",<1,.5,0>, 0);
        }
    }
    changed(integer change)
    {
        if(change == CHANGED_INVENTORY)
        {

            llOwnerSay("num lines");
            updateServerConfig();
        }
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
            dest += llGetSubString(data, -36, -1);
            i++;
            if( i < lines)
                llGetNotecardLine(config, i);
            else
                llOwnerSay("done");
        }
    }
}
