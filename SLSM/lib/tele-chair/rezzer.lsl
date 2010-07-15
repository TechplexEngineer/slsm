//Version 2.5.1


key     agent;
key     avatar;
integer server_chan = 30;
integer chair_chan = 25;
integer rez_chan = 5;
new()
{
    llWhisper(chair_chan, "removeself");
    vector new = llGetPos();
    new.x += 1;
    new.y -= .75;
    llRezObject("Tele-Chair", new, ZERO_VECTOR,  <0.00000, 0.00000, -0.70711, 0.70711>, 42);
}
integer set = 0;
default
{
    state_entry()
    {
        llSetRemoteScriptAccessPin(8324);
        new();
        llListen(rez_chan, "", NULL_KEY,"");  //menu
        llOwnerSay((string)llGetKey());
        llSetText("BBI Teleprt System \n Sit in chair to begin.", <1,.5,0>, 0);
    }
    on_rez(integer abcd123)
    {
        llOwnerSay("Welcome to the Setup Wizard, \n
        Please use the build menu to position me \n
        Then in the general tabo go the build menu change my description to the name of the teleport location,\n
        When you are done click me, and select \"set\"");
    }

    touch_start(integer total_number)
    {
        if(llDetectedKey(0) == llGetOwner() && set < 1)
            llDialog(llGetOwner(), "Are you Done?", ["Set"],rez_chan);
        else
        {
            // Rez a chair on right
            llSay(0, "You may need to click the chair before the menu apears");
            //check if a chair is already there.
            new();
        }
    }

    listen (integer channel,string name, key id, string message)
    {
        if(message == "Set")
        {
            set++;
            new();
            llOwnerSay("Configuration information for this station:");
            vector new = llGetPos();
            new.x -= 1;
            new.y -= .75;
            llOwnerSay(llGetObjectDesc()+"|"+(string)new+"|"+(string)llGetKey());
        }
        if (message == "new")
        {
            new();
        }
        if (message == "clear")
        {
            llWhisper(chair_chan, "removeself");
            llSetText("", <1,.5,0>, 1);
        }
        //Unused
        if(message == "key")
        {
            llRegionSay(server_chan,"new|"+(string)llGetKey());
        }
         //Used for update
         if (message == "removeChair")
        {
            llSetText("Updating System, please wait...", <1,.5,0>, 1);
            llWhisper(chair_chan, "removeself");
            if ( llGetInventoryType("Tele-Chair") != -1)
                llRemoveInventory("Tele-Chair");
            if ( llGetInventoryType("Tele-Chair 1") != -1)
                llRemoveInventory("Tele-Chair 1");
            if ( llGetInventoryType("Tele-Chair 2") != -1)
                llRemoveInventory("Tele-Chair 2");
        }
        if(message == "removeScript")
        {
            llSetText("Updating System, please wait...", <1,.5,0>, 1);
            llWhisper(chair_chan, "removeself");
            if ( llGetInventoryType("Rezzer") != -1)
                llRemoveInventory("Rezzer");

        }
        if (message == "removeConfig")
        {
            llSetText("Updating System, please wait...", <1,.5,0>, 1);
            llWhisper(chair_chan, "removeself");
            if ( llGetInventoryType("config") != -1)
                llRemoveInventory("config");

        }
        // end update stf
    }
    object_rez(key id)
    {
        llGiveInventory(id, "config");
    }
    changed(integer change)
    {
        if (change && CHANGED_INVENTORY)
        {
            //llWhisper(chair_chan, "removeself");
            llSleep(5);
            llSetText("", <1,.5,0>, 1);
            new();
            llSleep(1);
            llSetText("Done ... Resuming Normal Functions...", <1,.5,0>, 1);
            llSleep(5);
            llSetText("", <1,.5,0>, 1);
        }
    }
}
