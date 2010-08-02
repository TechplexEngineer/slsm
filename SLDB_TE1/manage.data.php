<h3>Variable Management</h3>
<form action="" method="get" name="form1" id="form1">
    <h5>Current Variables:</h5>
    <table border="1px" width="100%">
        <tr>
            <th>Name:</th>
            <th>Value:</th>
            <th>Delete:</th>

        </tr>


        <?php
        $getsql = "SELECT * FROM `sldb_data` WHERE creator='" . $_SESSION['uuid'] . "' ";
        $getqry = mysql_query($getsql) or die(mysql_error());
        while ($row = mysql_fetch_assoc($getqry))
        {
            $setname = $row['config_name'];
            $setvalue = $row['config_value'];
            $sysvar = $row['sys_var'];
            echo "<tr>";
            echo "<td>";
            echo "<label for='$setname'>$setname</label>";
            echo "</td>";
            echo "<td>";
            echo "<input name='$setname' type='text' id='$setname' value='$setvalue'  />";
            echo "</td>";
            echo "<td>";
            if ($sysvar)
                echo "System Varibles can not be deleted";
            else
                echo "<a href=\"varconf.php?cmd=del&name=$setname\" OnClick=\"return confirm('Are you sure you want to delete $setname? This change will not be reflected until the servers next syncronisation phase.');\"><img src=\"img/cross.gif\" border\"0\"></a><br/>";


            echo "</td>";
            echo "</tr>";
        }
        ?>

    </table>
    <label for="submit"></label>
    <input type="submit" name="cmd" id="cmd" value="Save Changes" />


</form>
<br/><hr/><br/>
<form id="form2" name="form2" method="get" action="">
    <h5>Add a Variable:</h5>
    <table>
        <tr>
            <td>
                <label for="confname">Name:</label>
                <input type="text" name="confname" id="confname" />
            </td>
            <td>
                <label for="confval">Value:</label>
                <input type="text" name="confval" id="confval" />
            </td>
            <td>
                <label for="sysvar">System Variable:</label>
                <input type="checkbox" name="sysvar" value="true" />
            </td>
        </tr>
        <tr>
            <td>
                <label for="Add"></label>
                <input type="submit" name="cmd" id="cmd" value="Add" />
            </td>
        </tr>
    </table>
</form>
<p>&nbsp;</p>