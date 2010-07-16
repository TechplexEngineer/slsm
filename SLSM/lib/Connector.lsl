string comms = "http://techwizworld.net/SLSM/";
key httpid;
key chan;
integer myid;
default
{
    on_rez(integer ret)
    {
        llResetScript(); // Reset if when we rez
    }
    state_entry()
    {
        if (llGetObjectDesc() == "" | llGetObjectDesc() == " ") // Is the object description empty? Ok lets generate a random ID
        {
            myid = llRound(llFrand(99999));
            llSetObjectDesc((string)myid);
        }
        else // I already have an ID
        {
            myid = (integer)llGetObjectDesc();
        }
        llOpenRemoteDataChannel(); // Opening a remote data channel

    }


     remote_data(integer type, key channel, key uid, string from, integer integerValue, string stringValue)
      {
        if (type == REMOTE_DATA_CHANNEL) {
        chan = channel; // Channel has been defined
        string region = llEscapeURL(llGetRegionName());
        string obj = llEscapeURL(llGetObjectName());

      httpid = llHTTPRequest(comms + "manageserver.php?cmd=store&name="+obj+"&region="+region+"&key="+(string)llGetKey()+"&xml="+(string)chan+"&id="+(string)myid+"&time="+(string)llGetUnixTime()+"&pos="+(string)llGetPos(), [], ""); // Store information about the server

        state getconf; // Moving on to retrieve the configuration
        }
    }
}
state getconf
{
    state_entry()
    {
        httpid = llHTTPRequest(comms+"retrieve.php?cmd=getconf", [], "");
    }
    http_response(key reqid, integer status, list meta, string data)
    {

        list temp = llCSV2List(data);
        integer length = llGetListLength(temp); // Convert data into a usable list from webserver
        integer x;
        if (llList2String(temp,0) == "conf") // Does the list start with conf? Then it is our configuration line
        {
            for (x=1; x < length; x++) // Run a check for certain variables offset by +1 because conf is at the start of the line
            {
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                llOwnerSay("Value " + llList2String(temp,x));
                if (llList2String(temp,x) == "adrot") // We have found a variable that we want
                {
                    x++; //// - Genius
                    integer tempint = llList2Integer(temp,x);
                    llOwnerSay("I got one of your config values + '"+(string)tempint+"'"); // Do some crazy stuff here

                }
                else if (llList2String(temp,x) == "test1") // We have found another variable we want
                {
                   x++;
                    llOwnerSay(llList2String(temp,x));
                    integer tempint = llList2Integer(temp,x);

                    llOwnerSay("I got one of your config values + '"+(string)tempint+"'");


                }

            }
            state online; // Finished reading startup configuration.. Moving on
        }
    }
}

state online
{
    on_rez(integer ret)
    {
        llResetScript(); // Reset if when we rez
    }
    state_entry()
    {
        llOwnerSay("Information Stored.");
        llSetTimerEvent(240); // Sent a sync timer - I recommend pulling this time from the website

    }
    remote_data(integer type, key channel, key uid, string from, integer integerValue, string stringValue)
    {

        if (type == REMOTE_DATA_REQUEST)
        {
            if (integerValue == 1)
            {
                llDie(); // Web server asked me to die :(
            }
            else if (integerValue == 2)
            {
                llResetScript();// Web server asked me to reset
            }
            else if (integerValue == 3) // Web server has requested a syncronisation
            {
                string region = llEscapeURL(llGetRegionName());
        string obj = llEscapeURL(llGetObjectName());
              httpid = llHTTPRequest(comms + "manageserver.php?cmd=store&name="+obj+"&region="+region+"&key="+(string)llGetKey()+"&xml="+(string)chan+"&id="+(string)myid+"&time="+(string)llGetUnixTime()+"&pos="+(string)llGetPos(), [], "");
httpid = llHTTPRequest(comms+"retrieve.php?cmd=getconf", [], "");
            }
            else if (integerValue == 4) // Web server has asked to disabled me
            {
                state offline;
            }
            else if (integerValue == 6) // Web server has sent floating text information
            {
                llSetText(stringValue,<1,1,1>,1);
            }

        }

    }
     http_response(key reqid, integer status, list meta, string data) // Retrieve configuration information
    {

        list temp = llCSV2List(data);
        integer length = llGetListLength(temp);
        integer x;
        if (llList2String(temp,0) == "conf")
        {
            for (x=1; x < length; x++)
            {

                if (llList2String(temp,x) == "adrot")
                {
                    x++;
                    integer tempint = llList2Integer(temp,x);
                    llOwnerSay("I got one of your config values + '"+(string)tempint+"'");

                }
                else if (llList2String(temp,x) == "test1")
                {
                   x++;
                    llOwnerSay(llList2String(temp,x));
                    integer tempint = llList2Integer(temp,x);

                    llOwnerSay("I got one of your config values + '"+(string)tempint+"'");


                }
                else if (llList2String(temp,x) == "test2")
                {
                    x++;
                    integer tempint = llList2Integer(temp,x);
                    llOwnerSay("I got one of your config values + '"+(string)tempint+"'");

                }
            }
            state online;
        }
    }

    timer()
    {
        string region = llEscapeURL(llGetRegionName());
        string obj = llEscapeURL(llGetObjectName());
         httpid = llHTTPRequest(comms + "manageserver.php?cmd=store&name="+obj+"&region="+region+"&key="+(string)llGetKey()+"&xml="+(string)chan+"&id="+(string)myid+"&time="+(string)llGetUnixTime()+"&pos="+(string)llGetPos(), [], "");
}
}

state offline
{
    on_rez(integer ret)
    {
        llResetScript(); // Reset if when we rez
    }
    state_entry()
    {

    }
    remote_data(integer type, key channel, key uid, string from, integer integerValue, string stringValue)
    {
        if (type == REMOTE_DATA_REQUEST)
        {
            if (integerValue == 1)
            {
                llDie(); // Web server asked me to die :(
            }
            else if (integerValue == 2)
            {
                llResetScript(); // Web server asked me to reset
            }
            else if (integerValue == 3)
            {
                string region = llEscapeURL(llGetRegionName());
        string obj = llEscapeURL(llGetObjectName());
               httpid = llHTTPRequest(comms + "manageserver.php?cmd=store&name="+obj+"&region="+region+"&key="+(string)llGetKey()+"&xml="+(string)chan+"&id="+(string)myid+"&time="+(string)llGetUnixTime()+"&pos="+(string)llGetPos(), [], "");
httpid = llHTTPRequest(comms+"retrieve.php?cmd=getconf", [], "");
            }
            else if (integerValue == 5)
            {
                state online;
            }
            else if (integerValue == 6)
            {
                llSetText(stringValue,<1,1,1>,1);
            }

        }
        else {
            // Code would go here to respond to a new open channel, etc...
            // Check the options for 'type' in the LSL Wiki.
        }
    }
     http_response(key reqid, integer status, list meta, string data)
    {

        list temp = llCSV2List(data);
        integer length = llGetListLength(temp);
        integer x;
        if (llList2String(temp,0) == "conf")
        {
            for (x=1; x < length; x++)
            {

                if (llList2String(temp,x) == "adrot")
                {
                    x++;
                    integer tempint = llList2Integer(temp,x);
                    llOwnerSay("I got one of your config values + '"+(string)tempint+"'");

                }
                else if (llList2String(temp,x) == "test1")
                {
                   x++;
                    llOwnerSay(llList2String(temp,x));
                    integer tempint = llList2Integer(temp,x);

                    llOwnerSay("I got one of your config values + '"+(string)tempint+"'");


                }
                else if (llList2String(temp,x) == "test2")
                {
                    x++;
                    integer tempint = llList2Integer(temp,x);
                    llOwnerSay("I got one of your config values + '"+(string)tempint+"'");

                }
            }
            state online;
        }
    }
}




